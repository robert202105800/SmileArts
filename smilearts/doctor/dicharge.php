<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Patient Appointment</title>
</head>

<body>
    <?php

    include("../include/header.php");
    include("../include/connection.php");

    ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left:-30px;">
                    <?php
                    include("sidenav.php");
                    ?>

                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-2">Total Appointment</h5>

                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $query = "SELECT * FROM appointment where id='$id'";
                        $res = mysqli_query($connect, $query);
                        $row = mysqli_fetch_array($res);
                    }
                    ?>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2">Appointment Details</td>
                            </tr>

                            <tr>
                                <td>Firstname</td>
                                <td><?php echo $row['firstname']; ?></td>
                            </tr>

                            <tr>
                                <td>surname</td>
                                <td><?php echo $row['surname']; ?></td>
                            </tr>

                            <tr>
                                <td>Gender</td>
                                <td><?php echo $row['gender']; ?></td>
                            </tr>

                            <tr>
                                <td>Phone number</td>
                                <td><?php echo $row['phone']; ?></td>
                            </tr>

                            <tr>
                                <td>Appointment Date</td>
                                <td><?php echo $row['appointment_date']; ?></td>
                            </tr>

                            <tr>
                                <td>symptoms</td>
                                <td><?php echo $row['symptoms']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-center my-1">Invoice</h5>

                        <?php
                        if (isset($_POST['send'])) {

                            $fee = $_POST['fee'];
                            $_des = $_POST['des'];

                            if (empty($fee)) 
                            {
                                echo "<script>alert('Enter fees')</script>";
                            } 
                            else if (empty($_des))
                             {
                                echo "<script>alert('Enter description')</script>";
                            } 
                            else {
                                $doc = $_SESSION['doctor'];
                                $fname = $row['firstname'];

                                $query = "INSERT INTO income(doctor,patient,date_discharge,amount_paid,description) VALUES('$doc','$fname',NOW(),'$fee','$_des')";

                                $res = mysqli_query($connect, $query);

                                if ($res) {
                                    echo "<script>alert('you have sent invoice')</script>";

                                    mysqli_query($connect, "UPDATE appointment SET status='Discharge' WHERE id='$id'");
                                }
                            }
                        }

                        ?>

                        <form method="post">
                            <label>Fees</label>
                            <input type="number" name="fee" class="form-control" autocomplete="off" placeholder="Enter patient fee">

                            <label>Description</label>
                            <input type="text" name="des" class="form-control" autocomplete="off" placeholder="Enter Description">

                            <input type="submit" name="send" class="btn btn-info my-2" value="send">
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>

</html>