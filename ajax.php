<?php
	//check command
if(!isset($_REQUEST['cmd'])){
	echo '{"message": "cmd is not provided"}';
	exit();
}
/*get command*/
$cmd=$_REQUEST['cmd'];
switch($cmd){
	case 1:
			deleteFile();		//if cmd=1 the call delete
			break;
			default:
			echo json_encode("wrong cmd");	//change to json message
			break;
		}
	/**
	* Delete Function that calls deleteFile Function in userFiles.php
	* @return json encoded response based on whether deleteFile returns true or false 
	*/
	function deleteFile(){
		//check if there is a user code
		if(!isset($_REQUEST['usercode'])){
			echo '{"message": "usercode is not given"}';	//change to json message	
			exit();
		}
		$usercode=$_REQUEST['usercode'];
		include_once("Functions.php");
		$obj=new Functions();
		//delete the file
		if($obj->deleteUser($usercode)){
			echo '{"result":1,"message":"File deleted"}';
		}else{
			echo '{"result":0,"message":"File not deleted"}';
		}
	}
	?>