<?php
$con=mysqli_connect("localhost",'sammy','hellow','test_db');

if(isset($_POST['btn'])){
	$move=$_POST['value'];
	mysqli_query($con,"update icrc set move='$move'");
};

if(isset($_POST['lights'])){
	$light=$_POST['light'];
	mysqli_query($con,"update icrc set lights='$light'");
}

if(isset($_POST['automation'])){
	$auto=$_POST['autox'];
	mysqli_query($con,"update icrc set automation='$auto'");
}
?>