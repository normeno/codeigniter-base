<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_groups extends CI_Migration
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
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
        ));

        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('groups');
    }

    public function down()
    {
        $this->dbforge->drop_table('groups');
    }
}