<?php

    $new_passwordError = "";
    $confirmPasswordError = "";
   
    session_start();
    if(isset($_POST['submit'])){

        $new_password=$_POST['new_password'];
        $confirmPassword = $_POST['confirm-password'];

        if(empty($new_password)){
            $new_passwordError="Password is required";
        }

        if(empty($confirmPassword)){
            $confirmPasswordError =  "Confirm Password is required.";
        }

        if(!empty($new_password) && !empty($confirmPassword)){
            
            $conn = mysqli_connect('localhost','root','','tourism_point');

            if(!$conn){
                die ("Not Connected.");
            }
            
            $ID = $_SESSION['user_ID'];
            $query="select * from user where user_ID='$ID' and password='$new_password'";
            $result=mysqli_query($conn,$query);
            
            if(mysqli_num_rows($result)>0){
                $new_passwordError = "This Password Already Exist!";
            }else{
                $password=md5($new_password);
                $pass_query = "update user set password='$password' where user_ID='$ID'";

                $pass_result = mysqli_query($conn,$pass_query);

                if($pass_result){
                    header('location:log-in.php');
                }else{
                    die("Not Inserted".mysqli_error($conn));
                }
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
				<h1>Login to your account</h1>

				<input type="assword" name="new_password" value="<?php echo isset($new_password) ? $new_password:"" ?>" placeholder=" New Password"><br>
				<span class="error"><?php echo isset($new_passwordError)?$new_passwordError:""?></span><br>

                <input type="password" name="confirm-password" value="<?php echo isset($confirmPassword) ? $confirmPassword:"" ?>" placeholder="Confirm Password"><br>
                <span class="error"><?php echo "$confirmPasswordError" ?></span><br>

				<div style="padding-top: 10px;">
					<input type="submit" name="submit" class="button" value="Next"><br>
				</div>
				
				<p>  Did you remember? <span><a href="log-in.php"> SignIn</a><span><p>
			</form>
			
		</div>
		
	</section>

</body>
</html>

