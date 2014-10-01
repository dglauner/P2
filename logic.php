<?php
//Globals
$maxwords = 10;
$minwords = 2;
//Word Array
$words[0]   = "dog";
$words[1] = "cat";
$words[2]   = "pizza";
$words[3]   = "telephone";
$words[4]   = "tape";
$words[5]   = "bronco";
$words[6]   = "iphone";
$words[7]   = "together";
$words[8]   = "book";
$words[9]   = "second";
$words[10]   = "western";
$words[11]   = "massage";
$words[12]   = "voice";
$words[13]   = "engine";
$words[14]   = "radio";
$words[15]   = "computer";
$words[16]   = "television";
$words[17]   = "cassette";
$words[18]   = "spindle";
$words[19]   = "notepad";

//symbol Array
$symbols[0]   = "!";
$symbols[1]   = "@";
$symbols[2]   = "#";
$symbols[3]   = "$";
$symbols[4]   = "%";
$symbols[5]   = "^";
$symbols[6]   = "&";
$symbols[7]   = "*";
$symbols[8]   = "~";
$symbols[9]   = "+";

//Track option to add number
$do_add_num = setFlag('add_num');
//Track option to add symbol
$do_add_sym = setFlag('add_sym');
//Track requested word count
$word_cnt = get_word_count('num_words', $maxwords, $minwords);

//Start: Generate new password
$rand_nums = getUniqueNumbers(0, count($words) - 1, $word_cnt);

$new_pwd = "";
for($i = 0; $i < $word_cnt; $i++) {
    $new_pwd = $new_pwd.$words[$rand_nums[$i]];
    if ($i < $word_cnt - 1){
		$new_pwd= $new_pwd."-";
	}
}

if ($do_add_num == TRUE){
	$new_pwd = $new_pwd."-".rand(0,9);
}

if ($do_add_sym  == TRUE){
	$new_pwd = $new_pwd."-".$symbols[rand(0,count($symbols) - 1)];
}
//end: Generate new password


function setFlag($key){
	//get key return value with hack prevention
	$retval = FALSE;
	
	if (isset($_GET[$key])) {
		if (strtolower($_GET[$key]) == 'on') {
			$retval = TRUE;
		}
	}
	
	return $retval;
}

function get_word_count($key, $max, $min){
	//Track number of words
	$retval = 4;
	if (isset($_GET['num_words'])) {
		$retval = (int)$_GET['num_words'];
	}
	//only allow within a certain range
	if ($retval > $max){
		$retval = $max;
	} elseif ($retval < $min){
		$retval = $min;
	}
	
	return $retval;
}

function getUniqueNumbers($min, $max, $num)
{
	/*******************************************
		min: Minimum number
		max: Maximum number
		num: Number of random numbers to return
	********************************************/
	$tempval = range($min,$max);
	shuffle($tempval);
    return array_slice ($tempval, 0, $num);
}

?>