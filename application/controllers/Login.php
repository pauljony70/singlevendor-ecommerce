<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('login_model');
	}

	public function index()
	{
		$this->load->view('login', $this->data);
	}

	public function login_data()
	{
		$language = $_POST['language'];
		$email = $_POST['email'];
		$otp = $_POST['otp'];

		$query = $this->db->get_where('user_profile', array('email' => $email));

		if ($query->num_rows() == 1) {
			if ($otp == $this->session->tempdata('email_otp')) {
				$userdata = $query->row_array();
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
			$response = array('status' => 0, 'message' => 'Email not found. Please sign up for an account.');
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

	public function sendLoginOtp()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() == TRUE) {
			// Get the email from the form
			$email = $this->input->post('email');

			// Check if the email exists in the user_profile table
			$query = $this->db->get_where('user_profile', array('email' => $email));
			if ($query->num_rows() == 1) {
				// Generate OTP
				$otp = rand(100000, 999999);

				$subject = 'Your OTP for Login';
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
				$response = array('status' => 0, 'message' => 'Email not found. Please sign up for an account.');
			}

			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		} else {
			$response = array('status' => 0, 'message' => form_error('email'));
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}

	public function logout()
	{
		//removing session  
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
