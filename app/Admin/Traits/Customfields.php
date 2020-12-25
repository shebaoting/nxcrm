<?php

namespace App\Admin\Traits;

use Dcat\Admin\Grid;
use App\Models\CrmCustomfield;
use Dcat\Admin\Form;

trait Customfields
{

    protected function custommodel($modelname)
    {
        $fields = CrmCustomfield::where([['model', '=', $modelname], ['show', '=', '1']])->orderBy('sort', 'desc')->get();
        // return dd($fields);
        return $fields;
    }

    protected function gridfield(Grid $grid, $modelname)
    {
        $fields = CrmCustomfield::where([['model', '=', $modelname], ['show', '=', '1'], ['iflist', '=', '1']])->orderBy('sort', 'desc')->get();
        foreach ($fields as $field) {
            $grid->column($field['field'], $field['name'])->display(function () use ($field) {
                $form_fields = json_decode($this->fields);
                $field_options = json_decode($field['options'], true);
                $field_field = $field['field'];
                if (isset($this->fields) && isset($form_fields->$field_field)) {
                    if (in_array($field['type'], ['select', 'radio'])) {
                        $value = $field_options[$form_fields->$field_field];
                    } elseif (in_array($field['type'], ['checkbox', 'multipleSelect'])) {

                        $valuearr = [];
                        foreach (array_filter($form_fields->$field_field) as $k => $v) {
                            $valuearr[] = $field_options[$v];
                        }
                        $value = implode(" ", $valuearr);
                    } elseif (in_array($field['type'], ['switch'])) {
                        $value = $form_fields->$field_field ? '是' : '否';
                    } else {
                        $value = $form_fields->$field_field;
                    }
                } else {
                    $value = '';
                }
                return $value;
            });
        }
        return;
    }

    protected function formfield(Form $form, $modelname)
    {
        foreach ($this->custommodel($modelname) as $field) {
            $field_type = $field['type'];
            $field_field = $field['field'];
            $field_name = $field['name'];
            $form_field = $form->$field_type($field_field, $field_name)->help($field['help']);


            // 如果是编辑状态，取出数据库的值
            if ($form->isEditing()) {
                $form_fields = json_decode($form->model()->fields);
                if (isset($form->model()->fields) && isset($form_fields->$field_field)) {
                    $form_fields_default = $form_fields->$field_field;
                } else {
                    $form_fields_default = '';
                }
            }
            if ($field['options']) {
                $field_options = json_decode($field['options'], true);
            }

            if ($field['required'] && $field['options']) {

                if ($form->isCreating()) {
                    $form_field->options($field_options)->required();
                } elseif ($form->isEditing()) {
                    $form_field->options($field_options)->default($form_fields_default, true)->required();
                } else {
                }
            } elseif ($field['required']) {

                if ($form->isCreating()) {
                    $form_field->required();
                } elseif ($form->isEditing()) {
                    $form_field->value($form_fields_default)->required();
                } else {
                }
            } elseif ($field['options']) {


                if ($form->isCreating()) {
                    $form_field->options($field_options);
                } elseif ($form->isEditing()) {
                    $form_field->options($field_options)->default($form_fields_default, true);
                } else {
                }
            } else {

                if ($form->isCreating()) {
                    $form_field;
                } elseif ($form->isEditing()) {
                    $form_field->value($form_fields_default);
                } else {
                }
            }
        }
        return;
    }
}
