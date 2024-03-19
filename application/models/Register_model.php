<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$date = $this->date_time = date('Y-m-d');
	}

	function register_details($language, $fullname, $phone, $password)
	{
		$date = $this->date_time = date('Y-m-d');
		$this->db->select('user_id');
		$this->db->order_by("sno", 'DESC');
		$this->db->limit(1);


		$s_query = $this->db->get('user_profile');

		if ($fullname != "" && $phone != "" && $password != "") {
			if ($s_query->num_rows() > 0) {
				$s_query_result = $s_query->result_object();
				//print_r($query_result);
				foreach ($s_query_result as $s_data) {
					$get_id = $s_data->user_id;
				}
				$user_id = $get_id + 1;
			} else {
				$user_id = 10001;
			}
			$query = $this->db->query("insert into user_profile set full_name='$fullname',address='',email='',phone_no='$phone',password='$password',user_id='$user_id',date='$date',interestid='0'");

			if ($query) {
				$status = '1';
			} else {
				$status = '0';
			}
			$post_data = array(
				'status' => $status,
				'msg' => 'New User registered Successfully',
				'Information' => array(
					'user_id' => $user_id,
					'fullname' => $fullname,
					'email' => '',
					'phone' => $phone,
					'wallet' => '0',
					'interestid' => '0'
				)
			);
			//$post_data= json_encode( $post_data );
		} else {
			$status= 0; 
			$post_data = array(
				'status' => $status,
				'msg' => 'Required fields are missing'
			);
		}
		//echo $post_data;
		return $post_data;
	}
}
