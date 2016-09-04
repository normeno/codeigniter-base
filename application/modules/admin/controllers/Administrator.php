<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('administrator_model', 'administrator');
        $this->load->model('company_model', 'company');
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
        if (!$this->form_validation->run('user')) {
            $companies = $this->company->get_all();
            $this->render_view('administrator.create', ['companies' => $companies]);
        } else {
            $this->store();
        }
    }

    /**
     * Create a new administrator
     */
    public function store()
    {
        if (!empty($_FILES) && (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name']))) {
            $avatar = $this->administrator->setAvatarAttribute($_FILES);
        }

        $email = $this->input->post('email', true);
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $additional_data = [
            'first_name' => $this->input->post('first_name', true),
            'last_name' => $this->input->post('last_name', true),
            'company_id' => $this->input->post('company', true),
            'phone' => $this->input->post('phone', true),
            'avatar' => isset($avatar) && !is_null($avatar) ? $avatar : null
        ];

        $group = ['2']; // Sets user to admin.

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
        if (!$this->form_validation->run('user')) {
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

        if (!empty($_FILES) && (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name']))) {
            $data['avatar'] = $this->administrator->setAvatarAttribute($_FILES, $id);
        }

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