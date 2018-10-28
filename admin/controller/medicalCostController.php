<?php

	// add cow medical cost
	if(isset($_POST['add_cow_medical_cost'])){
		$cow_id 		= validate($_POST['cow_id']);
		$illness_name 	= validate($_POST['illness_name']);
		$illness_cost 	= validate($_POST['illness_cost']);

		// check any input are empty or not
		if(($cow_id=='') || ($illness_name=='') || ($illness_cost=='')){
			echo "<script>location.href='index.php?page=add-cow-medical-cost&inp=empty';</script>";
		}
		else{
			// insert medical cost query
			$insMcCostQry = $conn->query("INSERT INTO or_cow_medical_cost SET
				cow_MC_cowId		='".$cow_id."',
				cow_MC_illnessName	='".$illness_name."',
				cow_MC_cost 		='".$illness_cost."',
				cow_MC_userId		='".$cur_user_id."',
				cow_MC_insertTime	='".$cur_time."',
				cow_MC_insertDate	='".$cur_date."',
				cow_MC_status		='1'");

			// if medical cost inserted succesfylly then return previous page with success message
			if($insMcCostQry==true){
				echo "<script>location.href='index.php?page=add-cow-medical-cost&add=success';</script>";
			}
			// if something went wrong to insert medical cost then return previous page with error message
			else{
				echo "<script>location.href='index.php?page=add-cow-medical-cost&add=error';</script>";
			}
		}
	}