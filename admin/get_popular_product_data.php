<?php
include('session.php');
$code  = $_POST['code'];
$page  = $_POST['page'];
$rowno = $_POST['rowno'];
$type = $_POST['type'];
$error = ''; // Variable To Store Error Message

$code =stripslashes($code);
$page =  stripslashes($page);
$rowno =  stripslashes($rowno);

//echo " value ".$page."---".$rowno."---".$sortcat;
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    // echo " dashboard redirect to index";
} else if ($code==$_SESSION['_token'] && $type == 'popular_product'){ 
   try{
		
		$limit = 10; 
		
	   
        $start = ($page - 1) * $limit; 
        $totalrow =0;
       
        
        $return = array();
        $i= 0;
       
        $order_by = "ORDER BY pd.prod_name ASC";
       
		
			$query = "SELECT pd.product_unique_id, pd.prod_name, pd.featured_img,  pd.status ,brand.brand_name,pd.product_sku,pp.id
				FROM product_details pd,brand,popular_product pp WHERE brand.brand_id  = pd.brand_id AND pd.status IN(1) AND pp.product_id= pd.product_unique_id  ".$order_by." LIMIT ?, ?";
				
			$query_total = "SELECT count(pd.product_unique_id) FROM product_details pd,brand, popular_product pp WHERE brand.brand_id  = pd.brand_id AND pd.status IN(1) AND pp.product_id= pd.product_unique_id  ";
		
	
		$stmt = $conn->prepare($query);
           
        $stmt ->bind_param("ii", $start, $limit);
        $stmt->execute();
        $data = $stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7);
        //  echo " get col data ";
        $tbl_html =  '';
		 
		
		$product_arr = array();
		$product_arr_final = array();
        while ($stmt->fetch()) {
			$product_arr['product_unique_id'] = $col1;
			$product_arr['prod_name'] = $col2;
			$product_arr['featured_img'] = $col3;
			$product_arr['status'] = $col4;
			$product_arr['brand_name'] = $col5;
			$product_arr['product_sku'] = $col6;
			$product_arr['id'] = $col7;
			$product_arr_final[] = $product_arr;
        }
		
		$i=1;
		foreach($product_arr_final as $products){
			$cat_names = array();
			//get_cat($col1,$conn);
			
			$checked =  '';
			if($products['status']==1){ $checked =  'checked';}
			
            $imgarray = json_decode($products['featured_img'], true);
			$sr = ($page-1)*$limit+$i;
            $imageurl = MEDIAURL.$imgarray['72-72'];            
            $tbl_html .=  '<tr id="tr'.$products['id'].'"><td>'.$sr.'</td>';
            $tbl_html .=  '<td><img src="'.$imageurl.'"></td>';
            $tbl_html .=  '<td>'.$products['product_unique_id'].'</td>';
            $tbl_html .=  '<td>'.$products['prod_name'].'</td>';
            $tbl_html .=  '<td>'.$products['product_sku'].'</td>';
            $tbl_html .=  '<td>'.$products['brand_name'].'</td>';
            $tbl_html .=  '<td>'.implode(', ',get_cat($products['product_unique_id'],$conn)).'</td>';
           
            $tbl_html .=  '<td><button type="submit" class= "btn btn-danger btn-sm pull-left" name="delete" onclick=delete_products("'.$products['id'].'")>DELETE</button>
							</td></tr>';
           $i++;
		}
		
		$stmt12 = $conn->prepare($query_total);
     
        $stmt12->execute();
        $stmt12->store_result();
        $stmt12->bind_result (  $col55);
                	 
        while($stmt12->fetch() ){
            $totalrow = $col55;         
        }
        
		$page_html =  $Common_Function->pagination('pagination_product',$page,$limit,$totalrow); 
		echo json_encode(array("status"=>1,"page_html" =>$page_html,"tbl_html"=>$tbl_html,"totalrowvalue"=>$totalrow));
    }
    catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}else if ($type == 'delete_popular_product'){ 
	$deletearray = $_POST['product_id'];
	$Common_Function->delete_popular_product($deletearray, $conn,'popular_product');
}

function get_cat($col1,$conn){
	
	$stmt15 = $conn->prepare("SELECT c.cat_name	FROM category c,product_category pc 
					WHERE pc.cat_id  = c.cat_id AND pc.prod_id= '".$col1."'");
           
	$stmt15->execute();
	$data1 = $stmt15->bind_result($col44);
	//  echo " get col data ";
	
	while ($stmt15->fetch()) {
		$cat_names[] = $col44;
	}
	return $cat_names;
}
?>