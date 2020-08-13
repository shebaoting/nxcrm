<?php

namespace App\Admin\Contracts;


abstract class SettingsContract

{
    protected $isRefresh = false;

    abstract function all();


    function set( $key , $value ) {
        $this->isRefresh = true;
        //TODO broadcast the event .
    }

    function delete( $key ) {
        $this->isRefresh = true;
        //TODO broadcast the event .
    }



    public function needRefresh() {
        return $this->isRefresh;
    }

}