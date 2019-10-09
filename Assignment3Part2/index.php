<?php
ini_set("error_reporting",E_ALL);
ini_set("log_errors","1");
ini_set("error_log","php_errors.txt");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/style.css">
<script src="javaScript/script.js"></script>
<title>Mars View</title>
</head>
    
<body>

<div class="header">
<h1>Mars View</h1>
</div>

<div class="picturesGrid">
<?php       
session_start();
if (isset($_SESSION["name1"])) {
$conn = new mysqli("mysql.cms.waikato.ac.nz", "zz169", "my11154850sql","zz169");
    //$conn = new mysqli("localhost", "root", "","ass3");
    if ($conn==FALSE) {
        die("<p>ERROR: Unable to connect: " . $conn->connect_error);
    }
    $x=0;
    $_SESSION["name"]=array();  
    while($x < 25) {
        $m=$_SESSION['name1'][$x];
        $sql = "SELECT fileName,labelID,ID FROM ass3 WHERE fileName='$m'";
        $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                $name=$row["fileName"];
                $LID=$row["labelID"];
                $ID=$row["ID"];
            }
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



        echo "<div class='grid-item'><div><a href='../~ln46/picDetail.php?number=$ID'><img id=$x src='https://www.cms.waikato.ac.nz/~mmayo/compx222/mars/images/$name' alt='img'></div>
        <div class='container'></a>
        <p>$LableName</p>
        </div></div>";
        array_push($_SESSION["name"],$name);
        $x++;
        }
   
        $conn->close();
        unset($_SESSION['name1']);      
        }
    
else{
    $x = 0;
    $conn = new mysqli("mysql.cms.waikato.ac.nz", "zz169", "my11154850sql","zz169");
    //$conn = new mysqli("localhost", "root", "","ass3");
    if ($conn==FALSE) {
        die("<p>ERROR: Unable to connect: " . $conn->connect_error);
    }

    $picArray=array();
    $n=0;
    while($n<25){
        $number=rand(1,30);
        if(check($picArray,$number)==true){
            array_push($picArray,$number);
            $n++;
        }
    }
    $_SESSION["name"]=array();
    while($x < 25) {
        $sql = "SELECT fileName,labelID FROM ass3 WHERE ID=$picArray[$x]";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $name=$row["fileName"];
            $LID=$row["labelID"];
        }
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
        
        echo "<div class='grid-item'><div><a href='../~ln46/picDetail.php?number=$picArray[$x]'><img id=$x src='https://www.cms.waikato.ac.nz/~mmayo/compx222/mars/images/$name' alt='test!!!'></div><div class='container'></a>
        <p>$LableName</p>
        </div></div>";
        /*
        echo "<div class='grid-item'><div><a href='../ass3/picDetail.php?number=$picArray[$x]'><img id=$x src='https://www.cms.waikato.ac.nz/~mmayo/compx222/mars/images/$name' alt='img'></div>
        <div class='container'></a>
        <p>$name $LableName</p>
        </div></div>";*/
        array_push($_SESSION["name"],$name);
        $x++;
    }
   
    $conn->close();
}

function check($ar,$number) {
    $arrlength = count($ar);
    for($x = 0; $x < $arrlength; $x++) {
        if($ar[$x]==$number){
            return false;
        }
    }
    return true;
}
?>
</div>
<!--end of picture grid-->
    
    
<div class="buttonDisplay">
<button class="button" onclick=location.reload() >Refresh</button>
<br>
<br>
<br>
<button class="button" onclick= GotoFavourite() >Favourite</button>
<br>
<br>
<br>
<button class="button" onclick= GotoStatistics() >Statistics</button>
</div> 
    
    
</body>
</html>

