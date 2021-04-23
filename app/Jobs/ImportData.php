<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Dcat\EasyExcel\Excel;
use App\Admin\Traits\Importfields;
use Dcat\Admin\Admin;

class ImportData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Importfields;

    protected $form, $formUser;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($formInput,$formUser)
    {
        $this->form = $formInput;
        $this->formUser = $formUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
            // 对表格数据进行转数组处理
            $rows = Excel::import(storage_path('tmp/'.$this->form['file']))->headingRow($this->form['titlelist'])->first()->toArray();


            // 根据选择获取数据为客户还是线索
            if ($this->form['modeltype'] == 'lead') {
                $detaState = 1;
            } elseif ($this->form['modeltype'] == 'customer') {
                $detaState = 3;
            }


            // 根据选择获取模型
            if ($this->form['modeltype'] == 'contact') {
                $detaname = 'crm_contacts';
                $this->form['modeltype'] = 'contact';
            } elseif ($this->form['modeltype'] == 'contract') {
                $detaname = 'crm_contracts';
                $this->form['modeltype'] = 'contract';
            } else {
                $detaname = 'crm_customers';
                $this->form['modeltype'] = 'customer';
            }
            // 将表格的数据处理成符合导入条件的数组
            $tmptable = array();
            foreach ($rows as $row) {

                $tmpdeta = array();

                // 循环模型本身的字段,并且将模型字段对应表格列
                foreach ($this->Importfield($this->form['modeltype']) as $k => $v) {
                    if ($k != 'fields') {
                        $tmpdeta[$k] = $row[$this->form[$k]];
                    }
                }
                // 判断模型自定义字段是否存在，存在则循环自定义字段，,并且将模型字段对应表格列
                $tmp = array();
                if (isset($this->Importfield($this->form['modeltype'])['fields'])) {
                    foreach ($this->Importfield($this->form['modeltype'])['fields'] as $k => $v) {
                        $tmp[$k] = $row[$this->form[$k]];
                    }
                }
                $tmpdeta['fields'] = json_encode($tmp);
                $tmpdeta['created_at'] = Carbon::now()->toDateTimeString();
                $tmpdeta['updated_at'] = Carbon::now()->toDateTimeString();
                if($this->form['modeltype'] == 'customer'){
                    $tmpdeta['state'] = $detaState;
                    $tmpdeta['admin_user_id'] = $this->formUser;
                }

                array_push($tmptable,$tmpdeta);
            }
            DB::table($detaname)->insert($tmptable);
    }
}
