<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">

<?php

include("sidenav.php");

$patient=$_SESSION['patient'];
$query="SELECT * from patient WHERE username='$patient'";

$res=mysqli_query($connect,$query);

$row=mysqli_fetch_array($res);

?>

                </div>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">

                            <?php
                            
                            if(isset($_POST['upload'])){

                                $img =$_FILES['img']['name'];

                                if(empty($img)){

                                }else{
                                    $query="UPDATE patient SET profile='$img' WHERE username='$patient'";
                                    
                                    $res=mysqli_query($connect,$query);

                                    if($res){
                                        move_uploaded_file($_FILES['img']['tmp_name'],"img/$img");
                                    }
                                }
                            }
                            
                            ?>

                            <h5>My Profile</h5>
                            <form method="post" enctype="multipart/form-data">
                            <?php
                            echo"<img src='img/" .$row['profile']."'class='col-md-12' style='height:400px;'>";
                            ?>

                                <input type="file" name="img" class="form-control my-2">
                                <input type="submit" name="upload" class="btn btn-info" value="Update Profile">
                            </form>

                            <table class="table table boarder">
                                <tr>
                                    <th colspan="2" class="text-center">My Details</th>
                                </tr>

                                <tr>
                                    <td>Firstname</td>
                                    <td><?php echo $row['firstname'];?></td>
                                </tr>
                                
                                <tr>
                                    <td>surname</td>
                                    <td><?php echo $row['surname'];?></td>
                                </tr>  

                                  <tr>
                                    <td>username</td>
                                    <td><?php echo $row['username'];?></td>
                                </tr>

                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $row['email'];?></td>
                                </tr>

                                <tr>
                                    <td>phone number</td>
                                    <td><?php echo $row['phone'];?></td>
                                </tr>

                                <tr>
                                    <td>Gender</td>
                                    <td><?php echo $row['gender'];?></td>
                                </tr>

                                <tr>
                                    <td>Country</td>
                                    <td><?php echo $row['country'];?></td>
                                </tr>
                            </table>

                            </div>
                            <div class="col-md-6">
                                <h5 class="text-center">Change username</h5>

                                <?php
                                
                                if(isset($_POST['update'])){
                                    
                                    $uname=$_POST['uname'];

                                    if(empty($uname)){

                                    }else{
                                        $query="UPDATE patient SET username='$uname' WHERE username='$patient'";

                                        $res=mysqli_query($connect,$query);

                                        if($res){
                                            $_SESSION['patient']=$uname;
                                        }
                                    }

                                }
                                
                                ?>
                                
                                <form method="post">
                                    <label>Enter Username </label>
                                    <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                                    <input type="submit" name="update" class="btn btn-info my-2" value="Update Username">

                                </form>

                                <?php
                                
                                if(isset($_POST['change'])){
                                    $old = $_POST['old_pass'];
                                    $new = $_POST['new_pass'];
                                    $con = $_POST['con_pass'];

                                    $q="SELECT * FROM patient WHERE username='$patient'";

                                    $re=mysqli_query($connect,$q);

                                    $row=mysqli_fetch_array($re);

                                    if(empty($old)){
                                        echo "<script>alert('Enter Old Password')</script>";
                                    }else if(empty($new)){
                                        echo "<script>alert('Enter New Password')</script>";
                                    }else if($con != $new){
                                        echo "<script>alert('Both password do not match')</script>";
                                    }else if($old != $row['password']){
                                        echo "<script>alert('check the password')</script>";
                                    }else{
                                        $query = "UPDATE patient SET password='$new' WHERE username='$patient'";

                                        mysqli_query($connect,$query);
                                    }
                                }

                                ?>

                                <h5 class="my-4 text center">Change Password</h5>

                                <form method="post">
                                    <label>Old Password</label>
                                    <input type="password" name="old_pass" class="form-control" autocomplete="off" placeholder="Enter Old Password">

                                    <label>New Password</label>
                                    <input type="password" name="new_pass" class="form-control" autocomplete="off" placeholder="Enter new Password">

                                    <label>Confim Password</label>
                                    <input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Enter confirm Password">

                                    <input type="submit" name="change" class="btn btn-info my-2" value="change password">
                                </form>
                                

                        
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>