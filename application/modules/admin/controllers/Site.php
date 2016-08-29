<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function edit()
    {
        $this->form_validation->set_rules('short_name', 'Short Name', 'trim|required');
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('logo', 'Logo', 'trim');
        $this->form_validation->set_rules('website', 'Website', 'trim|required');
        $this->form_validation->set_rules('contact_email', 'Contact Email', 'trim|required|valid_email');

        if (!$this->form_validation->run()) {
            $settings = $this->db->where('id', 1)->get('settings')->row();
            $this->render_view('site.edit', ['settings' => $settings]);
        } else {
            $this->update();
        }
    }

    public function update()
    {
        $data = [
            'short_name' => $this->input->post('short_name', true),
            'full_name' => $this->input->post('full_name', true),
            'logo' => $this->input->post('logo', true),
            'website' => $this->input->post('website', true),
            'contact_email' => $this->input->post('contact_email', true)
        ];

        $this->db->where('id', 1)->update('settings', $data);

        if($this->db->affected_rows() > 0)
            $notify = ['status' => 'success', 'msg' => 'Success Edit record'];
        else
            $notify = ['status' => 'error', 'msg' => 'Error Edit record'];

        $this->session->set_userdata('notify', $notify);
        redirect('admin/site/edit', 'refresh');
    }
}