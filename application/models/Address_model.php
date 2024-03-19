<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Address_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$date = $this->date_time = date('Y-m-d H:i:s');
	}

	public function get_country_data()
	{
		$query = $this->db->get('country');
		return $query;
	}

	public function insert_data($user_id, $address_json, $defaultaddress)
	{
		// Check if the user already has an entry in the database
		$existing_entry = $this->db->where('user_id', $user_id)->get('address')->row();

		if ($existing_entry) {
			// Update the existing entry
			$this->db->where('user_id', $user_id)
				->update('address', array('addressarray' => $address_json, 'defaultaddress' => $defaultaddress));
		} else {
			// Insert a new entry
			$this->db->insert('address', array('user_id' => $user_id, 'addressarray' => $address_json, 'defaultaddress' => $defaultaddress));
		}

		// Return the result of the database operation
		return $this->db->affected_rows();
	}

	public function get_address($user_id)
	{
		$address = $this->db->get_where('address', array('user_id' => $user_id))->row_array();
		return $address;
	}

	public function getAddressById($user_id, $id)
	{
		// Fetch the address array from the database
		$address_data = $this->get_address($user_id);
		$addressArray = json_decode($address_data['addressarray'], true);

		// Search for the address with the given address_id
		foreach ($addressArray as $address) {
			if ($address['address_id'] == $id) {
				$address['defaultaddress'] = $address_data['defaultaddress'];
				return $address; // Return the address if found
			}
		}

		// Return an empty array if the address_id is not found
		return array();
	}

	public function editAddress($user_id, $address_json, $defaultaddress)
	{
		return $this->db->where('user_id', $user_id)
			->update('address', array('addressarray' => $address_json, 'defaultaddress' => $defaultaddress));
	}

	public function delete_user($id)
	{
		$this->db->where('sno', $id);
		return $this->db->delete('address');
	}
}
