<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('site_model', 'site');
    }

    /**
     * Edit Form
     */
    public function edit()
    {
        if (!$this->form_validation->run()) {
            $settings = $this->db->where('id', 1)->get('settings')->row();
            $this->render_view('site.edit', ['settings' => $settings]);
        } else {
            $this->update(1);
        }
    }

    /**
     * Update administrator
     */
    public function update($id)
    {
        $data = [
            'short_name' => $this->input->post('short_name', true),
            'full_name' => $this->input->post('full_name', true),
            'website' => $this->input->post('website', true),
            'contact_email' => $this->input->post('contact_email', true)
        ];

        if (!empty($_FILES) && (isset($_FILES['logo']) && !empty($_FILES['logo']['name']))) {
            $data['logo'] = $this->site->setLogoAttribute($_FILES, $id);
        }

        $this->site->update(1, $data);

        if($this->db->affected_rows() > 0) {
            $notify = ['status' => 'success', 'msg' => $this->lang->line('success_update')];
        } else {
            $notify = ['status' => 'error', 'msg' => $this->lang->line('error_update')];
        }

        $this->session->set_userdata('notify', $notify);
        redirect('admin/site/edit', 'refresh');
    }
}