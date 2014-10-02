<?php
//Globals for min & max number of words
$maxwords = 10;
$minwords = 2;

//Word Array
$words = generateWordList();

//symbol Array
$symbols[0]   = "!";
$symbols[1]   = "@";
$symbols[2]   = "#";
$symbols[3]   = "$";
$symbols[4]   = "-";
$symbols[5]   = "^";
$symbols[6]   = "&";
$symbols[7]   = "*";
$symbols[8]   = "~";
$symbols[9]   = "+";
$symbols[9]   = "%";

//Track option to add number
$do_add_num = setFlag('add_num');
//Track option to add symbol
$do_add_sym = setFlag('add_sym');
//Track requested word count
$word_cnt = getCount('num_words', $maxwords, $minwords);
//Track separator index
$sep_idx = getCount('sep_idx', count($symbols) - 1, 0);

//Start: Generate new password
$rand_nums = getUniqueNumbers(0, count($words) - 1, $word_cnt);

$new_pwd = "";
for($i = 0; $i < $word_cnt; $i++) {
    $new_pwd = $new_pwd.$words[$rand_nums[$i]];
    if ($i < $word_cnt - 1){
		$new_pwd= $new_pwd.$symbols[$sep_idx] ;
	}
}

if ($do_add_num == TRUE){
	$new_pwd = $new_pwd.$symbols[$sep_idx].rand(0,9);
}

if ($do_add_sym  == TRUE){
	$new_pwd = $new_pwd.$symbols[$sep_idx].$symbols[rand(0,count($symbols) - 1)];
}
//end: Generate new password


function setFlag($key){
	/*******************************************
		key: Querystring index
	********************************************
		Get the querystring value for a key...
	********************************************/
	 
	$retval = FALSE;
	if (isset($_GET[$key])) {
		if (strtolower($_GET[$key]) == 'on') {
			$retval = TRUE;
		}
	}
	return $retval;
}

function getCount($key, $max, $min){
	/*******************************************
		min: Minimum number
		max: Maximum number
		key: Querystring index
	********************************************
		Get a numeric value requested 
		in a querystring variable.
		Make sure it's within min and max...
	********************************************/
	$retval = 4;
	if (isset($_GET[$key])) {
		$retval = (int)$_GET[$key];
	}
	//only allow within a certain range
	if ($retval > $max){
		$retval = $max;
	} elseif ($retval < $min){
		$retval = $min;
	}
	
	return $retval;
}

function getUniqueNumbers($min, $max, $num){
	/*******************************************
		min: Minimum number
		max: Maximum number
		num: Number of random numbers to return
	*********************************************
		Returns an array of random unique numbers 
		within a range between min and max...
	********************************************/
	$tempval = range($min,$max);
	shuffle($tempval);
    return array_slice ($tempval, 0, $num);
}

function generateWordList(){
	/*******************************************
		Returns an array of words to be used 
		as the source to generate a new password.
	********************************************/
    //open my local word file
	$myFile = file_get_contents('words.txt', TRUE);
	//set replacement order
	$replaceOrder = array("\r\n", "\r");
	$newstr = str_replace($replaceOrder, "\n" , $myFile);
	//Trim any whitespace
	$wordList = array_map('trim', explode("\n", $newstr));
		
	return $wordList;
}

?>