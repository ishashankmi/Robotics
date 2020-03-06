<?php 
$con=mysqli_connect('localhost','sammy','hellow','test_db');
if($con){
	$qu=mysqli_query($con,"SELECT * FROM icrc");
	if(mysqli_num_rows($qu)>0){
		$fet=mysqli_fetch_assoc($qu);
		$move=$fet['move'];
		$light=$fet['lights'];
		$auto=$fet['automation'];
		echo $move.",".$light.",".$auto;
	};
};
?>