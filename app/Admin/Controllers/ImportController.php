<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Widgets\Card;
use Dcat\Admin\FormStep\Form as StepForm;
use Dcat\Admin\Form;
use Dcat\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Dcat\Admin\Widgets\Alert;

class ImportController extends Controller
{
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
            $form->file('file', '数据文件');
            $form->multipleSteps()
                ->remember()
                ->width('950px')
                ->add('基本信息', function (StepForm $step) {
                    // $info = '<i class="fa fa-exclamation-circle"></i> 表单字段支持前端验证和后端验证混用，前端验证支持H5表单验证以及自定义验证。';
                    // $step->html(Alert::make($info)->info());
                    $step->number('titlelist', '标题行')->required()->attribute('min', 1)->default(1)->help('execl中每列标题所在的行，一般为第1行');
                    $step->radio('model', '数据类型')->options(['客户', '合同', '联系人'])->default(0)->help('选择数据类型');
                    $step->radio('repeat', '重复数据')->options(['覆盖', '跳过', '增加'])->default(0)->help('对重复数据的处理');
                    $step->file('file', '数据文件')->required()->rules('mimes:xlsx,csv,ods')->autoUpload();
                })
                ->add('数据设置', function (StepForm $step) {
                    $step->tags('hobbies', '爱好')
                        ->options(['唱', '跳', 'RAP', '踢足球'])
                        ->required();
                    $step->text('books', '书籍');
                    $step->text('music', '音乐');

                })
                ->add('地址', function (StepForm $step) {
                    $step->text('address', '街道地址');
                    $step->text('post_code', '邮政编码');
                    $step->tel('tel', ' 联系电话');
                })
                ->done(function () use ($form) {
                    $resource = $form->resource(0);
                    // dd($resource);
                    $data = [
                        'title'       => '操作成功',
                        'description' => '恭喜您成为第10086位用户',
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
            // 拦截保存操作
            return response(
                $form->multipleSteps()
                    ->done()
                    ->render()
            );
        })->store();
    }

}
