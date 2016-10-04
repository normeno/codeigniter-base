<?php

class User_model extends MY_Model
{
    public $_table = 'users';
    public $before_create = ['setCreatedAndUpdated'];
    public $before_update = ['setUpdated'];

    /**
     * Trigger to update the fields created_at and updated_at
     *
     * @param $user
     * @return mixed
     */
    protected function setCreatedAndUpdated($user)
    {
        $user['additional_data']['created_at'] = $user['additional_data']['updated_at'] = date('Y-m-d H:i:s');
        return $user;
    }

    /**
     * Trigger to update the field updated_at
     *
     * @param $user
     * @return mixed
     */
    protected function setUpdated($user)
    {
        $user['updated_at'] = date('Y-m-d H:i:s');
        return $user;
    }

    /**
     * Overwrite function to work with ion-auth
     *
     * @param $data
     * @param bool $skip_validation
     * @return bool
     */
    public function insert($data, $skip_validation = FALSE)
    {
        if ($skip_validation === FALSE) {
            $data = $this->validate($data);
        }

        if ($data !== FALSE) {
            $data = $this->trigger('before_create', $data);

            $insert_id = $this->ion_auth->register($data['email'], $data['password'], $data['email'],
                $data['additional_data'], $data['group']);

            $this->trigger('after_create', $insert_id);

            return $insert_id;
        } else {
            return FALSE;
        }
    }

    /**
     * Overwrite function to work with ion-auth
     *
     * @param $id
     * @param $data
     * @param bool $skip_validation
     * @return bool
     */
    public function update($id, $data, $skip_validation = FALSE)
    {
        $data = $this->trigger('before_update', $data);

        if ($skip_validation === FALSE) {
            $data = $this->validate($data);
        }

        if ($data !== FALSE) {
            $result = $this->ion_auth->update($id, $data);

            $this->trigger('after_update', array($data, $result));

            return $result;
        } else {
            return FALSE;
        }
    }

    public function count($where = null)
    {
        $this->db->from('users')->join('users_groups', 'users_groups.user_id = users.id');

        if(!is_null($where))
            $this->db->where($where[0], $where[1]);

        return $this->db->count_all_results();
    }

    /**
     * Generate avatar and upload the image field
     *
     * @param $image
     * @param null $id
     * @return mixed
     */
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

    public function loggedToday()
    {
        $users = $this->db
            ->select('id, username, email, avatar, first_name, last_name, company_id, phone')
            ->where('last_login >', 'SELECT UNIX_TIMESTAMP(DATE_ADD(CURDATE(),INTERVAL -1 DAY))', null, false)
            ->get($this->_table)
            ->result();

        return $users;
    }
}