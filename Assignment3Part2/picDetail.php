<?php
ini_set("error_reporting",E_ALL);
ini_set("log_errors","1");
ini_set("error_log","php_errors.txt");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Picture Details</title>
<link rel="stylesheet" href="./css/style.css">
<script src="javaScript/script.js"></script>
</head>


<!-- page body -->
<body>
    
<div class="header">
<h1>Picture Details</h1>
</div>
    
<div class="button">
<button class='button' onclick=GotoHomepage()>Home Page</button>
<button class="button" onclick= GotoFavourite() >Favourite</button>
<button class="button" onclick= GotoStatistics() >Statistics</button>
</div>
    
  <?php
    $name;
    session_start();  // start or resume a session
    // set session variable name, if we received it
      $_SESSION["name1"]=$_SESSION["name"];
    if (isset($_GET["number"])) {
        $imagenumber=$_GET["number"];
        $conn = new mysqli("mysql.cms.waikato.ac.nz", "zz169", "my11154850sql","zz169");
        //$conn = new mysqli("localhost", "root", "","ass3");
        if ($conn==FALSE) {
            die("<p>ERROR: Unable to connect: " . $conn->connect_error);
        }
        $sql = "SELECT fileName,labelID,favourited,comments,rating FROM ass3 WHERE ID=$imagenumber";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $name=$row["fileName"];
            $LID=$row["labelID"];
            $comments=$row["comments"];
            if($row["favourited"]==1){
                $rating=$row["rating"];
                $bool='true';
                $favourite='Yes';
            }
            else{
                $favourite='No';
                $rating=$row['rating'];
                $bool='false';
            }
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
        


echo"
<br>
<div class='bg'></div>






<br>
<br>
<br>
<br>
";


echo"
    <style>
        .bg {
            /* The image used */
             background-image: url('https://www.cms.waikato.ac.nz/~mmayo/compx222/mars/images/$name');
            margin:auto;
            /* Full height */
            height: 80%; 
            width:80%;
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>";
    }
    
else{
    echo '<p>Sorry this picture is not available!!!</p>';
}

?>
    
    
<p>Picture name: <?php echo $GLOBALS['name'] ?></p>
<p>Category: <?php echo $GLOBALS['LableName'] ?></p>
<p>Favourite: <?php echo $GLOBALS['favourite'] ?></p>
<p>Comments: <?php echo $GLOBALS['comments'] ?></p>
<?php if($bool=='true'): ?>    
<p>Rating: <?php echo $GLOBALS['rating'] ?></p>
<?php endif; ?>
<hr>
<div style="text-align:center">
<form action="" name="Category"method="post">
Category:<select id='categoryDropdown' name='Category'>
    <option disabled selected value> -- select an option -- </option>
    <option value='0'>Other</option>
    <option value='1'>Crater</option>
    <option value='2'>Dark Dune</option>
    <option value='3'>Slope Streak</option>
    <option value='4'>Bright Dune</option>
    <option value='5'>Impact Ejecta</option>
    <option value='6'>Swiss Cheese</option>
    <option value='7'>Spider</option>
</select>

<div>
<input class='favouriteRadio' type='radio' name='FavouriteRadio' value='1'> Add to Favourite<br>
<input class='favouriteRadio' type='radio' name='FavouriteRadio' value='0'> Remove from Favourite<br>
</div>

<textarea name='comments' id='textBox' rows='5' cols='30' onblur='validateComments()'>
</textarea><br><br>

Favourite Rating: <input type='number' name='rating' min='1' max='10'>
<input type='submit' name="Submit" value="Update">
</form>
    </div>
<?php
if(isset($_POST['Submit'])){
    $query="UPDATE ass3 SET labelID='$_POST[Category]', favourited='$_POST[FavouriteRadio]', comments='$_POST[comments]',rating='$_POST[rating]' WHERE ID=$imagenumber";
    if($conn->query($query)==TRUE){
        header("Refresh:0");
        echo "Data has updated";
    }
    else{
        echo "Error when updating data";
    }
}
    
    
 
    ?>

</body>
</html>
