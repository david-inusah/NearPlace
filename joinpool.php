
<head>
    <link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-alpha.4/dist/css/bootstrap.css">
    <script type="text/javascript" src="js/jquery-1.12.1.js"></script>
</head>
<html>
<body>
    <div id=menu>
        <span><h4 align="center">Join a Pool</h4></span>
    </div>
    <br>
    <?php
    include_once ("Functions.php");     
    $obj = new Functions();
    $id = $_SESSION['USERCODE'];
    $row = $obj->getUsername($id);
    if ($row<0){
        echo "an error occurred";
    } 
    else{
        $username=$row['username'];
        $row = $obj->getAllpools($username);
        if($row<0){
            echo "an error occured";
        }
        else {
            while ($row>0){
                echo "<div class='well well-lg'>";
                echo "<h3>$row['poolname']<h3>"; 
                echo "Students intending to take classes in a regular semester must register for the semester by the second day of classes. Students may sign up for classes only after they are registered; the normal add/drop period will be in effect for the first two weeks of the regular semester. </div>";
            }
        }
    }
    ?>
</body>

</html>