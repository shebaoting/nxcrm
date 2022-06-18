<?php

namespace App\Admin\Controllers;

use Dcat\Admin\FormStep\Form as StepForm;
use Dcat\Admin\Form;
use Dcat\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Dcat\Admin\Widgets\Alert;
use App\Admin\Renderable\ContractTable;
use App\Admin\Renderable\ModelContract;
use App\Models\CrmContract;
use App\Models\CrmModelcontract;
use PhpOffice\PhpWord\TemplateProcessor;
use Dcat\Admin\Admin;
use Illuminate\Http\Request;

class BuildContractsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->contract_id = $request->contract_id;
        return $this;
    }

    public function index(Content $content)
    {
        return $content
            // ->body('<div style="margin:5px 0 15px;">'.$this->buildPreviewButton().'</div>')
            ->body($this->form())
            ->header('生成合同')
            ->description('一键生成信息完备的合同');
    }

    protected function form()
    {
        return new Form(null, function (Form $form) {
            $form->title('生成合同');

            $form->action('buildContracts/form');
            $form->disableListButton();
            $form->file('file', '数据文件')->disk('tmp');
            $form->multipleSteps()
                ->remember()
                ->width('950px')
                ->add('准备工作', function (StepForm $step) {

                    // 合同变量
                    $info = '<i class="fa fa-exclamation-circle"></i> 生成步骤<br/> <br/> 第一步：将合同的word文档打开，将里面的关键部分用以下表格中的变量替代。<br/> 第二步：保存制作好的word文档，并且上传在后台的合同范本中。<br/> 第三步：在下方选择合同信息来源以及您上传的合同范本，点击提交即可生成新的合同。下载打印即可。<br/><br/> 需注意：生成的合同并不会永久保存，页面关闭后，生成的合同也将删除，所以生成合同后请及时下载，如不小心关闭掉页面，那么需要重新生成。';
                    $step->html(Alert::make($info)->info());
                    $step->html(view('admin.partials.buildcontracts-contract'));
                })
                ->add('合同设置', function (StepForm $step) {

                    // $step->radio('数据来源')
                    //     ->when(1, function (StepForm $step) {
                    //         $step->selectTable('crm_contract_id', '合同来源')
                    //             ->title('选择当前发票所属合同')
                    //             ->dialogWidth('50%') // 弹窗宽度，默认 800px
                    //             ->from(ContractTable::make(['id' => $step->getKey()])) // 设置渲染类实例，并传递自定义参数
                    //             ->model(CrmContract::class, 'id', 'title') // 设置编辑数据显示
                    //             ->default($this->contract_id);

                    //         $step->selectTable('model_contract_id', '合同范本')
                    //             ->title('选择要生成的合同范本')
                    //             ->dialogWidth('50%') // 弹窗宽度，默认 800px
                    //             ->from(ModelContract::make(['id' => $step->getKey()])) // 设置渲染类实例，并传递自定义参数
                    //             ->pluck('title', 'id');
                    //     })
                    //     ->when(2, function (StepForm $step) {
                    //         $step->editor('editor');
                    //     })
                    //     ->options([
                    //         1 => '从合同生成',
                    //         2 => '从客户生成',
                    //     ])
                    //     ->default(1);

                    $step->selectTable('crm_contract_id', '合同来源')
                    ->title('选择当前发票所属合同')
                    ->dialogWidth('50%') // 弹窗宽度，默认 800px
                    ->from(ContractTable::make(['id' => $step->getKey()])) // 设置渲染类实例，并传递自定义参数
                    ->model(CrmContract::class, 'id', 'title') // 设置编辑数据显示
                    ->default($this->contract_id);

                $step->selectTable('model_contract_id', '合同范本')
                    ->title('选择要生成的合同范本')
                    ->dialogWidth('50%') // 弹窗宽度，默认 800px
                    ->from(ModelContract::make(['id' => $step->getKey()])) // 设置渲染类实例，并传递自定义参数
                    ->pluck('title', 'id');
                })
                ->done(function () use ($form) {
                    $resource = $form->resource(0);
                    $data = [
                        'title'       => '操作成功',
                        'description' => '恭喜您，合同已经被生成，您可以点击按钮查看文件',
                        'createUrl'   => $resource,
                        'backUrl'     => $resource,
                    ];
                    return view('admin.partials.form-step', $data);
                });
        });
    }

    /**
     * 保存
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store()
    {
        $current_this = $this;
        return $this->form()->saving(function (Form $form) use($current_this) {
            // 清空缓存
            $form->multipleSteps()->flushStash();
            // 获取表单提交的数据
            $forminput = $form->input();


            $model = CrmContract::find($forminput['crm_contract_id']);

            // 合同范文地址
            $modelcontract = CrmModelcontract::find($forminput['model_contract_id'])->content;
            $modelcontract_paths = storage_path().'/app/public/'.$modelcontract;

            // 声明一个模板对象、读取模板
            $templateProcessor = new TemplateProcessor($modelcontract_paths);

            $party_a = $model->CrmCustomer->name; // 甲方
            $party_b = admin_setting('company_name');// 乙方全称
            $party_b_company_abbreviation = admin_setting('company_abbreviation');// 乙方简称
            $party_b_company_phone = admin_setting('company_phone');// 乙方公司电话
            $party_b_company_email = admin_setting('company_email');// 乙方公司邮箱
            $party_b_company_address = admin_setting('company_address');// 乙方地址
            $signdate = $model->signdate; // 合同开始日期
            $expiretime = $model->expiretime;// 合同到期日期
            $manager = Admin::user()->name; // 经办人
            $current_date = date("Y年m月d日");
            $total = 0;
            foreach ($model->CrmOrders as $order) {
                $total += abs($order->executionprice * $order->quantity);
            }
            //替换模板中的变量，对应word里的 ${test}
            $templateProcessor->setValues(array(
                '甲方' => $party_a,
                '乙方' => $party_b,
                '乙方简称' => $party_b_company_abbreviation,
                '乙方电话' => $party_b_company_phone,
                '乙方邮箱' => $party_b_company_email,
                '乙方地址' => $party_b_company_address,
                '乙方经办' => $manager,
                '合同开始' => $signdate,
                '合同截止' => $expiretime,
                '当前日期' => $current_date,
                '合同总额小写' => '￥'.$total,
                '合同总额大写' => $current_this->convertAmountToCn($total),
            ));


            //生成新的word
            $templateProcessor->saveAs(storage_path().'/app/public/files/modelcontract.docx');


            return response(
                $form->multipleSteps()
                    ->done()
                    ->render()
            );
        })->store();
    }

    public function convertAmountToCn($amount, $type = 1) {
        // 判断输出的金额是否为数字或数字字符串
        if(!is_numeric($amount)){
            return "要转换的金额只能为数字!";
        }

        // 金额为0,则直接输出"零元整"
        if($amount == 0) {
            return "人民币零元整";
        }

        // 金额不能为负数
        if($amount < 0) {
            return "要转换的金额不能为负数!";
        }

        // 金额不能超过万亿,即12位
        if(strlen($amount) > 12) {
            return "要转换的金额不能为万亿及更高金额!";
        }

        // 预定义中文转换的数组
        $digital = array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖');
        // 预定义单位转换的数组
        $position = array('仟', '佰', '拾', '亿', '仟', '佰', '拾', '万', '仟', '佰', '拾', '元');

        // 将金额的数值字符串拆分成数组
        $amountArr = explode('.', $amount);

        // 将整数位的数值字符串拆分成数组
        $integerArr = str_split($amountArr[0], 1);

        // 将整数部分替换成大写汉字
        $result = '人民币';
        $integerArrLength = count($integerArr);     // 整数位数组的长度
        $positionLength = count($position);         // 单位数组的长度
        $zeroCount = 0;                             // 连续为0数量
        for($i = 0; $i < $integerArrLength; $i++) {
            // 如果数值不为0,则正常转换
            if($integerArr[$i] != 0){
                // 如果前面数字为0需要增加一个零
                if($zeroCount >= 1){
                    $result .= $digital[0];
                }
                $result .= $digital[$integerArr[$i]] . $position[$positionLength - $integerArrLength + $i];
                $zeroCount = 0;
            }else{
                $zeroCount += 1;
                // 如果数值为0, 且单位是亿,万,元这三个的时候,则直接显示单位
                if(($positionLength - $integerArrLength + $i + 1)%4 == 0){
                    $result = $result . $position[$positionLength - $integerArrLength + $i];
                }
            }
        }

        // 如果小数位也要转换
        if($type == 0) {
            // 将小数位的数值字符串拆分成数组
            $decimalArr = str_split($amountArr[1], 1);
            // 将角替换成大写汉字. 如果为0,则不替换
            if($decimalArr[0] != 0){
                $result = $result . $digital[$decimalArr[0]] . '角';
            }
            // 将分替换成大写汉字. 如果为0,则不替换
            if($decimalArr[1] != 0){
                $result = $result . $digital[$decimalArr[1]] . '分';
            }
        }else{
            $result = $result . '整';
        }
        return $result;
    }
}
