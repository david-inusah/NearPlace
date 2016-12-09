<html>
<head>
	<link href="index.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery-1.12.1.js"></script>
	<script type="text/javascript">
	var currentObj=null;
	function deleteFileComplete(xhr,status){
		if(status!="success"){
			confirm("Unable to delete file");
			return;
		}
		// alert("yattah!");
		var obj=$.parseJSON(xhr.responseText);
		if (obj.result==0){
			alert(obj.message);
		}
		else {
			var row = currentObj.parentNode.parentNode;
			row.parentNode.removeChild(row);
			alert(obj.message);
		}
	}

	function deleteFile(obj,usercode){
		var r = confirm("Are you sure you want to delete this user?");
		if (r==false){
			// alert("yattah");
		}
		else{
			var ajaxURL="uajax.php?cmd=1&usercode="+usercode;
			$.ajax(ajaxURL,
				{async:true,
					complete: deleteFileComplete}
					);
			currentObj=obj;
		}
	}
	</script>
</head>
<body>
	<header><a href="#" title=""><img src="img/pointer.jpg"></a><h1> Admin Portal</h1></header>
	<div style="margin-left:25%" class="content" style="color:black" style="background-color:black">
		<?php
		include_once("Functions.php");
		$obj = new Functions();
		session_start();
		$usercode = $_SESSION['USERCODE'];
		
		if (!$obj->getUsers()) {
			echo "<span>Unable to access users</span>";
			exit();
		}
		$row=$obj->fetch();
		if($row>0){
			echo "<table class='deltab'>
			<tr id='hd'>
			<td></td>
			<td>File Name</td>";
			$count=0;
			$num=1;
			while ($row){
				if ($count==0){
					echo"<tr id='r1'>
					<td >$num</td>
					<td>{$row['Email']}</td>
					<td style='width:2%'' class='action'><button onclick='deleteFile(this,$usercode)'><img class='bin' src='img/delete.png'></button></td>
					</tr>";
					$count=1;
				}
				else if($count==1){
					echo"<tr id='r2'>
					<td >$num</td>
					<td>{$row['Email']}</td>
					<td style='width:2%'' class='action'><button onclick='deleteFile(this,$usercode)'><img class='bin' src='img/delete.png'></button></td>
					</tr>";
				}
				$row=$obj->fetch();
				$num++;
			}
			echo "</table>";
		}
		else {
			echo "<span>Sorry. No files to display</span>";
		}
		?>
	</div>
</body>
</html>