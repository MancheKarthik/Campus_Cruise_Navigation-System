<?php
	require 'config.php';
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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

        <form id="form" method="post" action="home.html">
            <div class="main_input">
                <img src="user-fill.png" alt="">
                <input id="email" name="email" class="input" type="text" placeholder="Email"><br>
            </div>

            <div class="main_input">
                <img class="key_image" src="key-fill.png" alt="">
                <input id="password" name="passwd" class="input" type="password" placeholder="Password"><br>
            </div>

            <button id="loginButton" name="login" style="margin-left:115px;" class="login">Login</button>
            <div id="message" style="color: red; margin-top: 10px;margin-left:30px;"></div> <!-- For displaying messages -->

        </form>

        <?php
		if(isset($_POST['login']))
		{
			$username=$_POST['email'];
			$password=$_POST['passwd'];
			
			$query="select * from userinfo WHERE email='$username' AND password='$password'";
			
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				// valid
				$_SESSION['username']= $username;
				header('location:home.html');
			}
			else
			{
				// invalid
				echo '<script type="text/javascript">alert("Invalid credentials") </script>';
			}
			
		}
		
		
		?>

        <p class="bottom_para">Copyright © CAMPUS CRUISE | All rights reserved</p>
        <!-- <div class="back"><a href="index.html"><img style="height:60px; top:100px;" src="arrow_back_24dp_white.png"></a></div> -->
    </section>
</main>

<!-- <script>
    // Login functionality
    document.getElementById("loginButton").addEventListener("click", function() {
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const emailDomain = "@student.mes.ac.in";
        const correctPassword = "123"; // The correct password
        const messageElement = document.getElementById("message");

        // Clear previous message
        messageElement.innerText = '';

        // Validation
        if (email === "" || password === "") {
            messageElement.innerText = "Please fill in both fields.";
        } else if (!email.endsWith(emailDomain)) {
            messageElement.innerText = "Email must be a valid @student.mes.ac.in address.";
      } else if (password !== correctPassword) {
         messageElement.innerText = "Incorrect Password."; // Incorrect password message-->
        } else {
            messageElement.innerText = "Login Successful!"; // Show success message
            setTimeout(() => {
                window.location.href = "home.html"; // Redirect to home page after a short delay
            }, 2000); // 2 seconds delay before redirecting
        }
    });
</script> --!>

</body>
</html>
