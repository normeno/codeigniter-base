<?php

class Administrator_datatable extends CI_Model implements DatatableModel
{
    public function appendToSelectStr() {
        return array(
            'full_name' => 'concat(u.first_name, \' \', u.last_name)'
        );
    }

    public function fromTableStr() {
        return 'users u';
    }

    public function joinArray(){
        return [
            'users_groups ug' => 'ug.user_id = u.id'
        ];
    }

    public function whereClauseArray()
    {
        return [
            'ug.group_id' => 2
        ];
    }
}