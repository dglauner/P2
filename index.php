<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" href="styles.css" type="text/css">
<?php
	require('logic.php')
?>
<title>Password Generator</title>
</head>

<body>

<h1>xkcd Password Generator</h1>
<p class="descBox">The button below will generate a random phrase consisting of four common words. According to an xkcd strip, such phrases are hard to guess (even by brute force), but easy to remember, making them interesting password choices.</p>
<h1><?php echo $new_pwd; ?></h1>
<form method='Get' action='index.php'>
	<label for="num_words"># of Words</label>
	<select id="num_words" name="num_words">	
	<?php 
	$output = "";
	for ($j = $minwords; $j <= $maxwords; $j++) { 
    	if ($j == $word_cnt) { 
    	$output = $output."<option value=".$j." selected='selected'>".$j."</option>";
    	 } else { 
    	$output = $output."<option value=".$j.">".$j."</option>";
    	}
     } 
     echo $output;
     ?>		
	</select>
    <br>
    
    <label for='add_num'>Add a random number</label>
    <?PHP if ($do_add_num == TRUE){ 
    	echo "<input type='checkbox' name='add_num' id='add_num' checked='checked'><br>";
     } else { 
    	echo "<input type='checkbox' name='add_num' id='add_num'><br>";
     } ?>
    <label for='add_sym'>Add a random symbol</label>
    <?PHP if ($do_add_sym == TRUE){ 
    	echo "<input type='checkbox' name='add_sym' id='add_sym' checked='checked'><br>";
    } else { 
    	echo "<input type='checkbox' name='add_sym' id='add_sym'><br>";
    } ?>
    
    <input type='submit' value='Create Password'><br>
    
</form>

</body>

</html>
