
<?php


include_once("../database.php");
session_start();
if(isset($_SESSION['user_id'])):
    
 ?>

 <?php 
if(isset($_POST['update']))
{
    $sid=$_SESSION['sid'];
$sql="SELECT * FROM season WHERE season_id=$sid";
$result=$db->getRows($sql,array());
foreach($result as $value)
{
    $season_name=$value['season_name_en'];
    $seasonyear=$value['season_year'];
}
$old_season_folder=$season_name.'-'.$seasonyear;

    $enName=$_POST['enName'];
    $arName=$_POST['arName'];
    $season_year=$_POST['year'];

    $sql="SELECT * FROM season where season_name_en=$enName && season_name_ar=$arName && season_year=$season_year";
   $_SESSION['count']=$db->getCount($sql);
   
   $new_season_folder=$enName.'-'.$season_year;
 
    $date_add=date("Y-m-d H:i:s");


 /*   
    
$all_image=array();
    $gallery=$_FILES["fileToUpload_gallery"];
    $image_name=$gallery['name'];
    $image_tmp=$gallery['tmp_name'];
    $file_count=count($image_name);
    for($i = 0 ; $i < $file_count ; $i++)
    {
    
        //$temp=addslashes(file_get_contents($image_tmp[$i]));
        move_uploaded_file($image_tmp[$i]  , "img/".$image_name[$i]);
        $all_image[]=$image_name[$i];
    }
    $temp=implode(',' , $all_image );








    $image=$_FILES["fileToUpload"]["name"];
    $image_tmp=$_FILES["fileToUpload"]["tmp_name"];
    move_uploaded_file( $image_tmp,"img/$image");
   
    */
    
  

}






$servername = "localhost";
$username = "root";
$password = "";
$dbname = "designer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET CHARACTER SET utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($_SESSION['count']>0)
{
    header('location:season.php');

}
else {

$sql="UPDATE season SET season_name_en='$enName' , season_name_ar='$arName' , season_year='$season_year' , season_date='$date_add'  WHERE season_id= $sid";

if ($conn->query($sql) === TRUE) {
    //print_r($temp);
    //var_dump($temp);

    $sql="SELECT * FROM department";
    $result=$db->getRows($sql,array());
    foreach($result as $value)
    {
        $dep=$value['department_name_en'];
        //mkdir("img/$dep/$season_folder");
        rename("img/$dep/$old_season_folder","img/$dep/$new_season_folder");
    }

  

    unset($_SESSION['sid']);
    
   header('location:season.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


}

//header('location:show.php');




 ?>




 <?php 
 
 
 else :
    header('location:index.php');
  
  endif;
 ?>