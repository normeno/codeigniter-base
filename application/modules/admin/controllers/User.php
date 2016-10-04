<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('company_model', 'company');
        $this->load->model('user_model', 'user');

        parent::set_current_module(5);
    }

    public function index()
    {
        $this->render_view('user.index', []);
    }

    /**
     * Creation Form
     */
    public function create()
    {
        if (!$this->form_validation->run('user')) {
            $companies = $this->company->get_all();

            $this->render_view('user.create', ['companies' => $companies]);
        } else {
            $this->store();
        }
    }


    public function store()
    {
        if (!empty($_FILES) && (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name']))) {
            $avatar = $this->user->setAvatarAttribute($_FILES);
        }

        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        $additional_data = [
            'username' => $this->input->post('username', true),
            'first_name' => $this->input->post('first_name', true),
            'last_name' => $this->input->post('last_name', true),
            'company_id' => $this->input->post('company', true),
            'phone' => $this->input->post('phone', true),
            'avatar' => isset($avatar) && !is_null($avatar) ? $avatar : null
        ];

        $group = ['3'];

        $create = $this->user->insert([
            'password' => $password,
            'email' => $email,
            'additional_data' => $additional_data,
            'group' => $group
        ]);

        if($create)
            $notify = ['status' => 'success', 'msg' => $this->lang->line('success_create')];
        else
            $notify = ['status' => 'error', 'msg' => $this->lang->line('error_create')];

        $this->session->set_userdata('notify', $notify);
        redirect('admin/user', 'refresh');
    }

    public function edit($id)
    {
        if (!$this->form_validation->run('user')) {
            $id = $this->uri->segment(4);
            $user = $this->ion_auth->user($id)->row();
            $companies = $this->db->get('companies')->result();
            $this->render_view('user.edit', ['id' => $id, 'user' => $user, 'companies' => $companies]);
        } else {
            $this->update($id);
        }
    }

    public function update($id)
    {
        $username = $this->input->post('username', true);

        $data = [
            'email' => $this->input->post('email', true),
            'username' => empty($username) ? null : $username,
            'first_name' => $this->input->post('first_name', true),
            'last_name' => $this->input->post('last_name', true),
            'company_id' => $this->input->post('company', true),
            'phone' => $this->input->post('phone', true)
        ];

        if (!empty($_FILES) && (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name']))) {
            $data['avatar'] = $this->user->setAvatarAttribute($_FILES, $id);
        }

        $password = $this->input->post('password', true);

        if(!empty($password))
            $data['password'] = $password;

        $update = $this->user->update($id, $data);

        if($update) {
            $notify = ['status' => 'success', 'msg' => $this->lang->line('success_update')];
        } else {
            $notify = ['status' => 'error', 'msg' => $this->lang->line('error_update')];
        }

        $this->session->set_userdata('notify', $notify);
        redirect('admin/user', 'refresh');
    }

    public function dataTable()
    {
        $this->load->library('Datatable', array('model' => 'user_datatable', 'rowIdCol' => 'id'));

        $jsonArray = $this -> datatable -> datatableJson(array(
            'active' => 'boolean'
        ));

        $this -> output -> set_header("Pragma: no-cache");
        $this -> output -> set_header("Cache-Control: no-store, no-cache");
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
    }
}