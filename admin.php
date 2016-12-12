<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="css/custom.css" rel="stylesheet">
	<script type="text/javascript">
	var currentObj=null;
	function deleteUserComplete(xhr,status){
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

	function deleteUser(obj,usercode){
		var r = confirm("Are you sure you want to delete this user?");
		if (r==false){
			// alert("yattah");
		}
		else{
			var ajaxURL="ajax.php?cmd=1&usercode="+usercode;
			$.ajax(ajaxURL,
				{async:true,
					complete: deleteUserComplete}
					);
			currentObj=obj;
		}
	}
	</script>
</head>
<body>
	<body style="background:#A9A9A9;">
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Logo and responsive toggle -->
        <div class="navbar-header">
            <a class="navbar-brand" href="admin.php">
              <span><img src="img/pointer.jpg" width="35px" height="35px"></span> 
              The Near Place: Admin Panel
          </a>
      </div>
  </div>
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
			echo "<h3>Edit Application Users</h3>
			<table class='deltab'>
			<tr id='hd'>
			<td></td>
			<td>Users</td>";
			$count=0;
			$num=1;
			while ($row){
				if ($count==0){
					echo"<tr id='r1'>
					<td >$num</td>
					<td>{$row['Email']}</td>
					<td style='width:2%'' class='action'><button onclick='deleteUser(this,$usercode)'><img class='bin' src='img/delete.png' style='height:10px;width:10px;'></button></td>
					</tr>";
					$count=1;
				}
				else if($count==1){
					echo"<tr id='r2'>
					<td >$num</td>
					<td>{$row['Email']}</td>
					<td style='width:2%'' class='action'><button onclick='deleteUser(this,$usercode)'><img class='bin' src='img/delete.png' style='height:10px;width:10px;'></button></td>
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