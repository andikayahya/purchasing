<?php
	include "koneksi.php";
	$jam = date ('H:i:s');
	/////
	function get_hh_mm_ii($jam) {
	        return date("G\:H A", strtotime($jam));
	}
	///DigitalCLock///
	function display_time()
	{
		$hour = date("g");
		$minute = date("i");
		$second = date("s");
		$ampm = date("a");
		for ($i=0; $i<=600; $i++){
		  	$minute = sprintf('%02d', $minute);
		  	$second = sprintf('%02d', $second);
		  	echo "<li class='link' id='time$i'>$hour:$minute:$second $ampm </li>";
		  	$second++;
		  	if ($second == 60) {
		     	$second = 0;
		     	$minute++;
		  	}
		  	if ($minute == 60) {
		     	$minute = 0;
		     	$hour++;
		  	}
		 	if ($hour == 13) {
		     	$hour = 1;
		  	}
		}
	}
	////////////////////////31 Mei 2013/////////////////////////
	function timeSpent($date_created, $endingDay)
	{
		$diff = abs(strtotime($date_created) - strtotime(date("Y-m-d H:i:s")));
		$years = floor($diff / (365 * 60 * 60 * 24));
		$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
		$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
		$hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
		$minuts = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
		$seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
		$week = floor($days / 7);
		$day = $days % 7;
		if ($week < 1 && $week != 0)
		{
		 	return $days . " days - " . $hours . " hrs - " . $minuts . "- min" . $week;
		} 

		elseif ($week == 0 && $months == 0 && $years == 0) {
		  	if ($days != 0) 
		  	{
		      	return $days . "days " . $hours . "hours ago";
		  	} 
		  	elseif ($hours != 0) {
		      	return $hours . "hours " . $minuts . "minute ago";
		  	} 
		  	elseif ($minuts) {
		      	return $minuts . "minute " . $seconds . "seconds ago";
		  	} 
		  	else {
		      	return "few seconds ago";
		  	}
		} 

		else 
		{
		  $stamp = strtotime($date_created);
		  return date("F d Y", $stamp);
		}
	}
?>