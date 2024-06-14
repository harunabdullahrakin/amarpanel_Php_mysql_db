<?php 
session_start();
	include("../connection.php");
	include("../functions.php");
    
	$user_data = check_login($con);

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
    	//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		$email = $_POST['email'];

		if(!empty($user_name) && !empty($password) && !empty($email)){
		

			//save to database
			$query = "insert into users (user_name,password,email,rank,admin,pfp) values ('$user_name','$password','$email','https://iili.io/JXqwhUQ.png','false','https://iili.io/JWy0bTu.png')";

			mysqli_query($con, $query);

			header("Location: ../login.php");
			die;
	    }else{
			echo "Please enter some valid information!";
		}
    }else{
        echo "an error occours.";
    }

	

?>
<?php
    if("true" === "true"){
    $ser = mysqli_query($con, "SELECT * FROM servers WHERE id = 1");
    $servers = mysqli_fetch_assoc($ser);
    }


?>

<?php
    if("true" === "true"){
    $user = mysqli_query($con, "SELECT * FROM servers WHERE id = 0");
    $member = mysqli_fetch_assoc($user);
    }

?>
<?php
if(!empty($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
    $result = mysqli_query($con, "SELECT * FROM users WHERE user_id = $user_id");
    $row = mysqli_fetch_assoc($result);
    $ok = $row["admin"];
}

    ?>
<?php
    if("$ok" === "true"){
    $gg = mysqli_query($con, "SELECT * FROM admin WHERE id = 0");
    $admin = mysqli_fetch_assoc($gg);
    }else{
        header("location: /");
        exit;
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="https://cdn.discordapp.com/attachments/1123666151839367268/1196364072745189386/ai_hoshino_.jpg?ex=65c9d0de&is=65b75bde&hm=476576fa475594d0428133df1f504a6b258a8b1aa23ff5e4d1fe28e7083fe3d4&" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <form method="post" class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="" class="">
                                <h3 class="text-primary">Admin Panel</h3>
                            </a>
                            <h3></h3>
                        </div>
                        <div class="form-floating mb-3" method="post">
                            <input type="text" name="user_name" class="form-control" placeholder="jhondoe" required>
                            <label for="floatingText">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary py-3 w-100 mb-4" value='Sign Up'>
                        <p class="text-center mb-0">Already have an Account? <a href="login.php"> Sign In</a></p>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/index.js"></script>
</body>

</html>
