<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->date_time = date('Y-m-d H:i:s');
    }

    // Get User Details
    function getUserFullDetails($user_id)
    {
        return $this->db->get_where('user_profile', array('user_id' => $user_id))->row_array();
    }

    // Update User Details
    function updateUserDetails($user_id, $fullname, $displayname, $email, $phone_no)
    {

        $this->db->where('user_id', $user_id);
        $data = array(
            'full_name' => $fullname,
            'display_name' => $displayname,
            'email' => $email,
            'phone_no' => $phone_no,
        );

        $this->db->update('user_profile', $data);

        $data = array();

        $error = $this->db->error();

        if ($this->db->affected_rows() > 0) {
            $data['status'] = 1;
            $data['msg'] = "Record Update Successfully";
        } else if ($error['message'] == "" && $this->db->affected_rows() == 0) {
            $data['status'] = 1;
            $data['msg'] = "Record already updated";
        } else {
            $data['status'] = 0;
            $data['msg'] = "Unable to update records";
        }

        return $data;
    }
}
