<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>
<body>
<?php
    include("../include/header.php");
    include("../include/connection.php");    
    ?>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2" style="margin-left: -30px;">
                                    <?php
                                        include("sidenav.php");
                                    ?>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-6 jumbotron bg-info my-5" style="margin-left:-80px">
                                <h3 class="text-center my-4">Send A Report</h3>
                                
                                <form method="post">
                                    <label> Title</label>
                                    <input type="text" name="title"autocomplete ="off" class="form-control" placeholder="Enter Title of the report">
                                    <br><br>
                                    <label>Message</label>
                                    <input type="text" name="message" autocomplete="off"class="form-control" placeholder="Enter Message">
                                    <br>
                                    <input type="submit" name="send" value="Send Report"class="btn btn-success my-2 " style="margin-left:255px;">

                                </form>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div> 
                    <?php
                        if(isset($_POST['send'])){
                            $title=$_POST['title'];
                            $message=$_POST['message'];


                            if(empty($title))
                            {

                            }else if(empty($message))
                            {

                            }else{
                                $user = $_SESSION['patient'];
                                $query = "INSERT INTO report(title,message,username,date_send) Values('$title','$message','$user',NOW())";
                                $res= mysqli_query($connect,$query);

                                if($res)
                                {

                                    echo "<script> alert('You have sent your Report')</script> ";
                                }
                            }
                        }
                        


                    ?>


</body>
</html>