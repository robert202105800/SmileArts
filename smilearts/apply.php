<?php

include("include/connection.php");

if(isset($_POST['apply'])){

    $firstname=$_POST['fname'];
    $surname=$_POST['sname'];
    $username=$_POST['uname'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];
    $phone=$_POST['phone'];
    $country=$_POST['country'];
    $password=$_POST['pass'];
    $confirm_password=$_POST['con_pass'];


    $error=array();

    if(empty($firstname)){
        $error['apply']="Enter first name";
    }
    else if(empty($surname)){
        $error['apply']="Enter surname";
    }
    else if(empty($username)){
        $error['apply']="Enter Username";
    }
    else if(empty($email)){
        $error['apply']="Enter Email";
    }
    else if($gender==""){
        $error['apply']="Enter Gender";
    }
    else if(empty($phone)){
        $error['apply']="Enter phone";
    }
    else if($country==""){
        $error['apply']="Enter country";
    }
    else if(empty($password)){
        $error['apply']="Enter Password";
    }
    else if(empty($confirm_password)){
        $error['apply']="confirm your Password";
    }
    else if($confirm_password!=$password){
        $error['apply']="Both password do not match";
    }

    if(count($error)==0){
        $query="INSERT INTO doctors(firstname,surname,username,email,gender,phone,country,password,salary,data_reg,status,profile) 
        VALUES('$firstname','$surname','$username','$email','$gender','$phone','$country','$password','0',NOW(),'Pendding','doctor.jpg')";


        $result=mysqli_query($connect,$query);

        if($result){
            echo"<script>alert('You have succefully appled')</script> ";

            header("Location:doctorlogin.php");
        }else{
            echo"<script>alert('Failed')</script> ";

        }
    }

    }
    
    if(isset($error['apply'])){

        $s=$error['apply'];

        $show="<h5 class='text-center alert alert-danger'>$s</h5>";
    }

else{
    $show = "";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Now!!</title>
</head>
<body>

<?php

include("include/header.php");

?>

<div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"> </div>
                   <div class="col-md-6 jumbotron my-3">

                   <h5 class="text-center">Apply Now!!</h5>

                     <?php echo $show; ?>

                   <form method="post">
                    <div class="form-group">
                        <label>Firstname:</label>
                        <input type="text" name="fname" class="form-control"
                        autocomplete="off" placeholder="Enter firstname" value=" <?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
                       
                    </div>

                    <div class="form-group">
                        <label>Surname:</label>
                        <input type="text" name="sname" class="form-control"
                        autocomplete="off" placeholder="Enter Surname"  value=" <?php if(isset($_POST['sname'])) echo $_POST['sname']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" name="uname" class="form-control"
                        autocomplete="off" placeholder="Enter Username"  value=" <?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" name="email" class="form-control"
                        autocomplete="off" placeholder="Enter Email"  value=" <?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                    </div>

                    <div class="from-group">
                        <label>Select Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">Select Gender </option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Phone number:</label>
                        <input type="number" name="phone" class="form-control"
                        autocomplete="off" placeholder="Enter Phone number"  value=" <?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
                    </div>


                    <div class="from-group">
                        <label>Select Country</label>
                        <select name="country">
                            <option value="">Select Country </option>
                            <option value="Egypt">Egypt</option>
                            <option value="Palestine">Palestine</option>
                            <option value="Russia">Russia</option>
                            <option value="India">India</option>
                        </select>
                    </div>                    

                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="pass" class="form-control"
                        autocomplete="off" placeholder="Enter Password">
                    </div>

                    <div class="form-group">
                        <label> Confirm Password:</label>   
                        <input type="password" name="con_pass" class="form-control"
                        autocomplete="off" placeholder="Confirm Password">
                    </div>  

                    <input type="submit" value="Apply Now!!" name="apply" class="btn btn-success">
                    <!-- <button type="submit" value="Apply Now!!" name="apply" class="btn btn-success">submit</button> -->
                    <p>I already have an account <a href="doctorlogin.php">Click here</a></p>

                   </form>
                   </div>
                <div class="col-md-3"> </div>

            </div>
        </div>
</div>

</body>
</html>





