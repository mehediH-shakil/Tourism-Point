<?php

    $nameError = "";
    $emailError = "";
    $passwordError = "";
    $confirmPasswordError = "";

 
    if(isset($_POST['submit'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        
        if($password!=$confirmPassword && !empty($confirmPassword)){
            $confirmPasswordError = "Password Don't Match.";
        }

        if(empty($name)){
            $nameError = "Name is required.";
        }
        if(empty($email)){
            $emailError =  "Email is required.";
        }
        if(empty($password)){
            $passwordError =  "Password is required.";
        }
        if(empty($confirmPassword)){
            $confirmPasswordError =  "Confirm Password is required.";
        }
        
        if(!empty($name) && !empty($email) && !empty($password) && !empty($confirmPassword) && empty($confirmPasswordError)){
            
            $conn = mysqli_connect('localhost','root','','tourism_point');

            if(!$conn){
                die ("Not Connected.");
            }
            
            $q="select * from user where email='$email'";
            $r=mysqli_query($conn,$q);
            
            if(mysqli_num_rows($r)>0){
                $emailError = "This Email Already Exist!";
            }else{
                $password=md5($password);
                $query = "insert into user(name,email,password) values('$name','$email','$password')";

                $result = mysqli_query($conn,$query);

                if($result){
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
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>

    <section id="sign-up">
        <div class="sign-uppage">

            <form action="" method="post">
                <h1>Sign Up Your Account</h1>
                <input type="text" name="name" value="<?php echo isset($name) ? $name:"" ?>" placeholder="Name"><br>
                <span class="error"><?php echo "$nameError"; ?></span><br>

                <input type="email" name="email" value="<?php echo isset($email) ? $email:"" ?>" placeholder="Email"><br>
                <span class="error"><?php echo "$emailError"; ?></span><br>

                <input type="password" name="password" value="<?php echo isset($password) ? $password:"" ?>" placeholder="Password"><br>
                <span class="error"><?php echo "$passwordError"; ?></span><br>

                <input type="password" name="confirm-password" value="<?php echo isset($confirmPassword) ? $confirmPassword:"" ?>" placeholder="Confirm Password"><br>
                <span class="error"><?php echo "$confirmPasswordError" ?></span><br>

                <div>
                    <input type="submit" name="submit" class="button" value="Sign Up"> 
                </div>

                <p>Already have an account? <span><a href="log-in.php">Log in</a><span><p>
            </form>
            
        </div>
        
    </section>

</body>
</html>

