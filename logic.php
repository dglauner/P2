<?php
//Globals
$maxwords = 10;
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


//Track number of words
if (isset($_GET['num_words'])) {
	$word_cnt = (int)$_GET['num_words'];
} else {
	$word_cnt = 4;
}
	//hack prevention
if ($word_cnt > $maxwords){
	$word_cnt = $maxwords;
} elseif ($word_cnt < 2){
	$word_cnt = 2;
}

//Track option to add number
if (isset($_GET['add_num'])) {
	$do_add_num = TRUE;
} else {
	$do_add_num = FALSE;
}
//Track option to add symbol
if (isset($_GET['add_sym'])) {
	$do_add_sym = TRUE;
} else {
	$do_add_sym = FALSE;
}

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