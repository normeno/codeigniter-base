<?php

class User_model extends MY_Model
{
    public $_table = 'users';
    public $before_create = ['setCreatedAndUpdated'];
    public $before_update = ['setUpdated'];

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

    public function register($username, $password, $email, $additional_data, $group)
    {
        $create = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
        return $create;
    }

    public function setAvatarAttribute($image, $id=null)
    {
        if (!empty($image)) {
            $path = FCPATH.'assets/img/users/';
            $avatar = $this->uploader->upload_image('avatar', ['path' => $path]);

            if($avatar['status'] == 0) {
                $this->session->set_userdata('error-avatar', $avatar['data']['error']);
                $this->session->set_userdata('notify', ['status' => 'error', 'msg' => $this->lang->line('error_update')]);

                if ($this->router->fetch_method() == 'create') {
                    redirect('admin/user/create', 'refresh');
                } else {
                    redirect('admin/user/edit/'.$id, 'refresh');
                }

            } else {
                $user = $this->db->where('id', $id)->get($this->_table)->row();
                @unlink($path.$user->avatar);
                return $avatar['data']['file_name'];
            }
        }
    }
}