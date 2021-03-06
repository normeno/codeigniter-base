<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_companies extends CI_Migration
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
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'website' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ));

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('companies');

        $data = [
            'name' => 'Krei',
            'logo' => null,
            'website' => 'http://www.krei.cl'
        ];

        $this->db->insert('companies', $data);
    }

    public function down()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS=0;');
        $this->dbforge->drop_table('companies');
        $this->db->query('SET FOREIGN_KEY_CHECKS=1;');
    }
}