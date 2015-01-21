<?php
function read_winner() {
	$arr=file_get_contents('./tweets.txt');


	$total=explode(PHP_EOL, $arr);
	$users=[];

	foreach ($total as $key => $value) {
		if( $value == '') continue;
		$user = explode('=', $value);
		$users[$user[0]] = $user[1];
	}

	echo "Vencedor ".array_rand($users), PHP_EOL;
} 

read_winner();