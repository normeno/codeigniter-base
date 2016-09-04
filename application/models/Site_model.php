<?php

class Site_model extends MY_Model
{
    public $_table = 'settings';
    public $before_create = ['setCreatedAndUpdated'];
    public $before_update = ['setUpdated'];

    public function __construct()
    {
        parent::__construct();
    }

    protected function setCreatedAndUpdated($user)
    {
        $user['created_at'] = $user['updated_at'] = date('Y-m-d H:i:s');
        return $user;
    }

    protected function setUpdated($user)
    {
        $user['updated_at'] = date('Y-m-d H:i:s');
        return $user;
    }

    public function setLogoAttribute($image, $id=null)
    {
        if (!empty($image)) {
            $path = FCPATH.'assets/img/companies/';
            $avatar = $this->uploader->upload_image('logo', ['path' => $path]);

            if($avatar['status'] == 0) {
                $this->session->set_userdata('error-logo', $avatar['data']['error']);
                $this->session->set_userdata('notify', ['status' => 'error', 'msg' => $this->lang->line('error_update')]);

                if ($this->router->fetch_method() == 'create') {
                    redirect('admin/site/create', 'refresh');
                } else {
                    redirect('admin/site/edit/'.$id, 'refresh');
                }

            } else {
                $user = $this->db->where('id', $id)->get($this->_table)->row();
                @unlink($path.$user->avatar);
                return $avatar['data']['file_name'];
            }
        }
    }
}