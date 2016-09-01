<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render_view('administrator.index', []);
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

    /**
     * Create a new administrator
     */
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

        if($create)
            $notify = ['status' => 'success', 'msg' => 'Success Edit record'];
        else
            $notify = ['status' => 'error', 'msg' => 'Error Edit record'];

        $this->session->set_userdata('notify', $notify);
        redirect('admin/administrator', 'refresh');
    }

    /**
     * Edit Form
     */
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

        if (!$this->form_validation->run('site/edit')) {
            $id = $this->uri->segment(4);
            $user = $this->ion_auth->user($id)->row();
            $companies = $this->db->get('companies')->result();
            $this->render_view('administrator.edit', ['id' => $id, 'user' => $user, 'companies' => $companies]);
        } else {
            $this->update($id);
        }
    }

    /**
     * Update administrator
     */
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

        $update = $this->ion_auth->update($id, $data);

        if($update)
            $notify = ['status' => 'success', 'msg' => 'Success Edit record'];
        else
            $notify = ['status' => 'error', 'msg' => 'Error Edit record'];

        $this->session->set_userdata('notify', $notify);
        redirect('admin/administrator', 'refresh');
    }

    /**
     * Show Datatable
     */
    public function dataTable()
    {
        $this->load->library('Datatable', ['model' => 'Administrator_datatable', 'rowIdCol' => 'id']);

        $jsonArray = $this -> datatable -> datatableJson(array(
            'active' => 'boolean'
        ));

        $this -> output -> set_header("Pragma: no-cache");
        $this -> output -> set_header("Cache-Control: no-store, no-cache");
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
    }
}