<?php

class Custom_customFunctions {
	public function dateToMysql($date){
		echo "date = $date<br/>";
		$tempArray = explode("/", $date);
		print_r($tempArray);
		$new_date = $tempArray[2]."-".$tempArray[1]."-".$tempArray[0];
		return $new_date;
	}
	
	public function getMicroTime(){
		list($usec, $sec) = explode(" ", microtime()); 
        return ((float)$usec + (float)$sec); 
	}
	
	
	public function renameImage($image){
		$ext = pathinfo($image, PATHINFO_EXTENSION);
		$currentMicroTime = self::getMicroTime();
    	$filename = $currentMicroTime.'.'.$ext;
    	$FullFilename = 'images/'.$filename;
    	$filterRename = new Zend_Filter_File_Rename(array('target' => $FullFilename, 'overwrite'=>TRUE));
    	$filterRename->filter($image);  
    	return $filename;
	}
}

