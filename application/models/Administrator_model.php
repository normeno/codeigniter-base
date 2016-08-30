<?php

/**
 * Created by PhpStorm.
 * User: normeno
 * Date: 29-08-16
 * Time: 17:23
 */
class Administrator_model extends CI_Model implements DatatableModel
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
        return NULL;
    }

    public function whereClauseArray(){
        return NULL;
    }
}