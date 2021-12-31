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


            $query="select admin_email,admin_password from admin where admin_email='$email' and admin_password='$pass' limit 1";
            $result = mysqli_query($conn,$query);

            $email_query="select admin_email from admin where admin_email='$email' limit 1";
            $email_result = mysqli_query($conn,$email_query);

            if(mysqli_num_rows($result)==1){
                $_SESSION['admin_email']=$email;
                header("location: dashboard.php");
                
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
	<link rel="stylesheet" type="text/css" href="../CSS/form.css">
</head>1
<body>

	<section id="log-in">
		<div class="log-in-page">
			<form action="" method="post">
				<h1>Admin Log in</h1>

				<input type="email" name="email" value="<?php echo isset($email) ? $email:"" ?>" placeholder="UserName"><br>
				<span class="error"><?php echo isset($emailError)?$emailError:""?></span><br>

				<input type="password" name="password" value="<?php echo isset($password) ? $password:"" ?>" placeholder="Password"><br>
				<span class="error"><?php echo isset($passwordError)?$passwordError:""?></span><br>
				<!-- <span><a href="forgot_password.php"> Forgot Password?</a><span> -->
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

