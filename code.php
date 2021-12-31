<?php
   
   session_start();
   if(isset($_POST['submit'])){

   	$code=$_POST['code'];
   	if(empty($code)){
   		$Error="Code is required";
   	}  

   	$code_generate = $_SESSION['code_generate'];
   	if($code == $code_generate){
   		header('location:new_password.php');
   	}else{
   		$display = "Code is not matching!";
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
				<h3 style="text-align: left;">Forgot Password</h3>
				<p style="text-align: left;"><?php echo isset($display) ? $display:"Code is send to your Email." ?></p>
				
				<input type="text" name="code" value="<?php echo isset($code) ? $code:"" ?>" placeholder="Code"><br>
				<span class="error"><?php echo isset($Error)?$Error:""?></span><br>	
				

				<div>
					<input type="submit" name="submit" class="button" value="Next"><br>
				</div>
				
				<p>  Did you remember? <span><a href="log-in.php"> SignIn</a><span><p>
			</form>
			
		</div>
		
	</section>

</body>
</html>

