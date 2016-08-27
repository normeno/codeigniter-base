<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_login_attempts extends CI_Migration
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
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => false,
            ],
            'time' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
        ));

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('login_attempts');
    }

    public function down()
    {
        $this->dbforge->drop_table('login_attempts');
    }
}