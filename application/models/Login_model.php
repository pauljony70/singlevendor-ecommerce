<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->date_time = date('Y-m-d H:i:s');
	}

	function login_details($language, $phone, $password)
	{
		$status = '0';
		$this->db->select('*');
		$this->db->where(array('phone_no' => $phone, 'password' => $password));
		$query = $this->db->get('user_profile');
		
		if ($query->num_rows() > 0) {
			$user_result1 = $query->result_object()[0];

			$user_id = $user_result1->user_id;
			$fullname = $user_result1->full_name;
			$phone = $user_result1->phone_no;
			$display_name = $user_result1->display_name;
			$status = '1';
		}
		if ($status == 1) {
			$post_data = array(
				'status' => $status,
				'msg' => 'User Login Successfully',
				'Information' => array(
					'user_id' => $user_id,
					'fullname' => $fullname,
					'display_name' => $display_name,
					'email' => '',
					'phone' => $phone,
					'wallet' => '0',
					'interestid' => '0'
				)
			);
		} else {
			$post_data = array(
				'status' => $status,
				'msg' => 'invalid Login Details'
			);
		}
		return $post_data;
	}

	//Functiofor validate user
	function validate_user($user_phone = '', $qouteid)
	{
		$user_result = array();

		$this->db->select('*');
		$this->db->where(array('phone' => $user_phone));
		$query = $this->db->get('appuser_login');

		if ($query->num_rows() > 0) {
			$user_result1 = $query->result_object()[0];

			$img_decode = json_decode($user_result1->profile_pic);

			if (isset($img_decode->{MOBILE})) {
				$img = $img_decode->{MOBILE};
			} else {
				$img = $user_result1->profile_pic;
			}

			$user_result['user_id'] = $user_result1->user_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = $user_result1->status;
			$user_result['profile_pic'] = $img;
		} else {
			$user_unique_id = 'U' . $this->random_strings(10);
			$data['phone'] = $user_phone;
			$data['status'] = 1;
			$data['user_unique_id'] = $user_unique_id;
			$data['create_by'] = $this->date_time;

			$this->db->insert('appuser_login', $data);

			$this->db->select('*');
			$this->db->where(array('phone' => $user_phone));
			$query1 = $this->db->get('appuser_login');

			$user_result1 = $query1->result_object()[0];

			$img_decode = json_decode($user_result1->profile_pic);

			if (isset($img_decode->{MOBILE})) {
				$img = $img_decode->{MOBILE};
			} else {
				$img = $user_result1->profile_pic;
			}

			$user_result['user_id'] = $user_result1->user_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = $user_result1->status;
			$user_result['profile_pic'] = $img;
		}
		if ($qouteid) {
			//get_cart_product
			$usercart = $this->get_cart_details($user_result1->user_unique_id, '');

			$quotecart = $this->get_cart_details('', $qouteid);

			foreach ($usercart as $product_id) {
				if (in_array($product_id, $quotecart)) {
					$this->db->where(array('prod_id' => $product_id, 'user_id' => $user_result1->user_unique_id));
					$this->db->delete('cartdetails');
				}
			}
			$cart = array();

			$cart['user_id'] = $user_result1->user_unique_id;

			$this->db->where(array('qoute_id' => $qouteid));
			$this->db->update('cartdetails', $cart);
		}

		return $user_result;
	}
	//Functiofor validate login user
	function validate_user_login($email, $Password)
	{
		$user_result = array();

		$this->db->select('*');
		$this->db->where(array('email' => $email, 'password' => $Password));
		$query = $this->db->get('seller_login');

		if ($query->num_rows() > 0) {
			$user_result1 = $query->result_object()[0];


			$user_result['seller_id'] = $user_result1->seller_id;
			$user_result['fname'] = $user_result1->fname;
			$user_result['lname'] = $user_result1->lname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['status'] = $user_result1->status;
		} else {
			$user_result['status'] = 'not_exist';
			return $user_result;
			die();
		}

		return $user_result;
	}


	//function for save user opt

	function save_user_otp($user_phone, $otp)
	{
		$this->db->delete('app_user_otp', array('phone' => $user_phone));

		$data['phone'] = $user_phone;
		$data['otp'] = $otp;

		$this->db->insert('app_user_otp', $data);
	}

	//function for get user opt

	function get_user_otp($user_phone)
	{
		$otp = '';

		$this->db->select('otp');
		$this->db->where(array('phone' => $user_phone));
		$query = $this->db->get('app_user_otp');

		if ($query->result_object()) {
			$user_result = $query->result_object()[0];
			$otp = $user_result->otp;
		}
		return $otp;
	}

	function get_cart_details($user_id, $quote_id)
	{
		$this->db->select("prod_id");

		if ($user_id) {
			$this->db->where(array('user_id' => $user_id));
		} else {
			$this->db->where(array('qoute_id' => $quote_id));
		}


		$query = $this->db->get('cartdetails');

		$cart_result = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result_object() as $result) {
				$cart_result[] = $result->prod_id;
			}
		}
		return $cart_result;
	}

	function get_user_review_ratings($user_id, $pageno)
	{
		if ($pageno > 0) {
			$start = ($pageno * LIMIT);
		} else {
			$start = 0;
		}

		$this->db->select("pr.review_id,rating,pr.title as review_title,pr.comment as review_comment,pr.created_at as review_date, apl.fullname as user_name, pd.prod_name as product_name");
		$this->db->join('appuser_login apl', 'apl.user_unique_id = pr.user_id', 'INNER');
		$this->db->join('product_details pd', 'pd.product_unique_id = pr.product_id', 'INNER');
		$this->db->where(array('pr.user_id' => $user_id));
		$this->db->order_by('pr.created_at', 'DESC');
		$this->db->limit(LIMIT, $start);
		$query_review = $this->db->get('product_review pr');

		$reviews = array();
		if ($query_review->num_rows() > 0) {
			$reviews = $query_review->result_object();
		}
		return $reviews;
	}


	function get_user_profile($user_id)
	{

		$this->db->select('user_unique_id, fullname, phone, email,profile_pic');
		$this->db->where(array('user_unique_id' => $user_id));
		$query = $this->db->get('appuser_login');

		$user_result = array();
		if ($query->num_rows() > 0) {
			$user_result1 = $query->result_object()[0];

			$img_decode = json_decode($user_result1->profile_pic);

			if (isset($img_decode->{MOBILE})) {
				$img = $img_decode->{MOBILE};
			} else {
				$img = $user_result1->profile_pic;
			}

			$user_result['user_id'] = $user_result1->user_unique_id;
			$user_result['name'] = $user_result1->fullname;
			$user_result['phone'] = $user_result1->phone;
			$user_result['email'] = $user_result1->email;
			$user_result['profile_pic'] = $img;
		}
		return $user_result;
	}




	// string of specified length 
	function random_strings($length_of_string)
	{

		// String of all alphanumeric character 
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		// Shufle the $str_result and returns substring 
		// of specified length 
		return substr(str_shuffle($str_result), 0, $length_of_string);
	}
}
