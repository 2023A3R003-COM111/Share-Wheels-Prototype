<?php
require "pdo.php";
session_start();

if (isset($_POST['cancel'])) {
    header("Location: index.php");
    return;
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SignUp/LogIn</title>
    <!-- Cool Google Fonts -->
    <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-database.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap" rel="stylesheet">
    <!-- Our stylesheet -->
    <link rel="stylesheet" type="text/css" href="./assets/css/index1.css">
</head>

<body>
 
    <div id="content_container">
        <div id="form_container">
            <div id="form_header_container">
                <h2 id="form_header"> SignUp</h2>
            </div>

            <div id="form_content_container">
                <div id="form_content_inner_container">
                    <form method="post">
                        <input type="text" id="name" name='name' placeholder="name">
                        <input type="email" id="email" name='email' placeholder="Email">
                        <input type="password" id="pass" name='password' placeholder="New Password">
                        <input type="date" id="dob" name='date' placeholder="Date of Birth">
                        <div id="button_container">
                            <button type="button" onclick="register()">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Our script must be loaded after firebase references -->
    <script src="./assets/js/index1.js"></script>
    <script>
        // Your JavaScript validation code here
        function validateEmail(email) {
            const re = /\S+@\S+\.\S+/;
            return re.test(String(email).toLowerCase());
        }

        //  function validatePassword(password) {
        //      const re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
        //      return re.test(String(password));
        //  }

        function register() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("pass").value;
            
            if (!validateEmail(email)) {
                alert('Please enter a valid email address.');
            // } else if (!validatePassword(password)) {
           //      alert('Password must contain at least one uppercase letter, one lowercase letter, one digit, and be at least 8 characters long.');
            } else {
                alert('Your account has been successfully created');
                document.forms[0].submit();
                <?php
         if (isset($_POST['name']) &&  isset($_POST['email']) && isset($_POST['password']) ) {
            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) ) {
                $_SESSION['error'] = "All fields are required";
                header("Location: register.php");
                return;
            }
            else if(strpos($_POST['email'],'@')==false){
                $_SESSION['error'] = "Invalid Email Address";
                header("Location: register.php");
                return;
        
            }
    
            $sql = "INSERT INTO register( email, password, name,dob) VALUES (:em,:pa, :fn,:dob)";
    
            $statement = $pdo->prepare($sql);
    
            $statement->execute(array(
                ":fn" => $_POST['name'],
                ":em" => $_POST['email'],
                ":pa" => $_POST['password'],
				":dob"=>$_POST['date']
                        ));
    
            $_SESSION['success'] = "Profile added";
            header("Location: index.php");
            return;
    
        }
    ?>
            }
        }

    </script>
</body>

</html>
