<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$date = $this->date_time = date('Y-m-d H:i:s');
	}

	function get_name_category($cat_id)
	{
		$prod_result = array();
		$product_array = array();
		$start = 0;
		$sortby = 1;
		$devicetype = 1;

		//get products details
		$this->db->select('*');
		$this->db->where(array('cat_id' => $cat_id));
		//$this->db->where_in('parent_id','0');
		$query_prod = $this->db->get('category');
		//print_r($this->db->last_query());    

		if ($query_prod->num_rows() > 0) {
			$prod_result = $query_prod->result_object();

			$product_array = array();
			foreach ($prod_result as $productdetails) {
				$cat_response = array();

				$cat_response['id'] = $productdetails->cat_id;
				$cat_response['name'] = $productdetails->cat_name;


				$cat_response['imgurl'] = $productdetails->cat_img;

				$product_array[] = $cat_response;
			}
		}

		return $product_array;
	}

	function get_sub_category($cat_id)
	{
		$prod_result = array();
		$product_array = array();
		$start = 0;
		$sortby = 1;
		$devicetype = 1;

		//get products details
		$this->db->select('*');
		$this->db->where(array('parent_id' => $cat_id));
		//$this->db->where_in('parent_id','0');
		$query_prod = $this->db->get('category');
		//print_r($this->db->last_query());    

		if ($query_prod->num_rows() > 0) {
			$prod_result = $query_prod->result_object();

			$product_array = array();
			foreach ($prod_result as $productdetails) {
				$cat_response = array();

				$cat_response['id'] = $productdetails->cat_id;
				$cat_response['name'] = $productdetails->cat_name;


				$cat_response['imgurl'] = $productdetails->cat_img;


				$this->db->select('*');
				$this->db->where(array('parent_id' => $productdetails->cat_id));
				$query_1 = $this->db->get('category');
				$cat_response['subcat_1'] = array();

				if ($query_1->num_rows() > 0) {
					$cat_result = $query_1->result_object();

					foreach ($cat_result as $cat_results) {
						$scat_response = array();

						$scat_response['id'] = $cat_results->cat_id;
						$scat_response['name'] = $cat_results->cat_name;

						$scat_response['imgurl'] = $cat_results->cat_img;


						$this->db->select('*');
						$this->db->where(array('parent_id' => $cat_results->cat_id));
						$query_2 = $this->db->get('category');
						$scat_response['subsubcat_2'] = array();

						if ($query_2->num_rows() > 0) {
							$cat_result1 = $query_2->result_object();

							foreach ($cat_result1 as $cat_results1) {
								$scat_response = array();

								$scat_response1['id'] = $cat_results1->cat_id;
								$scat_response1['name'] = $cat_results1->cat_name;

								$scat_response1['imgurl'] = $cat_results1->cat_img;


								$cat_response['subcat_2'][] = $scat_response1;
							}
						}


						$cat_response['subcat_1'][] = $scat_response;
					}
				}


				$product_array[] = $cat_response;
			}
		}


		return $product_array;
	}

	function get_all_category()
	{
		$prod_result = array();
		$product_array = array();
		$start = 0;
		$sortby = 1;
		$devicetype = 1;

		//get products details
		$this->db->select('*');
		$this->db->where_in('parent_id', '0');
		$query_prod = $this->db->get('category');
		//print_r($this->db->last_query());    

		if ($query_prod->num_rows() > 0) {
			$prod_result = $query_prod->result_object();

			$product_array = array();
			foreach ($prod_result as $productdetails) {
				$cat_response = array();

				$cat_response['id'] = $productdetails->cat_id;
				$cat_response['name'] = $productdetails->cat_name;


				$cat_response['imgurl'] = $productdetails->cat_img;


				$this->db->select('*');
				$this->db->where(array('parent_id' => $productdetails->cat_id));
				$query_1 = $this->db->get('category');
				$cat_response['subcat_1'] = array();

				if ($query_1->num_rows() > 0) {
					$cat_result = $query_1->result_object();

					foreach ($cat_result as $cat_results) {
						$scat_response = array();

						$scat_response['id'] = $cat_results->cat_id;
						$scat_response['name'] = $cat_results->cat_name;

						$scat_response['imgurl'] = $cat_results->cat_img;


						$this->db->select('*');
						$this->db->where(array('parent_id' => $cat_results->cat_id));
						$query_2 = $this->db->get('category');
						$scat_response['subsubcat_2'] = array();

						if ($query_2->num_rows() > 0) {
							$cat_result1 = $query_2->result_object();

							foreach ($cat_result1 as $cat_results1) {
								$scat_response = array();

								$scat_response1['id'] = $cat_results1->cat_id;
								$scat_response1['name'] = $cat_results1->cat_name;

								$scat_response1['imgurl'] = $cat_results1->cat_img;


								$cat_response['subcat_2'][] = $scat_response1;
							}
						}


						$cat_response['subcat_1'][] = $scat_response;
					}
				}


				$product_array[] = $cat_response;
			}
		}


		return $product_array;
	}

	public function getCategoryTree($cat_id)
	{
		$category_tree = array();

		$category = $this->db->get_where('category', array('cat_id' => $cat_id))->row_array();

		if ($category) {
			$category_tree[] = $category;

			$this->getParentCategories($category['parent_id'], $category_tree);

			$category_tree = array_reverse($category_tree);
		}

		return $category_tree;
	}

	private function getParentCategories($parent_id, &$category_tree)
	{
		$parent_category = $this->db->get_where('category', array('cat_id' => $parent_id))->row_array();

		if ($parent_category) {
			$category_tree[] = $parent_category;
			$this->getParentCategories($parent_category['parent_id'], $category_tree);
		}
	}

	public function getAllChildCatIds($cat_id)
	{
		$child_cat_ids = array();

		$this->getChildCategories($cat_id, $child_cat_ids);

		array_unshift($child_cat_ids, $cat_id);
		// $result = implode(',', $child_cat_ids);

		return $child_cat_ids;
	}

	private function getChildCategories($parent_id, &$child_cat_ids)
	{
		$child_categories = $this->db->get_where('category', array('parent_id' => $parent_id))->result_array();

		foreach ($child_categories as $child_category) {
			$child_cat_ids[] = $child_category['cat_id'];
			$this->getChildCategories($child_category['cat_id'], $child_cat_ids);
		}
	}

	function getcategory_product($language,  $catid, $pageno = 0, $sortby = '', $min_price = '', $max_price = '', $rating = '', $devicetype = 1, $config_attr = '')
	{
		$per_page = 16;
		if ($pageno > 0) {
			$start = ($pageno * $per_page);
		} else {
			$start = 0;
		}
		$cat_ids = $this->getAllChildCatIds($catid);


		$this->db->select('pd.prod_id, pd.prod_name, pd.prod_desc, pd.prod_mrp, pd.prod_price, pd.w_price, pd.w_qty, pd.other_attribute,  pd.prod_img_url, bd.brand_name, pd.pricearray, pd.stock, pd.prod_rating, pd.prod_rating_count, pd.review_id');
		$this->db->join('product prod', 'prod.prod_id = pd.prod_id', 'INNER');
		$this->db->join('brand bd', 'prod.prod_brand_id= bd.brand_id', 'INNER');
		$this->db->join('category ct', 'ct.cat_id= pd.cat_id', 'INNER');

		if (json_decode($config_attr))
			$this->db->join('product_attribute_value pav', 'prod.prod_id = pav.product_id', 'INNER');

		if ($min_price != '' && $max_price !== '')
			$this->db->where(array('pd.prod_price >=' => $min_price, 'pd.prod_price <=' => $max_price,));

		$this->db->where_in('(prod.prod_cat_id', $cat_ids);
		$this->db->where('prod.status', 'active');

		if (json_decode($config_attr)) {
			foreach (json_decode($config_attr) as $key => $config_attribute) {
				$attr_id = $config_attribute->attr_id;
				$attr_name = $config_attribute->attr_name;
				$attr_value = trim($config_attribute->attr_value);
				$query_prod = $this->db->query(' SELECT id FROM product_attributes_conf WHERE 
								attribute_id = "' . $attr_id . '" AND attribute_value = "' . $attr_value . '" ');
				if ($query_prod->num_rows() > 0) {
					if ($key == 0) {
						$this->db->like('pav.prod_attr_value', ':"' . $attr_value . '"');
					} else {
						$this->db->or_like('pav.prod_attr_value', ':"' . $attr_value . '"');
					}
				} else {
					$this->db->reset_query();
					return 'invalid_filter';
					die;
				}
			}
		}

		if ($sortby == 1) {
			$this->db->order_by("prod_price", 'ASC');
		} else if ($sortby == 2) {
			$this->db->order_by("prod_price", 'DESC');
		} else if ($sortby == 3) {
			$this->db->order_by("pd.create_by", 'DESC');
		} else if ($sortby == 4) {
			$this->db->order_by("pd.prod_rating", 'DESC');
		}

		$query = $this->db->group_end()->group_by("pd.prod_id");
		$cloned_query = clone $this->db;
		$total = $cloned_query->get('productdetails pd')->num_rows();
		$this->db->limit($per_page, $start);

		$query = $this->db->get('productdetails pd');
		$prod_result = $query->result_array();

		if (!empty($prod_result)) {
			foreach ($prod_result as $key =>  $product_data) {
				$prod_result[$key]['prod_mrp'] = price_format($product_data['prod_mrp']);
				$prod_result[$key]['prod_price'] = price_format($product_data['prod_price']);
				$offpercent =  ($product_data['prod_mrp'] - $product_data['prod_price']) * 100 /  $product_data['prod_mrp'];
				$prod_result[$key]['offpercent'] = number_format($offpercent, 0);
				$img_decode = json_decode($product_data['prod_img_url']);
				$prod_result[$key]['prod_img_url'] = $img_decode;
			}
		}

		return array(
			"product_array" => $prod_result,
			"total_pages" => ceil($total / $per_page),
			"total_products" => $total
		);
	}

	function get_product_filter($catid)
	{
		$cat_ids = $this->getAllChildCatIds($catid);
		$this->db->select('product.prod_id');
		$this->db->join('productdetails', 'productdetails.prod_id = product.prod_id', 'INNER');
		$this->db->where_in('product.prod_cat_id', $cat_ids);
		$this->db->where(array('product.status' => 'active'));
		$query = $this->db->get('product');

		$attribute_array = array();
		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();

			$product_id = array();
			foreach ($category_result as $cat_product) {
				$product_id[] = $cat_product->prod_id;
			}

			$this->db->select("GROUP_CONCAT(`pa`.`attr_value` separator '$#$') attr_value, pa.prod_attr_id, pas.attribute");
			$this->db->join('product_attributes_set pas', 'pas.id = pa.prod_attr_id', 'INNER');
			$this->db->where_in('prod_id', $product_id);
			$this->db->group_by("pa.prod_attr_id");
			$query = $this->db->get('product_attribute pa');
			$attribute = array();
			if ($query->num_rows() > 0) {
				$attr_result = $query->result_object();
				foreach ($attr_result as $attr) {
					$val_decode = explode('$#$', $attr->attr_value);
					$new_attr = array();
					foreach ($val_decode as $attr_json) {
						$attr_decode = json_decode($attr_json);
						foreach ($attr_decode as $attr_array) {
							if (!in_array($attr_array, $new_attr)) {
								$new_attr[] = $attr_array;
							}
						}
					}

					$attribute['attr_id'] = $attr->prod_attr_id;
					$attribute['name'] = $attr->attribute;
					$attribute['value'] = $new_attr;
					$attribute_array[] = $attribute;
				}
			}
			$price_filter = [];
			$query = $this->db->select_max('prod_price', 'max_price')
				->select_min('prod_price', 'min_price')
				->join('productdetails', 'productdetails.prod_id = product.prod_id', 'INNER')
				->where_in('product.prod_cat_id', $cat_ids)
				->get('product');

			if ($query->num_rows() > 0) {
				$result = $query->row();
				$price_filter['max_price'] = $result->max_price;
				$price_filter['min_price'] = $result->min_price;
			} else {
				$price_filter['max_price'] = '';
				$price_filter['min_price'] = '';
			}
			return [
				'attribute_array' => $attribute_array,
				'price_filter' => $price_filter,
			];
		}
		return [
			'attribute_array' => '',
			'price_filter' => '',
		];
	}
}
