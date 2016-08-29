<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_modules extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => false,
            ],
            'route' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'module_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'font' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => false,
            ],
        ));

        $this->dbforge->add_key('id', true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (module_id) REFERENCES modules(id)');

        $this->dbforge->create_table('modules');

        $this->insert_modules();
    }

    public function down()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS=0;');
        $this->dbforge->drop_table('modules');
        $this->db->query('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function insert_modules()
    {
        $name  = ['administration', 'site', 'users', 'administrators', 'users'];
        $route = ['#', 'admin/site', '#', 'admin/administrator', 'admin/user'];
        $module = [null, 1, null, 3, 3];
        $font = ['fa-unlock-alt', null, 'fa-users', null, null];

        for ($i=0; $i<count($name); $i++) {
            $data[] = [
                'name' => $name[$i],
                'route' => $route[$i],
                'module_id' => $module[$i],
                'font' => $font[$i]
            ];
        }

        $this->db->insert_batch('modules', $data);
    }
}