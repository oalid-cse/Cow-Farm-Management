<?php
	
	//if submit add food category form
	if(isset($_POST['add_food_category_btn'])){
		$food_category_name = validate($_POST['food_category_name']);

		//check if not empty the category name input  
		if(!empty($food_category_name)){
			//query for check category name is already added or not
			$chkFoodCatQry = $conn->query("SELECT * FROM or_cow_food_category WHERE cow_foodCat_name='".$food_category_name."'");
			if(mysqli_num_rows($chkFoodCatQry)>0){
				echo "<script>location.href='index.php?page=food-category&catAdd=exist';</script>";
			}
			else{
				//query for insert category in database
				$insFoodCatQry = $conn->query("INSERT INTO or_cow_food_category SET cow_foodCat_name = '".$food_category_name."', cow_foodCat_insertDate = '".$cur_date."', cow_foodCat_status = '1'");

				//if category added succesfully in database
				if($insFoodCatQry==true){
					echo "<script>location.href='index.php?page=food-category&catAdd=success';</script>";
				}
				//if category not added
				else{
				echo "<script>location.href='index.php?page=food-category&catAdd=error';</script>";
				}
			}
		}
		//if category name input is empty
		else{
			echo "<script>location.href='index.php?page=food-category&catInp=req';</script>";
		}
	}




	//if submit the edit food category form
	if(isset($_POST['edit_food_category_btn'])){
		$cow_foodCat_id = validate($_POST['food_category_id']);
		$cow_foodCat_name = validate($_POST['food_category_name']);

		//query for check the food category exist or not
		$chkFoodCatQry = $conn->query("SELECT * FROM or_cow_food_category WHERE cow_foodCat_id='".$cow_foodCat_id."'");
			//if food category exist then go to next for update
			if(mysqli_num_rows($chkFoodCatQry)>0){
				//query for update food category name
				$updFoodCatQry = $conn->query("UPDATE or_cow_food_category SET cow_foodCat_name='".$cow_foodCat_name."', cow_foodCat_updateDate='".$cur_date."' WHERE cow_foodCat_id='".$cow_foodCat_id."'");
				if($updFoodCatQry==true){
					echo "<script>location.href='index.php?page=food-category&catUpd=success';</script>";
				}
				else{
					echo "<script>location.href='index.php?page=food-category&catUpd=error';</script>";
				}
			}
		//if food category have not exist then go previous page 
			else{
					echo "<script>location.href='index.php?page=food-category&catId=notFound';</script>";
			}

	}


	

	//if submit food category delete form
	if(isset($_POST['cow_foodCat_delete_btn'])){
		$cow_foodCat_del_id = validate($_POST['cow_foodCat_del_id']);

		//query for check category exist or not
		$chkFoodCatQry = $conn->query("SELECT * FROM or_cow_food_category WHERE cow_foodCat_id='".$cow_foodCat_del_id."'");
		if(mysqli_num_rows($chkFoodCatQry)>0){

			//query for delete selected category
			$delFoodCatQry = $conn->query("DELETE FROM or_cow_food_category WHERE cow_foodCat_id='".$cow_foodCat_del_id."'");
			if($delFoodCatQry==true){
				echo "<script>location.href='index.php?page=food-category&delCat=success';</script>";
			}
			else{
				echo "<script>location.href='index.php?page=food-category&delCat=error';</script>";
			}
		}
		else{
				echo "<script>location.href='index.php?page=food-category&catId=notFound';</script>";
		}
	}



	//if submit add foods form 
	if(isset($_POST['add_cow_foods_btn'])){
		$cow_foodsCat_id = validate($_POST['cow_foodsCat_id']);
		$cow_Foods_quantity = validate($_POST['cow_Foods_quantity']);
		$cow_foods_cost = validate($_POST['cow_foods_cost']);
		$cow_foods_description = validate($_POST['cow_foods_description']);

		if((!empty($cow_foodsCat_id)) && (!empty($cow_Foods_quantity)) && (!empty($cow_foods_cost))){
			$addFoodsQry = $conn->query("INSERT INTO or_cow_foods SET 
				cow_foods_cat_id='".$cow_foodsCat_id."', 
				cow_Foods_quantity='".$cow_Foods_quantity."', 
				cow_foods_cost='".$cow_foods_cost."', 
				cow_foods_description='".$cow_foods_description."', 
				cow_foods_addedUser_id='".$cur_user_id."', 
				cow_foods_addTime='".$cur_time."', 
				cow_foods_insertDate='".$cur_date."', 
				cow_foods_status='1'");

			if($addFoodsQry==true){
				echo "<script>location.href='index.php?page=add-foods&addFoods=success';</script>";
			}
			else{
				echo "<script>location.href='index.php?page=add-foods&addFoods=error';</script>";
			}
		}
		else{
			echo "<script>location.href='index.php?page=add-foods&allInp=required';</script>";
		}
	}





















