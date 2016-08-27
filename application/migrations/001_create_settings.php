<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_settings extends CI_Migration
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
            'short_name' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => false,
            ],
            'long_name' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
                'null' => false,
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
        ));

        $this->dbforge->add_key('id', true);

        $this->dbforge->create_table('settings');
    }

    public function down()
    {
        $this->dbforge->drop_table('settings');
    }
}