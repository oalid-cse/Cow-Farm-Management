<?php
	/*Function for validate input data*/
	function validate($value) {
		$value = trim($value);
		$value = stripcslashes($value);
		$value = htmlspecialchars($value);
		$value = mysqli_real_escape_string($GLOBALS['conn'], $value);
		return $value;
	}

	/*Current Date*/
	date_default_timezone_set('Asia/Dhaka');
	$cur_date= date("Y-m-d");
	$cur_time= date("H:i:s");
