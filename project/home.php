<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <style>
.centered {
  position: absolute;
  top: 50%;
  left: 55%;
  transform: translate(-50%, -50%);
  font-size: 75px;
  color: white;
}

   </style>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<!-- quick select section starts  -->

<section class="quick-select">
<div class="container">
<img src="lolo.jpg"  alt="Random Image">
<div class="centered">HELLO LETS BEGIN THE JOURNEY</div>
<form action="XYZ.html">
         <button type="submit">CLICK HERE TO BEGIN THE LEARNING</button>
         </div>

   <div class="box-container">

      <?php
         if($user_id != ''){
      ?>
                                                     
      <?php
         }else{ 
      ?>
      <div class="box" style="text-align: center;">
         <h3 class="title">please login or register</h3>
          <div class="flex-btn" style="padding-top: .5rem;">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div>
      <div>
      <img src="https://csharp-station.com/wp-content/uploads/2019/08/Person-coding-on-laptop.jpg">
      </div>
      <?php
      }
      ?>
   

   </div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>