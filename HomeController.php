<?php
require_once('Model/database_handler.php');
require_once('Model/car_model.php');

$action = filter_input(INPUT_POST, 'action');
if($action == NULL) {
		$action = filter_input(INPUT_GET, 'action');
		if($action == NULL) {
			$action = 'list_products_lines';
		}
}

switch($action) {
	case 'list_products_lines':
		$product_line = filter_input(INPUT_GET, 'product_line');
		if($product_line ==NULL || $product_line == FALSE) {
			$product_line = "Classic Cars";
		}
		$product_lines = get_product_lines();
		
		$products = get_products_by_product_line($product_line);
		include('View/product_list.php');
	break;
	case 'delete_or_update':
		$product_line = filter_input(INPUT_POST, 'product_line');
		$product_code = filter_input(INPUT_POST, 'product_code');

		if ($product_line == NULL || $product_line == FALSE ) {
			$error = "Missing product line.";
			include('errors/error.php');
		} 
		if(isset($_POST['Delete'])){
			delete_product($product_code);
			header("Location: .?product_line=$product_line");
		}
		if(isset($_POST['Update'])) {
			$product = get_product_details($product_code);
			$productName = $product['productName'];
			include('View/product_update.php');
		}
	break;
	case 'save_update_changes':
		$product_line = filter_input(INPUT_POST, 'product_line');
		$product_code = filter_input(INPUT_POST, 'product_code', 
			FILTER_SANITIZE_STRING);
		$name = filter_input(INPUT_POST, 'product_name');
		$description = filter_input(INPUT_POST, 'description');
		$scale = filter_input(INPUT_POST, 'scale');
		$vendor = filter_input(INPUT_POST, 'vendor');
		$min_price = filter_input(INPUT_POST, 'min_price',
			FILTER_SANITIZE_NUMBER_FLOAT);
		$buy_price = filter_input(INPUT_POST, 'buy_price',
			FILTER_SANITIZE_NUMBER_FLOAT);
		$in_stock = filter_input(INPUT_POST, 'in_stock', 
			FILTER_SANITIZE_NUMBER_INT);	
		update_product($product_line,$product_code,$name,$description,$scale,$vendor,$min_price,$buy_price,$in_stock);
		header("Location: .?product_line=$product_line");
	break;
	case 'show_add_form':
		$product_lines = get_product_lines();
        include('View/product_add.php');
        break;
	case 'add_product':
		$product_line = filter_input(INPUT_POST, 'product_line');
		$product_code = filter_input(INPUT_POST, 'product_code');
		$name = filter_input(INPUT_POST, 'name');
		$description = filter_input(INPUT_POST, 'description');
		$scale = filter_input(INPUT_POST, 'scale');
		$vendor = filter_input(INPUT_POST, 'vendor');
		$buy_price = filter_input(INPUT_POST, 'min_price',
			FILTER_SANITIZE_NUMBER_FLOAT);
		$min_price = filter_input(INPUT_POST, 'buy_price',
			FILTER_SANITIZE_NUMBER_FLOAT);
		$in_stock = filter_input(INPUT_POST, 'in_stock', 
			FILTER_VALIDATE_INT);
		if ($product_line == NULL ||
				$product_code == NULL ||
				$name == NULL ||
				$description == NULL ||
				$scale == NULL ||
				$vendor == NULL ||
				$buy_price == NULL || $buy_price == FALSE ||
				$min_price == NULL || $min_price == FALSE ||
				$in_stock == NULL || $in_stock == FALSE) {
				$error = "Invalid product data. Check all fields and try again.";
				include('errors/error.php');
		
		} else { 
			add_product($product_line,$product_code,$name,$description,$scale,
						$vendor,$min_price,$buy_price,$in_stock);
			header("Location: .?product_line=$product_line");
		
			
		}
	break;
}//end switch

?>