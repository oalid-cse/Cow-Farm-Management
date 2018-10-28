<?php
	
	if(isset($_POST['add_new_cow_btn'])){
		$cattle_breed = validate($_POST['cattle_breed']);
		$cow_name = validate($_POST['cow_name']);
		$cow_from = validate($_POST['cow_from']);
		$cow_cost = validate($_POST['cow_cost']);
		$fare_cost = validate($_POST['fare_cost']);
		$cow_description = mysqli_real_escape_string($GLOBALS['conn'], $_POST['cow_description']);

		if($_FILES['cow_image1']['name'] != ''){ //check file select or not
			$img_name1 = addslashes($_FILES['cow_image1']['name']); //get image name
			$img_tmp1 = $_FILES['cow_image1']['tmp_name']; //temporary upload
			$img_content1 = getimagesize($img_tmp1); //check this file is image or not
			if($img_content1==false) {
	    		echo "<script>location.href = 'index.php?page=add-new-cow&imgerr=1';</script>";
			}
			else {
				$ex = explode(".", $img_name1);
				$ext = end($ex); //get file extention
				$filename = uniqid();
				$move_img1 = move_uploaded_file($img_tmp1, "images/cowImage/".$filename.".".$ext); //upload file into server
				$img_link1 = "images/cowImage/".$filename.".".$ext; //get file name
				if($move_img1 != true) {
	    			echo "<script>location.href = 'index.php?page=add-new-cow&imgerr=2';</script>";
				}
			}
		}
		else{
			$img_link1 = null;
		}

		if($_FILES['cow_image2']['name'] != ''){ //check file select or not
			$img_name2 = addslashes($_FILES['cow_image2']['name']); //get image name
			$img_tmp2 = $_FILES['cow_image2']['tmp_name']; //temporary upload
			$img_content2 = getimagesize($img_tmp2); //check this file is image or not
			if($img_content2==false) {
	    		echo "<script>location.href = 'index.php?page=add-new-cow&imgerr=1';</script>";
			}
			else {
				$ex = explode(".", $img_name2);
				$ext = end($ex); //get file extention
				$filename = uniqid();
				$move_img2 = move_uploaded_file($img_tmp2, "images/cowImage/".$filename.".".$ext); //upload file into server
				$img_link2 = "images/cowImage/".$filename.".".$ext; //get file name
				if($move_img2 != true) {
	    			echo "<script>location.href = 'index.php?page=add-new-cow&imgerr=2';</script>";
				}
			}
		}
		else{
			$img_link2 = null;
		}

		$insCowInfoQry = $conn->query("INSERT INTO or_cow_info SET cow_name='".$cow_name."', cattle_breed='".$cattle_breed."', cow_description='".$cow_description."', cow_image1='".$img_link1."', cow_image2='".$img_link2."', cow_insertStatus='".$cow_from."', cow_preCost='".$cow_cost."', cow_fareCost='".$fare_cost."', cow_insertDate='".$cur_date."', cow_status='1'");
		if($insCowInfoQry==true){
			echo "<script>location.href = 'index.php?page=add-new-cow&addCow=success';</script>";
		}
		else{
			echo "<script>location.href = 'index.php?page=add-new-cow&addCow=error';</script>";
		}
	}