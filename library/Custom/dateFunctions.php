<?php

class Custom_dateFunctions {
	public function dateToMysql($date){
		echo "date = $date<br/>";
		$tempArray = explode("/", $date);
		print_r($tempArray);
		$new_date = $tempArray[2]."-".$tempArray[1]."-".$tempArray[0];
		return $new_date;
	}
}