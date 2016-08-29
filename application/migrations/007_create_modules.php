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
            'route' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => false,
            ],
        ));

        $this->dbforge->add_key('id', true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (module_id) REFERENCES modules(id)');

        $this->dbforge->create_table('modules');
    }

    public function down()
    {
        $this->dbforge->drop_table('modules');
    }
}