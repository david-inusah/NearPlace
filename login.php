<?php
if(isset($_REQUEST['email'])&&isset($_REQUEST['password'])) {
	$db=new mysqli("127.0.0.1","root","","nearplace");

	if($db->connect_errno!=0){
		echo "error authenticating-connection {$db->connect_error}";
		exit();
	}


	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];

	$str_query="select usercode, Admin from users WHERE Email='$email' and Password='$password'";
	$result=$db->query($str_query);
	if(!$result){
		echo "error authenticating";
		exit();
	}

	$row=$result->fetch_assoc();
	if(!$row){
				//username or password must be wrong
		echo "username or password is wrong.";
		header("location: index.html");
	}else{
		$usercode = $row['usercode'];
		$admin = $row['Admin'];

		session_start();
		$_SESSION['USERCODE']=$usercode;

		if ($admin<1){
			header("location: dashboard.html");
		}
		else{
			header("location: admin.php?usercode".$usercode);
		}
	}
}
?>
