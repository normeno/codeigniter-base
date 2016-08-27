<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller
{
    public function login()
    {
        $this->form_validation->set_rules('identity', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if (!$this->form_validation->run()) {
            $this->render_view('auth.login', []);
        } else {
            $identity = $this->input->post('identity', true);
            $password = $this->input->post('password', true);
            $remember = $this->input->post('remember', true);

            if ($this->ion_auth->login($identity, $password, $remember)) {
                $messages = $this->ion_auth->messages();
                //redirect('admin');
                echo 'success';
            } else {
                $errors =  $this->ion_auth->errors();
                $this->render_view('auth.login', ['errors' => $errors]);
            }
        }
    }
}