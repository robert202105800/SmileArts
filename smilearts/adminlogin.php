<?php
session_start();
include("include/connection.php");

if(isset($_POST['login']))
{
    $username=$_POST['uname'];
    $password=$_POST['pass'];

    $error = array();

    if(empty($username)){
        $error['admin'] = "Enter Username";
    }
    else if(empty($password)){
        $error['admin'] = "Enter Password";
    }

    if(count($error)==0) {

        $query = "SELECT * FROM  admin WHERE username='$username' AND password ='$password'";
        
        $result = mysqli_query($connect,$query);


        if(mysqli_num_rows($result) == 1){
            echo "<script>alert('You have Login as an Admin')</script>";
            
            $_SESSION['admin'] = $username;

          header("Location:admin/index.php");
          exit();
        }
      
        else{
            echo "<script>alert('Invalid Username or Password')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

     <title>Admin login Page</title>
</head>
<body>
    <?php
    include("include/header.php");
    include("include/connection.php");
    ?>
<div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Admins login</h5>
<div style="margin-top: 20px;"></div>
<div class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 jumbotron">
                <!-- jumbotron dih background lel form bas msh shaghalaa -->
                <img src="images/log.jpg" class="col-md-12">
                <form method="post" class="my-2">
                    <div >
                        <?php
                        if(isset($error['admin']))
                        {
                            $sh=$error['admin'];
                            $show="<h4 class='alert alert-danger'>$sh</h4>";
                        }
                        else{
                            $show = " ";

                        }
                        echo $show;
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control" placeholder="Enter Password">
                    </div>
                    <input type="submit" name="login" class ="btn btn-success" value="Login">
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>

</body>
</html>