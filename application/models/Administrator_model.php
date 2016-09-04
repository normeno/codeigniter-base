<?php

class Administrator_model extends MY_Model
{
    public $_table = 'users';

    public function setAvatarAttribute($image, $id=null)
    {
        if (!empty($image)) {
            $path = FCPATH.'assets/img/administrators/';
            $avatar = $this->uploader->upload_image('avatar', ['path' => $path]);

            if($avatar['status'] == 0) {
                $this->session->set_userdata('error-avatar', $avatar['data']['error']);
                $this->session->set_userdata('notify', ['status' => 'error', 'msg' => $this->lang->line('error_update')]);

                if ($this->router->fetch_method() == 'create') {
                    redirect('admin/administrator/create', 'refresh');
                } else {
                    redirect('admin/administrator/edit/'.$id, 'refresh');
                }

            } else {
                $user = $this->db->where('id', $id)->get($this->_table)->row();
                @unlink($path.$user->avatar);
                return $avatar['data']['file_name'];
            }
        }
    }
}