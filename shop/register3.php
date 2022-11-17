<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $address = $salary629 = $username = $password ="";
$name_err = $address_err = $salary629_err = $username_err =$password_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate salary629
    $input_salary629 = trim($_POST["salary629"]);
    if(empty($input_salary629)){
        $salary629_err = "Please enter the salary629 amount.";     
    } elseif(!ctype_digit($input_salary629)){
        $salary629_err = "Please enter a positive integer value.";
    } else{
        $salary629 = $input_salary629;
    }

    // Validate username
if(empty(trim($_POST["username"]))){
    $username_err = "Please enter a username.";
} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
} else{
    // Prepare a select statement
    $sql = "SELECT id FROM employees WHERE username = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        
        // Set parameters
        $param_username = trim($_POST["username"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $username_err = "This username is already taken.";
            } else{
                $username = trim($_POST["username"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Validate confirm password
if(empty(trim($_POST["password"]))){
    $password_err = "Please confirm password.";     
} else{
    $password = trim($_POST["password"]);
    if(empty($password_err) && ($password != $password)){
        $password_err = "Password did not match.";
    }
}
 
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary629_err)&& empty($username_err)&& empty($password_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, address, salary629, username, password) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssiss", $param_name, $param_address, $param_salary629, $param_username, $param_password);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary629 = $salary629;
            $param_username = $username;
            $param_password = $password;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: register3.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>




<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="style3.css" />
    <link href="default.css" rel="stylesheet" type="text/css" media="all" />


</head>
<body>
<div class="container2">
<div class="container3">
      <div class="circle-container2">
        <div class="circle">
          <button id="close">
            <i class="fas fa-times"></i>
          </button>
          <button id="open">
            <i class="fas fa-bars"></i>
          </button>
        </div>
      </div>

<div id="header-wrapper">
        <div class="search">
          <input type="text" class="input" placeholder="Search...">
          <h1>Registration successful</h1><button class="btn">
            <i class="fas fa-search"></i>
          </button>
        </div>
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#">Welcome to Luca’s Loaves</a></h1>
		</div>
	</div>
</div>
</div>
    <div class="wrapper2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                    <h2 class="mt-5">Registration successful</h2>
                    <a href="register2.php" >Back to register</a>
                    </div>   
                </div>
            </div>        
        </div>
    </div>
    
    <footer class="footer2">  
    20ITA1 Pamper, Xu Hongyou
          </footer>
</div>	
          <nav>
      <ul>
        <li><i class="fas fa-home"></i><a href="index2.php" accesskey="1" title=""> Home</a></li>
        <li><i class="fas fa-user-alt"></i><a href="aboutus.php" accesskey="2" title=""> About</a></li>
        <li><i class="fas fa-envelope"></i><a href="upload.php" accesskey="3" title=""> CAREES</a></li>
        <li><i class="fa fa-cart-plus"></i><a href="orderonline.php" accesskey="4" title=""> ORDERONLINE</a></li>
        <li><i class="fa fa-globe"></i><a href="contactus.php" accesskey="5" title=""> Contact</a></li>
        <li><i class="fa fa-plus-square"></i><a href="register2.php" accesskey="6" title=""> REGISTER</a></li>

      </ul>
    </nav>
    <script src="script2.js"></script>
</body>
</html>
