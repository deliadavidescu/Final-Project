<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Alumnis Of Code Factory</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/styles-global.css">

  <script src="../../../assets/js/jquery-3.3.1.min.js"></script>
  
</head>
<body>
<div class="container-fluid topbar">
  <div class="topbar-left">
    <a class="nav-link" target="_blank" href="https://www.codefactory.wien/"> www.codefactory.wien</a>
  </div>

  <div class="topbar-right">
    <a target="_blank" href="https://www.facebook.com/CodeFactoryVienna">
      <img class="logobar" src="../../../assets/img/fb.svg" alt="Logo Facebook">
    </a>
    <a target="_blank" href="https://www.instagram.com/codefactoryvienna/">
      <img class="logobar" src="../../../assets/img/ig.svg" alt="Logo Instagram">
    </a>
  </div>
</div>

<?php 
ob_start();
session_start();
include "../../../inc/db_actions.php";
 ?>
<nav class="navbar navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand"><img src="../../../assets/img/alumnilogo.png" alt="Alumni of Code Factory Logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample04">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./stories.php">Stories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./directory.php">Directory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./career.php">Careers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./events.php">Events</a>
      </li>
      <?php if(isset($_SESSION['student'])!=""){  ?>
      <li class="nav-item">
        <a class="nav-link" href="./profile.php">Profile</a>
      </li>
    <?php }?>
    </ul>
    <?php if(isset($_SESSION['student'])!=""){  ?>
    <div>
        <span  class="user-welcome mr-3">
  
          <?php  
          $where=array("fk_userID"=>$_SESSION['student']);
          $rows=$obj->select_record("student_profile",$where);

          foreach ($rows as $row) {
            echo "Welcome ".$row["first_name"]."!<br>";
          }

          echo "userID is:".$_SESSION['student'];?> | <a>Login</a>
        </span>
    </div>
    <?php }elseif (isset($_SESSION['company'])!=""){?>
    <div>
        <span  class="user-welcome mr-3">
  
          <?php  
          $where=array("fk_userID"=>$_SESSION['company']);
          $rows=$obj->select_record("companies",$where);

          foreach ($rows as $row) {
            echo "Welcome ".$row["company_name"]."!<br>";
          }

          echo "userID is:".$_SESSION['company'];?> | <a>Login</a>
        </span>
    </div>
    <?php }elseif (isset($_SESSION['admin'])!=""){?>
    <div>
        <span  class="user-welcome mr-3">
  
          <?php  
  
          echo "Welcome Admin!"?> | <a>Login</a>
        </span>
    </div>
    <?php }elseif (isset($_SESSION['admin'])!="")?>
    <?php if(!isset($_SESSION['student']) && !isset($_SESSION['company']) && !isset($_SESSION['admin'])){//fix this shit?>
      <a href="inc/login/login.php">
        <button type="button" class="btn">Login</button>
      </a>
  <?php } ?>

  <?php if(isset($_SESSION['student'])!="" || isset($_SESSION['company'])!="" || isset($_SESSION['admin'])!="" || isset($_SESSION['admin'])!=""){  ?>
    <a href="./inc/login/logout.php?logout">
      <button type="button" class="btn btn-primary">Logout</button>
    </a>
   <?php }?>
</div>
</nav> 

<?php 

  $career_id = $_GET['career_id'];

 
  if($_GET['career_id']) {

    $sql = "SELECT * FROM career WHERE  career_id = {$career_id}";
    $connect = new mysqli("127.0.0.1", "root", "", "alumni_project");
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();
   
//--------------------------------------------------------------------  
 ?>


<div class="container">
  
    <form action="../actions/a_update_career.php" method="post" class="my-2">
              <div class="form-group">
                <label for="exampleInputEmail1">Career title:</label>
                <input type="text"
                class="form-control"
                name="career_title"
                placeholder="Enter Career title"
                value="<?php echo $data['career_title'] ?>"
                >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Career teaser:</label>
                <input type="text"
                class="form-control"
                name="career_teaser"
                placeholder="Career teaser"
                value="<?php echo $data['career_teaser'] ?>"
                >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1"> Career content:</label>
                <input type="text"
                class="form-control"
                name="career_content"
                placeholder="Enter Career content"
                value="<?php echo $data['career_content'] ?>"
                >
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Career image:</label>
                <input type="text"
                class="form-control"
                name="career_image"
                placeholder="Enter Career image"
                value="<?php echo $data['career_image'] ?>"
                >
              </div>
     
              <input type="hidden" name="career_id" value="<?php echo $data['career_id']?>">
 
              <button class="btn btn-danger" value="">
                Save Changes
              </button>
              <a href="../../../career.php"><button type="button" class=" btn btn-danger">Back</button>
            </form> 

 </div>
</body>
</html>
<?php 
}else{
  echo "eror";}
 ?>


