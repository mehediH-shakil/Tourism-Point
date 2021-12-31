<?php
   
   session_start();
   if(isset($_POST['submit'])){
       
       $email=$_POST['email'];
       $password=$_POST['password'];

       if(empty($email)){
        $emailError="Username is required";
       }

       if(empty($password)){
        $passwordError="Password is required";
       }


       if(!isset($emailError) && !isset($passwordError)){
            $conn = mysqli_connect('localhost','root','','tourism_point');
            if(!$conn){
                die("Connection Error");
            }
            $pass=md5($password);


            $query="select email,password from user where email='$email' and password='$pass' limit 1";
            $result = mysqli_query($conn,$query);

            $email_query="select email from user where email='$email' limit 1";
            $email_result = mysqli_query($conn,$email_query);

            if(mysqli_num_rows($result)==1){
                $_SESSION['email']=$email;
                header("location: Home.php");
                
            }elseif(mysqli_num_rows($email_result)==1){
              $passwordError = "Invalid Password";
            }else{
            	$display = "Invalid Account";
            }
        }
    }
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Tourism Point</title>
	<link rel="stylesheet" type="text/css" href="CSS/form.css">
</head>
<body>

	<section id="log-in">
		<div class="log-in-page">
			<form action="" method="post">
				<h1>Log in Here</h1>

				<input type="email" name="email" value="<?php echo isset($email) ? $email:"" ?>" placeholder="UserName"><br>
				<span class="error"><?php echo isset($emailError)?$emailError:""?></span><br>

				<input type="password" name="password" value="<?php echo isset($password) ? $password:"" ?>" placeholder="Password"><br>
				<span class="error"><?php echo isset($passwordError)?$passwordError:""?></span><br>
				<span><a href="forgot_password.php"> Forgot Password?</a><span>
				<br>

				<div style="padding-top: 10px;">
					<input type="submit" name="submit" class="button" value="Next"><br>
				</div>
				
				<p>  Don't have an account? <span><a href="registration.php"> SignUp</a><span><p>
			</form>
			
		</div>
		
	</section>

</body>
</html>

