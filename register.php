<?php
	require 'config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
<main>
    <section>
        <h1 class="poppins">Let's join the <br> PCE Community</h1>
        <p class="para">If you're currently pursuing your degree at PCE, then <br>
            don't forget to use your PCE email address</p>

        <form id="form" method="post" action="register.php">
            <div class="main_input">
                <img src="user-fill.png" alt="">
                <input id="email" name="email" class="input" type="text" placeholder="Email"><br>
            </div>

            <div class="main_input">
                <img class="key_image" src="key-fill.png" alt="">
                <input id="password" name="passwd" class="input" type="password" placeholder="Password"><br>
            </div>

            <button id="signupButton" name="submit_btn" class="login">Signup</button><br><br>
            <a href="login.php" style="text-decoration: none;color:red;font-size:20px;margin-left:105px;" >Already a user</a>
            <div id="message" style="color: red; margin-top: 10px;margin-left:35px;"></div> <!-- For displaying messages -->
        </form>

        <?php
			if(isset($_POST['submit_btn']))
			{
				//echo '<script type="text/javascript">alert("Sign Up button clicked") </script>';

				
				$username = $_POST['email'];
				$password = $_POST['passwd'];
				

				//echo '<script type="text/javascript">alert("User already exists.. try another username") </script>';
				//echo '<script type="text/javascript">alert("'.$fullname.' ---'.$username.' --- '.$password.' --- '.$gender.' --- '.$qualification.'"  ) </script>';

				
				
					$query= "select * from userinfo WHERE email='$username'";
					$query_run = mysqli_query($con,$query);
					
					if(mysqli_num_rows($query_run)>0)
					{
						// there is already a user with the same username
						echo '<script type="text/javascript">alert("User already exists.. try another username") </script>';
					}
					else
					{
						$query= "insert into userinfo values('$username','$password')";
						$query_run = mysqli_query($con,$query);
						
						if($query_run)
						{
							echo '<script type="text/javascript">alert("User Registered.. Go to login page to login") </script>';
						}
						else
						{
							echo '<script type="text/javascript"> alert("'.mysqli_error($con).'") </script>';
						}
					}
					
					
				
	
				
				
				
			}
		?>

        <p class="bottom_para">Copyright © CAMPUS CRUISE | All rights reserved</p>
        <!-- <div class="back"><a href="contactus.html"><img style="height:60px" src="arrow_back_24dp_white.png"></a></div> -->
    </section>
</main>


</body>
</html>
