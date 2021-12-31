<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/PHPMailer.php');

   
   session_start();
   if(isset($_POST['submit'])){

   	$email=$_POST['email'];
   	if(empty($email)){
   		$Error="Email is required";
   	}  

   	if(!isset($Error)){
   		$conn = mysqli_connect('localhost','root','','tourism_point');
         if(!$conn){
            die("Connection Error");
         }


         $query="select * from user where email='$email' limit 1";
         $result = mysqli_query($conn,$query);
         

         if(mysqli_num_rows($result)==1){

         	$row = mysqli_fetch_assoc($result);
         	$fetch_email=$row['email'];
         	$_SESSION['user_ID']=$row['user_ID'];

				$code_generate = rand(10000,99999);
				$_SESSION['code_generate'] = $code_generate;
				if($email==$fetch_email){

					$to   = $fetch_email;
					$sub  = "Reset Password";
					$body = "Your Code is : $code_generate";

					$mail = new PHPMailer(true);
					try {

						$mail->isSMTP();                                       
						$mail->Host       = 'smtp.gmail.com';                
						$mail->SMTPAuth   = true;         
						$mail->Username   = 'mh872096@gmail.com';           
						$mail->Password   = 'mehedi@11081';                    
						$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      
						$mail->Port       = 465;                               
						$mail->setFrom('mh872096@gmail.com', 'Tourism Point');
						$mail->addAddress($to);  
						$mail->isHTML(true);                                 
						$mail->Subject = $sub;
						$mail->Body    = $body;
						$mail->send();

						header('location:code.php');
					}catch (Exception $e) {
						$display = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					}
				}
         }else{
         	$display = "Email is not found!";
         }
      }else{
      	$Error = "invalid email";
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
				<h3 style="text-align: center;">Forgot Password</h3>
				<p style="text-align: left;"><?php echo isset($display) ? $display:"Just provide your email" ?></p>

				<input type="email" name="email" value="<?php echo isset($email) ? $email:"" ?>" placeholder="Email"><br>
				<span class="error"><?php echo isset($Error)?$Error:""?></span><br>
				

				<div style="padding-top: 10px;">
					<input type="submit" name="submit" class="button" value="Next"><br>
				</div>
				
				<p>  Did you remember? <span><a href="log-in.php"> SignIn</a><span><p>
			</form>
			
		</div>
		
	</section>

</body>
</html>

