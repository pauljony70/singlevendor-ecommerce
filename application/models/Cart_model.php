<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$date = $this->date_time = date('Y-m-d H:i:s');
	}

	function get_storedata()
	{
		$minordervalue = 0;
		$this->db->select('name,value');
		$query0 = $this->db->get('store_config');
		$store_array = $query0->result_object();
		foreach ($store_array as $store_data) {

			if ($store_data->name == "minorder") {
				$minordervalue = $store_data->value;
			}
		}
		return $minordervalue;
	}

	function check_product_conf($prod_id)
	{

		$query_prod = $this->db->get_where('productdetails', array('prod_id' => $prod_id));

		$configuration = array(
			'status' => '',
			'data' => []
		);
		if ($query_prod->num_rows() > 0) {
			$query_prod_conf = $this->db->get_where("product_attribute_value pav", array('pav.product_id' => $prod_id));
			$config_data = [];
			if ($query_prod_conf->num_rows() > 0) {
				$conf = "yes";
				$config_data = $query_prod_conf->result_array();
			} else {
				$conf = "no";
			}

			$configuration = array(
				'status' => $conf,
				'data' => $config_data
			);
		}


		return $configuration;
	}

	function add_to_cart($user_id, $prod_id, $config_attr, $qty)
	{
		if (!empty($user_id) && isset($prod_id) && !empty($prod_id) && !empty($qty)) {

			$query = $this->db->get_where('cartdetails', array('user_id' => $user_id));
			$cart_data = $query->row_array();

			// Decode the existing JSON data if it exists
			$cart_items = $cart_data ? json_decode($cart_data['prod_id'], true) : array();

			// Check if the product already exists in the cart
			$existing_key = array_search($prod_id, array_column($cart_items, 'prod_id'));

			if ($existing_key !== false) {
				// If product exists, update the quantity
				$cart_items[$existing_key]['qty'] = $qty;
				$cart_items[$existing_key]['config_attr'] = $config_attr;
			} else {
				// If product doesn't exist, add a new item
				$new_item = array(
					'index' => count($cart_items),
					'prod_id' => $prod_id,
					'qty' => $qty,
					'config_attr' => $config_attr,
					'date' => date('Y-m-d'), // Assuming current date for new items
				);

				$cart_items[] = $new_item;
			}

			// Encode the updated data back to JSON
			$updated_cart_data = json_encode($cart_items);

			// Update or insert the data in the database
			if ($cart_data) {
				// Update existing record
				$this->db->where('user_id', $user_id);
				$status = $this->db->update('cartdetails', array('prod_id' => $updated_cart_data));
			} else {
				// Insert new record
				$status = $this->db->insert('cartdetails', array('user_id' => $user_id, 'prod_id' => $updated_cart_data));
			}

			// Count total unique products and return the status
			$total_products = count($cart_items);
			return array('status' => $status, 'total_products' => $total_products, 'cart_items' => $cart_items);
		}

		return array('status' => false, 'message' => 'Invalid input parameters');
	}



	function get_cart_details($language, $securecode, $user_id)
	{

		$cart_details = $this->db->get_where('cartdetails', array('user_id' => $user_id))->row_array();
		$cart_result = array();
		$total_cart_value = 0;
		if (!empty($cart_details)) {

			$cart_prod_details = json_decode($cart_details['prod_id'], true);

			if (!empty($cart_prod_details)) {
				foreach ($cart_prod_details as $key => $cart_prod_detail) {
					$prodid = $cart_prod_detail['prod_id'];

					$this->db->select('pd.prod_id, pd.prod_name, pd.prod_mrp, pd.prod_price, pd.prod_img_url, ct.cat_name, pd.unit, pd.other_attribute, pd.pricearray, pd.stock, prod.status');
					$this->db->join('product prod', 'prod.prod_id = pd.prod_id', 'INNER');
					$this->db->join('category ct', 'ct.cat_id= pd.cat_id', 'INNER');
					$this->db->where(array('pd.prod_id' => $prodid, 'prod.status' => 'active'));
					$query = $this->db->get('productdetails pd');
					$prod_array = $query->row_array();

					if (!empty($prod_array)) {
						if ($cart_prod_detail['config_attr'] !== "") {
							$configAttrArray = json_decode($cart_prod_detail['config_attr'], true);
							$attributes = [];
							foreach ($configAttrArray as $index => $attr) {
								$attributes[$index] = $attr['attr_value'];
							}
							$attributes = (object) $attributes;
							$prodAttrValue = json_encode($attributes);
							$query_prod_attr = $this->db->get_where('product_attribute_value', array('product_id' => $cart_prod_detail['prod_id'], 'prod_attr_value' => $prodAttrValue));
							$result_prod_attr = $query_prod_attr->row_array();
							if (!empty($result_prod_attr)) {
								$total_cart_value += $result_prod_attr['price'] * intval($cart_prod_detail['qty']);
								$offpercent = ($result_prod_attr['mrp'] - $result_prod_attr['price']) * 100 /  $result_prod_attr['mrp'];
								$prod_array['prod_mrp_value'] = $result_prod_attr['mrp'];
								$prod_array['prod_price_value'] = $result_prod_attr['price'];
								$prod_array['prod_mrp'] = price_format($result_prod_attr['mrp']);
								$prod_array['prod_price'] = price_format($result_prod_attr['price']);
								$prod_array['offpercent'] = number_format($offpercent, 0);
								$prod_array['stock'] = $result_prod_attr['stock'];
								$prod_array['config_attr'] = $configAttrArray;
								$prod_array['prod_img_url'] = json_decode($prod_array['prod_img_url']);
								$prod_array['qty'] = intval($cart_prod_detail['qty']);
								$cart_result[] = $prod_array;
							}
						} else {
							$total_cart_value += $prod_array['prod_price'] * intval($cart_prod_detail['qty']);
							$offpercent = ($prod_array['prod_mrp'] - $prod_array['prod_price']) * 100 /  $prod_array['prod_mrp'];
							$prod_array['prod_mrp_value'] = $prod_array['prod_mrp'];
							$prod_array['prod_price_value'] = $prod_array['prod_price'];
							$prod_array['prod_mrp'] = price_format($prod_array['prod_mrp']);
							$prod_array['prod_price'] = price_format($prod_array['prod_price']);
							$prod_array['offpercent'] = number_format($offpercent, 0);
							$prod_array['config_attr'] = "";
							$prod_array['prod_img_url'] = json_decode($prod_array['prod_img_url']);
							$prod_array['qty'] = intval($cart_prod_detail['qty']);
							$cart_result[] = $prod_array;
						}
					}
				}
			}
		}
		return array(
			'cart_result' => $cart_result,
			'total_cart_value' => price_format($total_cart_value),
			'total_cart_price' => $total_cart_value
		);
	}

	function update_cart_details($langauge, $securecode, $user_id, $prod_id, $qty)
	{
		if (!empty($user_id) && isset($prod_id) && !empty($prod_id) && !empty($qty)) {

			$query = $this->db->get_where('cartdetails', array('user_id' => $user_id));
			$cart_data = $query->row_array();

			// Decode the existing JSON data if it exists
			$cart_items = $cart_data ? json_decode($cart_data['prod_id'], true) : array();

			// Check if the product already exists in the cart
			$existing_key = array_search($prod_id, array_column($cart_items, 'prod_id'));

			if ($existing_key !== false) {
				// If product exists, update the quantity
				$cart_items[$existing_key]['qty'] = $qty;
				$updated_cart_data = json_encode($cart_items);
				$this->db->where('user_id', $user_id);
				$this->db->update('cartdetails', array('prod_id' => $updated_cart_data));
				return array('status' => true, 'msg' => 'Cart is updated successfully');
			} else {
				// If product doesn't exist
				return array('status' => false, 'msg' => 'Product is not exist in the cart');
			}
		}

		return array('status' => false, 'msg' => 'Invalid input parameters');
	}

	function delete_cart_details($language, $securecode, $user_id, $prod_id)
	{
		if (isset($language) && !empty($language) && isset($securecode) && !empty($securecode) && isset($prod_id) && !empty($prod_id) && !empty($user_id)) {
			// Fetch cart data from the database
			$query = $this->db->get_where('cartdetails', array('user_id' => $user_id));
			$cart_data = $query->row_array();

			// Decode the existing JSON data if it exists
			$cart_items = $cart_data ? json_decode($cart_data['prod_id'], true) : array();

			// Check if the product already exists in the cart
			$existing_key = null;

			foreach ($cart_items as $key => $item) {
				if ($item['prod_id'] == $prod_id) {
					$existing_key = $key;
					break;
				}
			}

			if ($existing_key !== null) {
				// If product exists, remove that product
				unset($cart_items[$existing_key]);

				// Encode and update the cart data in the database
				$updated_cart_data = json_encode(array_values($cart_items)); // Reindex the array
				$this->db->where('user_id', $user_id);
				$this->db->update('cartdetails', array('prod_id' => $updated_cart_data));

				return array('status' => true, 'msg' => 'Cart is updated successfully');
			} else {
				// If product doesn't exist
				return array('status' => false, 'msg' => 'Product is not exist in the cart');
			}
		} else {
			return array('status' => false, 'message' => 'Invalid input parameters');
		}
	}
}
