<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('setting_model', 'setting');
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
            $this->update();
        }
    }

    /**
     * Update administrator
     */
    public function update()
    {
        if (!empty($_FILES)) {
            $path = FCPATH.'assets/img/companies/';
            $avatar = $this->uploader->upload_image('logo', ['path' => $path]);

            if($avatar['status'] == 0) {
                $this->session->set_userdata('error-logo', $avatar['data']['error']);
                $this->session->set_userdata('notify', ['status' => 'error', 'msg' => 'Error Edit record']);
                redirect('admin/site/edit', 'refresh');
            }
        }

        if (!empty($avatar) && $avatar['status'] == 1) {
            $image = $avatar['data']['file_name'];
        } else {
            $image = $this->setting->get(1);
            $image = $image->logo;
        }

        $data = [
            'short_name' => $this->input->post('short_name', true),
            'full_name' => $this->input->post('full_name', true),
            'website' => $this->input->post('website', true),
            'logo' => isset($image) ? $image : null,
            'contact_email' => $this->input->post('contact_email', true)
        ];

        var_dump($avatar);
        exit;

        $this->db->where('id', 1)->update('settings', $data);

        if($this->db->affected_rows() > 0) {
            if (!empty($_FILES)) {
                $path = './companies/';
                $this->uploader->upload_image('logo', $path);
            }

            $notify = ['status' => 'success', 'msg' => 'Success Edit record'];
        } else {
            $notify = ['status' => 'error', 'msg' => 'Error Edit record'];
        }

        $this->session->set_userdata('notify', $notify);
        redirect('admin/site/edit', 'refresh');
    }
}