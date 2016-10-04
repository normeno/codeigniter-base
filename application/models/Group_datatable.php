<?php

class Group_datatable extends CI_Model implements DatatableModel
{
    public function appendToSelectStr() {
        return [];
    }

    public function fromTableStr() {
        return 'groups g';
    }

    public function joinArray(){
        return [];
    }

    public function whereClauseArray()
    {
        return [];
    }
}