<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Topbar End -->
    <div class="container-fluid sticky-top bg-white shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
                <a href="index.php" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>Smile arts</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        
                              
                            </div>
                        </div>
                      
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-info bg-info">
      

        <div class="mr-auto" ></div>
        <ul class="navbar-nav">
            <?php
            if(isset($_SESSION['admin'])){
                $user=$_SESSION['admin'];
                echo '
                <li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-white">logout</a></li>';

            }else if(isset($_SESSION['doctor'])){
                $user=$_SESSION['doctor'];
                echo '
                <li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-white">logout</a></li>';

            }
            else if(isset($_SESSION['patient'])){
                $user=$_SESSION['patient'];
                echo '
                <li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-white">logout</a></li>';
            }
            else{
                echo '
                <li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li>
                <li class="nav-item"><a href="adminlogin.php" class="nav-link text-white">Admin</a></li>
                <li class="nav-item"><a href="doctorlogin.php" class="nav-link text-white">Doctor</a></li>
                <li class="nav-item"><a href="patientlogin.php" class="nav-link text-white">Patient</a></li>';
            }
            ?>
        </ul>

    </nav>
</body>
</html>
