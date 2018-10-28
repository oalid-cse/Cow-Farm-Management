<?php
	
	include("connection.php");


	// add cow list after select cattle breed
	if((isset($_GET['needShow'])) && ($_GET['needShow']=='cowDetails')){
		$cattle_breed_id = $_GET['cattle_breed_id'];
		$showCowQry = $conn->query("SELECT or_cow_info.cow_id, or_cow_info.cow_name FROM or_cow_info WHERE cattle_breed='".$cattle_breed_id."' AND cow_status='1'");
		$retData = "<option></option>";
		while($showCowRow = mysqli_fetch_object($showCowQry)){
	        $retData = $retData."<option value='$showCowRow->cow_id'>$showCowRow->cow_name</option>";
	    }

	    echo $retData;
	} 




	// add each food after select food category
	if((isset($_GET['needAdd'])) && ($_GET['needAdd']=='eachFoodCat')){

		$total_food_cats = array();

		$food_cat_id = $_GET['food_cat_id'];
		
		if(in_array($food_cat_id, $total_food_cats)){
			echo "alreadyExist";
		}
		else{
			array_push($total_food_cats, $food_cat_id);
			$foodCatQry = $conn->query("SELECT * FROM or_cow_food_category WHERE cow_foodCat_id='".$food_cat_id."'");
			$foodCatRow = mysqli_fetch_object($foodCatQry);

			// get available food from or_cow_foods table
			$availableFoodQry1 = mysqli_fetch_object($conn->query("SELECT SUM(cow_foods_quantity) AS sumFood1 FROM or_cow_foods WHERE cow_foods_cat_id='".$foodCatRow->cow_foodCat_id."' AND cow_foods_status=1"));
			// get available food from or_reamining_cow_food table
			$availableFoodQry2 = mysqli_fetch_object($conn->query("SELECT SUM(remaining_cf_quantity) AS someFood2 FROM or_remaining_cow_food WHERE remaining_cf_cat_id='".$foodCatRow->cow_foodCat_id."' AND remaining_cf_status=1"));
			// get eaten food from or_cow_eaten_foods table
			$removeFoodQry1 = mysqli_fetch_object($conn->query("SELECT SUM(cowEF_foodQuantity) AS removeFood1 FROM or_cow_eaten_foods WHERE cowEF_foodCatId ='".$foodCatRow->cow_foodCat_id."' AND cowEF_status=1"));
			// calculate available food
			$maxFood = round(((float)$availableFoodQry1->sumFood1 + (float)$availableFoodQry2->someFood2)-(float)$removeFoodQry1->removeFood1, 2);

			



			$return = "<div class='form-group'>
	                      <div class='food-product'>
	                        <label style='min-width: 200px; display: inline;'>".$foodCatRow->cow_foodCat_name." : </label>
	                        <div style='display: inline;'>
	                          <input type='number' step='0.01' name='foodCat[".$foodCatRow->cow_foodCat_id."]' class='' max='".$maxFood."' required>
	                        </div>&nbsp;&nbsp;&nbsp;
	                        <button type='button' id='".$foodCatRow->cow_foodCat_id."' onclick='removeAddFood(".$foodCatRow->cow_foodCat_id.")' class='btn btn-danger btn-sm'><i class='fas fa-times-circle'></i></button> (available food is ".$maxFood." kg)
	                      </div>
	                    </div>";
	        echo $return;
		}
		
	}