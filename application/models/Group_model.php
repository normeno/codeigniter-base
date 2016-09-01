<?php

class Group_model extends CI_Model implements DatatableModel
{
    public function appendToSelectStr()
    {
        return null;
    }

    public function fromTableStr() {
        return 'groups g';
    }

    public function joinArray(){
        return null;
    }

    public function whereClauseArray()
    {
        return null;
    }


}