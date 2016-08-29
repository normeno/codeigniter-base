<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users_groups extends CI_Migration
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
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'group_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ));

        $this->dbforge->add_key('id', true);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (group_id) REFERENCES groups(id)');
        $this->dbforge->create_table('users_groups');

        $this->insert_user();
    }

    public function down()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS=0;');
        $this->dbforge->drop_table('users_groups');
        $this->db->query('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function insert_user()
    {
        $this->load->library(['ion_auth']);

        $email = 'nicolas.ormeno@krei.cl';
        $username = 'normeno';
        $password = '123123';

        $additional_data = [
            'first_name' => 'Nicolás',
            'last_name' => 'Ormeño',
            'company_id' => 1,
            'phone' => '987654321'
        ];

        $group = ['1'];

        $this->ion_auth->register($username, $password, $email, $additional_data, $group);
    }
}