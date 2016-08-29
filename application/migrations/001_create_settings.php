<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_settings extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'short_name' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => false,
            ],
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
                'null' => false,
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'website' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ],
            'contact_email' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => true,
            ],
        ]);

        $this->dbforge->add_key('id', true);

        $this->dbforge->create_table('settings');

        $data = [
            'short_name' => 'Krei',
            'full_name' => 'Krei',
            'logo' => null,
            'website' => 'http://www.krei.cl',
            'contact_email' => 'hola@krei.cl'
        ];

        $this->db->insert('settings', $data);
    }

    public function down()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS=0;');
        $this->dbforge->drop_table('settings');
        $this->db->query('SET FOREIGN_KEY_CHECKS=1;');
    }
}