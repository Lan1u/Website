<?php
ini_set("error_reporting",E_ALL);
ini_set("log_errors","1");
ini_set("error_log","php_errors.txt");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Favourite List</title>
<link rel="stylesheet" href="./css/style.css">
<script src="javaScript/script.js"></script>
</head>
    
    
<body>
<div class="header">
<h1>Favourite List</h1>
</div>
    <div class="buttonDisplay">
<button class='button' onclick=GotoHomepage()>Home Page</button>
<br><br><br>
<button class="button" onclick= GotoStatistics() >Statistics</button>
</div>
<br>
<div class="picturesGrid">
    <?php   
        session_start();  // start or resume a session
        // set session variable name, if we received it
        $_SESSION["name1"]=$_SESSION["name"];
        $conn = new mysqli("mysql.cms.waikato.ac.nz", "zz169", "my11154850sql","zz169");
        //$conn = new mysqli("localhost", "root", "","ass3");
        if ($conn==FALSE) {
            die("<p>ERROR: Unable to connect: " . $conn->connect_error);
        }

        $sql = "SELECT fileName,labelID FROM ass3 WHERE favourited=1";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $name=$row["fileName"];
            $LID=$row["labelID"];
            if($LID==0){$LableName="Other";}
            else if($LID==0){$LableName="Other";}
            else if($LID==1){$LableName="Crater";}
            else if($LID==2){$LableName="Dark Dune";}
            else if($LID==3){$LableName="Slope Streak";}
            else if($LID==4){$LableName="Bright Dune";}
            else if($LID==5){$LableName="Impact Ejecta";}
            else if($LID==6){$LableName="Swiss Cheese";}
            else if($LID==7){$LableName="Spider";}
            else{$LableName="###Unknown###";}
            echo "<div class='grid-item'><div><img src='https://www.cms.waikato.ac.nz/~mmayo/compx222/mars/images/$name' alt='img'></div>
            <div class='container'><p>$name  $LableName</p>
            </div></div>";
        }
    ?>
</div>
    
</body>
</html>
