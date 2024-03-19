<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$date = $this->date_time = date('Y-m-d H:i:s');
	}

	public function select()
	{
		//data is retrive from this query  
		$query = $this->db->get('user_profile');
		return $query;
	}

	public function getTopbarDetails()
	{
		return $this->db->get_where('homepage_banner', array('type' => 'topbar'))->row_array();
	}

	function get_search_product_request($language,  $search, $pageno = 0, $sortby = '', $min_price = '', $max_price = '', $rating = '', $devicetype = 1, $config_attr = '')
	{
		$per_page = 16;
		if ($pageno > 0) {
			$start = ($pageno * $per_page);
		} else {
			$start = 0;
		}

		$this->db->select('pd.prod_id, pd.prod_name, pd.prod_desc, pd.prod_mrp, pd.prod_price, pd.w_price, pd.w_qty, pd.other_attribute,  pd.prod_img_url, bd.brand_name, pd.pricearray, pd.stock, pd.prod_rating, pd.prod_rating_count, pd.review_id');
		$this->db->join('product prod', 'prod.prod_id = pd.prod_id', 'INNER');
		$this->db->join('brand bd', 'prod.prod_brand_id= bd.brand_id', 'INNER');
		$this->db->join('category ct', 'ct.cat_id= pd.cat_id', 'INNER');

		if (json_decode($config_attr))
			$this->db->join('product_attribute_value pav', 'prod.prod_id = pav.product_id', 'INNER');

		if ($min_price != '' && $max_price !== '')
			$this->db->where(array('pd.prod_price >=' => $min_price, 'pd.prod_price <=' => $max_price,));

		$this->db->like('pd.prod_name', $search);
		$this->db->where('(prod.status', 'active');

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

	function get_search_product_filter($search)
	{
		$this->db->select('product.prod_id');
		$this->db->join('productdetails', 'productdetails.prod_id = product.prod_id', 'INNER');
		$this->db->like('product.prod_name', $search);
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
				->like('product.prod_name', $search)
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

	function getHomeBanners()
	{
		$data = $this->db->get('homepage_banner')->result_array();
		$result = array();

		foreach ($data as $item) {
			$section = $item['section'];
			unset($item['section']); // Remove the 'section' key from the item

			// Append to the result array based on the section
			$result[$section][] = $item;
		}

		return $result;
	}

	function get_header_banner_request($section, $dimension)
	{
		$this->db->select('*');
		$this->db->where(array('name' => $section));
		$query = $this->db->get('layoutsection');

		$banner_result = array();

		if ($query->num_rows() > 0) {
			$home_result = $query->result_object();
			foreach ($home_result as $banners) {
				$this->db->select('*');
				$this->db->where(array('layoutsection_id' => $banners->sno));
				$query2 = $this->db->get('sectionvalue');

				$banners_data = array();
				$home_result = $query2->result_object();

				foreach ($home_result as $banners) {

					$banners_data['image'] = 'media/' . $banners->image;
					$banners_data['url'] = $banners->onclick_url;
					$banners_data['title'] = $banners->title;
					$banners_data['des'] = $banners->description;
					$banners_data['btn'] = $banners->button;

					$banner_result[] = $banners_data;
				}
			}
		}

		return $banner_result;
	}

	function get_category()
	{
		$category_result = array();

		$this->db->select('cat.cat_id,cat.cat_name,cat.cat_name_ar,cat.cat_img,cat.parent_id');

		$this->db->where(array('cat.parent_id' => 0, 'cat.cat_id !=' => 10));
		$this->db->order_by('cat.cat_order', 'ASC');

		//$this->db->limit(8, 0);
		$query = $this->db->get('category cat');

		if ($query->num_rows() > 0) {
			$category_array = $query->result_object();
			foreach ($category_array as $cat_details) {
				$cat_response = array();
				$cat_response['cat_id'] = $cat_details->cat_id;
				// 1 arabic 2 english

				$cat_response['cat_name'] = $cat_details->cat_name;



				$cat_response['parent_id'] = $cat_details->parent_id;
				$cat_response['cat_slug'] = $cat_details->cat_slug;

				$img = $cat_details->cat_img;


				$cat_response['imgurl'] = $img;

				//get sub category 
				$this->db->select('cat.cat_id,cat.cat_name, cat.cat_name_ar,cat.cat_img,cat.parent_id');

				$this->db->where(array('cat.parent_id' => $cat_details->cat_id));
				$this->db->order_by('cat.cat_order', 'ASC');

				//$this->db->limit(8, 0);
				$querysubcat = $this->db->get('category cat');
				$cat_response['subcat_1'] = array();
				if ($querysubcat->num_rows() > 0) {
					$category_sub = $querysubcat->result_object();
					foreach ($category_sub as $subcat_details) {
						$scat_response = array();
						$scat_response['cat_id'] = $subcat_details->cat_id;
						// 1 arabic 2 english

						$scat_response['cat_name'] = $subcat_details->cat_name;
						$scat_response['parent_id'] = $subcat_details->parent_id;
						$scat_response['cat_slug'] = $subcat_details->cat_slug;

						$img = json_decode($subcat_details->cat_img);

						$scat_response['imgurl'] = $img;

						//getsub sub category 
						$this->db->select('cat.cat_id,cat.cat_name, cat.cat_name_ar,cat.cat_img,cat.parent_id');

						$this->db->where(array('cat.parent_id' => $subcat_details->cat_id));
						$this->db->order_by('cat.cat_order', 'ASC');

						//$this->db->limit(8, 0);
						$querysubcat1 = $this->db->get('category cat');
						$scat_response['subsubcat_2'] = array();
						if ($querysubcat1->num_rows() > 0) {
							$category_sub1 = $querysubcat1->result_object();
							foreach ($category_sub1 as $subcat_details1) {
								$scat_response1 = array();
								$scat_response1['cat_id'] = $subcat_details1->cat_id;
								// 1 arabic 2 english

								$scat_response1['cat_name'] = $subcat_details1->cat_name;


								$scat_response1['parent_id'] = $subcat_details1->parent_id;
								$scat_response1['cat_slug'] = $subcat_details1->cat_slug;

								$img1 = json_decode($subcat_details1->cat_img);


								$scat_response1['imgurl'] = $img1;

								$scat_response['subsubcat_2'][] = $scat_response1;
							}
						}
						$cat_response['subcat_1'][] = $scat_response;
					}
				}

				$category_result[] = $cat_response;
			}
		}

		return $category_result;
	}

	public function getCustomNavigations()
	{
		$navigations = $this->db->get('custom_navigations')->result_array();

		foreach($navigations as &$navigation)
		{
			$navigation_data = $this->db->get_where('custom_navigation_products', array('navigation_id' => $navigation['id']))->result_array();
			$navigation['navigation_data'] = $navigation_data;
		}

		return $navigations;
	}

	function get_home_products($type)
	{
		$prod_result = array();
		$product_array = array();
		$start = 0;
		$sortby = 1;
		$devicetype = 1;

		$this->db->select('popular_product.product_id');
		$this->db->join('productdetails', 'productdetails.prod_id = popular_product.product_id', 'INNER');
		//$this->db->join('vendor_product vp', 'productdetails.prod_id = vp.product_id','INNER');
		//$this->db->join('sellerlogin seller', 'vp.vendor_id = seller.seller_unique_id','INNER');
		$this->db->where(array('popular_product.type' => $type));
		//$this->db->group_by("popular_product.prod_id"); 
		$this->db->order_by("popular_product.id", 'ASC');

		$this->db->limit(15, $start);

		$query = $this->db->get('popular_product');


		if ($query->num_rows() > 0) {
			$category_result = $query->result_object();
			$product_id = array();
			foreach ($category_result as $cat_product) {
				$product_id[] = $cat_product->product_id;
			}


			//get products details
			$this->db->select('pd.prod_id as id , pd.prod_name as name, pd.prod_img_url as img , "active" as active, pd.prod_mrp as mrp, pd.prod_price price, pd.stock as stock, pd.prod_remark as remark');


			$this->db->where_in('pd.prod_id', $product_id);
			$this->db->group_by("pd.prod_id");

			/*if($sortby==1){
				$this->db->order_by("vp2.mrp_min",'ASC'); 
			}else if($sortby==2){
				$this->db->order_by("vp2.mrp_min",'DESC'); 
			}else if($sortby==3){
				$this->db->order_by("pd.created_at",'DESC'); 
			}else if($sortby==4){
				$this->db->order_by("pd.prod_rating_count",'DESC'); 
			}*/

			$query_prod = $this->db->get('productdetails as pd');

			if ($query_prod->num_rows() > 0) {
				$prod_result = $query_prod->result_object();

				$product_array = array();
				foreach ($prod_result as $productdetails) {
					$product_response = array();
					$product_response['id'] = $productdetails->id;
					$product_response['name'] = str_replace('"', '', $productdetails->name);
					$product_response['active'] = $productdetails->active;
					$product_response['mrp'] =  $productdetails->mrp;
					$product_response['price'] = $productdetails->price;
					$product_response['stock'] = $productdetails->stock;
					$product_response['remark'] = $productdetails->remark;
					$product_response['rating'] = 0;

					$discount_per = 0;
					$discount_price = 0;
					if ($productdetails->price > 0) {
						$discount_price = ($productdetails->mrp - $productdetails->price);

						$discount_per = ($discount_price / $productdetails->mrp) * 100;
					}
					$product_response['totaloff'] = $discount_price;
					$product_response['offpercent'] = round($discount_per) . '% off';

					$img_decode = json_decode($productdetails->img);


					$product_response['imgurl'] = $img_decode[0]->url;
					$product_array[] = $product_response;
				}
			}
		}

		return $product_array;
	}
}
