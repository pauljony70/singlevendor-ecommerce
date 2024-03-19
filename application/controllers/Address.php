<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Address extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('address_model');
	}

	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		if ($user_id) {
			$this->data['address'] = $this->address_model->get_address($user_id);
			$this->load->view('address', $this->data);
		} else {
			redirect(base_url());
		}
	}

	public function addAddress()
	{
		$user_id = $this->session->userdata('user_id');

		if ($user_id) {
			if ($this->input->method() === 'post') {
				$fullname = $this->input->post('fullname');
				$email = $this->input->post('email');
				$phone = $this->input->post('phone');
				$address = $this->input->post('address');
				$pincode = $this->input->post('pincode');
				$state_id = $this->input->post('state');
				$state = $this->input->post('state_value');
				$city_id = $this->input->post('city');
				$city = $this->input->post('city_value');
				$defaultaddress = $this->input->post('defaultaddress');

				$address_data = $this->address_model->get_address($user_id);
				$existing_addresses = json_decode($address_data['addressarray'], true) ?? array();

				// Determine the new address_id
				$address_id = empty($existing_addresses) ? 1 : end($existing_addresses)['address_id'] + 1;
				$address_array = empty($existing_addresses) ? array() : $existing_addresses;
				$defaultaddressvalue = empty($existing_addresses) ? 1 : $address_data['defaultaddress'];

				// Prepare the new address data
				$new_address = array(
					'address_id' => $address_id,
					'fullname' => $fullname,
					'email' => $email,
					'phone' => $phone,
					'address' => $address,
					'pincode' => $pincode,
					'state_id' => $state_id,
					'state' => $state,
					'city_id' => $city_id,
					'city' => $city
				);

				if ($defaultaddress) {
					$defaultaddressvalue = $address_id;
				}

				// Add the new address to the existing addresses
				$address_array[] = $new_address;

				// Convert the array to JSON
				$address_json = json_encode($address_array);

				// Insert or update the data in the database
				$insert = $this->address_model->insert_data($user_id, $address_json, $defaultaddressvalue);

				if ($insert) {
					$response = array('status' => 1, 'msg' => 'Address is saved successfully.');
				} else {
					$response = array('status' => 0, 'msg' => 'Failed to save address.');
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
			} elseif ($this->input->method() === 'get') {
				$this->load->view('add_address', $this->data);
			} else {
				show_404();
			}
		} else {
			redirect(base_url());
		}
	}


	public function editAddress($id)
	{
		$user_id = $this->session->userdata('user_id');

		if ($user_id) {
			if ($this->input->method() === 'post') {
				$fullname = $this->input->post('fullname');
				$email = $this->input->post('email');
				$phone = $this->input->post('phone');
				$fulladdress = $this->input->post('address');
				$pincode = $this->input->post('pincode');
				$state_id = $this->input->post('state');
				$state = $this->input->post('state_value');
				$city_id = $this->input->post('city');
				$city = $this->input->post('city_value');
				$defaultaddress = $this->input->post('defaultaddress');

				$address_data = $this->address_model->get_address($user_id);
				$existing_addresses = json_decode($address_data['addressarray'], true) ?? array();
				$defaultaddressvalue = $defaultaddress ? $id : $address_data['defaultaddress'];

				foreach ($existing_addresses as &$address) {
					if ($address['address_id'] == $id) {
						$address['fullname'] = $fullname;
						$address['email'] = $email;
						$address['phone'] = $phone;
						$address['address'] = $fulladdress;
						$address['pincode'] = $pincode;
						$address['state_id'] = $state_id;
						$address['state'] = $state;
						$address['city_id'] = $city_id;
						$address['city'] = $city;

						break;
					}
				}

				// Convert the array to JSON
				$address_json = json_encode($existing_addresses);

				// Update the data in the database
				$update = $this->address_model->editAddress($user_id, $address_json, $defaultaddressvalue);

				if ($update) {
					$response = array('status' => 1, 'msg' => 'Address is updated successfully.');
				} else {
					$response = array('status' => 0, 'msg' => 'Failed to save address.');
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
			} elseif ($this->input->method() === 'get') {
				$this->data['address'] = $this->address_model->getAddressById($user_id, $id);
				$this->data['states'] = $this->db->group_by('name')->get('state')->result_array();
				$this->data['cities'] = $this->db->group_by('city_name')->get('city')->result_array();
				if (!empty($this->data['address'])) {
					$this->load->view('edit_address', $this->data);
				} else {
					show_404();
				}
			} else {
				show_404();
			}
		} else {
			redirect(base_url());
		}
	}

	public function deleteAddress($id)
	{
		$user_id = $this->session->userdata('user_id');

		if ($user_id) {
			$address_data = $this->address_model->get_address($user_id);
			$existing_addresses = json_decode($address_data['addressarray'], true) ?? array();

			$address = array_search($id, array_column($existing_addresses, 'address_id'));
			if ($address !== false) {
				$deleted_address = $existing_addresses[$address];

				unset($existing_addresses[$address]);
				$existing_addresses = array_values($existing_addresses);

				$address_json = json_encode($existing_addresses);

				// Check if the deleted address was the default address
				$default_address_id = $address_data['defaultaddress'];
				if ($deleted_address['address_id'] == $default_address_id) {
					// Set the default address to the address_id of the new first element
					$default_address_id = isset($existing_addresses[0]['address_id']) ? $existing_addresses[0]['address_id'] : null;
				}

				$this->address_model->editAddress($user_id, $address_json, $default_address_id);
			} else {
				show_404();
			}

			redirect(base_url('address'));
		} else {
			redirect(base_url());
		}
	}

	public function makeDefaultAddress($id)
	{
		$user_id = $this->session->userdata('user_id');

		if ($user_id) {
			$address_data = $this->address_model->get_address($user_id);
			$existing_addresses = json_decode($address_data['addressarray'], true) ?? array();

			$address = array_search($id, array_column($existing_addresses, 'address_id'));
			if ($address !== false) {
				$this->address_model->editAddress($user_id, $address_data['addressarray'], $id);
			} else {
				show_404();
			}

			redirect(base_url('address'));
		} else {
			redirect(base_url());
		}
	}

	public function getState()
	{
		$states = $this->db->group_by('name')->get('state')->result_array();
		$response = array('status' => true, 'message' => 'States are fetched successfully.', 'data' => $states);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getCity()
	{
		$state_code = $this->input->get('stateid') ?? 0;
		$this->db->select();
		if ($state_code != 0)
			$this->db->where('state_code', $state_code);
		$this->db->group_by('city_name');
		$cities = $this->db->get('city')->result_array();
		$response = array('status' => true, 'message' => 'Cities are fetched successfully.', 'data' => $cities);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
