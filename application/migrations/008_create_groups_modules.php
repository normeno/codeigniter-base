<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_groups_modules extends CI_Migration
{
    /**
     * @var string
     */
    private $tableName = 'groups_modules';

    /**
     * Up Table
     */
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'group_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'module_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ));

        $this->dbforge->add_key('id', true);

        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (group_id) REFERENCES groups(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (module_id) REFERENCES modules(id)');

        $this->dbforge->create_table($this->tableName);

        $this->insert();
    }

    /**
     * Down Table
     */
    public function down()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS=0;');
        $this->dbforge->drop_table($this->tableName);
        $this->db->query('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Insert Data
     */
    public function insert()
    {
        /*
         * Modules: 1 => Administration; 3 => Users; 6 => Dashboard
         * Groups: 1 => Developer; 2 => Admin; 3 => General
         */
        $data = [
            ['group_id' => 1, 'module_id' => 1],
            ['group_id' => 1, 'module_id' => 2],
            ['group_id' => 1, 'module_id' => 3],
            ['group_id' => 1, 'module_id' => 4],
            ['group_id' => 1, 'module_id' => 5],
            ['group_id' => 1, 'module_id' => 6],
            ['group_id' => 1, 'module_id' => 7],
            ['group_id' => 2, 'module_id' => 1],
            ['group_id' => 2, 'module_id' => 2],
            ['group_id' => 2, 'module_id' => 3],
            ['group_id' => 2, 'module_id' => 4],
            ['group_id' => 2, 'module_id' => 5],
            ['group_id' => 2, 'module_id' => 6],
            ['group_id' => 2, 'module_id' => 7],
        ];

        $this->db->insert_batch($this->tableName, $data);
    }
}