<?php
    include_once "includes/header.inc.php";
?>
<div>
    <h2>Welcome New User!</h2>
    <p>Enter your details</p>
    
    <form action="includes/sign_up.inc.php" method="post" autocomplete="off">
        <input class="form-control"type="text" name="user_name" placeholder="User name">    
        <input class="form-control"type="text" name="name" placeholder="Full name">
        <input class="form-control"type="text" name="email" placeholder="Email">
        <input class="form-control"type="tel" name="phone" placeholder="Phone no">
        <input class="form-control"type="password" name="pwd" placeholder="Password">
        <input class="form-control"type="password" name="confirm_pwd" placeholder="Confirm password">
        <button class="btn btn-primary" type="submit" name="submit">Sign up</button>  
    </form>
</div>

<?php
    // Checking for Error after sign up

    if(isset($_GET["error"])){
        if($_GET["error"] == "inputempty"){
            echo '<div class="alert alert-warning" role="alert">Please fill in all fields!</div>';
        }
        else if($_GET["error"] == "invalidusername"){
            echo '<div class="alert alert-warning" role="alert">Username is invalid! Use letters and numbers only.</div>';
        }
        else if($_GET["error"] == "usernameExists"){
            echo '<div class="alert alert-warning" role="alert">Username or Email already exists!</div>';
        }
        else if($_GET["error"] == "invalidName"){
            echo '<div class="alert alert-warning" role="alert">Name is invalid! Use only letters.</div>';
        }
        else if($_GET["error"] == "invalidEmail"){
            echo '<div class="alert alert-warning" role="alert">Email is invalid!</div>';
        }
        else if($_GET["error"] == "invalidPhone"){
            echo '<div class="alert alert-warning" role="alert">Phone number is invalid! Use numbers only.</div>';
        }
        else if($_GET["error"] == "passwordnotmatch"){
            echo '<div class="alert alert-warning" role="alert">Passwords don\'t match!</div>';
        }
        else if($_GET["error"] == "invalidPassword"){
            echo '<div class="alert alert-warning" role="alert">Password is invalid!</div>';
        }
        else if($_GET["error"] == "sqlStmtFailed"){
            echo '<div class="alert alert-warning" role="alert">Failed to sign up, try again later.</div>';
        }
        else if($_GET["error"] == "signupSuccess"){
            echo '<div class="alert alert-success" >Sign up was successful!</div>';
        }
    }
?>
<?php
    include_once "includes/footer.inc.php";
?>
