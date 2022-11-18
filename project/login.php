<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   if($select_user->rowCount() > 0){
     setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
     header('location:home.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
<!--css chalu re 
-->
<style>
body {
	background-image: linear-gradient(135deg, #FAB2FF 10%, #1904E5 100%);
	background-size: cover;
	background-repeat: no-repeat;
	background-attachment: fixed;
	font-family: "Open Sans", sans-serif;
	color: #333333;
  }
  
  .box-form {
	margin: 0 auto;
	width: 80%;
	background: #FFFFFF;
	border-radius: 10px;
	overflow: hidden;
	display: flex;
	flex: 1 1 100%;
	align-items: stretch;
	justify-content: space-between;
	box-shadow: 0 0 20px 6px #090b6f85;
  }
  @media (max-width: 980px) {
	.box-form {
	  flex-flow: wrap;
	  text-align: center;
	  align-content: center;
	  align-items: center;
	}
  }
  .box-form div {
	height: auto;
  }
  .box-form .left {
	color: #FFFFFF;
	background-size: cover;
	background-repeat: no-repeat;
	background-image: url("https://i.pinimg.com/736x/5d/73/ea/5d73eaabb25e3805de1f8cdea7df4a42--tumblr-backgrounds-iphone-phone-wallpapers-iphone-wallaper-tumblr.jpg");
	overflow: hidden;
  }
  .box-form .left .overlay {
	padding: 30px;
	width: 100%;
	height: 100%;
	background: #5961f9ad;
	overflow: hidden;
	box-sizing: border-box;
  }
  .box-form .left .overlay h1 {
	font-size: 10vmax;
	line-height: 1;
	font-weight: 900;
	margin-top: 40px;
	margin-bottom: 20px;
  }
  .box-form .left .overlay span p {
	margin-top: 30px;
	font-weight: 900;
  }
  .box-form .left .overlay span a {
	background: #3b5998;
	color: #FFFFFF;
	margin-top: 10px;
	padding: 14px 50px;
	border-radius: 100px;
	display: inline-block;
	box-shadow: 0 3px 6px 1px #042d4657;
  }
  .box-form .left .overlay span a:last-child {
	background: #1dcaff;
	margin-left: 30px;
  }
  .box-form .right {
	padding: 40px;
	overflow: hidden;
  }
  @media (max-width: 980px) {
	.box-form .right {
	  width: 100%;
	}
  }
  .box-form .right h5 {
	font-size: 6vmax;
	line-height: 0;
  }
  .box-form .right p {
	font-size: 14px;
	color: #B0B3B9;
  }
  .box-form .right .inputs {
	overflow: hidden;
  }
  .box-form .right input {
	width: 100%;
	padding: 10px;
	margin-top: 25px;
	font-size: 16px;
	border: none;
	outline: none;
	border-bottom: 2px solid #B0B3B9;
  }
  .box-form .right .remember-me--forget-password {
	display: flex;
	justify-content: space-between;
	align-items: center;
  }
  .box-form .right .remember-me--forget-password input {
	margin: 0;
	margin-right: 7px;
	width: auto;
  }
  .box-form .right button {
	float: right;
	color: #fff;
	font-size: 16px;
	padding: 12px 35px;
	border-radius: 50px;
	display: inline-block;
	border: 0;
	outline: 0;
	box-shadow: 0px 4px 20px 0px #49c628a6;
	background-image: linear-gradient(135deg, #70F570 10%, #49C628 100%);
  }
  
  label {
	display: block;
	position: relative;
	margin-left: 30px;
  }
  
  label::before {
	content: ' \f00c';
	position: absolute;
	font-family: FontAwesome;
	background: transparent;
	border: 3px solid #70F570;
	border-radius: 4px;
	color: transparent;
	left: -30px;
	transition: all 0.2s linear;
  }
  
  label:hover::before {
	font-family: FontAwesome;
	content: ' \f00c';
	color: #fff;
	cursor: pointer;
	background: #70F570;
  }
  
  label:hover::before .text-checkbox {
	background: #70F570;
  }
  
  label span.text-checkbox {
	display: inline-block;
	height: auto;
	position: relative;
	cursor: pointer;
	transition: all 0.2s linear;
  }
  
  label input[type="checkbox"] {
	display: none;
  }
</style>
<!--done-->
</head>
<body>

<?php include 'components/user_header.php'; ?>
<div class="box-form">
	<div class="left">
		<div class="overlay">
		<H3>welcome back<H3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		Curabitur et est sed felis aliquet sollicitudin</p>
		</div>
	</div>

   <div class="right">
		<h5>Login</h5>
      <section class="form-container">
<form action="" method="post" enctype="multipart/form-data" class="login">
  
   <p>your email <span>*</span></p>
   <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
   <p>your password <span>*</span></p>
   <input type="password" name="pass" placeholder="enter your password" maxlength="20" required class="box">
   <p class="link">don't have an account? <a href="register.php">register now</a></p>
   <input type="submit" name="submit" value="login now" class="btn">
</form>

</section>
<script src="js/script.js"></script>
   
</body>
</html>