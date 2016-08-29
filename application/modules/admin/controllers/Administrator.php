<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends Admin_Controller
{
    public function index()
    {

    }

    /**
     * Creation Form
     */
    public function create()
    {
        $this->form_validation->set_rules('company', 'Company', 'trim|required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim');
        $this->form_validation->set_rules('username', 'Username', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');

        if (!$this->form_validation->run()) {
            $this->render_view('administrator.create', []);
        } else {
            $this->store();
        }
    }


    public function store()
    {
        $email = $this->input->post('email', true);
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $additional_data = [
            'first_name' => $this->input->post('first_name', true),
            'last_name' => $this->input->post('last_name', true),
            'company_id' => $this->input->post('company', true),
            'phone' => $this->input->post('phone', true)
        ];

        $group = ['1']; // Sets user to admin.

        $create = $this->ion_auth->register($username, $password, $email, $additional_data, $group);

        var_dump($create);
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('company', 'Company', 'trim|required');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim');
        $this->form_validation->set_rules('username', 'Username', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|matches[password]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');

        if (!$this->form_validation->run()) {
            $id = $this->uri->segment(4);
            $user = $this->ion_auth->user($id)->row();
            $companies = $this->db->get('companies')->result();
            $this->render_view('administrator.edit', ['id' => $id, 'user' => $user, 'companies' => $companies]);
        } else {
            $this->update($id);
        }
    }

    public function update($id)
    {
        $data = [
            'email' => $this->input->post('email', true),
            'username' => $this->input->post('username', true),
            'first_name' => $this->input->post('first_name', true),
            'last_name' => $this->input->post('last_name', true),
            'company_id' => $this->input->post('company', true),
            'phone' => $this->input->post('phone', true)
        ];

        $password = $this->input->post('password', true);
        if(!empty($password))
            $data['password'] = $password;

        $create = $this->ion_auth->update($id, $data);

        var_dump($create);
    }

    public function dataTable()
    {
        $array = [
            'draw' => 1,
            "recordsTotal" => 2,
            "recordsFiltered" => 2,
            [
                "Airi",
                "Satou",
                "Accountant",
                "Tokyo",
                "28th Nov 08",
                "$162,700"
            ],
            [
                "Airi",
                "Satou",
                "Accountant",
                "Tokyo",
                "28th Nov 08",
                "$162,700"
            ],
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($array));
    }
}