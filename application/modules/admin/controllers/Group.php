<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('group_model', 'group');
        $this->load->model('module_model', 'module');
        $this->load->model('group_module_model', 'group_module');

        parent::set_current_module(7);
    }

    public function index()
    {
        $this->render_view('group.index', []);
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
            $modules = $this->db->where('module_id IS NULL', null, false)->order_by('priority', 'ASC')->get('modules')->result();
            echo $this->db->last_query();

            $this->render_view('group.create', ['modules' => $modules]);
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
        if (!$this->form_validation->run('group/update')) {
            $group = $this->group->get($id);

            $modules = parent::modules();

            $this->render_view('group.edit', ['id' => $id, 'group' => $group, 'modules' => $modules]);
        } else {
            $this->update($id);
        }
    }

    public function update($id)
    {
        // Update Group
        $this->group->update($id, [
            'name' => $this->input->post('name', true),
            'description' => $this->input->post('description', true)
        ]);

        // Delete all records by group
        $gms = $this->group_module->get_many_by('group_id', $id);

        foreach ($gms as $gm) {
            $this->group_module->delete($gm->id);
        }

        // Insert new records
        $modules = $this->input->post('modules', true);
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->group_module->insert([
                    'group_id' => $id,
                    'module_id' => $module
                ]);
            }
        }

        $notify = ['status' => 'success', 'msg' => $this->lang->line('success_update')];
        $this->session->set_userdata('notify', $notify);
        redirect('admin/group', 'refresh');
    }

    public function dataTable()
    {
        $this->load->library('Datatable', ['model' => 'group_datatable', 'rowIdCol' => 'id']);

        $jsonArray = $this->datatable->datatableJson();

        $this->output->set_header("Pragma: no-cache");
        $this->output->set_header("Cache-Control: no-store, no-cache");
        $this->output->set_content_type('application/json')->set_output(json_encode($jsonArray));
    }
}