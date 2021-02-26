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
                    $step->number('titlelist', '标题行')->required()->attribute('min', 1)->default(1)->help('execl中每列标题所在的行，一般为第1行');
                    $step->radio('model', '数据类型')->options(['lead' => '线索', 'customer' => '客户', 'contract' =>'合同', 'contact' =>'联系人'])->default(0)->help('选择数据类型');
                    $step->radio('repeat', '重复数据')->options(['覆盖', '跳过', '增加'])->default(0)->help('对重复数据的处理');
                    $step->file('file', '数据文件')->required()->rules('mimes:xlsx,csv,ods')->autoUpload();
                })
                ->add('对应关系', function (StepForm $step) {
                    //   dd(session('step-form-input:import')['file']);
                    $info = session('step-form-input:import')['model'];
                    $step->html(Alert::make($info)->info());
                    $step->select('test2', '客户名称')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
                    $step->select('test1', '客户名称')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
                    $step->select('test1', '客户名称')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
                    $step->select('test1', '客户名称')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
                    $step->select('test1', '客户名称')->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name']);
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
