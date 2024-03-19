<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('register_model');
	}

	public function index()
	{
		$this->load->view('register.php', $this->data);
	}

	function register_data()
	{
		$language = $_POST['language'];
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$otp = $_POST['otp'];

		$query = $this->db->get_where('user_profile', array('email' => $email));

		if ($query->num_rows() < 1) {
			if ($otp == $this->session->tempdata('email_otp')) {
				$last_user = $this->db->select_max('user_id')->get('user_profile')->row_array();
				$user_id = $last_user['user_id'] ? $last_user['user_id'] + 1 : 10001;

				// Insert user data
				$insert_data = array(
					'full_name' => $fullname,
					'email' => $email,
					'user_id' => $user_id,
					'display_name' => explode(' ', $fullname)[0],
					'date' => date('Y-m-d')
				);
				$this->db->insert('user_profile', $insert_data);

				$userdata = $this->db->get_where('user_profile', array('sno' => $this->db->insert_id()))->row_array();
				$newdata = array(
					'user_id'  => $userdata['user_id'],
					'fullname'  => $userdata['full_name'],
					'phone'  => $userdata['phone_no'],
					'displayname'  => $userdata['display_name'],
					'logged_in' => TRUE
				);

				$this->session->set_userdata($newdata);
				$response = array('status' => 1, 'message' => 'User logged in succesfully');
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
			} else {
				$response = array('status' => 0, 'message' => 'Wrong OTP.');
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
			}
		} else {
			$response = array('status' => 0, 'message' => 'Email is already exists. Please log in.');
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

	public function sendSignupOtp()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() == TRUE) {
			// Get the email from the form
			$email = $this->input->post('email');

			// Check if the email exists in the user_profile table
			$query = $this->db->get_where('user_profile', array('email' => $email));
			if ($query->num_rows() < 1) {
				// Generate OTP
				$otp = rand(100000, 999999);

				$subject = 'Your OTP for Signup';
				ob_start();
				$this->load->view('email/otp', array(
					'full_name' => $query->row()->full_name,
					'otp' => $otp
				));
				$message = ob_get_clean();

				// Send email using the common helper function
				if (send_email($email, $subject, $message)) {
					$this->session->set_tempdata('email_otp', $otp, 180);
					$response = array('status' => 1, 'message' => 'OTP sent successfully.');
				} else {
					$response = array('status' => 0, 'message' => 'Failed to send OTP.');
				}
			} else {
				$response = array('status' => 0, 'message' => 'Email is already exists. Please log in.');
			}

			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		} else {
			$response = array('status' => 0, 'message' => form_error('email'));
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}
}
