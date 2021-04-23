<?php

namespace App\Admin\Controllers;

use Dcat\Admin\FormStep\Form as StepForm;
use Dcat\Admin\Form;
use Dcat\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use App\Admin\Traits\Importfields;
use Dcat\Admin\Widgets\Alert;
use Dcat\EasyExcel\Excel;
use App\Jobs\ImportData;

class ImportController extends Controller
{
    use Importfields;
    public function index(Content $content)
    {
        return $content
            // ->body('<div style="margin:5px 0 15px;">'.$this->buildPreviewButton().'</div>')
            ->body($this->form())
            ->header('导入数据')
            ->description('导入本地数据');
    }

    protected function form()
    {
        return new Form(null, function (Form $form) {
            $form->title('导入数据');
            $form->action('import/form');
            $form->disableListButton();
            $form->file('file', '数据文件')->disk('tmp');
            $form->multipleSteps()
                ->remember()
                ->width('950px')
                ->add('基本信息', function (StepForm $step) {
                    $step->number('titlelist', '标题行')->required()->attribute('min', 1)->default(1)->help('execl中每列标题所在的行，一般为第1行');
                    $step->radio('modeltype', '数据类型')->options([
                        'lead' => '线索',
                        'customer' => '客户',
                        // 'contract' => '合同',
                        // 'contact' => '联系人'
                        ])->default('lead')->required()->help('选择数据类型');
                    // $step->radio('repeat', '重复数据')->options(['覆盖', '跳过', '增加'])->default(0)->help('对重复数据的处理');
                    $step->file('file', '数据文件')->required()->rules('mimes:xlsx,csv,ods')->accept('xlsx,csv')->disk('tmp')->autoUpload();
                })
                ->add('对应关系', function (StepForm $step) {


                    // 对应关系提醒
                    $info = '<i class="fa fa-exclamation-circle"></i>重要提醒<br/> <br/> 请设置字段与您导入的表格列名称的对应关系。<br/>左侧为网站中内置的字段，右侧下拉选择为您刚才导入的表格列名称。<br/>建议不要重复设置，不要将一个表格列分配给两个字段。';
                    $step->html(Alert::make($info)->info());


                    // 获取导入的文件并且转为数组
                    if (isset(session('step-form-input:import')['file'])) {
                        $detatable = Excel::import(storage_path('tmp/' . session('step-form-input:import')['file']))->first()->toArray();
                    } else {
                        $detatable = [];
                    }


                    // 获取表格的标题行
                    $detatable_title = [];
                    if (!empty($detatable)) {
                        foreach (current($detatable) as $k => $v) {
                            $detatable_title[$k] = $k;
                        }
                    }


                    // 判断session是否存在，如果存在，那么继续判断模型选择是否为lead,因为lead和customer用的都是customer
                    if (isset(session('step-form-input:import')['modeltype'])) {
                        $modelname = (session('step-form-input:import')['modeltype'] != 'lead') ? (session('step-form-input:import')['modeltype']) : ('customer');
                    } else {
                        $modelname = 'customer';
                    }

                    // 循环模型本身的字段,并且将模型字段对应表格列
                    foreach ($this->Importfield($modelname) as $k => $v) {
                        if ($k != 'fields') {
                            $step->select($k, $v)->options($detatable_title);
                        }
                    }

                    // 判断模型自定义字段是否存在，存在则循环自定义字段，,并且将模型字段对应表格列
                    if (isset($this->Importfield($modelname)['fields'])) {
                        foreach ($this->Importfield($modelname)['fields'] as $k => $v) {
                            $step->select($k, $v)->options($detatable_title);
                        }
                    }

                    $step->shown(function () {
                        return <<<JS
                    setTimeout(function () {
                    Dcat.reload();
                    }, 0);
        JS;
                    });
                })
                ->done(function () use ($form) {
                    $resource = $form->resource(0);
                    $data = [
                        'title'       => '操作成功',
                        'description' => '恭喜您，信息被成功导入',
                        'createUrl'   => $resource,
                        'backUrl'     => $resource,
                    ];
                    return view('dcat-admin.form-step::completion-page', $data);
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
        return $this->form()->saving(function (Form $form) {
            // 清空缓存
            $form->multipleSteps()->flushStash();
            // 推送任务到队列
            $forminput = $form->input();
            dispatch(new ImportData($forminput));
            // dd($tmptable);
            return response(
                $form->multipleSteps()
                    ->done()
                    ->render()
            );
        })->store();
    }
}
