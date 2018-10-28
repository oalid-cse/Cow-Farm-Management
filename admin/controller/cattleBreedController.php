<?php
	if(isset($_POST['add_cattle_breed_btn'])){
		$cattle_breed_name = validate($_POST['cattle_breed_name']);
		$cattle_breed_desc = mysqli_real_escape_string($GLOBALS['conn'], $_POST['cattle_breed_desc']);

		if($cattle_breed_name == ''){
			echo "<script>location.href='index.php?page=add-cattle-breed&inp=req';</script>";
		}
		else{
			$addCattleBreedQry = $conn->query("INSERT INTO or_cattle_breed SET cattle_breed_name = '".$cattle_breed_name."', cattle_breed_description = '".$cattle_breed_desc."', cattle_breed_insertDate='".$cur_date."', cattle_breed_status='1'");
			if($addCattleBreedQry == true){
				echo "<script>location.href='index.php?page=add-cattle-breed&add=success';</script>";
			}
			else{
				echo "<script>location.href='index.php?page=add-cattle-breed&add=error';</script>";
			}
		}
	}