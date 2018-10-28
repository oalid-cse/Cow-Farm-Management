<?php
	session_start();
	include("controller/connection.php");
	include("controller/validator.php");
	$GLOBALS['conn'] = $conn;
	$cur_page_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$cur_user_id = '1';
	include("controller/cattleBreedController.php");
	include("controller/addNewCowController.php");
	include("controller/foodController.php");
	include("controller/eatenFoodController.php");
	include("controller/medicalCostController.php");




	if(isset($_GET['page'])){

		$page = $_GET['page'];

		if($page == 'home')
			include('views/index.php');

		elseif ($page == 'add-new-cow')
			include('views/add_new_cow.php');

		elseif($page == 'cow-list')
			include('views/all_cow_list.php');

		elseif ($page == 'add-cattle-breed')
			include('views/add_cattle_breed.php');

		elseif (($page == 'food-category') && (isset($_GET['edit_id'])) && ($_GET['edit_id'] != ''))
			include('views/edit_food_category.php');

		elseif ($page == 'food-category')
			include('views/food_category.php');

		elseif ($page == 'add-foods')
			include('views/add_foods.php');

		elseif ($page == 'add-eaten-foods')
			include('views/add_eaten_foods.php');

		elseif ($page == 'check-eaten-foods')
			include('views/check_eaten_foods.php');

		elseif ($page == 'add-cow-medical-cost')
			include('views/add_cow_medical_cost.php');
		
		else
			echo "<h1>page not found. please <a href='index.php'>go back</a>...</h1>";
	}

	else{
		include("views/index.php");
	}
