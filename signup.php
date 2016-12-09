<?php
		if(isset($_REQUEST['firstname'])) {
			include_once ("Functions.php");			
			$obj = new Functions();

			$firstname=$_REQUEST['firstname'];
			$lastname=$_REQUEST['lastname'];
			$email=$_REQUEST['email'];
			$organization=$_REQUEST['organization'];
			$number=$_REQUEST['number'];
			$password=$_REQUEST['setpassword'];
			$sender = 'The Near Place';
			$message = 'Congratulations. You have successfully singed up to The Near Place';
			
			$result=$obj->addUser($firstname,$lastname,$organization,$email,$number,$password);
			if(!$result){
				echo "An error occurred";
				exit();
			}else{
				$url = "http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=".$number."&from=".$sender."&text=".$message;
				header("location: $url");
			}
		}
		else{
			echo "Please fill the required fields";
			header('Location:'.$url);
		}
?>