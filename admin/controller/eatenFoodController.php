<?php
	
	// add eaten food
	if(isset($_POST['add_cow_eaten_food_btn'])){
		$cow_id = validate($_POST['cow_id']);
		foreach ($_POST['foodCat'] as $food_cat_id => $food_quantity) {
			//get foods and cost from cow food category
			$getFoodCost1 = $conn->query("SELECT SUM(cow_foods_quantity) AS foodQnt, SUM(cow_foods_cost) AS foodCost FROM or_cow_foods WHERE cow_foods_cat_id='".$food_cat_id."' AND cow_foods_status='1' ORDER BY cow_foods_cat_id ASC LIMIT 1");
			while ($getFoodCostRow1 = mysqli_fetch_object($getFoodCost1)) {
				$foodCost1 = $getFoodCostRow1->foodCost;
				$foodQnt1 = $getFoodCostRow1->foodQnt;
			}
			// get remaining foods and cost from or_remaining_cow_food
			$getFoodCost2 = $conn->query("SELECT remaining_cf_quantity, remaining_cf_cost FROM or_remaining_cow_food WHERE remaining_cf_cat_id='".$food_cat_id."' AND remaining_cf_status='1' ORDER BY remaining_cf_cat_id ASC LIMIT 1");
			if(mysqli_num_rows($getFoodCost2)>0){
				while($getFoodCostRow2 = mysqli_fetch_object($getFoodCost2)){
					$foodCost2 = $getFoodCostRow2->remaining_cf_cost;
					$foodQnt2 = $getFoodCostRow2->remaining_cf_quantity;
				}
			}
			else{
				$foodCost2 = 0;
				$foodQnt2 = 0;
			}
			
			// calculate eaten food cost
			$eatenFoodCost = (((float)$foodCost1 + (float)$foodCost2)/((float)$foodQnt1 + (float)$foodQnt2))*$food_quantity;

			$insEatenFoodQry = $conn->query("INSERT INTO or_cow_eaten_foods SET 
				cowEF_cowId			='".$cow_id."',
				cowEF_foodCatId 	= '".$food_cat_id."',
				cowEF_foodQuantity	='".$food_quantity."',
				cowEF_foodCost		='".$eatenFoodCost."',
				cowEF_Time			='".$cur_time."',
				cowEF_Date			='".$cur_date."',
				cowEF_status		='1'
				");
			if($insEatenFoodQry==true){
				echo "<script>location.href='index.php?page=add-eaten-foods&removeFood=success';</script>";
			}
			else{
				echo "<script>location.href='index.php?page=add-eaten-foods&removeFood=error';</script>";
			}

		}
	}



	// check eaten food
	if((isset($_POST['checkAllEatenFoodSubmit'])) && ($_POST['checkAllEatenFoodSubmit']=='go')){
		$getEatenFoodsIdsQry = $conn->query("SELECT cowEF_foodCatId FROM or_cow_eaten_foods WHERE cowEF_status='1'");
		$EatenFoodIds = array();
		// receive all food category id in array
		while($getEatenFoodsIdsRow = mysqli_fetch_object($getEatenFoodsIdsQry)){
			array_push($EatenFoodIds, $getEatenFoodsIdsRow->cowEF_foodCatId);
		}

		// remove duplicate id from this array
		$UniqueEatenFoodIds = array_unique($EatenFoodIds);
		// each food category id work
		foreach ($UniqueEatenFoodIds as $EatenFoodId) {
			// query for get sum of eaten food cost and quantity from or_cow_eaten_food table
			$getEatenFoodDet = mysqli_fetch_object($conn->query("SELECT SUM(cowEF_foodQuantity) AS EF_Quntity, SUM(cowEF_foodCost) AS EF_Cost FROM or_cow_eaten_foods WHERE cowEF_foodCatId='".$EatenFoodId."' AND cowEF_status='1'"));
			$eatenFoodQuantity = round($getEatenFoodDet->EF_Quntity,2);
			$eatenFoodCost = round($getEatenFoodDet->EF_Cost,2);

			// query for get sum of food quantity and food cost from or_cow_food table
			$getCowFoodDet = mysqli_fetch_object($conn->query("SELECT SUM(cow_foods_quantity) AS food_Quantity, SUM(cow_foods_cost) AS food_Cost FROM or_cow_foods WHERE cow_foods_cat_id='".$EatenFoodId."' AND cow_foods_status='1'"));
			$cowFoodQuantity = round($getCowFoodDet->food_Quantity,2);
			$cowFoodCost = round($getCowFoodDet->food_Cost,2);

			// query for get remaining food quantity and cost from or_remaining_cow_food table
			$getRemainingFoodDetQry = $conn->query("SELECT remaining_cf_quantity, remaining_cf_cost FROM or_remaining_cow_food WHERE remaining_cf_cat_id='".$EatenFoodId."' AND remaining_cf_status='1'");
			if(mysqli_num_rows($getRemainingFoodDetQry)>0){
				$getRemainingFoodSS=true;
				$getRemainingFoodDet=mysqli_fetch_object($getRemainingFoodDetQry);
				$remainingFoodQuantity = round($getRemainingFoodDet->remaining_cf_quantity,2);
				$remainingFoodCost = round($getRemainingFoodDet->remaining_cf_cost,2);
			}
			else{
				$remainingFoodQuantity = 0;
				$remainingFoodCost = 0;
			}
			
			// total food quantity and cost (add from or_cow_food and or_remaining_cow_food table)
			$totalFoodQuantity = $cowFoodQuantity + $remainingFoodQuantity;
			$totalFoodCost = $cowFoodCost + $remainingFoodCost;
			// available food quantity and cost (remove eaten food quantity and cost from total food quantity and cost)
			$availableFoodQuantity = $totalFoodQuantity - $eatenFoodQuantity;
			$availableFoodCost = $totalFoodCost - (($totalFoodCost/$totalFoodQuantity)*$eatenFoodQuantity);
			
			// previous or_cow_foods status change to 0 for inactive 
			$pushPreCowFoodQry = $conn->query("UPDATE or_cow_foods SET cow_foods_status ='0' WHERE cow_foods_cat_id='".$EatenFoodId."' AND cow_foods_status='1'");

			// previous or_cow_eaten_foods status change to 0 for inactive
			$pushPreEatenFoodQry = $conn->query("UPDATE or_cow_eaten_foods SET cowEF_status='0' WHERE cowEF_foodCatId='".$EatenFoodId."' AND cowEF_status='1'");

			// previous or_remaining_cow_foods status change to 0 for inactive
			$pushPreRemainingFoodQry = $conn->query("UPDATE or_remaining_cow_food SET remaining_cf_status='0' WHERE remaining_cf_cat_id='".$EatenFoodId."' AND remaining_cf_status='1'");

			// check if all status change is successfully or not
			// if successfully change status
			if(($pushPreCowFoodQry==true) && ($pushPreEatenFoodQry==true) && ($pushPreRemainingFoodQry==true)){
				// add remaining food cost and quantity to or_remaining_cow_food table
				$insRemainingFoodQry = $conn->query("INSERT INTO or_remaining_cow_food SET
					remaining_cf_cat_id='".$EatenFoodId."',
					remaining_cf_quantity='".$availableFoodQuantity."',
					remaining_cf_cost='".$availableFoodCost."',
					remaining_cf_addTime='".$cur_time."',
					remaining_cf_insertDate='".$cur_date."',
					remaining_cf_status='1'");
				// if add remaining food is success
				if($insRemainingFoodQry==true){
					echo "<script>location.href='index.php?page=check-eaten-foods&check=success';</script>";
				}
				else{
					echo "<script>location.href='index.php?page=check-eaten-foods&check=error1';</script>";
				}
			}
			// if something wrong to change status
			else{
				echo "<script>location.href='index.php?page=check-eaten-foods&check=error2';</script>";
			}

		}
		
	}