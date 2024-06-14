<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
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



<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Amer Dashboard" name="keywords">
    <meta content="Dashboard Of Rakin" name="description">
    <link rel="image_src" href="https://i.ibb.co/wy4F2FW/standard.gif" />


    <!-- Favicon -->
    <link href="https://i.ibb.co/wy4F2FW/standard.gif" rel="icon">

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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/colors.css" rel="stylesheet">

</head>

<body style="background-color: var(--secondary-color)">



        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3" >
            <nav class="navbar" style="background-color:  rgba(0, 0, 0, 0);">
            <div class="d-flex align-items-center ms-4 mb-4" >
                    <div class="position-relative">
                        <img src="<?php echo $servers['logo'] ?>" alt="<?php echo $servers['name'] ?>" style="width: 55px; height: 55px; border: 0.1px solid; border-radius: 7px;">
                        <div class="bg-success rounded-circle"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0" style="color: var(--test-color);"><?php echo $servers['name'] ?></h6>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <p style="font-size: 18px;font-weight: 700;font-family: Plus Jakarta Sans;line-height: 26px; margin-left:25px;color: #888e96;"><strong>Home</strong></p>
                </div>
                <div class="navbar-nav w-100">
                    <a href="/" class="nav-item nav-link active"><i class="fa fa-th me-2"></i>Dashboard</a>
                    <a href="/accountinfo" class="nav-item nav-link"><i class="fas fa-user-alt"></i> Account Info</a>
                    <a href="/articles" class="nav-item nav-link"><i class="far fa-newspaper"></i> Articles</a>


                    <?php 
                                if("$ok" === "true"){
                                    
                                     echo '<a href="/store" class="nav-item nav-link "><i class="fas fa-store"></i> Store</a>
                                        <a href="/gamepanel" class="nav-item nav-link "><i class="fa fa-gamepad"></i> Panel Access</a>';
                                }else if("$ok" === "false"){
                                    
                                    if($member['store'] == "true" && $member['gamepanel'] == "true"){
                                        echo '<a href="/store" class="nav-item nav-link "><i class="fas fa-store"></i> Store</a>
                                        <a href="/panel" class="nav-item nav-link "><i class="fa fa-gamepad"></i> Panel Access</a>';
                                    }
                                    else if($member['gamepanel'] == "true"){
                                        echo '<a href="/panel" class="nav-item nav-link "><i class="fa fa-gamepad"></i> Panel Access</a>';
                                    }
                                    else if($member['store'] == "true"){
                                        echo '<a href="/store" class="nav-item nav-link "><i class="fas fa-store"></i> Store</a>';
                                    }

                                    else{
                                        echo "";
                                    }
                                
                                }else{
                                    echo "Error Code Admin in users";
                                }
                        ?>




                    <?php 
                    if("$ok" === "true"){
                        echo $admin['signup'];
                    }else{
                        echo "";
                    }
                    ?> 
                    
                   

                </div>
                <div class="d-flex align-items-center ms-4 mb-4" style="margin-top: 11vh; border: 1px transparent; background-color: #e5f3fb; padding: 30px; border-radius: 20px;">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?php echo $row['pfp'];?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $row['user_name'];?></h6>
                        <h6 class="mb-0" style="font-size: 9px;">                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M184,89.57V84c0-25.08-37.83-44-88-44S8,58.92,8,84v40c0,20.89,26.25,37.49,64,42.46V172c0,25.08,37.83,44,88,44s88-18.92,88-44V132C248,111.3,222.58,94.68,184,89.57ZM232,132c0,13.22-30.79,28-72,28-3.73,0-7.43-.13-11.08-.37C170.49,151.77,184,139,184,124V105.74C213.87,110.19,232,122.27,232,132ZM72,150.25V126.46A183.74,183.74,0,0,0,96,128a183.74,183.74,0,0,0,24-1.54v23.79A163,163,0,0,1,96,152,163,163,0,0,1,72,150.25Zm96-40.32V124c0,8.39-12.41,17.4-32,22.87V123.5C148.91,120.37,159.84,115.71,168,109.93ZM96,56c41.21,0,72,14.78,72,28s-30.79,28-72,28S24,97.22,24,84,54.79,56,96,56ZM24,124V109.93c8.16,5.78,19.09,10.44,32,13.57v23.37C36.41,141.4,24,132.39,24,124Zm64,48v-4.17c2.63.1,5.29.17,8,.17,3.88,0,7.67-.13,11.39-.35A121.92,121.92,0,0,0,120,171.41v23.46C100.41,189.4,88,180.39,88,172Zm48,26.25V174.4a179.48,179.48,0,0,0,24,1.6,183.74,183.74,0,0,0,24-1.54v23.79a165.45,165.45,0,0,1-48,0Zm64-3.38V171.5c12.91-3.13,23.84-7.79,32-13.57V172C232,180.39,219.59,189.4,200,194.87Z"></path></svg>&nbsp;<?php echo $row['coins'];?>.00 coins</h6>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand  navbar-dark sticky-top px-4 "  style="background-color: var(--primary-color); margin-top: 3vh; border: 5px transparent; border-radius: 25px; width: auto; margin-left: 20px; margin-right: 20px;" >
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"></h2>
                </a>
                <a href="#" style="color:#75ffed;" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                
                <div class="navbar-nav align-items-center ms-auto">

                    <img src="https://iili.io/JXnDsMF.png" id="icon">
                    <div class="nav-item dropdown" >
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php echo $row['pfp'];?>" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex" style="color: var(--test-color);"><?php echo $row['user_name'];?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <div style="line-height: 26px;
                            font-family: Plus Jakarta Sans; height:70vh; background-color: rgba(233, 232, 232, 0.74); border: 5px transparent; border-radius: 35px;  padding: 35px; width: 59vh;">
                                <div class="mat-mdc-menu-content ng-tns-c185672549-5" bis_skin_checked="1"><ng-scrollbar class="position-relative ng-scrollbar ng-tns-c185672549-5" style="height: 495px;" _nghost-ng-c3967978005=""><div _ngcontent-ng-c3967978005="" class="ng-scrollbar-wrapper" position="native" track="vertical" appearance="compact" visibility="native" deactivated="false" dir="ltr" pointereventsmethod="viewport" verticalused="true" horizontalused="false" isverticallyscrollable="true" ishorizontallyscrollable="false" verticalhovered="false" bis_skin_checked="1"><div _ngcontent-ng-c3967978005="" class="ng-scroll-viewport-wrapper" bis_skin_checked="1"><div _ngcontent-ng-c3967978005="" scrollviewport="" hidenativescrollbar="" class="ng-native-scrollbar-hider ng-scroll-viewport " style="--native-scrollbar-size:0px;" bis_skin_checked="1"><div _ngcontent-ng-c3967978005="" class="ng-scroll-content" bis_skin_checked="1"><div class="p-x-32 p-y-16" bis_skin_checked="1" ><h6 class="f-s-16 f-w-600 m-0 mat-subtitle-1" >User Profile</h6><div style="margin-top: 2vh;" class="d-flex align-items-center p-b-24 b-b-1 m-t-16" bis_skin_checked="1"><img src="<?php echo $row['pfp'];?>" width="95" class="rounded-circle"><div class="m-l-16" bis_skin_checked="1"><h6 style="margin-left: 5vh;"><?php echo $row['user_name'];?></h6><span style="margin-left: 6vh;"><img src="<?php echo $row['rank'];?>" style="border: 5px transparent; border-radius: 20px;"></span><span class="d-flex align-items-center">
                                  
                                  </i-tabler>  </span ></div></div></div><div style="margin-top: 8vh;" class="p-x-32" bis_skin_checked="1"><div class="d-flex align-items-center" bis_skin_checked="1">
                                  
                                  </i-tabler></span><img src="" style="border: 5px transparent; border-radius: 25px; width: vh;"><div style=" margin-left: px;" class="m-l-16" bis_skin_checked="1"><h5 class="f-s-14 f-w-600 m-0 textprimary mat-subtitle-1 hover-text">Email :</h5><span class="mat-body-1" style="color: black; font-weight: 300; "><?php echo $row['email'];?></span></div></div><div class="d-flex align-items-center" bis_skin_checked="1"><span class="align-items-center bg-light-success d-flex icon-50 justify-content-center rounded shadow-none text-success"><i-tabler class="icon-20" _nghost-ng-c2605515766="">
                                  
                                  
                                  </i-tabler></span><a href="/accountinfo"><div class="m-l-16" bis_skin_checked="1"><h5 class="f-s-14 f-w-600 m-0 textprimary mat-subtitle-1 hover-text">Account Info</h5><span class="mat-body-1">Customize Your Account</span></div></div></a><a class="p-y-16 text-decoration-none d-block text-hover-primary ng-star-inserted" href=""><div class="d-flex align-items-center" bis_skin_checked="1"><span class="align-items-center bg-light-error d-flex icon-50 justify-content-center rounded shadow-none text-error"><i-tabler class="icon-20" _nghost-ng-c2605515766=""></a>
                                  
                                  
                                  </i-tabler></span><a href="https://discord.gg/92wh6YwddU"><div class="m-l-16" bis_skin_checked="1"><h5 class="f-s-14 f-w-600 m-0 textprimary mat-subtitle-1 hover-text"> Amar Discord </h5><span class="mat-body-1">Official Discord Of Amar Basement</span></div></div></a><!----></div><div class="p-y-12 p-x-32" bis_skin_checked="1"></a><a  href="/logout.php"><button style="margin-top:19px; padding: 7px; background-image: linear-gradient(#2196F3,#1976D2); font-size: 15px;color:white; font-weight: 20px; border: 5px #2196F3; border-radius: 9px;" mat-flat-button="" color="primary" class="w-100 mdc-button mdc-button--unelevated mat-mdc-unelevated-button mat-primary mat-mdc-button-base" mat-ripple-loader-class-name="mat-mdc-button-ripple" tabindex="0"><span class="mat-mdc-button-persistent-ripple mdc-button__ripple"></span><span class="mdc-button__label"> Logout </span><span class="mat-mdc-focus-indicator"></span><span class="mat-mdc-button-touch-target"></span><span class="mat-ripple mat-mdc-button-ripple"></span></button></a></div></div></div></div><!----><scrollbar-y _ngcontent-ng-c3967978005="" _nghost-ng-c1959957197="" scrollable="true" fit="false" class="scrollbar-control ng-star-inserted"><div _ngcontent-ng-c1959957197="" scrollbartracky="" class="ng-scrollbar-track" bis_skin_checked="1"><div _ngcontent-ng-c1959957197="" scrollbarthumby="" class="ng-scrollbar-thumb" style="height: 474px; transform: translate3d(0px, 0px, 0px);" bis_skin_checked="1"></div></div></scrollbar-y><!----><!----><!----></div></ng-scrollbar></div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">

                <p style="font-size: 39px;color: var(--test-color);"><strong>Account Info</strong></p>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3" >
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                        <img class="rounded-circle" src="<?php echo $row['pfp'];?>" alt="" style="width: 85px; height: 85px;">
                            <div class="ms-3" >
                                <p class="mb-2">User ID</p>
                                <h6 class="mb-0" style="color: var(--test-color);"><?php echo $row['user_id'];?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <img src="https://i.ibb.co/Ptt3dmj/GC.png" style="width: 55px; height: 55px;">
                            <div class="ms-3">
                                <p class="mb-2" style="margin-left:55px; color: var(--test-color);">Rank</p>
                                <img src="<?php 
                                

                                if("$ok" === "false"){
                                    
                                    if($row['mvpplus'] == "true"){
                                        echo "";
                                    }
                                    else if($row['mvp'] == "true"){
                                        echo "";
                                    }
                                    else if($row['vipplus'] == "true"){
                                        echo "";
                                    }
                                    else if($row['vip'] == "true"){
                                        echo "";
                                    }
                                    else{
                                        echo "https://iili.io/JXqwhUQ.png";
                                    }
                                }else{
                                    echo "https://i.ibb.co/hHvnzb0/admin.png";
                                }



                                ?>" style="border: 5px transparent;border-radius: 10px; width: 142px;height: 18px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <img src="https://i.ibb.co/ZmgRqZR/Shiney-Gold-Coins-Inv36.gif" style="width: 55px; height: 55px;">
                            <div class="ms-3">
                            <p class="mb-2" style="margin-left:52px;">Coins</p>
                                <h6 class="mb-0" style="margin-left:52px; color: var(--test-color);"> <?php echo $row['coins'];?>.00</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <img src="https://i.ibb.co/2yxRzQT/discord.png" style="width: 45px; height: 45px;">
                            <div class="ms-3">
                            <p class="mb-2" style="margin-left:45px;">Discord</p>
                            <a href="<?php echo $row['link'];?>"><p style="margin-left:45px;">Server</p></a>
                            </div>
                        </div>
                    </div>







                </div>
            </div>

            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <h2 style="font-size: 39px;color: var(--test-color);">Your Servers</h2>
                <div style="display: flex;text-align: center;align-items:center;justify-content:center; "class="container-fluid pt-4 px-4"><svg data-name="Layer 1" width="200" height="200" viewBox="0 0 862.70323 644.78592"><polygon points="629.943 612.644 612.777 612.644 604.608 546.435 629.943 546.435 629.943 612.644" fill="#9e616a"/><path d="M807.65107,769.99215H795.34112l-2.19727-11.62205-5.62754,11.62205H754.86738A7.33919,7.33919,0,0,1,750.697,756.6135l26.07247-18.00658v-11.7495l27.42368,1.63683Z" transform="translate(-168.64838 -127.60704)" fill="#2f2e41"/><polygon points="731.923 590.981 718.148 601.224 672.085 552.969 692.415 537.851 731.923 590.981" fill="#9e616a"/><path d="M925.58816,737.04791,915.71,744.39344l-8.69827-8.015,2.41922,12.68419-26.19923,19.48211a7.33918,7.33918,0,0,1-11.32976-8.24721l10.17712-30.00728-7.0111-9.42842,22.98294-15.05066Z" transform="translate(-168.64838 -127.60704)" fill="#2f2e41"/><path d="M818.57583,398.64705s32.56879,28.13791,17.542,108.35207l-18.3454,78.59653,59.8294,99.2561-19.07664,23.20771-77.77961-107.4334-28.18529-66.11365L744.6516,416.843Z" transform="translate(-168.64838 -127.60704)" fill="#2f2e41"/><polygon points="599.447 425.746 597.488 456.084 603.483 585.365 631.692 580.452 637.083 488.406 599.447 425.746" fill="#2f2e41"/><polygon points="237.445 628.211 252.796 628.21 260.098 569.001 237.443 569.002 237.445 628.211" fill="#ffb6b6"/><path d="M402.178,750.80612l4.32074-.00018,16.86888-6.86018,9.0412,6.85913H432.41A19.26648,19.26648,0,0,1,451.67546,770.07v.62605l-49.49658.00183Z" transform="translate(-168.64838 -127.60704)" fill="#2f2e41"/><polygon points="296.932 618.538 311.905 621.918 332.071 565.772 309.972 560.782 296.932 618.538" fill="#ffb6b6"/><path d="M462.86463,740.39329l4.21465.9516,17.96568-2.97583,7.3082,8.68223.0012.00027a19.26648,19.26648,0,0,1,14.54854,23.03569l-.1379.61067L458.48379,759.7967Z" transform="translate(-168.64838 -127.60704)" fill="#2f2e41"/><path d="M386.6516,393.843c-7.19708,21.70636-6.43618,45.268,1.72992,70.55606l3.49087,142.37821S386.67128,700.146,403.4543,733.00177h24.34l12.05112-134.75129,1.5133-90.44591,52.18244,76.30583L460.30462,730.79868l29.9568,2.678,53.93408-159.1909L477.6516,419.843Z" transform="translate(-168.64838 -127.60704)" fill="#2f2e41"/><path d="M667.346,332.01487c18.61732-16.77656,46.30893-25.21208,69.53714-15.805a115.466,115.466,0,0,0-51.888,59.93484c-3.6979,9.83846-6.78644,21.16623-15.88188,26.43349-5.65933,3.27753-12.70027,3.4377-19.04568,1.85557-6.34568-1.58237-12.16226-4.75415-17.89913-7.89422l-1.63218-.03691C637.86406,372.53682,648.72872,348.79142,667.346,332.01487Z" transform="translate(-168.64838 -127.60704)" fill="#e6e6e6"/><path d="M736.75328,316.71942A98.69239,98.69239,0,0,0,681.847,342.64994a42.50049,42.50049,0,0,0-8.34534,10.37667,24.37584,24.37584,0,0,0-2.81751,12.51568c.10054,4.05833.67335,8.19792-.21438,12.21a14.92537,14.92537,0,0,1-7.42454,9.68865c-4.54586,2.613-9.7595,3.43673-14.886,4.0651-5.692.69769-11.61526,1.33219-16.54238,4.5248-.597.38683-1.16231-.56211-.56622-.94836,8.57235-5.5546,19.41969-3.5335,28.63724-7.24065,4.30108-1.72983,8.10691-4.76631,9.454-9.35719,1.17794-4.01452.5909-8.2838.45359-12.39207a26.01068,26.01068,0,0,1,2.299-12.34028,39.29038,39.29038,0,0,1,7.9156-10.65924,95.74917,95.74917,0,0,1,24.3333-17.41978A100.44256,100.44256,0,0,1,736.743,315.61475c.70319-.09065.70886,1.01461.01026,1.10467Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M686.44718,337.79134a14.807,14.807,0,0,1,1.63241-19.1039c.50628-.49873,1.30506.26457.79811.764a13.71094,13.71094,0,0,0-1.48216,17.77371c.41512.5769-.53561,1.13983-.94836.56623Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M670.36216,363.49127a28.53932,28.53932,0,0,0,20.3938-4.08346c.59834-.38471,1.16384.56412.56622.94836a29.68517,29.68517,0,0,1-21.23023,4.20607c-.70085-.12626-.42683-1.19655.27021-1.071Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M714.44656,321.9478a8.38148,8.38148,0,0,0,6.2686,4.89443c.7021.11732.42732,1.18753-.27021,1.071a9.39213,9.39213,0,0,1-6.94675-5.39917.57084.57084,0,0,1,.19107-.7573.55506.55506,0,0,1,.75729.19107Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M762.46124,397.11454c-.44048-.06079-.881-.12157-1.32791-.1756a110.37862,110.37862,0,0,0-17.88208-.90839c-.46221.00673-.93053.02051-1.39159.0405a116.3646,116.3646,0,0,0-41.75015,9.61014,113.00482,113.00482,0,0,0-15.16291,8.0555c-6.68773,4.23438-13.602,9.35764-21.078,11.08459a19.38584,19.38584,0,0,1-2.36217.42086l-30.88864-26.74546c-.03969-.096-.0858-.18531-.12584-.28162l-1.28212-1.01147c.23872-.17556.49008-.35251.72879-.52808.138-.10241.283-.19887.421-.30128.09422-.06639.18881-.13253.27-.19782.03128-.02222.0629-.04413.08811-.05934.08122-.06529.1636-.11732.23871-.17556q2.10345-1.4895,4.23516-2.95463c.00611-.007.00611-.007.0191-.00815a166.15689,166.15689,0,0,1,34.601-18.59939c.36686-.13859.73948-.28453,1.12045-.4109a107.831,107.831,0,0,1,16.93919-4.76651,95.32878,95.32878,0,0,1,9.5528-1.33433,79.272,79.272,0,0,1,24.72335,1.7516c16.14332,3.7433,30.90977,12.60785,39.65578,26.43254C762.02688,396.40555,762.24387,396.75367,762.46124,397.11454Z" transform="translate(-168.64838 -127.60704)" fill="#e6e6e6"/><path d="M762.05235,397.44645a98.69236,98.69236,0,0,0-59.45156-12.3533A42.50006,42.50006,0,0,0,689.69,388.35387a24.3758,24.3758,0,0,0-9.78493,8.29673c-2.36313,3.30088-4.39808,6.951-7.52245,9.62a14.92533,14.92533,0,0,1-11.76132,3.26575c-5.2028-.6506-9.86156-3.13185-14.3331-5.71664-4.9648-2.86991-10.0762-5.92951-15.93241-6.34685-.70956-.05056-.5896-1.14861.11888-1.09812,10.1888.72611,17.633,8.8707,27.22462,11.46035,4.47564,1.20837,9.34256,1.07528,13.18213-1.77925,3.35754-2.49617,5.45923-6.25839,7.82305-9.62129a26.01082,26.01082,0,0,1,9.26529-8.46889,39.29037,39.29037,0,0,1,12.73777-3.74506,95.74907,95.74907,0,0,1,29.91669.7416,100.44263,100.44263,0,0,1,32.085,11.59611c.616.351-.04488,1.23688-.65689.88819Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M709.199,383.98345a14.807,14.807,0,0,1,12.80526-14.27057c.7045-.09339.88272.997.17729,1.0905a13.711,13.711,0,0,0-11.88443,13.29895c-.01588.71056-1.11391.58761-1.09812-.11888Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M680.88287,394.81911a28.53928,28.53928,0,0,0,18.74183,9.01806c.70936.05308.58963,1.15113-.11888,1.09812a29.68518,29.68518,0,0,1-19.4835-9.42375c-.48357-.52277.37961-1.21236.86055-.69243Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M741.09383,388.19084a8.38147,8.38147,0,0,0,2.05834,7.68205c.49.51638-.37378,1.20545-.86055.69243a9.39216,9.39216,0,0,1-2.29591-8.49336.57082.57082,0,0,1,.6085-.48962.55506.55506,0,0,1,.48962.6085Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M219.92162,754.74293c-1.45,5.44-5.26,9.97-9.86,13.27-.75.54-1.52,1.04-2.3,1.51-.24.14-.48.29-.73.42q-.405.24-.81.45h-21.63c-.39-.79-.77-1.59-1.15-2.38-9.27-19.48-15.78-40.5-14.67-61.91a79.25417,79.25417,0,0,1,5.17-24.25c5.94-15.47,16.78-28.86,31.69-35.6.37-.17.76-.34,1.14-.5-.12.43-.24.85-.36,1.28a110.78533,110.78533,0,0,0-3.38,17.59c-.06.46-.11.92-.15,1.39a116.05427,116.05427,0,0,0,3.72,42.69c.01.03.01995.07.03.1q1.27506,4.605,2.96,9.07c.88,2.35,1.83,4.67,2.87,6.95C216.80163,734.393,222.62157,744.593,219.92162,754.74293Z" transform="translate(-168.64838 -127.60704)" fill="#e6e6e6"/><path d="M207.04162,646.203c-.21.28-.42005.55-.63.83a98.12885,98.12885,0,0,0-11.12,18.76c-.16.33-.31.66-.44,1a97.8135,97.8135,0,0,0-7.82,29.24,1.49,1.49,0,0,0-.02.21c-.25,2.36005-.4,4.74-.46,7.12a42.48011,42.48011,0,0,0,1.43,13.24,23.7688,23.7688,0,0,0,5.46,9.42c.25.27.5.54.77.8.2.21.42.42.63.62,2.02,1.93,4.23,3.72,6.13,5.79a21.43163,21.43163,0,0,1,2.35,3,14.90407,14.90407,0,0,1,1.6,12.1c-1.36,5.06-4.47,9.33-7.65,13.4-1.59,2.04-3.23,4.1-4.65,6.28-.51995.78-1,1.57-1.43994,2.38h-1.26c.42-.81.88-1.6,1.38-2.38,3.65-5.75,8.84-10.69,11.53-17.02,1.82-4.26995,2.37-9.11.07-13.3a17.68156,17.68156,0,0,0-2.43-3.38c-1.83-2.07-4.02-3.84-6.01-5.71-.5-.47-.99-.95-1.46-1.45a24.96377,24.96377,0,0,1-5.64-8.9,39.23028,39.23028,0,0,1-1.94-13.13c0-2.84.15-5.7.43-8.54.03-.36.07-.73.11-1.1a100.76663,100.76663,0,0,1,19.67-49.23c.2-.28.41-.55.62-.82C206.68163,644.87294,207.47161,645.653,207.04162,646.203Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M186.36526,696.67763a14.807,14.807,0,0,1-12.3542-14.66278.55275.55275,0,0,1,1.10455-.02415,13.711,13.711,0,0,0,11.51986,13.616c.70147.11439.42725,1.18471-.27021,1.071Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M193.164,726.22406a28.5393,28.5393,0,0,0,11.53315-17.308c.15106-.69512,1.22186-.42407,1.071.27021a29.68514,29.68514,0,0,1-12.0379,17.98619c-.58485.40629-1.1479-.54428-.56622-.94836Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M194.96075,665.676a8.38149,8.38149,0,0,0,7.89345-.97168c.57941-.41351,1.14186.53754.56622.94836a9.39215,9.39215,0,0,1-8.72989,1.09429.57082.57082,0,0,1-.40038-.67059.55507.55507,0,0,1,.6706-.40038Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M282.06158,684.87294c-.35.27-.71.54-1.06.82a110.362,110.362,0,0,0-13.29,12c-.32.33-.64.67-.95,1.01l-.01.01a116.347,116.347,0,0,0-22.66,36.14l-.03.09c-.01.03-.02.05-.03.08a114.44321,114.44321,0,0,0-5.03,16.42c-1.22,5.46-2.22,11.31-4.13,16.57-.29.81-.61,1.61-.95,2.38h-44.46c.15-.79.31-1.59.47-2.38a160.30168,160.30168,0,0,1,10.54-33.7c.16-.36.32-.72.5-1.08a108.30478,108.30478,0,0,1,8.61-15.35.0098.0098,0,0,1,.01-.01,94.95585,94.95585,0,0,1,5.8-7.69,79.11871,79.11871,0,0,1,18.72-16.24c.04-.03.09-.05.13-.08,14.04-8.71,30.68-12.86,46.59-9.27h.01C281.25158,684.68294,281.6516,684.773,282.06158,684.87294Z" transform="translate(-168.64838 -127.60704)" fill="#e6e6e6"/><path d="M282.01159,685.403c-.34.09-.68.19-1.01.29a98.5888,98.5888,0,0,0-20.17,8.27c-.32.17-.64.35-.96.53a98.25544,98.25544,0,0,0-23.79,18.59.035.035,0,0,0-.01.02c-.08.08-.17.17-.24.25-1.6,1.72-3.14,3.51-4.6,5.35a42.769,42.769,0,0,0-6.82,11.43,23.67365,23.67365,0,0,0-1.31,10.81c.03.37.08.73.13,1.1.04.29.08.58.13.88.66,4.01,1.8,8.03,1.48,12.12a14.90913,14.90913,0,0,1-6.01,10.63,23.794,23.794,0,0,1-3.68,2.34,36.85232,36.85232,0,0,1-5.77,2.38h-3.93c.53-.15,1.05-.3,1.58-.45a48.21182,48.21182,0,0,0,5.53-1.93,26.912,26.912,0,0,0,3-1.48c4.02-2.31,7.37005-5.85,8.07-10.58.61-4.14-.57-8.28-1.27-12.33-.12-.7-.23-1.39-.29-2.08a24.43856,24.43856,0,0,1,.85-10.46,39.0623,39.0623,0,0,1,6.36-11.66,83.355,83.355,0,0,1,5.48-6.55q.36-.40494.75-.81a100.901,100.901,0,0,1,24.21-18.73h.01a99.28782,99.28782,0,0,1,21.1-8.74h.01c.33-.1.67-.2,1-.29C282.53161,684.12294,282.69158,685.213,282.01159,685.403Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M235.116,713.25243a14.807,14.807,0,0,1-1.03613-19.1455c.43212-.5642,1.32915.08079.89646.64574A13.711,13.711,0,0,0,235.97653,712.56c.49121.51367-.37215,1.20316-.86055.69243Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M222.75543,740.93692a28.53931,28.53931,0,0,0,19.62921-6.87574c.53912-.46406,1.2309.397.69242.86054a29.68514,29.68514,0,0,1-20.44051,7.11332c-.71159-.02772-.58885-1.12569.11888-1.09812Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M260.64411,693.67444a8.38149,8.38149,0,0,0,6.8875,3.97657c.71159.01869.58807,1.11668-.11888,1.09812a9.39215,9.39215,0,0,1-7.62917-4.38226.57083.57083,0,0,1,.08406-.77649.55507.55507,0,0,1,.77649.08406Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M625.03076,300.73673a11.59945,11.59945,0,0,1-17.7667.83759l-37.80039,16.44009,3.682-21.10161,35.3314-12.37668a11.66235,11.66235,0,0,1,16.55372,16.20061Z" transform="translate(-168.64838 -127.60704)" fill="#ffb8b8"/><path d="M599.80571,307.32525l-87.7976,39.10831-.18835-.06738-100.067-35.65889a32.95966,32.95966,0,0,1-14.78168-42.75569h0a32.92423,32.92423,0,0,1,46.9872-14.63652l74.4685,44.85908,72.21121-9.35878Z" transform="translate(-168.64838 -127.60704)" fill="#e6e6e6"/><path d="M1031.35162,771.203a1.1865,1.1865,0,0,1-1.19,1.19h-860.29a1.19,1.19,0,0,1,0-2.38h860.29A1.1865,1.1865,0,0,1,1031.35162,771.203Z" transform="translate(-168.64838 -127.60704)" fill="#ccc"/><path d="M481.99193,424.40352l-88.50585-14.15674a16.89334,16.89334,0,0,1-9.95557-23.646l4.01367-8.02832-1.55908-84.34668A62.48156,62.48156,0,0,1,416.32152,239.572l8.63086-5.16064,4.36182-11.07666,40.22022.981.11718,14.52734,14.40381,22.96826-.00049.09522-.90381,125.01367-3.96972,12.90137,6.00244,15.00586Z" transform="translate(-168.64838 -127.60704)" fill="#e6e6e6"/><circle cx="284.4591" cy="45.40997" r="36.54413" fill="#ffb8b8"/><path d="M415.05385,180.98352c-1.09-4.59187-.58956-11.05349.02641-15.677,1.61485-12.12129,8.3464-23.64474,18.57336-30.47048a13.37957,13.37957,0,0,1,6.66453-2.64845c2.41939-.101,5.04189,1.19418,5.78465,3.499a11.99254,11.99254,0,0,1,6.76552-6.709,21.1355,21.1355,0,0,1,9.63075-1.29746,35.19728,35.19728,0,0,1,29.36306,20.98947c.97609,2.3188,3.70246-6.24621,4.93916-4.05528a9.7407,9.7407,0,0,0,5.52388,4.85342c2.4233.67619,3.40756,10.66034,4.3612,8.33222a11.0984,11.0984,0,0,1-10.61055,15.47525c-2.46642-.09228-4.82489-.99947-7.262-1.39-8.71512-1.39642-17.96,4.92316-19.82312,13.55058a23.98689,23.98689,0,0,0-3.15565-7.021,8.1187,8.1187,0,0,0-6.51321-3.57866c-2.47957.09278-4.6591,1.7139-6.26793,3.60295s-2.81713,4.093-4.43782,5.97186c-4.7555,5.513-11.18745,18.3697-17.96453,17.432C425.30335,201.103,416.54206,187.25309,415.05385,180.98352Z" transform="translate(-168.64838 -127.60704)" fill="#2f2e41"/><path d="M674.01238,342.14754a7.1328,7.1328,0,0,0-4.80706-7.85363l-98.41317-32.77709a7.13219,7.13219,0,0,0-2.933-.3368l-24.66687,2.33267-14.15377,1.34255-26.11867,2.46833a7.15519,7.15519,0,0,0-6.38357,5.98973l-13.26135,82.8376a7.18646,7.18646,0,0,0,4.48439,7.79592l99.4404,38.38442a6.94669,6.94669,0,0,0,1.44636.38836,7.13621,7.13621,0,0,0,2.17571.01648l64.25546-9.52349a7.12057,7.12057,0,0,0,6.023-5.99919Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><path d="M490.01349,398.1102l99.44009,38.38234a.89711.89711,0,0,0,.457.05366l64.247-9.52224a.88347.88347,0,0,0,.7549-.75161l12.91979-85.06677a.90469.90469,0,0,0-.59937-.98151l-.66169-.22392-97.75762-32.54588a.67787.67787,0,0,0-.13742-.03318.88732.88732,0,0,0-.23-.01192l-60.16426,5.6932-4.77428.44794a.90314.90314,0,0,0-.7947.74781l-13.259,82.83439A.89735.89735,0,0,0,490.01349,398.1102Z" transform="translate(-168.64838 -127.60704)" fill="#6c63ff"/><path d="M508.28194,313.10237l60.16426-5.6932a.88732.88732,0,0,1,.23.01192.67787.67787,0,0,1,.13742.03318l97.75762,32.54588-25.78658,2.72965-9.65046,1.01669-27.46045,2.90123a1.939,1.939,0,0,1-.24081-.0029c-.04881-.01472-.09762-.02944-.15639-.04511Z" transform="translate(-168.64838 -127.60704)" fill="#2f2e41"/><path d="M487.75761,403.95209l99.44009,38.38233a6.72242,6.72242,0,0,0,1.4505.37968,7.22358,7.22358,0,0,0,2.17727.02722l64.247-9.52224a7.13521,7.13521,0,0,0,6.02839-6.00387l12.90982-85.06772a7.19014,7.19014,0,0,0-.4184-3.71669c-.06533-.15688-.13072-.31384-.207-.46172a6.99031,6.99031,0,0,0-2.26369-2.69758,7.13789,7.13789,0,0,0-1.91579-.97662l-.11659-.04131-98.29175-32.73751a8.95539,8.95539,0,0,0-1.22721-.29807,7.08573,7.08573,0,0,0-1.71463-.03323l-24.66295,2.32468-14.15253,1.35L502.917,307.3259a7.09173,7.09173,0,0,0-3.01853.99744,1.32948,1.32948,0,0,0-.20245.12125,1.1922,1.1922,0,0,0-.12992.09813,7.14818,7.14818,0,0,0-3.02682,4.76367l-13.2699,82.84346A7.19418,7.19418,0,0,0,487.75761,403.95209Zm10.54219-90.35694a5.29965,5.29965,0,0,1,1.26984-2.6713,4.65147,4.65147,0,0,1,.67571-.65875,5.31719,5.31719,0,0,1,2.32365-1.08389,4.059,4.059,0,0,1,.50915-.07189l43.98466-4.15521,20.96479-1.995c.14217-.01658.27254-.01418.40386-.02168a5.00673,5.00673,0,0,1,.94761.07043,4.14489,4.14489,0,0,1,.84467.20125l98.4084,32.77882c.07775.02754.14554.05407.22323.0816a5.218,5.218,0,0,1,2.27305,1.6537,5.25912,5.25912,0,0,1,1.12074,4.14541l-12.92068,85.07674a5.34916,5.34916,0,0,1-4.5086,4.50155l-64.257,9.52134a5.41346,5.41346,0,0,1-2.72281-.31038l-99.441-38.37237a5.40237,5.40237,0,0,1-3.35921-5.846Z" transform="translate(-168.64838 -127.60704)" fill="#3f3d56"/><path d="M499.35216,308.99439a.87724.87724,0,0,1,.268-.38623,1.05132,1.05132,0,0,1,.129-.08817c.04169-.01607.08434-.04216.12611-.05828a.87349.87349,0,0,1,.62383-.01066l2.06994.73016,101.1157,35.66943,23.66513-2.5004,13.24288-1.39675,28.02932-2.96742,2.50639-.26279.48732-.05387a.9043.9043,0,0,1,.95216.65352.73938.73938,0,0,1,.02649.14313.893.893,0,0,1-.55014.92188.98843.98843,0,0,1-.24752.06673l-3.40944.35738-27.60268,2.91775-9.65046,1.01669-27.46045,2.90123a1.939,1.939,0,0,1-.24081-.0029c-.04881-.01472-.09762-.02944-.15639-.04511L500.24535,310.2651l-.3498-.1238a.67025.67025,0,0,1-.21942-.12146A.91016.91016,0,0,1,499.35216,308.99439Z" transform="translate(-168.64838 -127.60704)" fill="#3f3d56"/><path d="M588.91905,442.97456a.89376.89376,0,0,1-.74251-1.01574l14.51687-96.33414a.894.894,0,0,1,1.017-.75056l.008.00129a.89377.89377,0,0,1,.74252,1.01574l-14.51687,96.33414a.894.894,0,0,1-1.017.75055Z" transform="translate(-168.64838 -127.60704)" fill="#3f3d56"/><path d="M625.716,436.86342l-9.6548,1.01888,11.29337-95.5347s12.89458-2.33464,13.23951-1.39846C640.80631,341.50808,625.80805,436.25066,625.716,436.86342Z" transform="translate(-168.64838 -127.60704)" fill="#3f3d56"/><polygon points="331.25 182.533 330.99 226.1 408.116 255.488 435.813 218.284 331.25 182.533" fill="#3f3d56"/><path d="M671.13144,337.72465a5.30105,5.30105,0,0,0-2.49688-1.73654l-98.40594-32.7777a5.10582,5.10582,0,0,0-.848-.20665,5.00894,5.00894,0,0,0-.95065-.07115l.15966-.99731.98511-.71323,23.36822-16.9188,78.04053,23.91705.13549,27.05154Z" transform="translate(-168.64838 -127.60704)" fill="#3f3d56"/><path d="M503.829,380.07963a1.51326,1.51326,0,0,1,.326.06843l30.19365,9.91686a1.50014,1.50014,0,0,1-.93555,2.85069l-30.19364-9.91685a1.50039,1.50039,0,0,1,.60952-2.91913Z" transform="translate(-168.64838 -127.60704)" fill="#fff"/><circle cx="457.00322" cy="423.23593" r="12" fill="#f2f2f2"/><circle cx="151.00322" cy="467.23593" r="12" fill="#f2f2f2"/><circle cx="401.00322" cy="70.23593" r="12" fill="#f2f2f2"/><path d="M589.34024,397.72852A11.59947,11.59947,0,0,1,573.433,389.7714L532.421,385.62792l13.53022-16.60628,36.87128,6.48065a11.66236,11.66236,0,0,1,6.5177,22.22623Z" transform="translate(-168.64838 -127.60704)" fill="#ffb8b8"/><path d="M564.115,391.14082l-95.70849-8.81836-.13135-.15088L398.42455,302.135a32.95967,32.95967,0,0,1,8.01319-44.52344h0a32.92425,32.92425,0,0,1,48.14355,10.209l43.02246,75.54443,67.56543,27.147Z" transform="translate(-168.64838 -127.60704)" fill="#e6e6e6"/><path d="M804.33859,237.22376c-2.37688-17.43387-5.35788-36.15172-17.65411-48.7369a41.34992,41.34992,0,0,0-59.74384.61837c-8.95079,9.54876-12.90365,22.95672-13.2654,36.03983s2.55205,26.02081,5.78442,38.70347a119.28958,119.28958,0,0,0,49.78577-9.79937c3.92617-1.70407,7.789-3.63056,11.93689-4.68634,4.14784-1.05571,7.10454,1.60088,10.96292,3.45335l2.118-4.05545c1.73377,3.22659,7.10244,2.27017,9.04978-.83224C805.26007,244.82608,804.83352,240.853,804.33859,237.22376Z" transform="translate(-168.64838 -127.60704)" fill="#2f2e41"/><path d="M736.532,334.53244l-69.876,1.49441a11.05455,11.05455,0,1,0-4.93974,15.57383c9.26761.52674,81.77191,10.81733,86.0974,4.18549,4.39027-6.73106,27.82423-30.48612,27.82423-30.48612l-18.01271-25.64378Z" transform="translate(-168.64838 -127.60704)" fill="#9e616a"/><circle cx="584.91096" cy="94.03525" r="32.83012" fill="#9e616a"/><path d="M599.36147,299.184" transform="translate(-168.64838 -127.60704)" fill="#6c63ff"/><path d="M806.14195,284.81075c-3.86888-7.69981-5.74873-17.212-13.99671-19.70823-5.56965-1.68563-28.09691.84048-33.17312,3.6859-8.44356,4.73313-.79189,13.60234-5.77332,21.90214-5.41517,9.02271-20.132,27.12978-25.5472,36.15241-3.72279,6.20279,8.8171,24.40947,6.80408,31.358-2.01273,6.94848-2.10962,14.74736,1.31952,21.11722,3.06888,5.70141-1.37137,10.745,1.71521,16.437,3.20957,5.91962,7.14849,28.05274,4.16119,34.08785l-2,6c19.84682,1.16609,36.53459-22.54427,56.25813-25.04188,4.89894-.62032,9.98565-1.43073,14.02251-4.27435,5.94639-4.18864,8.29717-11.78923,9.76638-18.91282A159.32576,159.32576,0,0,0,806.14195,284.81075Z" transform="translate(-168.64838 -127.60704)" fill="#3f3d56"/><path d="M835.89793,366.11245c-2.76443-7.54563-7.769-40.5366-7.769-40.5366l-31.32417-.91848,15.31443,37.772-41.79036,58.50283s.07739.12853.21808.35778a11.052,11.052,0,1,0,9.26964,11.74483.76305.76305,0,0,0,.95807-.16445C785.42465,427.035,838.66236,373.65815,835.89793,366.11245Z" transform="translate(-168.64838 -127.60704)" fill="#9e616a"/><path d="M839.0826,345.27741c-2.87511-12.13478-5.77152-24.33549-10.61887-35.82566s-11.78661-22.34286-21.54669-30.10543c-3.12048-2.48179-6.609-4.67232-10.52078-5.44389-3.91147-.77165-8.31967.09193-11.0667,2.98137-4.39621,4.62357-3.07339,12.0451-1.4611,18.21781Q791,322.40224,798.13123,349.70286q20.59418-2.18287,41.188-4.36591Z" transform="translate(-168.64838 -127.60704)" fill="#3f3d56"/><path d="M793.7871,226.19592c-1.20908-7.942-2.47188-15.95043-5.31228-23.42857-2.8404-7.47821-7.41882-14.48249-13.98647-18.71882-10.39879-6.70709-23.862-5.41352-35.52074-1.55544-9.01622,2.9837-17.81761,7.51864-24.17574,14.8093-6.35848,7.29074-9.92957,17.69379-7.56439,27.22665q18.65464-4.40738,37.30893-8.81483l-1.36137.962a30.03765,30.03765,0,0,1,16.03083,20.8927,31.12209,31.12209,0,0,1-6.56554,25.84773q12.72244-4.51323,25.44489-9.0263c5.23526-1.85713,10.83833-3.997,13.94267-8.76047C795.62723,240.107,794.79091,232.78685,793.7871,226.19592Z" transform="translate(-168.64838 -127.60704)" fill="#2f2e41"/></svg>
                </div>
                <div style="display: flex;text-align: center;align-items:center;justify-content:center; ">
                    <h5>You don't have any server yet</h5>
                </div>
                <p> &nbsp;</p>
              <div style="display: flex;text-align: center;align-items:center;justify-content:center; ">
                    <a href="/create"><button style=" padding: 9px; background-image: linear-gradient(#2196F3,#1976D2); font-size: 20px;color:white; font-weight: 20px; border: 20px #2196F3; border-radius: 9px;"class="">Create a server</button></a>
                </div> 
                <div>
                    <p> &nbsp;</p>
                    <p> &nbsp;</p>
                    <p> &nbsp;</p>
                    <p> &nbsp;</p>
                    <p style="text-align: center;">Made By Rakin</p>
                    <p style="text-align: center;">My Own Project For Dashboard. Idea : Shadow</p>
                    <p> &nbsp;</p>
                    <p> &nbsp;</p>
                </div>

            </div>

        </div>
        <!-- Content End -->


        <!-- Back to Top -->

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
    <script src="js/index.js"></script>
    <script src="js/dark.js"></script>

</body>

</html>


<style>
    /********** Template CSS **********/


.back-to-top {
    position: fixed;
    display: none;
    right: 45px;
    bottom: 45px;
    z-index: 99;
}

#icon {
    width: 30px;
    cursor:pointer;
}


/*** Spinner ***/
#spinner {
    opacity: 0;
    visibility: hidden;
    transition: opacity .5s ease-out, visibility 0s linear .5s;
    z-index: 99999;
}

#spinner.show {
    transition: opacity .5s ease-out, visibility 0s linear 0s;
    visibility: visible;
    opacity: 1;
}


/*** Button ***/
.btn {
    transition: .5s;
}

.btn-square {
    width: 38px;
    height: 38px;
}

.btn-sm-square {
    width: 32px;
    height: 32px;
}

.btn-lg-square {
    width: 48px;
    height: 48px;
}

.btn-square,
.btn-sm-square,
.btn-lg-square {
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: normal;
    border-radius: 50px;
}


/*** Layout ***/
.sidebar {
    padding-top: 4vh;
    position: fixed;
    top: 4vh;
    left: 0;
    bottom: 4vh;
    width: 250px;
    height: 90vh;
    border:5px transparent;
    border-radius: 35px;
    overflow-y: auto;
    background: var(--primary-color);
    transition: 0.5s;
    z-index: 999;
}

.content {
    margin-left: 250px;
    min-height: 100vh;
    background: var(--secondary-color);
    transition: 0.5s;
}

@media (min-width: 992px) {
    .sidebar {
        margin-left: 0;
    }

    .sidebar.open {
        margin-left: -250px;
    }

    .content {
        width: calc(100% - 250px);
    }

    .content.open {
        width: 100%;
        margin-left: 0;
    }
}

@media (max-width: 991.98px) {
    .sidebar {
        margin-left: -250px;
    }

    .sidebar.open {
        margin-left: 0;
    }

    .content {
        width: 100%;
        margin-left: 0;
    }
}


/*** Navbar ***/
.sidebar .navbar .navbar-nav .nav-link {
    padding: 7px 20px;
    color: var(--light);
    font-weight: 500;
    border-left: 3px solid var(--primary-color);
    border-radius: 0 30px 30px 0;
    outline: none;
}

.sidebar .navbar .navbar-nav .nav-link:hover,
.sidebar .navbar .navbar-nav .nav-link.active {
    color: var(--primary);
    background: var(--secondary-color);
    border-color: var(--primary);
}

.sidebar .navbar .navbar-nav .nav-link i {
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: var(--secondary-color);
    border-radius: 40px;
}

.sidebar .navbar .navbar-nav .nav-link:hover i,
.sidebar .navbar .navbar-nav .nav-link.active i {
    background: var(--primary-color);
}

.sidebar .navbar .dropdown-toggle::after {
    position: absolute;
    top: 15px;
    right: 15px;
    border: none;
    content: "\f107";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    transition: .5s;
}

.sidebar .navbar .dropdown-toggle[aria-expanded=true]::after {
    transform: rotate(-180deg);
}

.sidebar .navbar .dropdown-item {
    padding-left: 25px;
    border-radius: 0 30px 30px 0;
    color: var(--light);
}

.sidebar .navbar .dropdown-item:hover,
.sidebar .navbar .dropdown-item.active {
    background: var(--secondary-color);
}

.content .navbar .navbar-nav .nav-link {
    margin-left: 25px;
    padding: 12px 0;
    color: var(--light);
    outline: none;
}

.content .navbar .navbar-nav .nav-link:hover,
.content .navbar .navbar-nav .nav-link.active {
    color: var(--primary);
}

.content .navbar .sidebar-toggler,
.content .navbar .navbar-nav .nav-link i {
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: var(--secondary-color);
    border-radius: 40px;
}

.content .navbar .dropdown-item {
    color: var(--light);
}

.content .navbar .dropdown-item:hover,
.content .navbar .dropdown-item.active {
    background: var(--secondary-color);
}

.content .navbar .dropdown-toggle::after {
    margin-left: 6px;
    vertical-align: middle;
    border: none;
    content: "\f107";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    transition: .5s;
}

.content .navbar .dropdown-toggle[aria-expanded=true]::after {
    transform: rotate(-180deg);
}

@media (max-width: 575.98px) {
    .content .navbar .navbar-nav .nav-link {
        margin-left: 15px;
    }
}


/*** Date Picker ***/
.bootstrap-datetimepicker-widget.bottom {
    top: auto !important;
}

.bootstrap-datetimepicker-widget .table * {
    border-bottom-width: 0px;
}

.bootstrap-datetimepicker-widget .table th {
    font-weight: 500;
}

.bootstrap-datetimepicker-widget.dropdown-menu {
    padding: 10px;
    border-radius: 2px;
}

.bootstrap-datetimepicker-widget table td.active,
.bootstrap-datetimepicker-widget table td.active:hover {
    background: var(--primary);
}

.bootstrap-datetimepicker-widget table td.today::before {
    border-bottom-color: var(--primary);
}


/*** Testimonial ***/
.progress .progress-bar {
    width: 0px;
    transition: 2s;
}


/*** Testimonial ***/
.testimonial-carousel .owl-dots {
    margin-top: 24px;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}

.testimonial-carousel .owl-dot {
    position: relative;
    display: inline-block;
    margin: 0 5px;
    width: 15px;
    height: 15px;
    border: 5px solid var(--primary);
    border-radius: 15px;
    transition: .5s;
}

.testimonial-carousel .owl-dot.active {
    background: var(--secondary-color);
    border-color: var(--primary);
}




</style>



<style>
   /*! * Bootstrap v5.0.0 (https://getbootstrap.com/) * Copyright 2011-2021 The Bootstrap Authors * Copyright 2011-2021 Twitter, Inc. * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE) */
:root{
    --bs-blue: #0d6efd;
    --bs-indigo: #6610f2;
    --bs-purple: #6f42c1;
    --bs-pink: #d63384;
    --bs-red: #6af7e5;
    --bs-orange: #fd7e14;
    --bs-yellow: #ffc107;
    --bs-green: #198754;
    --bs-teal: #20c997;
    --bs-cyan: #0dcaf0;
    --bs-white: #fff;
    --bs-gray: #6c757d;
    --bs-gray-dark: #343a40;
    --bs-primary: #6af7e5;
    --bs-secondary: white;
    --bs-success: #198754;
    --bs-info: #0dcaf0;
    --bs-warning: #ffc107;
    --bs-danger: #6af7e5;
    --bs-light: #6C7293;
    --bs-dark: #000;
    --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    --bs-gradient: linear-gradient(180deg, rgba(255,255,255,0.15), rgba(255,255,255,0))
}
*,*::before,*::after{
    box-sizing:border-box
}
@media (prefers-reduced-motion: no-preference){
    :root{
        scroll-behavior:smooth
    }
}
body{
    margin:0;
    font-family:"Open Sans",sans-serif;
    font-size:1rem;
    font-weight:400;
    line-height:1.5;
    color:var(--test-color);
    -webkit-text-size-adjust:100%;
    -webkit-tap-highlight-color:rgba(0,0,0,0)
}
hr{
    margin:1rem 0;
    color:inherit;
    background-color:currentColor;
    border:0;
    opacity:.25
}
hr:not([size]){
    height:1px
}
h1,.h1,h2,.h2,h3,.h3,h4,.h4,h5,.h5,h6,.h6{
    margin-top:0;
    margin-bottom:.5rem;
    font-family:"Roboto",sans-serif;
    font-weight:700;
    line-height:1.2;
    color:#121d2e
}
h1,.h1{
    font-size:calc(1.375rem + 1.5vw)
}
@media (min-width: 1200px){
    h1,.h1{
        font-size:2.5rem
    }
}
h2,.h2{
    font-size:calc(1.325rem + .9vw)
}
@media (min-width: 1200px){
    h2,.h2{
        font-size:2rem
    }
}
h3,.h3{
    font-size:calc(1.3rem + .6vw)
}
@media (min-width: 1200px){
    h3,.h3{
        font-size:1.75rem
    }
}
h4,.h4{
    font-size:calc(1.275rem + .3vw)
}
@media (min-width: 1200px){
    h4,.h4{
        font-size:1.5rem
    }
}
h5,.h5{
    font-size:1.25rem
}
h6,.h6{
    font-size:1rem
}
p{
    margin-top:0;
    margin-bottom:1rem
}
abbr[title],abbr[data-bs-original-title]{
    text-decoration:underline dotted;
    cursor:help;
    text-decoration-skip-ink:none
}
address{
    margin-bottom:1rem;
    font-style:normal;
    line-height:inherit
}
ol,ul{
    padding-left:2rem
}
ol,ul,dl{
    margin-top:0;
    margin-bottom:1rem
}
ol ol,ul ul,ol ul,ul ol{
    margin-bottom:0
}
dt{
    font-weight:700
}
dd{
    margin-bottom:.5rem;
    margin-left:0
}
blockquote{
    margin:0 0 1rem
}
b,strong{
    font-weight:bolder
}
small,.small{
    font-size:.875em
}
mark,.mark{
    padding:.2em;
    background-color:#fcf8e3
}
sub,sup{
    position:relative;
    font-size:.75em;
    line-height:0;
    vertical-align:baseline
}
sub{
    bottom:-.25em
}
sup{
    top:-.5em
}
a{
    color:#6af7e5;
    text-decoration:none
}
a:hover{
    color:#6af7e5
}
a:not([href]):not([class]),a:not([href]):not([class]):hover{
    color:inherit;
    text-decoration:none
}
pre,code,kbd,samp{
    font-family:var(--bs-font-monospace);
    font-size:1em;
    direction:ltr 
    /* rtl:ignore */
    ;
    unicode-bidi:bidi-override
}
pre{
    display:block;
    margin-top:0;
    margin-bottom:1rem;
    overflow:auto;
    font-size:.875em
}
pre code{
    font-size:inherit;
    color:inherit;
    word-break:normal
}
code{
    font-size:.875em;
    color:#d63384;
    word-wrap:break-word
}
a>code{
    color:inherit
}
kbd{
    padding:.2rem .4rem;
    font-size:.875em;
    color:#fff;
    background-color:#212529;
    border-radius:.2rem
}
kbd kbd{
    padding:0;
    font-size:1em;
    font-weight:700
}
figure{
    margin:0 0 1rem
}
img,svg{
    vertical-align:middle
}
table{
    caption-side:bottom;
    border-collapse:collapse
}
caption{
    padding-top:.5rem;
    padding-bottom:.5rem;
    color:#6c757d;
    text-align:left
}
th{
    text-align:inherit;
    text-align:-webkit-match-parent
}
thead,tbody,tfoot,tr,td,th{
    border-color:inherit;
    border-style:solid;
    border-width:0
}
label{
    display:inline-block
}
button{
    border-radius:0
}
button:focus:not(:focus-visible){
    outline:0
}
input,button,select,optgroup,textarea{
    margin:0;
    font-family:inherit;
    font-size:inherit;
    line-height:inherit
}
button,select{
    text-transform:none
}
[role="button"]{
    cursor:pointer
}
select{
    word-wrap:normal
}
select:disabled{
    opacity:1
}
[list]::-webkit-calendar-picker-indicator{
    display:none
}
button,[type="button"],[type="reset"],[type="submit"]{
    -webkit-appearance:button
}
button:not(:disabled),[type="button"]:not(:disabled),[type="reset"]:not(:disabled),[type="submit"]:not(:disabled){
    cursor:pointer
}
::-moz-focus-inner{
    padding:0;
    border-style:none
}
textarea{
    resize:vertical
}
fieldset{
    min-width:0;
    padding:0;
    margin:0;
    border:0
}
legend{
    float:left;
    width:100%;
    padding:0;
    margin-bottom:.5rem;
    font-size:calc(1.275rem + .3vw);
    line-height:inherit
}
@media (min-width: 1200px){
    legend{
        font-size:1.5rem
    }
}
legend+*{
    clear:left
}
::-webkit-datetime-edit-fields-wrapper,::-webkit-datetime-edit-text,::-webkit-datetime-edit-minute,::-webkit-datetime-edit-hour-field,::-webkit-datetime-edit-day-field,::-webkit-datetime-edit-month-field,::-webkit-datetime-edit-year-field{
    padding:0
}
::-webkit-inner-spin-button{
    height:auto
}
[type="search"]{
    outline-offset:-2px;
    -webkit-appearance:textfield
}
::-webkit-search-decoration{
    -webkit-appearance:none
}
::-webkit-color-swatch-wrapper{
    padding:0
}
::file-selector-button{
    font:inherit
}
::-webkit-file-upload-button{
    font:inherit;
    -webkit-appearance:button
}
output{
    display:inline-block
}
iframe{
    border:0
}
summary{
    display:list-item;
    cursor:pointer
}
progress{
    vertical-align:baseline
}
[hidden]{
    display:none !important
}
.lead{
    font-size:1.25rem;
    font-weight:300
}
.display-1{
    font-size:calc(1.625rem + 4.5vw);
    font-weight:700;
    line-height:1.2
}
@media (min-width: 1200px){
    .display-1{
        font-size:5rem
    }
}
.display-2{
    font-size:calc(1.575rem + 3.9vw);
    font-weight:700;
    line-height:1.2
}
@media (min-width: 1200px){
    .display-2{
        font-size:4.5rem
    }
}
.display-3{
    font-size:calc(1.525rem + 3.3vw);
    font-weight:700;
    line-height:1.2
}
@media (min-width: 1200px){
    .display-3{
        font-size:4rem
    }
}
.display-4{
    font-size:calc(1.475rem + 2.7vw);
    font-weight:700;
    line-height:1.2
}
@media (min-width: 1200px){
    .display-4{
        font-size:3.5rem
    }
}
.display-5{
    font-size:calc(1.425rem + 2.1vw);
    font-weight:700;
    line-height:1.2
}
@media (min-width: 1200px){
    .display-5{
        font-size:3rem
    }
}
.display-6{
    font-size:calc(1.375rem + 1.5vw);
    font-weight:700;
    line-height:1.2
}
@media (min-width: 1200px){
    .display-6{
        font-size:2.5rem
    }
}
.list-unstyled{
    padding-left:0;
    list-style:none
}
.list-inline{
    padding-left:0;
    list-style:none
}
.list-inline-item{
    display:inline-block
}
.list-inline-item:not(:last-child){
    margin-right:.5rem
}
.initialism{
    font-size:.875em;
    text-transform:uppercase
}
.blockquote{
    margin-bottom:1rem;
    font-size:1.25rem
}
.blockquote>:last-child{
    margin-bottom:0
}
.blockquote-footer{
    margin-top:-1rem;
    margin-bottom:1rem;
    font-size:.875em;
    color:#6c757d
}
.blockquote-footer::before{
    content:"\2014\00A0"
}
.img-fluid{
    max-width:100%;
    height:auto
}
.img-thumbnail{
    padding:.25rem;
    background-color:#000;
    border:1px solid #dee2e6;
    border-radius:5px;
    max-width:100%;
    height:auto
}
.figure{
    display:inline-block
}
.figure-img{
    margin-bottom:.5rem;
    line-height:1
}
.figure-caption{
    font-size:.875em;
    color:#6c757d
}
.container,.container-fluid,.container-sm,.container-md,.container-lg,.container-xl,.container-xxl{
    width:100%;
    padding-right:var(--bs-gutter-x, .75rem);
    padding-left:var(--bs-gutter-x, .75rem);
    margin-right:auto;
    margin-left:auto
}
@media (min-width: 576px){
    .container,.container-sm{
        max-width:540px
    }
}
@media (min-width: 768px){
    .container,.container-sm,.container-md{
        max-width:720px
    }
}
@media (min-width: 992px){
    .container,.container-sm,.container-md,.container-lg{
        max-width:960px
    }
}
@media (min-width: 1200px){
    .container,.container-sm,.container-md,.container-lg,.container-xl{
        max-width:1140px
    }
}
@media (min-width: 1400px){
    .container,.container-sm,.container-md,.container-lg,.container-xl,.container-xxl{
        max-width:1320px
    }
}
.row{
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display:flex;
    flex-wrap:wrap;
    margin-top:calc(var(--bs-gutter-y) * -1);
    margin-right:calc(var(--bs-gutter-x) / -2);
    margin-left:calc(var(--bs-gutter-x) / -2)
}
.row>*{
    flex-shrink:0;
    width:100%;
    max-width:100%;
    padding-right:calc(var(--bs-gutter-x) / 2);
    padding-left:calc(var(--bs-gutter-x) / 2);
    margin-top:var(--bs-gutter-y)
}
.col{
    flex:1 0 0%
}
.row-cols-auto>*{
    flex:0 0 auto;
    width:auto
}
.row-cols-1>*{
    flex:0 0 auto;
    width:100%
}
.row-cols-2>*{
    flex:0 0 auto;
    width:50%
}
.row-cols-3>*{
    flex:0 0 auto;
    width:33.33333%
}
.row-cols-4>*{
    flex:0 0 auto;
    width:25%
}
.row-cols-5>*{
    flex:0 0 auto;
    width:20%
}
.row-cols-6>*{
    flex:0 0 auto;
    width:16.66667%
}
.col-auto{
    flex:0 0 auto;
    width:auto
}
.col-1{
    flex:0 0 auto;
    width:8.33333%
}
.col-2{
    flex:0 0 auto;
    width:16.66667%
}
.col-3{
    flex:0 0 auto;
    width:25%
}
.col-4{
    flex:0 0 auto;
    width:33.33333%
}
.col-5{
    flex:0 0 auto;
    width:41.66667%
}
.col-6{
    flex:0 0 auto;
    width:50%
}
.col-7{
    flex:0 0 auto;
    width:58.33333%
}
.col-8{
    flex:0 0 auto;
    width:66.66667%
}
.col-9{
    flex:0 0 auto;
    width:75%
}
.col-10{
    flex:0 0 auto;
    width:83.33333%
}
.col-11{
    flex:0 0 auto;
    width:91.66667%
}
.col-12{
    flex:0 0 auto;
    width:100%
}
.offset-1{
    margin-left:8.33333%
}
.offset-2{
    margin-left:16.66667%
}
.offset-3{
    margin-left:25%
}
.offset-4{
    margin-left:33.33333%
}
.offset-5{
    margin-left:41.66667%
}
.offset-6{
    margin-left:50%
}
.offset-7{
    margin-left:58.33333%
}
.offset-8{
    margin-left:66.66667%
}
.offset-9{
    margin-left:75%
}
.offset-10{
    margin-left:83.33333%
}
.offset-11{
    margin-left:91.66667%
}
.g-0,.gx-0{
    --bs-gutter-x: 0
}
.g-0,.gy-0{
    --bs-gutter-y: 0
}
.g-1,.gx-1{
    --bs-gutter-x: .25rem
}
.g-1,.gy-1{
    --bs-gutter-y: .25rem
}
.g-2,.gx-2{
    --bs-gutter-x: .5rem
}
.g-2,.gy-2{
    --bs-gutter-y: .5rem
}
.g-3,.gx-3{
    --bs-gutter-x: 1rem
}
.g-3,.gy-3{
    --bs-gutter-y: 1rem
}
.g-4,.gx-4{
    --bs-gutter-x: 1.5rem
}
.g-4,.gy-4{
    --bs-gutter-y: 1.5rem
}
.g-5,.gx-5{
    --bs-gutter-x: 3rem
}
.g-5,.gy-5{
    --bs-gutter-y: 3rem
}
@media (min-width: 576px){
    .col-sm{
        flex:1 0 0%
    }
    .row-cols-sm-auto>*{
        flex:0 0 auto;
        width:auto
    }
    .row-cols-sm-1>*{
        flex:0 0 auto;
        width:100%
    }
    .row-cols-sm-2>*{
        flex:0 0 auto;
        width:50%
    }
    .row-cols-sm-3>*{
        flex:0 0 auto;
        width:33.33333%
    }
    .row-cols-sm-4>*{
        flex:0 0 auto;
        width:25%
    }
    .row-cols-sm-5>*{
        flex:0 0 auto;
        width:20%
    }
    .row-cols-sm-6>*{
        flex:0 0 auto;
        width:16.66667%
    }
    .col-sm-auto{
        flex:0 0 auto;
        width:auto
    }
    .col-sm-1{
        flex:0 0 auto;
        width:8.33333%
    }
    .col-sm-2{
        flex:0 0 auto;
        width:16.66667%
    }
    .col-sm-3{
        flex:0 0 auto;
        width:25%
    }
    .col-sm-4{
        flex:0 0 auto;
        width:33.33333%
    }
    .col-sm-5{
        flex:0 0 auto;
        width:41.66667%
    }
    .col-sm-6{
        flex:0 0 auto;
        width:50%
    }
    .col-sm-7{
        flex:0 0 auto;
        width:58.33333%
    }
    .col-sm-8{
        flex:0 0 auto;
        width:66.66667%
    }
    .col-sm-9{
        flex:0 0 auto;
        width:75%
    }
    .col-sm-10{
        flex:0 0 auto;
        width:83.33333%
    }
    .col-sm-11{
        flex:0 0 auto;
        width:91.66667%
    }
    .col-sm-12{
        flex:0 0 auto;
        width:100%
    }
    .offset-sm-0{
        margin-left:0
    }
    .offset-sm-1{
        margin-left:8.33333%
    }
    .offset-sm-2{
        margin-left:16.66667%
    }
    .offset-sm-3{
        margin-left:25%
    }
    .offset-sm-4{
        margin-left:33.33333%
    }
    .offset-sm-5{
        margin-left:41.66667%
    }
    .offset-sm-6{
        margin-left:50%
    }
    .offset-sm-7{
        margin-left:58.33333%
    }
    .offset-sm-8{
        margin-left:66.66667%
    }
    .offset-sm-9{
        margin-left:75%
    }
    .offset-sm-10{
        margin-left:83.33333%
    }
    .offset-sm-11{
        margin-left:91.66667%
    }
    .g-sm-0,.gx-sm-0{
        --bs-gutter-x: 0
    }
    .g-sm-0,.gy-sm-0{
        --bs-gutter-y: 0
    }
    .g-sm-1,.gx-sm-1{
        --bs-gutter-x: .25rem
    }
    .g-sm-1,.gy-sm-1{
        --bs-gutter-y: .25rem
    }
    .g-sm-2,.gx-sm-2{
        --bs-gutter-x: .5rem
    }
    .g-sm-2,.gy-sm-2{
        --bs-gutter-y: .5rem
    }
    .g-sm-3,.gx-sm-3{
        --bs-gutter-x: 1rem
    }
    .g-sm-3,.gy-sm-3{
        --bs-gutter-y: 1rem
    }
    .g-sm-4,.gx-sm-4{
        --bs-gutter-x: 1.5rem
    }
    .g-sm-4,.gy-sm-4{
        --bs-gutter-y: 1.5rem
    }
    .g-sm-5,.gx-sm-5{
        --bs-gutter-x: 3rem
    }
    .g-sm-5,.gy-sm-5{
        --bs-gutter-y: 3rem
    }
}
@media (min-width: 768px){
    .col-md{
        flex:1 0 0%
    }
    .row-cols-md-auto>*{
        flex:0 0 auto;
        width:auto
    }
    .row-cols-md-1>*{
        flex:0 0 auto;
        width:100%
    }
    .row-cols-md-2>*{
        flex:0 0 auto;
        width:50%
    }
    .row-cols-md-3>*{
        flex:0 0 auto;
        width:33.33333%
    }
    .row-cols-md-4>*{
        flex:0 0 auto;
        width:25%
    }
    .row-cols-md-5>*{
        flex:0 0 auto;
        width:20%
    }
    .row-cols-md-6>*{
        flex:0 0 auto;
        width:16.66667%
    }
    .col-md-auto{
        flex:0 0 auto;
        width:auto
    }
    .col-md-1{
        flex:0 0 auto;
        width:8.33333%
    }
    .col-md-2{
        flex:0 0 auto;
        width:16.66667%
    }
    .col-md-3{
        flex:0 0 auto;
        width:25%
    }
    .col-md-4{
        flex:0 0 auto;
        width:33.33333%
    }
    .col-md-5{
        flex:0 0 auto;
        width:41.66667%
    }
    .col-md-6{
        flex:0 0 auto;
        width:50%
    }
    .col-md-7{
        flex:0 0 auto;
        width:58.33333%
    }
    .col-md-8{
        flex:0 0 auto;
        width:66.66667%
    }
    .col-md-9{
        flex:0 0 auto;
        width:75%
    }
    .col-md-10{
        flex:0 0 auto;
        width:83.33333%
    }
    .col-md-11{
        flex:0 0 auto;
        width:91.66667%
    }
    .col-md-12{
        flex:0 0 auto;
        width:100%
    }
    .offset-md-0{
        margin-left:0
    }
    .offset-md-1{
        margin-left:8.33333%
    }
    .offset-md-2{
        margin-left:16.66667%
    }
    .offset-md-3{
        margin-left:25%
    }
    .offset-md-4{
        margin-left:33.33333%
    }
    .offset-md-5{
        margin-left:41.66667%
    }
    .offset-md-6{
        margin-left:50%
    }
    .offset-md-7{
        margin-left:58.33333%
    }
    .offset-md-8{
        margin-left:66.66667%
    }
    .offset-md-9{
        margin-left:75%
    }
    .offset-md-10{
        margin-left:83.33333%
    }
    .offset-md-11{
        margin-left:91.66667%
    }
    .g-md-0,.gx-md-0{
        --bs-gutter-x: 0
    }
    .g-md-0,.gy-md-0{
        --bs-gutter-y: 0
    }
    .g-md-1,.gx-md-1{
        --bs-gutter-x: .25rem
    }
    .g-md-1,.gy-md-1{
        --bs-gutter-y: .25rem
    }
    .g-md-2,.gx-md-2{
        --bs-gutter-x: .5rem
    }
    .g-md-2,.gy-md-2{
        --bs-gutter-y: .5rem
    }
    .g-md-3,.gx-md-3{
        --bs-gutter-x: 1rem
    }
    .g-md-3,.gy-md-3{
        --bs-gutter-y: 1rem
    }
    .g-md-4,.gx-md-4{
        --bs-gutter-x: 1.5rem
    }
    .g-md-4,.gy-md-4{
        --bs-gutter-y: 1.5rem
    }
    .g-md-5,.gx-md-5{
        --bs-gutter-x: 3rem
    }
    .g-md-5,.gy-md-5{
        --bs-gutter-y: 3rem
    }
}
@media (min-width: 992px){
    .col-lg{
        flex:1 0 0%
    }
    .row-cols-lg-auto>*{
        flex:0 0 auto;
        width:auto
    }
    .row-cols-lg-1>*{
        flex:0 0 auto;
        width:100%
    }
    .row-cols-lg-2>*{
        flex:0 0 auto;
        width:50%
    }
    .row-cols-lg-3>*{
        flex:0 0 auto;
        width:33.33333%
    }
    .row-cols-lg-4>*{
        flex:0 0 auto;
        width:25%
    }
    .row-cols-lg-5>*{
        flex:0 0 auto;
        width:20%
    }
    .row-cols-lg-6>*{
        flex:0 0 auto;
        width:16.66667%
    }
    .col-lg-auto{
        flex:0 0 auto;
        width:auto
    }
    .col-lg-1{
        flex:0 0 auto;
        width:8.33333%
    }
    .col-lg-2{
        flex:0 0 auto;
        width:16.66667%
    }
    .col-lg-3{
        flex:0 0 auto;
        width:25%
    }
    .col-lg-4{
        flex:0 0 auto;
        width:33.33333%
    }
    .col-lg-5{
        flex:0 0 auto;
        width:41.66667%
    }
    .col-lg-6{
        flex:0 0 auto;
        width:50%
    }
    .col-lg-7{
        flex:0 0 auto;
        width:58.33333%
    }
    .col-lg-8{
        flex:0 0 auto;
        width:66.66667%
    }
    .col-lg-9{
        flex:0 0 auto;
        width:75%
    }
    .col-lg-10{
        flex:0 0 auto;
        width:83.33333%
    }
    .col-lg-11{
        flex:0 0 auto;
        width:91.66667%
    }
    .col-lg-12{
        flex:0 0 auto;
        width:100%
    }
    .offset-lg-0{
        margin-left:0
    }
    .offset-lg-1{
        margin-left:8.33333%
    }
    .offset-lg-2{
        margin-left:16.66667%
    }
    .offset-lg-3{
        margin-left:25%
    }
    .offset-lg-4{
        margin-left:33.33333%
    }
    .offset-lg-5{
        margin-left:41.66667%
    }
    .offset-lg-6{
        margin-left:50%
    }
    .offset-lg-7{
        margin-left:58.33333%
    }
    .offset-lg-8{
        margin-left:66.66667%
    }
    .offset-lg-9{
        margin-left:75%
    }
    .offset-lg-10{
        margin-left:83.33333%
    }
    .offset-lg-11{
        margin-left:91.66667%
    }
    .g-lg-0,.gx-lg-0{
        --bs-gutter-x: 0
    }
    .g-lg-0,.gy-lg-0{
        --bs-gutter-y: 0
    }
    .g-lg-1,.gx-lg-1{
        --bs-gutter-x: .25rem
    }
    .g-lg-1,.gy-lg-1{
        --bs-gutter-y: .25rem
    }
    .g-lg-2,.gx-lg-2{
        --bs-gutter-x: .5rem
    }
    .g-lg-2,.gy-lg-2{
        --bs-gutter-y: .5rem
    }
    .g-lg-3,.gx-lg-3{
        --bs-gutter-x: 1rem
    }
    .g-lg-3,.gy-lg-3{
        --bs-gutter-y: 1rem
    }
    .g-lg-4,.gx-lg-4{
        --bs-gutter-x: 1.5rem
    }
    .g-lg-4,.gy-lg-4{
        --bs-gutter-y: 1.5rem
    }
    .g-lg-5,.gx-lg-5{
        --bs-gutter-x: 3rem
    }
    .g-lg-5,.gy-lg-5{
        --bs-gutter-y: 3rem
    }
}
@media (min-width: 1200px){
    .col-xl{
        flex:1 0 0%
    }
    .row-cols-xl-auto>*{
        flex:0 0 auto;
        width:auto
    }
    .row-cols-xl-1>*{
        flex:0 0 auto;
        width:100%
    }
    .row-cols-xl-2>*{
        flex:0 0 auto;
        width:50%
    }
    .row-cols-xl-3>*{
        flex:0 0 auto;
        width:33.33333%
    }
    .row-cols-xl-4>*{
        flex:0 0 auto;
        width:25%
    }
    .row-cols-xl-5>*{
        flex:0 0 auto;
        width:20%
    }
    .row-cols-xl-6>*{
        flex:0 0 auto;
        width:16.66667%
    }
    .col-xl-auto{
        flex:0 0 auto;
        width:auto
    }
    .col-xl-1{
        flex:0 0 auto;
        width:8.33333%
    }
    .col-xl-2{
        flex:0 0 auto;
        width:16.66667%
    }
    .col-xl-3{
        flex:0 0 auto;
        width:25%
    }
    .col-xl-4{
        flex:0 0 auto;
        width:33.33333%
    }
    .col-xl-5{
        flex:0 0 auto;
        width:41.66667%
    }
    .col-xl-6{
        flex:0 0 auto;
        width:50%
    }
    .col-xl-7{
        flex:0 0 auto;
        width:58.33333%
    }
    .col-xl-8{
        flex:0 0 auto;
        width:66.66667%
    }
    .col-xl-9{
        flex:0 0 auto;
        width:75%
    }
    .col-xl-10{
        flex:0 0 auto;
        width:83.33333%
    }
    .col-xl-11{
        flex:0 0 auto;
        width:91.66667%
    }
    .col-xl-12{
        flex:0 0 auto;
        width:100%
    }
    .offset-xl-0{
        margin-left:0
    }
    .offset-xl-1{
        margin-left:8.33333%
    }
    .offset-xl-2{
        margin-left:16.66667%
    }
    .offset-xl-3{
        margin-left:25%
    }
    .offset-xl-4{
        margin-left:33.33333%
    }
    .offset-xl-5{
        margin-left:41.66667%
    }
    .offset-xl-6{
        margin-left:50%
    }
    .offset-xl-7{
        margin-left:58.33333%
    }
    .offset-xl-8{
        margin-left:66.66667%
    }
    .offset-xl-9{
        margin-left:75%
    }
    .offset-xl-10{
        margin-left:83.33333%
    }
    .offset-xl-11{
        margin-left:91.66667%
    }
    .g-xl-0,.gx-xl-0{
        --bs-gutter-x: 0
    }
    .g-xl-0,.gy-xl-0{
        --bs-gutter-y: 0
    }
    .g-xl-1,.gx-xl-1{
        --bs-gutter-x: .25rem
    }
    .g-xl-1,.gy-xl-1{
        --bs-gutter-y: .25rem
    }
    .g-xl-2,.gx-xl-2{
        --bs-gutter-x: .5rem
    }
    .g-xl-2,.gy-xl-2{
        --bs-gutter-y: .5rem
    }
    .g-xl-3,.gx-xl-3{
        --bs-gutter-x: 1rem
    }
    .g-xl-3,.gy-xl-3{
        --bs-gutter-y: 1rem
    }
    .g-xl-4,.gx-xl-4{
        --bs-gutter-x: 1.5rem
    }
    .g-xl-4,.gy-xl-4{
        --bs-gutter-y: 1.5rem
    }
    .g-xl-5,.gx-xl-5{
        --bs-gutter-x: 3rem
    }
    .g-xl-5,.gy-xl-5{
        --bs-gutter-y: 3rem
    }
}
@media (min-width: 1400px){
    .col-xxl{
        flex:1 0 0%
    }
    .row-cols-xxl-auto>*{
        flex:0 0 auto;
        width:auto
    }
    .row-cols-xxl-1>*{
        flex:0 0 auto;
        width:100%
    }
    .row-cols-xxl-2>*{
        flex:0 0 auto;
        width:50%
    }
    .row-cols-xxl-3>*{
        flex:0 0 auto;
        width:33.33333%
    }
    .row-cols-xxl-4>*{
        flex:0 0 auto;
        width:25%
    }
    .row-cols-xxl-5>*{
        flex:0 0 auto;
        width:20%
    }
    .row-cols-xxl-6>*{
        flex:0 0 auto;
        width:16.66667%
    }
    .col-xxl-auto{
        flex:0 0 auto;
        width:auto
    }
    .col-xxl-1{
        flex:0 0 auto;
        width:8.33333%
    }
    .col-xxl-2{
        flex:0 0 auto;
        width:16.66667%
    }
    .col-xxl-3{
        flex:0 0 auto;
        width:25%
    }
    .col-xxl-4{
        flex:0 0 auto;
        width:33.33333%
    }
    .col-xxl-5{
        flex:0 0 auto;
        width:41.66667%
    }
    .col-xxl-6{
        flex:0 0 auto;
        width:50%
    }
    .col-xxl-7{
        flex:0 0 auto;
        width:58.33333%
    }
    .col-xxl-8{
        flex:0 0 auto;
        width:66.66667%
    }
    .col-xxl-9{
        flex:0 0 auto;
        width:75%
    }
    .col-xxl-10{
        flex:0 0 auto;
        width:83.33333%
    }
    .col-xxl-11{
        flex:0 0 auto;
        width:91.66667%
    }
    .col-xxl-12{
        flex:0 0 auto;
        width:100%
    }
    .offset-xxl-0{
        margin-left:0
    }
    .offset-xxl-1{
        margin-left:8.33333%
    }
    .offset-xxl-2{
        margin-left:16.66667%
    }
    .offset-xxl-3{
        margin-left:25%
    }
    .offset-xxl-4{
        margin-left:33.33333%
    }
    .offset-xxl-5{
        margin-left:41.66667%
    }
    .offset-xxl-6{
        margin-left:50%
    }
    .offset-xxl-7{
        margin-left:58.33333%
    }
    .offset-xxl-8{
        margin-left:66.66667%
    }
    .offset-xxl-9{
        margin-left:75%
    }
    .offset-xxl-10{
        margin-left:83.33333%
    }
    .offset-xxl-11{
        margin-left:91.66667%
    }
    .g-xxl-0,.gx-xxl-0{
        --bs-gutter-x: 0
    }
    .g-xxl-0,.gy-xxl-0{
        --bs-gutter-y: 0
    }
    .g-xxl-1,.gx-xxl-1{
        --bs-gutter-x: .25rem
    }
    .g-xxl-1,.gy-xxl-1{
        --bs-gutter-y: .25rem
    }
    .g-xxl-2,.gx-xxl-2{
        --bs-gutter-x: .5rem
    }
    .g-xxl-2,.gy-xxl-2{
        --bs-gutter-y: .5rem
    }
    .g-xxl-3,.gx-xxl-3{
        --bs-gutter-x: 1rem
    }
    .g-xxl-3,.gy-xxl-3{
        --bs-gutter-y: 1rem
    }
    .g-xxl-4,.gx-xxl-4{
        --bs-gutter-x: 1.5rem
    }
    .g-xxl-4,.gy-xxl-4{
        --bs-gutter-y: 1.5rem
    }
    .g-xxl-5,.gx-xxl-5{
        --bs-gutter-x: 3rem
    }
    .g-xxl-5,.gy-xxl-5{
        --bs-gutter-y: 3rem
    }
}
.table{
    --bs-table-bg: rgba(0,0,0,0);
    --bs-table-striped-color: #6C7293;
    --bs-table-striped-bg: rgba(0,0,0,0.05);
    --bs-table-active-color: #6C7293;
    --bs-table-active-bg: rgba(0,0,0,0.1);
    --bs-table-hover-color: #6C7293;
    --bs-table-hover-bg: rgba(0,0,0,0.075);
    width:100%;
    margin-bottom:1rem;
    color:#6C7293;
    vertical-align:top;
    border-color:#000
}
.table>:not(caption)>*>*{
    padding:.5rem .5rem;
    background-color:var(--bs-table-bg);
    border-bottom-width:1px;
    box-shadow:inset 0 0 0 9999px var(--bs-table-accent-bg)
}
.table>tbody{
    vertical-align:inherit
}
.table>thead{
    vertical-align:bottom
}
.table>:not(:last-child)>:last-child>*{
    border-bottom-color:currentColor
}
.caption-top{
    caption-side:top
}
.table-sm>:not(caption)>*>*{
    padding:.25rem .25rem
}
.table-bordered>:not(caption)>*{
    border-width:1px 0
}
.table-bordered>:not(caption)>*>*{
    border-width:0 1px
}
.table-borderless>:not(caption)>*>*{
    border-bottom-width:0
}
.table-striped>tbody>tr:nth-of-type(odd){
    --bs-table-accent-bg: var(--bs-table-striped-bg);
    color:var(--bs-table-striped-color)
}
.table-active{
    --bs-table-accent-bg: var(--bs-table-active-bg);
    color:var(--bs-table-active-color)
}
.table-hover>tbody>tr:hover{
    --bs-table-accent-bg: var(--bs-table-hover-bg);
    color:var(--bs-table-hover-color)
}
.table-primary{
    --bs-table-bg: #fbd0d0;
    --bs-table-striped-bg: #eec6c6;
    --bs-table-striped-color: #000;
    --bs-table-active-bg: #e2bbbb;
    --bs-table-active-color: #000;
    --bs-table-hover-bg: #e8c0c0;
    --bs-table-hover-color: #000;
    color:#000;
    border-color:#e2bbbb
}
.table-secondary{
    --bs-table-bg: #d1d2d3;
    --bs-table-striped-bg: #c7c8c8;
    --bs-table-striped-color: #000;
    --bs-table-active-bg: #bcbdbe;
    --bs-table-active-color: #000;
    --bs-table-hover-bg: #c1c2c3;
    --bs-table-hover-color: #000;
    color:#000;
    border-color:#bcbdbe
}
.table-success{
    --bs-table-bg: #d1e7dd;
    --bs-table-striped-bg: #c7dbd2;
    --bs-table-striped-color: #000;
    --bs-table-active-bg: #bcd0c7;
    --bs-table-active-color: #000;
    --bs-table-hover-bg: #c1d6cc;
    --bs-table-hover-color: #000;
    color:#000;
    border-color:#bcd0c7
}
.table-info{
    --bs-table-bg: #cff4fc;
    --bs-table-striped-bg: #c5e8ef;
    --bs-table-striped-color: #000;
    --bs-table-active-bg: #badce3;
    --bs-table-active-color: #000;
    --bs-table-hover-bg: #bfe2e9;
    --bs-table-hover-color: #000;
    color:#000;
    border-color:#badce3
}
.table-warning{
    --bs-table-bg: #fff3cd;
    --bs-table-striped-bg: #f2e7c3;
    --bs-table-striped-color: #000;
    --bs-table-active-bg: #e6dbb9;
    --bs-table-active-color: #000;
    --bs-table-hover-bg: #ece1be;
    --bs-table-hover-color: #000;
    color:#000;
    border-color:#e6dbb9
}
.table-danger{
    --bs-table-bg: #f8d7da;
    --bs-table-striped-bg: #eccccf;
    --bs-table-striped-color: #000;
    --bs-table-active-bg: #dfc2c4;
    --bs-table-active-color: #000;
    --bs-table-hover-bg: #e5c7ca;
    --bs-table-hover-color: #000;
    color:#000;
    border-color:#dfc2c4
}
.table-light{
    --bs-table-bg: #6C7293;
    --bs-table-striped-bg: #737998;
    --bs-table-striped-color: #000;
    --bs-table-active-bg: #7b809e;
    --bs-table-active-color: #000;
    --bs-table-hover-bg: #777d9b;
    --bs-table-hover-color: #000;
    color:#fff;
    border-color:#7b809e
}
.table-dark{
    --bs-table-bg: #000;
    --bs-table-striped-bg: #0d0d0d;
    --bs-table-striped-color: #fff;
    --bs-table-active-bg: #1a1a1a;
    --bs-table-active-color: #fff;
    --bs-table-hover-bg: #131313;
    --bs-table-hover-color: #fff;
    color:#fff;
    border-color:#1a1a1a
}
.table-responsive{
    overflow-x:auto;
    -webkit-overflow-scrolling:touch
}
@media (max-width: 575.98px){
    .table-responsive-sm{
        overflow-x:auto;
        -webkit-overflow-scrolling:touch
    }
}
@media (max-width: 767.98px){
    .table-responsive-md{
        overflow-x:auto;
        -webkit-overflow-scrolling:touch
    }
}
@media (max-width: 991.98px){
    .table-responsive-lg{
        overflow-x:auto;
        -webkit-overflow-scrolling:touch
    }
}
@media (max-width: 1199.98px){
    .table-responsive-xl{
        overflow-x:auto;
        -webkit-overflow-scrolling:touch
    }
}
@media (max-width: 1399.98px){
    .table-responsive-xxl{
        overflow-x:auto;
        -webkit-overflow-scrolling:touch
    }
}
.form-label{
    margin-bottom:.5rem
}
.col-form-label{
    padding-top:calc(.375rem + 1px);
    padding-bottom:calc(.375rem + 1px);
    margin-bottom:0;
    font-size:inherit;
    line-height:1.5
}
.col-form-label-lg{
    padding-top:calc(.5rem + 1px);
    padding-bottom:calc(.5rem + 1px);
    font-size:1.25rem
}
.col-form-label-sm{
    padding-top:calc(.25rem + 1px);
    padding-bottom:calc(.25rem + 1px);
    font-size:.875rem
}
.form-text{
    margin-top:.25rem;
    font-size:.875em;
    color:#6c757d
}
.form-control{
    display:block;
    width:100%;
    padding:.375rem .75rem;
    font-size:1rem;
    font-weight:400;
    line-height:1.5;
    color:#6C7293;
    background-color:rgb(197, 197, 197);
    background-clip:padding-box;
    border:1px solid rgb(197, 197, 197);
    appearance:none;
    border-radius:5px;
    transition:border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out
}
@media (prefers-reduced-motion: reduce){
    .form-control{
        transition:none
    }
}
.form-control[type="file"]{
    overflow:hidden
}
.form-control[type="file"]:not(:disabled):not(:read-only){
    cursor:pointer
}
.form-control:focus{
    color:#6C7293;
    background-color:#000;
    border-color:#f58b8b;
    outline:0;
    box-shadow:0 0 0 .25rem rgba(235,22,22,0.25)
}
.form-control::-webkit-date-and-time-value{
    height:1.5em
}
.form-control::placeholder{
    color:#6c757d;
    opacity:1
}
.form-control:disabled,.form-control:read-only{
    background-color:#e9ecef;
    opacity:1
}
.form-control::file-selector-button{
    padding:.375rem .75rem;
    margin:-.375rem -.75rem;
    margin-inline-end:.75rem;
    color:#6C7293;
    background-color:#e9ecef;
    pointer-events:none;
    border-color:inherit;
    border-style:solid;
    border-width:0;
    border-inline-end-width:1px;
    border-radius:0;
    transition:color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out
}
@media (prefers-reduced-motion: reduce){
    .form-control::file-selector-button{
        transition:none
    }
}
.form-control:hover:not(:disabled):not(:read-only)::file-selector-button{
    background-color:#dde0e3
}
.form-control::-webkit-file-upload-button{
    padding:.375rem .75rem;
    margin:-.375rem -.75rem;
    margin-inline-end:.75rem;
    color:#6C7293;
    background-color:#e9ecef;
    pointer-events:none;
    border-color:inherit;
    border-style:solid;
    border-width:0;
    border-inline-end-width:1px;
    border-radius:0;
    transition:color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out
}
@media (prefers-reduced-motion: reduce){
    .form-control::-webkit-file-upload-button{
        transition:none
    }
}
.form-control:hover:not(:disabled):not(:read-only)::-webkit-file-upload-button{
    background-color:#dde0e3
}
.form-control-plaintext{
    display:block;
    width:100%;
    padding:.375rem 0;
    margin-bottom:0;
    line-height:1.5;
    color:#6C7293;
    background-color:transparent;
    border:solid transparent;
    border-width:1px 0
}
.form-control-plaintext.form-control-sm,.form-control-plaintext.form-control-lg{
    padding-right:0;
    padding-left:0
}
.form-control-sm{
    min-height:calc(1.5em + .5rem + 2px);
    padding:.25rem .5rem;
    font-size:.875rem;
    border-radius:.2rem
}
.form-control-sm::file-selector-button{
    padding:.25rem .5rem;
    margin:-.25rem -.5rem;
    margin-inline-end:.5rem
}
.form-control-sm::-webkit-file-upload-button{
    padding:.25rem .5rem;
    margin:-.25rem -.5rem;
    margin-inline-end:.5rem
}
.form-control-lg{
    min-height:calc(1.5em + 1rem + 2px);
    padding:.5rem 1rem;
    font-size:1.25rem;
    border-radius:.3rem
}
.form-control-lg::file-selector-button{
    padding:.5rem 1rem;
    margin:-.5rem -1rem;
    margin-inline-end:1rem
}
.form-control-lg::-webkit-file-upload-button{
    padding:.5rem 1rem;
    margin:-.5rem -1rem;
    margin-inline-end:1rem
}
textarea.form-control{
    min-height:calc(1.5em + .75rem + 2px)
}
textarea.form-control-sm{
    min-height:calc(1.5em + .5rem + 2px)
}
textarea.form-control-lg{
    min-height:calc(1.5em + 1rem + 2px)
}
.form-control-color{
    max-width:3rem;
    height:auto;
    padding:.375rem
}
.form-control-color:not(:disabled):not(:read-only){
    cursor:pointer
}
.form-control-color::-moz-color-swatch{
    height:1.5em;
    border-radius:5px
}
.form-control-color::-webkit-color-swatch{
    height:1.5em;
    border-radius:5px
}
.form-select{
    display:block;
    width:100%;
    padding:.375rem 2.25rem .375rem .75rem;
    font-size:1rem;
    font-weight:400;
    line-height:1.5;
    color:#6C7293;
    background-color:#000;
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat:no-repeat;
    background-position:right .75rem center;
    background-size:16px 12px;
    border:1px solid #000;
    border-radius:5px;
    appearance:none
}
.form-select:focus{
    border-color:#f58b8b;
    outline:0;
    box-shadow:0 0 0 .25rem rgba(235,22,22,0.25)
}
.form-select[multiple],.form-select[size]:not([size="1"]){
    padding-right:.75rem;
    background-image:none
}
.form-select:disabled{
    background-color:#e9ecef
}
.form-select:-moz-focusring{
    color:transparent;
    text-shadow:0 0 0 #6C7293
}
.form-select-sm{
    padding-top:.25rem;
    padding-bottom:.25rem;
    padding-left:.5rem;
    font-size:.875rem
}
.form-select-lg{
    padding-top:.5rem;
    padding-bottom:.5rem;
    padding-left:1rem;
    font-size:1.25rem
}
.form-check{
    display:block;
    min-height:1.5rem;
    padding-left:1.5em;
    margin-bottom:.125rem
}
.form-check .form-check-input{
    float:left;
    margin-left:-1.5em
}
.form-check-input{
    width:1em;
    height:1em;
    margin-top:.25em;
    vertical-align:top;
    background-color:#000;
    background-repeat:no-repeat;
    background-position:center;
    background-size:contain;
    border:1px solid rgba(0,0,0,0.25);
    appearance:none;
    color-adjust:exact
}
.form-check-input[type="checkbox"]{
    border-radius:.25em
}
.form-check-input[type="radio"]{
    border-radius:50%
}
.form-check-input:active{
    filter:brightness(90%)
}
.form-check-input:focus{
    border-color:#f58b8b;
    outline:0;
    box-shadow:0 0 0 .25rem rgba(235,22,22,0.25)
}
.form-check-input:checked{
    background-color:#6af7e5;
    border-color:#6af7e5
}
.form-check-input:checked[type="checkbox"]{
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e")
}
.form-check-input:checked[type="radio"]{
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e")
}
.form-check-input[type="checkbox"]:indeterminate{
    background-color:#6af7e5;
    border-color:#6af7e5;
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10h8'/%3e%3c/svg%3e")
}
.form-check-input:disabled{
    pointer-events:none;
    filter:none;
    opacity:.5
}
.form-check-input[disabled] ~ .form-check-label,.form-check-input:disabled ~ .form-check-label{
    opacity:.5
}
.form-switch{
    padding-left:2.5em
}
.form-switch .form-check-input{
    width:2em;
    margin-left:-2.5em;
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280,0,0,0.25%29'/%3e%3c/svg%3e");
    background-position:left center;
    border-radius:2em;
    transition:background-position 0.15s ease-in-out
}
@media (prefers-reduced-motion: reduce){
    .form-switch .form-check-input{
        transition:none
    }
}
.form-switch .form-check-input:focus{
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23f58b8b'/%3e%3c/svg%3e")
}
.form-switch .form-check-input:checked{
    background-position:right center;
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e")
}
.form-check-inline{
    display:inline-block;
    margin-right:1rem
}
.btn-check{
    position:absolute;
    clip:rect(0, 0, 0, 0);
    pointer-events:none
}
.btn-check[disabled]+.btn,.btn-check:disabled+.btn{
    pointer-events:none;
    filter:none;
    opacity:.65
}
.form-range{
    width:100%;
    height:1.5rem;
    padding:0;
    background-color:transparent;
    appearance:none
}
.form-range:focus{
    outline:0
}
.form-range:focus::-webkit-slider-thumb{
    box-shadow:0 0 0 1px #000,0 0 0 .25rem rgba(235,22,22,0.25)
}
.form-range:focus::-moz-range-thumb{
    box-shadow:0 0 0 1px #000,0 0 0 .25rem rgba(235,22,22,0.25)
}
.form-range::-moz-focus-outer{
    border:0
}
.form-range::-webkit-slider-thumb{
    width:1rem;
    height:1rem;
    margin-top:-.25rem;
    background-color:#6af7e5;
    border:0;
    border-radius:1rem;
    transition:background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out;
    appearance:none
}
@media (prefers-reduced-motion: reduce){
    .form-range::-webkit-slider-thumb{
        transition:none
    }
}
.form-range::-webkit-slider-thumb:active{
    background-color:#f9b9b9
}
.form-range::-webkit-slider-runnable-track{
    width:100%;
    height:.5rem;
    color:transparent;
    cursor:pointer;
    background-color:#dee2e6;
    border-color:transparent;
    border-radius:1rem
}
.form-range::-moz-range-thumb{
    width:1rem;
    height:1rem;
    background-color:#6af7e5;
    border:0;
    border-radius:1rem;
    transition:background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out;
    appearance:none
}
@media (prefers-reduced-motion: reduce){
    .form-range::-moz-range-thumb{
        transition:none
    }
}
.form-range::-moz-range-thumb:active{
    background-color:#f9b9b9
}
.form-range::-moz-range-track{
    width:100%;
    height:.5rem;
    color:transparent;
    cursor:pointer;
    background-color:#dee2e6;
    border-color:transparent;
    border-radius:1rem
}
.form-range:disabled{
    pointer-events:none
}
.form-range:disabled::-webkit-slider-thumb{
    background-color:#adb5bd
}
.form-range:disabled::-moz-range-thumb{
    background-color:#adb5bd
}
.form-floating{
    position:relative
}
.form-floating>.form-control,.form-floating>.form-select{
    height:calc(3.5rem + 2px);
    padding:1rem .75rem
}
.form-floating>label{
    position:absolute;
    top:0;
    left:0;
    height:100%;
    padding:1rem .75rem;
    pointer-events:none;
    border:1px solid transparent;
    transform-origin:0 0;
    transition:opacity 0.1s ease-in-out,transform 0.1s ease-in-out
}
@media (prefers-reduced-motion: reduce){
    .form-floating>label{
        transition:none
    }
}
.form-floating>.form-control::placeholder{
    color:transparent
}
.form-floating>.form-control:focus,.form-floating>.form-control:not(:placeholder-shown){
    padding-top:1.625rem;
    padding-bottom:.625rem
}
.form-floating>.form-control:-webkit-autofill{
    padding-top:1.625rem;
    padding-bottom:.625rem
}
.form-floating>.form-select{
    padding-top:1.625rem;
    padding-bottom:.625rem
}
.form-floating>.form-control:focus ~ label,.form-floating>.form-control:not(:placeholder-shown) ~ label,.form-floating>.form-select ~ label{
    opacity:.65;
    transform:scale(0.85) translateY(-0.5rem) translateX(0.15rem)
}
.form-floating>.form-control:-webkit-autofill ~ label{
    opacity:.65;
    transform:scale(0.85) translateY(-0.5rem) translateX(0.15rem)
}
.input-group{
    position:relative;
    display:flex;
    flex-wrap:wrap;
    align-items:stretch;
    width:100%
}
.input-group>.form-control,.input-group>.form-select{
    position:relative;
    flex:1 1 auto;
    width:1%;
    min-width:0
}
.input-group>.form-control:focus,.input-group>.form-select:focus{
    z-index:3
}
.input-group .btn{
    position:relative;
    z-index:2
}
.input-group .btn:focus{
    z-index:3
}
.input-group-text{
    display:flex;
    align-items:center;
    padding:.375rem .75rem;
    font-size:1rem;
    font-weight:400;
    line-height:1.5;
    color:#6C7293;
    text-align:center;
    white-space:nowrap;
    background-color:#e9ecef;
    border:1px solid #000;
    border-radius:5px
}
.input-group-lg>.form-control,.input-group-lg>.form-select,.input-group-lg>.input-group-text,.input-group-lg>.btn{
    padding:.5rem 1rem;
    font-size:1.25rem;
    border-radius:.3rem
}
.input-group-sm>.form-control,.input-group-sm>.form-select,.input-group-sm>.input-group-text,.input-group-sm>.btn{
    padding:.25rem .5rem;
    font-size:.875rem;
    border-radius:.2rem
}
.input-group-lg>.form-select,.input-group-sm>.form-select{
    padding-right:3rem
}
.input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu),.input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3){
    border-top-right-radius:0;
    border-bottom-right-radius:0
}
.input-group.has-validation>:nth-last-child(n+3):not(.dropdown-toggle):not(.dropdown-menu),.input-group.has-validation>.dropdown-toggle:nth-last-child(n+4){
    border-top-right-radius:0;
    border-bottom-right-radius:0
}
.input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback){
    margin-left:-1px;
    border-top-left-radius:0;
    border-bottom-left-radius:0
}
.valid-feedback{
    display:none;
    width:100%;
    margin-top:.25rem;
    font-size:.875em;
    color:#198754
}
.valid-tooltip{
    position:absolute;
    top:100%;
    z-index:5;
    display:none;
    max-width:100%;
    padding:.25rem .5rem;
    margin-top:.1rem;
    font-size:.875rem;
    color:#fff;
    background-color:rgba(25,135,84,0.9);
    border-radius:5px
}
.was-validated :valid ~ .valid-feedback,.was-validated :valid ~ .valid-tooltip,.is-valid ~ .valid-feedback,.is-valid ~ .valid-tooltip{
    display:block
}
.was-validated .form-control:valid,.form-control.is-valid{
    border-color:#198754;
    padding-right:calc(1.5em + .75rem);
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-repeat:no-repeat;
    background-position:right calc(.375em + .1875rem) center;
    background-size:calc(.75em + .375rem) calc(.75em + .375rem)
}
.was-validated .form-control:valid:focus,.form-control.is-valid:focus{
    border-color:#198754;
    box-shadow:0 0 0 .25rem rgba(25,135,84,0.25)
}
.was-validated textarea.form-control:valid,textarea.form-control.is-valid{
    padding-right:calc(1.5em + .75rem);
    background-position:top calc(.375em + .1875rem) right calc(.375em + .1875rem)
}
.was-validated .form-select:valid,.form-select.is-valid{
    border-color:#198754
}
.was-validated .form-select:valid:not([multiple]):not([size]),.was-validated .form-select:valid:not([multiple])[size="1"],.form-select.is-valid:not([multiple]):not([size]),.form-select.is-valid:not([multiple])[size="1"]{
    padding-right:4.125rem;
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"),url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-position:right .75rem center,center right 2.25rem;
    background-size:16px 12px,calc(.75em + .375rem) calc(.75em + .375rem)
}
.was-validated .form-select:valid:focus,.form-select.is-valid:focus{
    border-color:#198754;
    box-shadow:0 0 0 .25rem rgba(25,135,84,0.25)
}
.was-validated .form-check-input:valid,.form-check-input.is-valid{
    border-color:#198754
}
.was-validated .form-check-input:valid:checked,.form-check-input.is-valid:checked{
    background-color:#198754
}
.was-validated .form-check-input:valid:focus,.form-check-input.is-valid:focus{
    box-shadow:0 0 0 .25rem rgba(25,135,84,0.25)
}
.was-validated .form-check-input:valid ~ .form-check-label,.form-check-input.is-valid ~ .form-check-label{
    color:#198754
}
.form-check-inline .form-check-input ~ .valid-feedback{
    margin-left:.5em
}
.was-validated .input-group .form-control:valid,.input-group .form-control.is-valid,.was-validated .input-group .form-select:valid,.input-group .form-select.is-valid{
    z-index:3
}
.invalid-feedback{
    display:none;
    width:100%;
    margin-top:.25rem;
    font-size:.875em;
    color:#6af7e5
}
.invalid-tooltip{
    position:absolute;
    top:100%;
    z-index:5;
    display:none;
    max-width:100%;
    padding:.25rem .5rem;
    margin-top:.1rem;
    font-size:.875rem;
    color:#fff;
    background-color:rgba(220,53,69,0.9);
    border-radius:5px
}
.was-validated :invalid ~ .invalid-feedback,.was-validated :invalid ~ .invalid-tooltip,.is-invalid ~ .invalid-feedback,.is-invalid ~ .invalid-tooltip{
    display:block
}
.was-validated .form-control:invalid,.form-control.is-invalid{
    border-color:#6af7e5;
    padding-right:calc(1.5em + .75rem);
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat:no-repeat;
    background-position:right calc(.375em + .1875rem) center;
    background-size:calc(.75em + .375rem) calc(.75em + .375rem)
}
.was-validated .form-control:invalid:focus,.form-control.is-invalid:focus{
    border-color:#6af7e5;
    box-shadow:0 0 0 .25rem rgba(220,53,69,0.25)
}
.was-validated textarea.form-control:invalid,textarea.form-control.is-invalid{
    padding-right:calc(1.5em + .75rem);
    background-position:top calc(.375em + .1875rem) right calc(.375em + .1875rem)
}
.was-validated .form-select:invalid,.form-select.is-invalid{
    border-color:#6af7e5
}
.was-validated .form-select:invalid:not([multiple]):not([size]),.was-validated .form-select:invalid:not([multiple])[size="1"],.form-select.is-invalid:not([multiple]):not([size]),.form-select.is-invalid:not([multiple])[size="1"]{
    padding-right:4.125rem;
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"),url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-position:right .75rem center,center right 2.25rem;
    background-size:16px 12px,calc(.75em + .375rem) calc(.75em + .375rem)
}
.was-validated .form-select:invalid:focus,.form-select.is-invalid:focus{
    border-color:#6af7e5;
    box-shadow:0 0 0 .25rem rgba(220,53,69,0.25)
}
.was-validated .form-check-input:invalid,.form-check-input.is-invalid{
    border-color:#6af7e5
}
.was-validated .form-check-input:invalid:checked,.form-check-input.is-invalid:checked{
    background-color:#6af7e5
}
.was-validated .form-check-input:invalid:focus,.form-check-input.is-invalid:focus{
    box-shadow:0 0 0 .25rem rgba(220,53,69,0.25)
}
.was-validated .form-check-input:invalid ~ .form-check-label,.form-check-input.is-invalid ~ .form-check-label{
    color:#6af7e5
}
.form-check-inline .form-check-input ~ .invalid-feedback{
    margin-left:.5em
}
.was-validated .input-group .form-control:invalid,.input-group .form-control.is-invalid,.was-validated .input-group .form-select:invalid,.input-group .form-select.is-invalid{
    z-index:3
}
.btn{
    display:inline-block;
    font-weight:400;
    line-height:1.5;
    color:#6C7293;
    text-align:center;
    vertical-align:middle;
    cursor:pointer;
    user-select:none;
    background-color:transparent;
    border:1px solid transparent;
    padding:.375rem .75rem;
    font-size:1rem;
    border-radius:5px;
    transition:color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out
}
@media (prefers-reduced-motion: reduce){
    .btn{
        transition:none
    }
}
.btn:hover{
    color:#6C7293
}
.btn-check:focus+.btn,.btn:focus{
    outline:0;
    box-shadow:0 0 0 .25rem rgba(235,22,22,0.25)
}
.btn:disabled,.btn.disabled,fieldset:disabled .btn{
    pointer-events:none;
    opacity:.65
}
.btn-primary{
    color:#fff;
    background-color:#6af7e5;
    border-color:#6af7e5
}
.btn-primary:hover{
    color:#fff;
    background-color:#c81313;
    border-color:#6af7e5
}
.btn-check:focus+.btn-primary,.btn-primary:focus{
    color:#fff;
    background-color:#c81313;
    border-color:#6af7e5;
    box-shadow:0 0 0 .25rem rgba(238,57,57,0.5)
}
.btn-check:checked+.btn-primary,.btn-check:active+.btn-primary,.btn-primary:active,.btn-primary.active,.show>.btn-primary.dropdown-toggle{
    color:#fff;
    background-color:#6af7e5;
    border-color:#b01111
}
.btn-check:checked+.btn-primary:focus,.btn-check:active+.btn-primary:focus,.btn-primary:active:focus,.btn-primary.active:focus,.show>.btn-primary.dropdown-toggle:focus{
    box-shadow:0 0 0 .25rem rgba(238,57,57,0.5)
}
.btn-primary:disabled,.btn-primary.disabled{
    color:#fff;
    background-color:#6af7e5;
    border-color:#6af7e5
}
.btn-secondary{
    color:#fff;
    background-color:white;
    border-color:white;
}
.btn-secondary:hover{
    color:#fff;
    background-color:#15181f;
    border-color:#14161d
}
.btn-check:focus+.btn-secondary,.btn-secondary:focus{
    color:#fff;
    background-color:#15181f;
    border-color:#14161d;
    box-shadow:0 0 0 .25rem rgba(60,62,69,0.5)
}
.btn-check:checked+.btn-secondary,.btn-check:active+.btn-secondary,.btn-secondary:active,.btn-secondary.active,.show>.btn-secondary.dropdown-toggle{
    color:#fff;
    background-color:#14161d;
    border-color:#13151b
}
.btn-check:checked+.btn-secondary:focus,.btn-check:active+.btn-secondary:focus,.btn-secondary:active:focus,.btn-secondary.active:focus,.show>.btn-secondary.dropdown-toggle:focus{
    box-shadow:0 0 0 .25rem rgba(60,62,69,0.5)
}
.btn-secondary:disabled,.btn-secondary.disabled{
    color:#fff;
    background-color:#191C24;
    border-color:#191C24
}
.btn-success{
    color:#fff;
    background-color:#198754;
    border-color:#198754
}
.btn-success:hover{
    color:#fff;
    background-color:#157347;
    border-color:#146c43
}
.btn-check:focus+.btn-success,.btn-success:focus{
    color:#fff;
    background-color:#157347;
    border-color:#146c43;
    box-shadow:0 0 0 .25rem rgba(60,153,110,0.5)
}
.btn-check:checked+.btn-success,.btn-check:active+.btn-success,.btn-success:active,.btn-success.active,.show>.btn-success.dropdown-toggle{
    color:#fff;
    background-color:#146c43;
    border-color:#13653f
}
.btn-check:checked+.btn-success:focus,.btn-check:active+.btn-success:focus,.btn-success:active:focus,.btn-success.active:focus,.show>.btn-success.dropdown-toggle:focus{
    box-shadow:0 0 0 .25rem rgba(60,153,110,0.5)
}
.btn-success:disabled,.btn-success.disabled{
    color:#fff;
    background-color:#198754;
    border-color:#198754
}
.btn-info{
    color:#000;
    background-color:#0dcaf0;
    border-color:#0dcaf0
}
.btn-info:hover{
    color:#000;
    background-color:#31d2f2;
    border-color:#25cff2
}
.btn-check:focus+.btn-info,.btn-info:focus{
    color:#000;
    background-color:#31d2f2;
    border-color:#25cff2;
    box-shadow:0 0 0 .25rem rgba(11,172,204,0.5)
}
.btn-check:checked+.btn-info,.btn-check:active+.btn-info,.btn-info:active,.btn-info.active,.show>.btn-info.dropdown-toggle{
    color:#000;
    background-color:#3dd5f3;
    border-color:#25cff2
}
.btn-check:checked+.btn-info:focus,.btn-check:active+.btn-info:focus,.btn-info:active:focus,.btn-info.active:focus,.show>.btn-info.dropdown-toggle:focus{
    box-shadow:0 0 0 .25rem rgba(11,172,204,0.5)
}
.btn-info:disabled,.btn-info.disabled{
    color:#000;
    background-color:#0dcaf0;
    border-color:#0dcaf0
}
.btn-warning{
    color:#000;
    background-color:#ffc107;
    border-color:#ffc107
}
.btn-warning:hover{
    color:#000;
    background-color:#ffca2c;
    border-color:#ffc720
}
.btn-check:focus+.btn-warning,.btn-warning:focus{
    color:#000;
    background-color:#ffca2c;
    border-color:#ffc720;
    box-shadow:0 0 0 .25rem rgba(217,164,6,0.5)
}
.btn-check:checked+.btn-warning,.btn-check:active+.btn-warning,.btn-warning:active,.btn-warning.active,.show>.btn-warning.dropdown-toggle{
    color:#000;
    background-color:#ffcd39;
    border-color:#ffc720
}
.btn-check:checked+.btn-warning:focus,.btn-check:active+.btn-warning:focus,.btn-warning:active:focus,.btn-warning.active:focus,.show>.btn-warning.dropdown-toggle:focus{
    box-shadow:0 0 0 .25rem rgba(217,164,6,0.5)
}
.btn-warning:disabled,.btn-warning.disabled{
    color:#000;
    background-color:#ffc107;
    border-color:#ffc107
}
.btn-danger{
    color:#fff;
    background-color:#6af7e5;
    border-color:#6af7e5
}
.btn-danger:hover{
    color:#fff;
    background-color:#bb2d3b;
    border-color:#b02a37
}
.btn-check:focus+.btn-danger,.btn-danger:focus{
    color:#fff;
    background-color:#bb2d3b;
    border-color:#b02a37;
    box-shadow:0 0 0 .25rem rgba(225,83,97,0.5)
}
.btn-check:checked+.btn-danger,.btn-check:active+.btn-danger,.btn-danger:active,.btn-danger.active,.show>.btn-danger.dropdown-toggle{
    color:#fff;
    background-color:#b02a37;
    border-color:#a52834
}
.btn-check:checked+.btn-danger:focus,.btn-check:active+.btn-danger:focus,.btn-danger:active:focus,.btn-danger.active:focus,.show>.btn-danger.dropdown-toggle:focus{
    box-shadow:0 0 0 .25rem rgba(225,83,97,0.5)
}
.btn-danger:disabled,.btn-danger.disabled{
    color:#fff;
    background-color:#6af7e5;
    border-color:#6af7e5
}
.btn-light{
    color:#fff;
    background-color:#6C7293;
    border-color:#6C7293
}
.btn-light:hover{
    color:#fff;
    background-color:#5c617d;
    border-color:#565b76
}
.btn-check:focus+.btn-light,.btn-light:focus{
    color:#fff;
    background-color:#5c617d;
    border-color:#565b76;
    box-shadow:0 0 0 .25rem rgba(130,135,163,0.5)
}
.btn-check:checked+.btn-light,.btn-check:active+.btn-light,.btn-light:active,.btn-light.active,.show>.btn-light.dropdown-toggle{
    color:#fff;
    background-color:#565b76;
    border-color:#51566e
}
.btn-check:checked+.btn-light:focus,.btn-check:active+.btn-light:focus,.btn-light:active:focus,.btn-light.active:focus,.show>.btn-light.dropdown-toggle:focus{
    box-shadow:0 0 0 .25rem rgba(130,135,163,0.5)
}
.btn-light:disabled,.btn-light.disabled{
    color:#fff;
    background-color:#6C7293;
    border-color:#6C7293
}
.btn-dark{
    color:#fff;
    background-color:#000;
    border-color:#000
}
.btn-dark:hover{
    color:#fff;
    background-color:#000;
    border-color:#000
}
.btn-check:focus+.btn-dark,.btn-dark:focus{
    color:#fff;
    background-color:#000;
    border-color:#000;
    box-shadow:0 0 0 .25rem rgba(38,38,38,0.5)
}
.btn-check:checked+.btn-dark,.btn-check:active+.btn-dark,.btn-dark:active,.btn-dark.active,.show>.btn-dark.dropdown-toggle{
    color:#fff;
    background-color:#000;
    border-color:#000
}
.btn-check:checked+.btn-dark:focus,.btn-check:active+.btn-dark:focus,.btn-dark:active:focus,.btn-dark.active:focus,.show>.btn-dark.dropdown-toggle:focus{
    box-shadow:0 0 0 .25rem rgba(38,38,38,0.5)
}
.btn-dark:disabled,.btn-dark.disabled{
    color:#fff;
    background-color:#000;
    border-color:#000
}
.btn-outline-primary{
    color:#6af7e5;
    border-color:#6af7e5
}
.btn-outline-primary:hover{
    color:#fff;
    background-color:#6af7e5;
    border-color:#6af7e5
}
.btn-check:focus+.btn-outline-primary,.btn-outline-primary:focus{
    box-shadow:0 0 0 .25rem rgba(235,22,22,0.5)
}
.btn-check:checked+.btn-outline-primary,.btn-check:active+.btn-outline-primary,.btn-outline-primary:active,.btn-outline-primary.active,.btn-outline-primary.dropdown-toggle.show{
    color:#fff;
    background-color:#6af7e5;
    border-color:#6af7e5
}
.btn-check:checked+.btn-outline-primary:focus,.btn-check:active+.btn-outline-primary:focus,.btn-outline-primary:active:focus,.btn-outline-primary.active:focus,.btn-outline-primary.dropdown-toggle.show:focus{
    box-shadow:0 0 0 .25rem rgba(235,22,22,0.5)
}
.btn-outline-primary:disabled,.btn-outline-primary.disabled{
    color:#6af7e5;
    background-color:transparent
}
.btn-outline-secondary{
    color:#191C24;
    border-color:#191C24
}
.btn-outline-secondary:hover{
    color:#fff;
    background-color:#191C24;
    border-color:#191C24
}
.btn-check:focus+.btn-outline-secondary,.btn-outline-secondary:focus{
    box-shadow:0 0 0 .25rem rgba(25,28,36,0.5)
}
.btn-check:checked+.btn-outline-secondary,.btn-check:active+.btn-outline-secondary,.btn-outline-secondary:active,.btn-outline-secondary.active,.btn-outline-secondary.dropdown-toggle.show{
    color:#fff;
    background-color:#191C24;
    border-color:#191C24
}
.btn-check:checked+.btn-outline-secondary:focus,.btn-check:active+.btn-outline-secondary:focus,.btn-outline-secondary:active:focus,.btn-outline-secondary.active:focus,.btn-outline-secondary.dropdown-toggle.show:focus{
    box-shadow:0 0 0 .25rem rgba(25,28,36,0.5)
}
.btn-outline-secondary:disabled,.btn-outline-secondary.disabled{
    color:#191C24;
    background-color:transparent
}
.btn-outline-success{
    color:#198754;
    border-color:#198754
}
.btn-outline-success:hover{
    color:#fff;
    background-color:#198754;
    border-color:#198754
}
.btn-check:focus+.btn-outline-success,.btn-outline-success:focus{
    box-shadow:0 0 0 .25rem rgba(25,135,84,0.5)
}
.btn-check:checked+.btn-outline-success,.btn-check:active+.btn-outline-success,.btn-outline-success:active,.btn-outline-success.active,.btn-outline-success.dropdown-toggle.show{
    color:#fff;
    background-color:#198754;
    border-color:#198754
}
.btn-check:checked+.btn-outline-success:focus,.btn-check:active+.btn-outline-success:focus,.btn-outline-success:active:focus,.btn-outline-success.active:focus,.btn-outline-success.dropdown-toggle.show:focus{
    box-shadow:0 0 0 .25rem rgba(25,135,84,0.5)
}
.btn-outline-success:disabled,.btn-outline-success.disabled{
    color:#198754;
    background-color:transparent
}
.btn-outline-info{
    color:#0dcaf0;
    border-color:#0dcaf0
}
.btn-outline-info:hover{
    color:#000;
    background-color:#0dcaf0;
    border-color:#0dcaf0
}
.btn-check:focus+.btn-outline-info,.btn-outline-info:focus{
    box-shadow:0 0 0 .25rem rgba(13,202,240,0.5)
}
.btn-check:checked+.btn-outline-info,.btn-check:active+.btn-outline-info,.btn-outline-info:active,.btn-outline-info.active,.btn-outline-info.dropdown-toggle.show{
    color:#000;
    background-color:#0dcaf0;
    border-color:#0dcaf0
}
.btn-check:checked+.btn-outline-info:focus,.btn-check:active+.btn-outline-info:focus,.btn-outline-info:active:focus,.btn-outline-info.active:focus,.btn-outline-info.dropdown-toggle.show:focus{
    box-shadow:0 0 0 .25rem rgba(13,202,240,0.5)
}
.btn-outline-info:disabled,.btn-outline-info.disabled{
    color:#0dcaf0;
    background-color:transparent
}
.btn-outline-warning{
    color:#ffc107;
    border-color:#ffc107
}
.btn-outline-warning:hover{
    color:#000;
    background-color:#ffc107;
    border-color:#ffc107
}
.btn-check:focus+.btn-outline-warning,.btn-outline-warning:focus{
    box-shadow:0 0 0 .25rem rgba(255,193,7,0.5)
}
.btn-check:checked+.btn-outline-warning,.btn-check:active+.btn-outline-warning,.btn-outline-warning:active,.btn-outline-warning.active,.btn-outline-warning.dropdown-toggle.show{
    color:#000;
    background-color:#ffc107;
    border-color:#ffc107
}
.btn-check:checked+.btn-outline-warning:focus,.btn-check:active+.btn-outline-warning:focus,.btn-outline-warning:active:focus,.btn-outline-warning.active:focus,.btn-outline-warning.dropdown-toggle.show:focus{
    box-shadow:0 0 0 .25rem rgba(255,193,7,0.5)
}
.btn-outline-warning:disabled,.btn-outline-warning.disabled{
    color:#ffc107;
    background-color:transparent
}
.btn-outline-danger{
    color:#6af7e5;
    border-color:#6af7e5
}
.btn-outline-danger:hover{
    color:#fff;
    background-color:#6af7e5;
    border-color:#6af7e5
}
.btn-check:focus+.btn-outline-danger,.btn-outline-danger:focus{
    box-shadow:0 0 0 .25rem rgba(220,53,69,0.5)
}
.btn-check:checked+.btn-outline-danger,.btn-check:active+.btn-outline-danger,.btn-outline-danger:active,.btn-outline-danger.active,.btn-outline-danger.dropdown-toggle.show{
    color:#fff;
    background-color:#6af7e5;
    border-color:#6af7e5
}
.btn-check:checked+.btn-outline-danger:focus,.btn-check:active+.btn-outline-danger:focus,.btn-outline-danger:active:focus,.btn-outline-danger.active:focus,.btn-outline-danger.dropdown-toggle.show:focus{
    box-shadow:0 0 0 .25rem rgba(220,53,69,0.5)
}
.btn-outline-danger:disabled,.btn-outline-danger.disabled{
    color:#6af7e5;
    background-color:transparent
}
.btn-outline-light{
    color:#6C7293;
    border-color:#6C7293
}
.btn-outline-light:hover{
    color:#fff;
    background-color:#6C7293;
    border-color:#6C7293
}
.btn-check:focus+.btn-outline-light,.btn-outline-light:focus{
    box-shadow:0 0 0 .25rem rgba(108,114,147,0.5)
}
.btn-check:checked+.btn-outline-light,.btn-check:active+.btn-outline-light,.btn-outline-light:active,.btn-outline-light.active,.btn-outline-light.dropdown-toggle.show{
    color:#fff;
    background-color:#6C7293;
    border-color:#6C7293
}
.btn-check:checked+.btn-outline-light:focus,.btn-check:active+.btn-outline-light:focus,.btn-outline-light:active:focus,.btn-outline-light.active:focus,.btn-outline-light.dropdown-toggle.show:focus{
    box-shadow:0 0 0 .25rem rgba(108,114,147,0.5)
}
.btn-outline-light:disabled,.btn-outline-light.disabled{
    color:#6C7293;
    background-color:transparent
}
.btn-outline-dark{
    color:#000;
    border-color:#000
}
.btn-outline-dark:hover{
    color:#fff;
    background-color:#000;
    border-color:#000
}
.btn-check:focus+.btn-outline-dark,.btn-outline-dark:focus{
    box-shadow:0 0 0 .25rem rgba(0,0,0,0.5)
}
.btn-check:checked+.btn-outline-dark,.btn-check:active+.btn-outline-dark,.btn-outline-dark:active,.btn-outline-dark.active,.btn-outline-dark.dropdown-toggle.show{
    color:#fff;
    background-color:#000;
    border-color:#000
}
.btn-check:checked+.btn-outline-dark:focus,.btn-check:active+.btn-outline-dark:focus,.btn-outline-dark:active:focus,.btn-outline-dark.active:focus,.btn-outline-dark.dropdown-toggle.show:focus{
    box-shadow:0 0 0 .25rem rgba(0,0,0,0.5)
}
.btn-outline-dark:disabled,.btn-outline-dark.disabled{
    color:#000;
    background-color:transparent
}
.btn-link{
    font-weight:400;
    color:#6af7e5;
    text-decoration:none
}
.btn-link:hover{
    color:#6af7e5
}
.btn-link:disabled,.btn-link.disabled{
    color:#6c757d
}
.btn-lg,.btn-group-lg>.btn{
    padding:.5rem 1rem;
    font-size:1.25rem;
    border-radius:.3rem
}
.btn-sm,.btn-group-sm>.btn{
    padding:.25rem .5rem;
    font-size:.875rem;
    border-radius:.2rem
}
.fade{
    transition:opacity 0.15s linear
}
@media (prefers-reduced-motion: reduce){
    .fade{
        transition:none
    }
}
.fade:not(.show){
    opacity:0
}
.collapse:not(.show){
    display:none
}
.collapsing{
    height:0;
    overflow:hidden;
    transition:height 0.35s ease
}
@media (prefers-reduced-motion: reduce){
    .collapsing{
        transition:none
    }
}
.dropup,.dropend,.dropdown,.dropstart{
    position:relative
}
.dropdown-toggle{
    white-space:nowrap
}
.dropdown-toggle::after{
    display:inline-block;
    margin-left:.255em;
    vertical-align:.255em;
    content:"";
    border-top:.3em solid;
    border-right:.3em solid transparent;
    border-bottom:0;
    border-left:.3em solid transparent
}
.dropdown-toggle:empty::after{
    margin-left:0
}
.dropdown-menu{
    position:absolute;
    z-index:1000;
    display:none;
    min-width:10rem;
    padding:.5rem 0;
    margin:0;
    font-size:1rem;
    color:#6C7293;
    text-align:left;
    list-style:none;
    background-color:#fff;
    background-clip:padding-box;
    border:1px solid rgba(0,0,0,0.15);
    border-radius:5px
}
.dropdown-menu[data-bs-popper]{
    top:100%;
    left:0;
    margin-top:.125rem
}
.dropdown-menu-start{
    --bs-position: start
}
.dropdown-menu-start[data-bs-popper]{
    right:auto 
    /* rtl:ignore */
    ;
    left:0 
    /* rtl:ignore */
}
.dropdown-menu-end{
    --bs-position: end
}
.dropdown-menu-end[data-bs-popper]{
    right:0 
    /* rtl:ignore */
    ;
    left:auto 
    /* rtl:ignore */
}
@media (min-width: 576px){
    .dropdown-menu-sm-start{
        --bs-position: start
    }
    .dropdown-menu-sm-start[data-bs-popper]{
        right:auto 
        /* rtl:ignore */
        ;
        left:0 
        /* rtl:ignore */
    }
    .dropdown-menu-sm-end{
        --bs-position: end
    }
    .dropdown-menu-sm-end[data-bs-popper]{
        right:0 
        /* rtl:ignore */
        ;
        left:auto 
        /* rtl:ignore */
    }
}
@media (min-width: 768px){
    .dropdown-menu-md-start{
        --bs-position: start
    }
    .dropdown-menu-md-start[data-bs-popper]{
        right:auto 
        /* rtl:ignore */
        ;
        left:0 
        /* rtl:ignore */
    }
    .dropdown-menu-md-end{
        --bs-position: end
    }
    .dropdown-menu-md-end[data-bs-popper]{
        right:0 
        /* rtl:ignore */
        ;
        left:auto 
        /* rtl:ignore */
    }
}
@media (min-width: 992px){
    .dropdown-menu-lg-start{
        --bs-position: start
    }
    .dropdown-menu-lg-start[data-bs-popper]{
        right:auto 
        /* rtl:ignore */
        ;
        left:0 
        /* rtl:ignore */
    }
    .dropdown-menu-lg-end{
        --bs-position: end
    }
    .dropdown-menu-lg-end[data-bs-popper]{
        right:0 
        /* rtl:ignore */
        ;
        left:auto 
        /* rtl:ignore */
    }
}
@media (min-width: 1200px){
    .dropdown-menu-xl-start{
        --bs-position: start
    }
    .dropdown-menu-xl-start[data-bs-popper]{
        right:auto 
        /* rtl:ignore */
        ;
        left:0 
        /* rtl:ignore */
    }
    .dropdown-menu-xl-end{
        --bs-position: end
    }
    .dropdown-menu-xl-end[data-bs-popper]{
        right:0 
        /* rtl:ignore */
        ;
        left:auto 
        /* rtl:ignore */
    }
}
@media (min-width: 1400px){
    .dropdown-menu-xxl-start{
        --bs-position: start
    }
    .dropdown-menu-xxl-start[data-bs-popper]{
        right:auto 
        /* rtl:ignore */
        ;
        left:0 
        /* rtl:ignore */
    }
    .dropdown-menu-xxl-end{
        --bs-position: end
    }
    .dropdown-menu-xxl-end[data-bs-popper]{
        right:0 
        /* rtl:ignore */
        ;
        left:auto 
        /* rtl:ignore */
    }
}
.dropup .dropdown-menu[data-bs-popper]{
    top:auto;
    bottom:100%;
    margin-top:0;
    margin-bottom:.125rem
}
.dropup .dropdown-toggle::after{
    display:inline-block;
    margin-left:.255em;
    vertical-align:.255em;
    content:"";
    border-top:0;
    border-right:.3em solid transparent;
    border-bottom:.3em solid;
    border-left:.3em solid transparent
}
.dropup .dropdown-toggle:empty::after{
    margin-left:0
}
.dropend .dropdown-menu[data-bs-popper]{
    top:0;
    right:auto;
    left:100%;
    margin-top:0;
    margin-left:.125rem
}
.dropend .dropdown-toggle::after{
    display:inline-block;
    margin-left:.255em;
    vertical-align:.255em;
    content:"";
    border-top:.3em solid transparent;
    border-right:0;
    border-bottom:.3em solid transparent;
    border-left:.3em solid
}
.dropend .dropdown-toggle:empty::after{
    margin-left:0
}
.dropend .dropdown-toggle::after{
    vertical-align:0
}
.dropstart .dropdown-menu[data-bs-popper]{
    top:0;
    right:100%;
    left:auto;
    margin-top:0;
    margin-right:.125rem
}
.dropstart .dropdown-toggle::after{
    display:inline-block;
    margin-left:.255em;
    vertical-align:.255em;
    content:""
}
.dropstart .dropdown-toggle::after{
    display:none
}
.dropstart .dropdown-toggle::before{
    display:inline-block;
    margin-right:.255em;
    vertical-align:.255em;
    content:"";
    border-top:.3em solid transparent;
    border-right:.3em solid;
    border-bottom:.3em solid transparent
}
.dropstart .dropdown-toggle:empty::after{
    margin-left:0
}
.dropstart .dropdown-toggle::before{
    vertical-align:0
}
.dropdown-divider{
    height:0;
    margin:.5rem 0;
    overflow:hidden;
    border-top:1px solid rgba(0,0,0,0.15)
}
.dropdown-item{
    display:block;
    width:100%;
    padding:.25rem 1rem;
    clear:both;
    font-weight:400;
    color:#212529;
    text-align:inherit;
    white-space:nowrap;
    background-color:transparent;
    border:0
}
.dropdown-item:hover,.dropdown-item:focus{
    color:#1e2125;
    background-color:#e9ecef
}
.dropdown-item.active,.dropdown-item:active{
    color:#fff;
    text-decoration:none;
    background-color:#6af7e5
}
.dropdown-item.disabled,.dropdown-item:disabled{
    color:#adb5bd;
    pointer-events:none;
    background-color:transparent
}
.dropdown-menu.show{
    display:block
}
.dropdown-header{
    display:block;
    padding:.5rem 1rem;
    margin-bottom:0;
    font-size:.875rem;
    color:#6c757d;
    white-space:nowrap
}
.dropdown-item-text{
    display:block;
    padding:.25rem 1rem;
    color:#212529
}
.dropdown-menu-dark{
    color:#dee2e6;
    background-color:#343a40;
    border-color:rgba(0,0,0,0.15)
}
.dropdown-menu-dark .dropdown-item{
    color:#dee2e6
}
.dropdown-menu-dark .dropdown-item:hover,.dropdown-menu-dark .dropdown-item:focus{
    color:#fff;
    background-color:rgba(255,255,255,0.15)
}
.dropdown-menu-dark .dropdown-item.active,.dropdown-menu-dark .dropdown-item:active{
    color:#fff;
    background-color:#6af7e5
}
.dropdown-menu-dark .dropdown-item.disabled,.dropdown-menu-dark .dropdown-item:disabled{
    color:#adb5bd
}
.dropdown-menu-dark .dropdown-divider{
    border-color:rgba(0,0,0,0.15)
}
.dropdown-menu-dark .dropdown-item-text{
    color:#dee2e6
}
.dropdown-menu-dark .dropdown-header{
    color:#adb5bd
}
.btn-group,.btn-group-vertical{
    position:relative;
    display:inline-flex;
    vertical-align:middle
}
.btn-group>.btn,.btn-group-vertical>.btn{
    position:relative;
    flex:1 1 auto
}
.btn-group>.btn-check:checked+.btn,.btn-group>.btn-check:focus+.btn,.btn-group>.btn:hover,.btn-group>.btn:focus,.btn-group>.btn:active,.btn-group>.btn.active,.btn-group-vertical>.btn-check:checked+.btn,.btn-group-vertical>.btn-check:focus+.btn,.btn-group-vertical>.btn:hover,.btn-group-vertical>.btn:focus,.btn-group-vertical>.btn:active,.btn-group-vertical>.btn.active{
    z-index:1
}
.btn-toolbar{
    display:flex;
    flex-wrap:wrap;
    justify-content:flex-start
}
.btn-toolbar .input-group{
    width:auto
}
.btn-group>.btn:not(:first-child),.btn-group>.btn-group:not(:first-child){
    margin-left:-1px
}
.btn-group>.btn:not(:last-child):not(.dropdown-toggle),.btn-group>.btn-group:not(:last-child)>.btn{
    border-top-right-radius:0;
    border-bottom-right-radius:0
}
.btn-group>.btn:nth-child(n+3),.btn-group>:not(.btn-check)+.btn,.btn-group>.btn-group:not(:first-child)>.btn{
    border-top-left-radius:0;
    border-bottom-left-radius:0
}
.dropdown-toggle-split{
    padding-right:.5625rem;
    padding-left:.5625rem
}
.dropdown-toggle-split::after,.dropup .dropdown-toggle-split::after,.dropend .dropdown-toggle-split::after{
    margin-left:0
}
.dropstart .dropdown-toggle-split::before{
    margin-right:0
}
.btn-sm+.dropdown-toggle-split,.btn-group-sm>.btn+.dropdown-toggle-split{
    padding-right:.375rem;
    padding-left:.375rem
}
.btn-lg+.dropdown-toggle-split,.btn-group-lg>.btn+.dropdown-toggle-split{
    padding-right:.75rem;
    padding-left:.75rem
}
.btn-group-vertical{
    flex-direction:column;
    align-items:flex-start;
    justify-content:center
}
.btn-group-vertical>.btn,.btn-group-vertical>.btn-group{
    width:100%
}
.btn-group-vertical>.btn:not(:first-child),.btn-group-vertical>.btn-group:not(:first-child){
    margin-top:-1px
}
.btn-group-vertical>.btn:not(:last-child):not(.dropdown-toggle),.btn-group-vertical>.btn-group:not(:last-child)>.btn{
    border-bottom-right-radius:0;
    border-bottom-left-radius:0
}
.btn-group-vertical>.btn ~ .btn,.btn-group-vertical>.btn-group:not(:first-child)>.btn{
    border-top-left-radius:0;
    border-top-right-radius:0
}
.nav{
    display:flex;
    flex-wrap:wrap;
    padding-left:0;
    margin-bottom:0;
    list-style:none
}
.nav-link{
    display:block;
    padding:.5rem 1rem;
    color:#6af7e5;
    transition:color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out
}
@media (prefers-reduced-motion: reduce){
    .nav-link{
        transition:none
    }
}
.nav-link:hover,.nav-link:focus{
    color:#6af7e5
}
.nav-link.disabled{
    color:#6c757d;
    pointer-events:none;
    cursor:default
}
.nav-tabs{
    border-bottom:1px solid #000
}
.nav-tabs .nav-link{
    margin-bottom:-1px;
    background:none;
    border:1px solid transparent;
    border-top-left-radius:5px;
    border-top-right-radius:5px
}
.nav-tabs .nav-link:hover,.nav-tabs .nav-link:focus{
    border-color:#000;
    isolation:isolate
}
.nav-tabs .nav-link.disabled{
    color:#6c757d;
    background-color:transparent;
    border-color:transparent
}
.nav-tabs .nav-link.active,.nav-tabs .nav-item.show .nav-link{
    color:#495057;
    background-color:#000;
    border-color:black;
}
.nav-tabs .dropdown-menu{
    margin-top:-1px;
    border-top-left-radius:0;
    border-top-right-radius:0
}
.nav-pills .nav-link{
    background:none;
    border:0;
    border-radius:5px
}
.nav-pills .nav-link.active,.nav-pills .show>.nav-link{
    color:#fff;
    background-color:#6af7e5
}
.nav-fill>.nav-link,.nav-fill .nav-item{
    flex:1 1 auto;
    text-align:center
}
.nav-justified>.nav-link,.nav-justified .nav-item{
    flex-basis:0;
    flex-grow:1;
    text-align:center
}
.nav-fill .nav-item .nav-link,.nav-justified .nav-item .nav-link{
    width:100%
}
.tab-content>.tab-pane{
    display:none
}
.tab-content>.active{
    display:block
}
.navbar{
    position:relative;
    display:flex;
    flex-wrap:wrap;
    align-items:center;
    justify-content:space-between;
    padding-top:.5rem;
    padding-bottom:.5rem
}
.navbar>.container,.navbar>.container-fluid,.navbar>.container-sm,.navbar>.container-md,.navbar>.container-lg,.navbar>.container-xl,.navbar>.container-xxl{
    display:flex;
    flex-wrap:inherit;
    align-items:center;
    justify-content:space-between
}
.navbar-brand{
    padding-top:.3125rem;
    padding-bottom:.3125rem;
    margin-right:1rem;
    font-size:1.25rem;
    white-space:nowrap
}
.navbar-nav{
    display:flex;
    flex-direction:column;
    padding-left:0;
    margin-bottom:0;
    list-style:none
}
.navbar-nav .nav-link{
    padding-right:0;
    padding-left:0
}
.navbar-nav .dropdown-menu{
    position:static
}
.navbar-text{
    padding-top:.5rem;
    padding-bottom:.5rem
}
.navbar-collapse{
    flex-basis:100%;
    flex-grow:1;
    align-items:center
}
.navbar-toggler{
    padding:.25rem .75rem;
    font-size:1.25rem;
    line-height:1;
    background-color:transparent;
    border:1px solid transparent;
    border-radius:5px;
    transition:box-shadow 0.15s ease-in-out
}
@media (prefers-reduced-motion: reduce){
    .navbar-toggler{
        transition:none
    }
}
.navbar-toggler:hover{
    text-decoration:none
}
.navbar-toggler:focus{
    text-decoration:none;
    outline:0;
    box-shadow:0 0 0 .25rem
}
.navbar-toggler-icon{
    display:inline-block;
    width:1.5em;
    height:1.5em;
    vertical-align:middle;
    background-repeat:no-repeat;
    background-position:center;
    background-size:100%
}
.navbar-nav-scroll{
    max-height:var(--bs-scroll-height, 75vh);
    overflow-y:auto
}
@media (min-width: 576px){
    .navbar-expand-sm{
        flex-wrap:nowrap;
        justify-content:flex-start
    }
    .navbar-expand-sm .navbar-nav{
        flex-direction:row
    }
    .navbar-expand-sm .navbar-nav .dropdown-menu{
        position:absolute
    }
    .navbar-expand-sm .navbar-nav .nav-link{
        padding-right:.5rem;
        padding-left:.5rem
    }
    .navbar-expand-sm .navbar-nav-scroll{
        overflow:visible
    }
    .navbar-expand-sm .navbar-collapse{
        display:flex !important;
        flex-basis:auto
    }
    .navbar-expand-sm .navbar-toggler{
        display:none
    }
}
@media (min-width: 768px){
    .navbar-expand-md{
        flex-wrap:nowrap;
        justify-content:flex-start
    }
    .navbar-expand-md .navbar-nav{
        flex-direction:row
    }
    .navbar-expand-md .navbar-nav .dropdown-menu{
        position:absolute
    }
    .navbar-expand-md .navbar-nav .nav-link{
        padding-right:.5rem;
        padding-left:.5rem
    }
    .navbar-expand-md .navbar-nav-scroll{
        overflow:visible
    }
    .navbar-expand-md .navbar-collapse{
        display:flex !important;
        flex-basis:auto
    }
    .navbar-expand-md .navbar-toggler{
        display:none
    }
}
@media (min-width: 992px){
    .navbar-expand-lg{
        flex-wrap:nowrap;
        justify-content:flex-start
    }
    .navbar-expand-lg .navbar-nav{
        flex-direction:row
    }
    .navbar-expand-lg .navbar-nav .dropdown-menu{
        position:absolute
    }
    .navbar-expand-lg .navbar-nav .nav-link{
        padding-right:.5rem;
        padding-left:.5rem
    }
    .navbar-expand-lg .navbar-nav-scroll{
        overflow:visible
    }
    .navbar-expand-lg .navbar-collapse{
        display:flex !important;
        flex-basis:auto
    }
    .navbar-expand-lg .navbar-toggler{
        display:none
    }
}
@media (min-width: 1200px){
    .navbar-expand-xl{
        flex-wrap:nowrap;
        justify-content:flex-start
    }
    .navbar-expand-xl .navbar-nav{
        flex-direction:row
    }
    .navbar-expand-xl .navbar-nav .dropdown-menu{
        position:absolute
    }
    .navbar-expand-xl .navbar-nav .nav-link{
        padding-right:.5rem;
        padding-left:.5rem
    }
    .navbar-expand-xl .navbar-nav-scroll{
        overflow:visible
    }
    .navbar-expand-xl .navbar-collapse{
        display:flex !important;
        flex-basis:auto
    }
    .navbar-expand-xl .navbar-toggler{
        display:none
    }
}
@media (min-width: 1400px){
    .navbar-expand-xxl{
        flex-wrap:nowrap;
        justify-content:flex-start
    }
    .navbar-expand-xxl .navbar-nav{
        flex-direction:row
    }
    .navbar-expand-xxl .navbar-nav .dropdown-menu{
        position:absolute
    }
    .navbar-expand-xxl .navbar-nav .nav-link{
        padding-right:.5rem;
        padding-left:.5rem
    }
    .navbar-expand-xxl .navbar-nav-scroll{
        overflow:visible
    }
    .navbar-expand-xxl .navbar-collapse{
        display:flex !important;
        flex-basis:auto
    }
    .navbar-expand-xxl .navbar-toggler{
        display:none
    }
}
.navbar-expand{
    flex-wrap:nowrap;
    justify-content:flex-start
}
.navbar-expand .navbar-nav{
    flex-direction:row
}
.navbar-expand .navbar-nav .dropdown-menu{
    position:absolute
}
.navbar-expand .navbar-nav .nav-link{
    padding-right:.5rem;
    padding-left:.5rem
}
.navbar-expand .navbar-nav-scroll{
    overflow:visible
}
.navbar-expand .navbar-collapse{
    display:flex !important;
    flex-basis:auto
}
.navbar-expand .navbar-toggler{
    display:none
}
.navbar-light .navbar-brand{
    color:rgba(0,0,0,0.9)
}
.navbar-light .navbar-brand:hover,.navbar-light .navbar-brand:focus{
    color:rgba(0,0,0,0.9)
}
.navbar-light .navbar-nav .nav-link{
    color:rgba(0,0,0,0.55)
}
.navbar-light .navbar-nav .nav-link:hover,.navbar-light .navbar-nav .nav-link:focus{
    color:rgba(0,0,0,0.7)
}
.navbar-light .navbar-nav .nav-link.disabled{
    color:rgba(0,0,0,0.3)
}
.navbar-light .navbar-nav .show>.nav-link,.navbar-light .navbar-nav .nav-link.active{
    color:rgba(0,0,0,0.9)
}
.navbar-light .navbar-toggler{
    color:rgba(0,0,0,0.55);
    border-color:rgba(0,0,0,0.1)
}
.navbar-light .navbar-toggler-icon{
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280,0,0,0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e")
}
.navbar-light .navbar-text{
    color:rgba(0,0,0,0.55)
}
.navbar-light .navbar-text a,.navbar-light .navbar-text a:hover,.navbar-light .navbar-text a:focus{
    color:rgba(0,0,0,0.9)
}
.navbar-dark .navbar-brand{
    color:#fff
}
.navbar-dark .navbar-brand:hover,.navbar-dark .navbar-brand:focus{
    color:#fff
}
.navbar-dark .navbar-nav .nav-link{
    color:rgba(255,255,255,0.55)
}
.navbar-dark .navbar-nav .nav-link:hover,.navbar-dark .navbar-nav .nav-link:focus{
    color:rgba(255,255,255,0.75)
}
.navbar-dark .navbar-nav .nav-link.disabled{
    color:rgba(255,255,255,0.25)
}
.navbar-dark .navbar-nav .show>.nav-link,.navbar-dark .navbar-nav .nav-link.active{
    color:#fff
}
.navbar-dark .navbar-toggler{
    color:rgba(255,255,255,0.55);
    border-color:rgba(255,255,255,0.1)
}
.navbar-dark .navbar-toggler-icon{
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255,255,255,0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e")
}
.navbar-dark .navbar-text{
    color:rgba(255,255,255,0.55)
}
.navbar-dark .navbar-text a,.navbar-dark .navbar-text a:hover,.navbar-dark .navbar-text a:focus{
    color:#fff
}
.card{
    position:relative;
    display:flex;
    flex-direction:column;
    min-width:0;
    word-wrap:break-word;
    background-color:#fff;
    background-clip:border-box;
    border:1px solid rgba(0,0,0,0.125);
    border-radius:5px
}
.card>hr{
    margin-right:0;
    margin-left:0
}
.card>.list-group{
    border-top:inherit;
    border-bottom:inherit
}
.card>.list-group:first-child{
    border-top-width:0;
    border-top-left-radius:4px;
    border-top-right-radius:4px
}
.card>.list-group:last-child{
    border-bottom-width:0;
    border-bottom-right-radius:4px;
    border-bottom-left-radius:4px
}
.card>.card-header+.list-group,.card>.list-group+.card-footer{
    border-top:0
}
.card-body{
    flex:1 1 auto;
    padding:1rem 1rem
}
.card-title{
    margin-bottom:.5rem
}
.card-subtitle{
    margin-top:-.25rem;
    margin-bottom:0
}
.card-text:last-child{
    margin-bottom:0
}
.card-link:hover{
    text-decoration:none
}
.card-link+.card-link{
    margin-left:1rem
}
.card-header{
    padding:.5rem 1rem;
    margin-bottom:0;
    background-color:rgba(0,0,0,0.03);
    border-bottom:1px solid rgba(0,0,0,0.125)
}
.card-header:first-child{
    border-radius:4px 4px 0 0
}
.card-footer{
    padding:.5rem 1rem;
    background-color:rgba(0,0,0,0.03);
    border-top:1px solid rgba(0,0,0,0.125)
}
.card-footer:last-child{
    border-radius:0 0 4px 4px
}
.card-header-tabs{
    margin-right:-.5rem;
    margin-bottom:-.5rem;
    margin-left:-.5rem;
    border-bottom:0
}
.card-header-tabs .nav-link.active{
    background-color:#fff;
    border-bottom-color:#fff
}
.card-header-pills{
    margin-right:-.5rem;
    margin-left:-.5rem
}
.card-img-overlay{
    position:absolute;
    top:0;
    right:0;
    bottom:0;
    left:0;
    padding:1rem;
    border-radius:4px
}
.card-img,.card-img-top,.card-img-bottom{
    width:100%
}
.card-img,.card-img-top{
    border-top-left-radius:4px;
    border-top-right-radius:4px
}
.card-img,.card-img-bottom{
    border-bottom-right-radius:4px;
    border-bottom-left-radius:4px
}
.card-group>.card{
    margin-bottom:.75rem
}
@media (min-width: 576px){
    .card-group{
        display:flex;
        flex-flow:row wrap
    }
    .card-group>.card{
        flex:1 0 0%;
        margin-bottom:0
    }
    .card-group>.card+.card{
        margin-left:0;
        border-left:0
    }
    .card-group>.card:not(:last-child){
        border-top-right-radius:0;
        border-bottom-right-radius:0
    }
    .card-group>.card:not(:last-child) .card-img-top,.card-group>.card:not(:last-child) .card-header{
        border-top-right-radius:0
    }
    .card-group>.card:not(:last-child) .card-img-bottom,.card-group>.card:not(:last-child) .card-footer{
        border-bottom-right-radius:0
    }
    .card-group>.card:not(:first-child){
        border-top-left-radius:0;
        border-bottom-left-radius:0
    }
    .card-group>.card:not(:first-child) .card-img-top,.card-group>.card:not(:first-child) .card-header{
        border-top-left-radius:0
    }
    .card-group>.card:not(:first-child) .card-img-bottom,.card-group>.card:not(:first-child) .card-footer{
        border-bottom-left-radius:0
    }
}
.accordion-button{
    position:relative;
    display:flex;
    align-items:center;
    width:100%;
    padding:1rem 1.25rem;
    font-size:1rem;
    color:#6C7293;
    text-align:left;
    background-color:#000;
    border:0;
    border-radius:0;
    overflow-anchor:none;
    transition:color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out,border-radius 0.15s ease
}
@media (prefers-reduced-motion: reduce){
    .accordion-button{
        transition:none
    }
}
.accordion-button:not(.collapsed){
    color:#d41414;
    background-color:#fde8e8;
    box-shadow:inset 0 -1px 0 rgba(0,0,0,0.125)
}
.accordion-button:not(.collapsed)::after{
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23d41414'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    transform:rotate(-180deg)
}
.accordion-button::after{
    flex-shrink:0;
    width:1.25rem;
    height:1.25rem;
    margin-left:auto;
    content:"";
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%236C7293'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    background-repeat:no-repeat;
    background-size:1.25rem;
    transition:transform 0.2s ease-in-out
}
@media (prefers-reduced-motion: reduce){
    .accordion-button::after{
        transition:none
    }
}
.accordion-button:hover{
    z-index:2
}
.accordion-button:focus{
    z-index:3;
    border-color:#f58b8b;
    outline:0;
    box-shadow:0 0 0 .25rem rgba(235,22,22,0.25)
}
.accordion-header{
    margin-bottom:0
}
.accordion-item{
    background-color:#000;
    border:1px solid rgba(0,0,0,0.125)
}
.accordion-item:first-of-type{
    border-top-left-radius:5px;
    border-top-right-radius:5px
}
.accordion-item:first-of-type .accordion-button{
    border-top-left-radius:4px;
    border-top-right-radius:4px
}
.accordion-item:not(:first-of-type){
    border-top:0
}
.accordion-item:last-of-type{
    border-bottom-right-radius:5px;
    border-bottom-left-radius:5px
}
.accordion-item:last-of-type .accordion-button.collapsed{
    border-bottom-right-radius:4px;
    border-bottom-left-radius:4px
}
.accordion-item:last-of-type .accordion-collapse{
    border-bottom-right-radius:5px;
    border-bottom-left-radius:5px
}
.accordion-body{
    padding:1rem 1.25rem
}
.accordion-flush .accordion-collapse{
    border-width:0
}
.accordion-flush .accordion-item{
    border-right:0;
    border-left:0;
    border-radius:0
}
.accordion-flush .accordion-item:first-child{
    border-top:0
}
.accordion-flush .accordion-item:last-child{
    border-bottom:0
}
.accordion-flush .accordion-item .accordion-button{
    border-radius:0
}
.breadcrumb{
    display:flex;
    flex-wrap:wrap;
    padding:0 0;
    margin-bottom:1rem;
    list-style:none
}
.breadcrumb-item+.breadcrumb-item{
    padding-left:.5rem
}
.breadcrumb-item+.breadcrumb-item::before{
    float:left;
    padding-right:.5rem;
    color:#6c757d;
    content:var(--bs-breadcrumb-divider, "/") 
    /* rtl: var(--bs-breadcrumb-divider, "/") */
}
.breadcrumb-item.active{
    color:#6c757d
}
.pagination{
    display:flex;
    padding-left:0;
    list-style:none
}
.page-link{
    position:relative;
    display:block;
    color:#6af7e5;
    background-color:#fff;
    border:1px solid #dee2e6;
    transition:color 0.15s ease-in-out,background-color 0.15s ease-in-out,border-color 0.15s ease-in-out,box-shadow 0.15s ease-in-out
}
@media (prefers-reduced-motion: reduce){
    .page-link{
        transition:none
    }
}
.page-link:hover{
    z-index:2;
    color:#6af7e5;
    background-color:#e9ecef;
    border-color:#dee2e6
}
.page-link:focus{
    z-index:3;
    color:#6af7e5;
    background-color:#e9ecef;
    outline:0;
    box-shadow:0 0 0 .25rem rgba(235,22,22,0.25)
}
.page-item:not(:first-child) .page-link{
    margin-left:-1px
}
.page-item.active .page-link{
    z-index:3;
    color:#fff;
    background-color:#6af7e5;
    border-color:#6af7e5
}
.page-item.disabled .page-link{
    color:#6c757d;
    pointer-events:none;
    background-color:#fff;
    border-color:#dee2e6
}
.page-link{
    padding:.375rem .75rem
}
.page-item:first-child .page-link{
    border-top-left-radius:5px;
    border-bottom-left-radius:5px
}
.page-item:last-child .page-link{
    border-top-right-radius:5px;
    border-bottom-right-radius:5px
}
.pagination-lg .page-link{
    padding:.75rem 1.5rem;
    font-size:1.25rem
}
.pagination-lg .page-item:first-child .page-link{
    border-top-left-radius:.3rem;
    border-bottom-left-radius:.3rem
}
.pagination-lg .page-item:last-child .page-link{
    border-top-right-radius:.3rem;
    border-bottom-right-radius:.3rem
}
.pagination-sm .page-link{
    padding:.25rem .5rem;
    font-size:.875rem
}
.pagination-sm .page-item:first-child .page-link{
    border-top-left-radius:.2rem;
    border-bottom-left-radius:.2rem
}
.pagination-sm .page-item:last-child .page-link{
    border-top-right-radius:.2rem;
    border-bottom-right-radius:.2rem
}
.badge{
    display:inline-block;
    padding:.35em .65em;
    font-size:.75em;
    font-weight:700;
    line-height:1;
    color:#fff;
    text-align:center;
    white-space:nowrap;
    vertical-align:baseline;
    border-radius:5px
}
.badge:empty{
    display:none
}
.btn .badge{
    position:relative;
    top:-1px
}
.alert{
    position:relative;
    padding:1rem 1rem;
    margin-bottom:1rem;
    border:1px solid transparent;
    border-radius:5px
}
.alert-heading{
    color:inherit
}
.alert-link{
    font-weight:700
}
.alert-dismissible{
    padding-right:3rem
}
.alert-dismissible .btn-close{
    position:absolute;
    top:0;
    right:0;
    z-index:2;
    padding:1.25rem 1rem
}
.alert-primary{
    color:#8d0d0d;
    background-color:#fbd0d0;
    border-color:#f9b9b9
}
.alert-primary .alert-link{
    color:#710a0a
}
.alert-secondary{
    color:#0f1116;
    background-color:#d1d2d3;
    border-color:#babbbd
}
.alert-secondary .alert-link{
    color:#0c0e12
}
.alert-success{
    color:#0f5132;
    background-color:#d1e7dd;
    border-color:#badbcc
}
.alert-success .alert-link{
    color:#0c4128
}
.alert-info{
    color:#055160;
    background-color:#cff4fc;
    border-color:#b6effb
}
.alert-info .alert-link{
    color:#04414d
}
.alert-warning{
    color:#664d03;
    background-color:#fff3cd;
    border-color:#ffecb5
}
.alert-warning .alert-link{
    color:#523e02
}
.alert-danger{
    color:#842029;
    background-color:#f8d7da;
    border-color:#f5c2c7
}
.alert-danger .alert-link{
    color:#6a1a21
}
.alert-light{
    color:#414458;
    background-color:#e2e3e9;
    border-color:#d3d5df
}
.alert-light .alert-link{
    color:#343646
}
.alert-dark{
    color:#000;
    background-color:#ccc;
    border-color:#b3b3b3
}
.alert-dark .alert-link{
    color:#000
}
@keyframes progress-bar-stripes{
    0%{
        background-position-x:1rem
    }
}
.progress{
    display:flex;
    height:1rem;
    overflow:hidden;
    font-size:.75rem;
    background-color:#e9ecef;
    border-radius:5px
}
.progress-bar{
    display:flex;
    flex-direction:column;
    justify-content:center;
    overflow:hidden;
    color:#fff;
    text-align:center;
    white-space:nowrap;
    background-color:#6af7e5;
    transition:width 0.6s ease
}
@media (prefers-reduced-motion: reduce){
    .progress-bar{
        transition:none
    }
}
.progress-bar-striped{
    background-image:linear-gradient(45deg, rgba(255,255,255,0.15) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.15) 50%, rgba(255,255,255,0.15) 75%, transparent 75%, transparent);
    background-size:1rem 1rem
}
.progress-bar-animated{
    animation:1s linear infinite progress-bar-stripes
}
@media (prefers-reduced-motion: reduce){
    .progress-bar-animated{
        animation:none
    }
}
.list-group{
    display:flex;
    flex-direction:column;
    padding-left:0;
    margin-bottom:0;
    border-radius:5px
}
.list-group-numbered{
    list-style-type:none;
    counter-reset:section
}
.list-group-numbered>li::before{
    content:counters(section, ".") ". ";
    counter-increment:section
}
.list-group-item-action{
    width:100%;
    color:#495057;
    text-align:inherit
}
.list-group-item-action:hover,.list-group-item-action:focus{
    z-index:1;
    color:#495057;
    text-decoration:none;
    background-color:#f8f9fa
}
.list-group-item-action:active{
    color:#6C7293;
    background-color:#e9ecef
}
.list-group-item{
    position:relative;
    display:block;
    padding:.5rem 1rem;
    color:#6C7293;
    background-color:#fff;
    border:1px solid #000
}
.list-group-item:first-child{
    border-top-left-radius:inherit;
    border-top-right-radius:inherit
}
.list-group-item:last-child{
    border-bottom-right-radius:inherit;
    border-bottom-left-radius:inherit
}
.list-group-item.disabled,.list-group-item:disabled{
    color:#6c757d;
    pointer-events:none;
    background-color:#fff
}
.list-group-item.active{
    z-index:2;
    color:#fff;
    background-color:#6af7e5;
    border-color:#6af7e5
}
.list-group-item+.list-group-item{
    border-top-width:0
}
.list-group-item+.list-group-item.active{
    margin-top:-1px;
    border-top-width:1px
}
.list-group-horizontal{
    flex-direction:row
}
.list-group-horizontal>.list-group-item:first-child{
    border-bottom-left-radius:5px;
    border-top-right-radius:0
}
.list-group-horizontal>.list-group-item:last-child{
    border-top-right-radius:5px;
    border-bottom-left-radius:0
}
.list-group-horizontal>.list-group-item.active{
    margin-top:0
}
.list-group-horizontal>.list-group-item+.list-group-item{
    border-top-width:1px;
    border-left-width:0
}
.list-group-horizontal>.list-group-item+.list-group-item.active{
    margin-left:-1px;
    border-left-width:1px
}
@media (min-width: 576px){
    .list-group-horizontal-sm{
        flex-direction:row
    }
    .list-group-horizontal-sm>.list-group-item:first-child{
        border-bottom-left-radius:5px;
        border-top-right-radius:0
    }
    .list-group-horizontal-sm>.list-group-item:last-child{
        border-top-right-radius:5px;
        border-bottom-left-radius:0
    }
    .list-group-horizontal-sm>.list-group-item.active{
        margin-top:0
    }
    .list-group-horizontal-sm>.list-group-item+.list-group-item{
        border-top-width:1px;
        border-left-width:0
    }
    .list-group-horizontal-sm>.list-group-item+.list-group-item.active{
        margin-left:-1px;
        border-left-width:1px
    }
}
@media (min-width: 768px){
    .list-group-horizontal-md{
        flex-direction:row
    }
    .list-group-horizontal-md>.list-group-item:first-child{
        border-bottom-left-radius:5px;
        border-top-right-radius:0
    }
    .list-group-horizontal-md>.list-group-item:last-child{
        border-top-right-radius:5px;
        border-bottom-left-radius:0
    }
    .list-group-horizontal-md>.list-group-item.active{
        margin-top:0
    }
    .list-group-horizontal-md>.list-group-item+.list-group-item{
        border-top-width:1px;
        border-left-width:0
    }
    .list-group-horizontal-md>.list-group-item+.list-group-item.active{
        margin-left:-1px;
        border-left-width:1px
    }
}
@media (min-width: 992px){
    .list-group-horizontal-lg{
        flex-direction:row
    }
    .list-group-horizontal-lg>.list-group-item:first-child{
        border-bottom-left-radius:5px;
        border-top-right-radius:0
    }
    .list-group-horizontal-lg>.list-group-item:last-child{
        border-top-right-radius:5px;
        border-bottom-left-radius:0
    }
    .list-group-horizontal-lg>.list-group-item.active{
        margin-top:0
    }
    .list-group-horizontal-lg>.list-group-item+.list-group-item{
        border-top-width:1px;
        border-left-width:0
    }
    .list-group-horizontal-lg>.list-group-item+.list-group-item.active{
        margin-left:-1px;
        border-left-width:1px
    }
}
@media (min-width: 1200px){
    .list-group-horizontal-xl{
        flex-direction:row
    }
    .list-group-horizontal-xl>.list-group-item:first-child{
        border-bottom-left-radius:5px;
        border-top-right-radius:0
    }
    .list-group-horizontal-xl>.list-group-item:last-child{
        border-top-right-radius:5px;
        border-bottom-left-radius:0
    }
    .list-group-horizontal-xl>.list-group-item.active{
        margin-top:0
    }
    .list-group-horizontal-xl>.list-group-item+.list-group-item{
        border-top-width:1px;
        border-left-width:0
    }
    .list-group-horizontal-xl>.list-group-item+.list-group-item.active{
        margin-left:-1px;
        border-left-width:1px
    }
}
@media (min-width: 1400px){
    .list-group-horizontal-xxl{
        flex-direction:row
    }
    .list-group-horizontal-xxl>.list-group-item:first-child{
        border-bottom-left-radius:5px;
        border-top-right-radius:0
    }
    .list-group-horizontal-xxl>.list-group-item:last-child{
        border-top-right-radius:5px;
        border-bottom-left-radius:0
    }
    .list-group-horizontal-xxl>.list-group-item.active{
        margin-top:0
    }
    .list-group-horizontal-xxl>.list-group-item+.list-group-item{
        border-top-width:1px;
        border-left-width:0
    }
    .list-group-horizontal-xxl>.list-group-item+.list-group-item.active{
        margin-left:-1px;
        border-left-width:1px
    }
}
.list-group-flush{
    border-radius:0
}
.list-group-flush>.list-group-item{
    border-width:0 0 1px
}
.list-group-flush>.list-group-item:last-child{
    border-bottom-width:0
}
.list-group-item-primary{
    color:#8d0d0d;
    background-color:#fbd0d0
}
.list-group-item-primary.list-group-item-action:hover,.list-group-item-primary.list-group-item-action:focus{
    color:#8d0d0d;
    background-color:#e2bbbb
}
.list-group-item-primary.list-group-item-action.active{
    color:#fff;
    background-color:#8d0d0d;
    border-color:#8d0d0d
}
.list-group-item-secondary{
    color:#0f1116;
    background-color:#d1d2d3
}
.list-group-item-secondary.list-group-item-action:hover,.list-group-item-secondary.list-group-item-action:focus{
    color:#0f1116;
    background-color:#bcbdbe
}
.list-group-item-secondary.list-group-item-action.active{
    color:#fff;
    background-color:#0f1116;
    border-color:#0f1116
}
.list-group-item-success{
    color:#0f5132;
    background-color:#d1e7dd
}
.list-group-item-success.list-group-item-action:hover,.list-group-item-success.list-group-item-action:focus{
    color:#0f5132;
    background-color:#bcd0c7
}
.list-group-item-success.list-group-item-action.active{
    color:#fff;
    background-color:#0f5132;
    border-color:#0f5132
}
.list-group-item-info{
    color:#055160;
    background-color:#cff4fc
}
.list-group-item-info.list-group-item-action:hover,.list-group-item-info.list-group-item-action:focus{
    color:#055160;
    background-color:#badce3
}
.list-group-item-info.list-group-item-action.active{
    color:#fff;
    background-color:#055160;
    border-color:#055160
}
.list-group-item-warning{
    color:#664d03;
    background-color:#fff3cd
}
.list-group-item-warning.list-group-item-action:hover,.list-group-item-warning.list-group-item-action:focus{
    color:#664d03;
    background-color:#e6dbb9
}
.list-group-item-warning.list-group-item-action.active{
    color:#fff;
    background-color:#664d03;
    border-color:#664d03
}
.list-group-item-danger{
    color:#842029;
    background-color:#f8d7da
}
.list-group-item-danger.list-group-item-action:hover,.list-group-item-danger.list-group-item-action:focus{
    color:#842029;
    background-color:#dfc2c4
}
.list-group-item-danger.list-group-item-action.active{
    color:#fff;
    background-color:#842029;
    border-color:#842029
}
.list-group-item-light{
    color:#414458;
    background-color:#e2e3e9
}
.list-group-item-light.list-group-item-action:hover,.list-group-item-light.list-group-item-action:focus{
    color:#414458;
    background-color:#cbccd2
}
.list-group-item-light.list-group-item-action.active{
    color:#fff;
    background-color:#414458;
    border-color:#414458
}
.list-group-item-dark{
    color:#000;
    background-color:#ccc
}
.list-group-item-dark.list-group-item-action:hover,.list-group-item-dark.list-group-item-action:focus{
    color:#000;
    background-color:#b8b8b8
}
.list-group-item-dark.list-group-item-action.active{
    color:#fff;
    background-color:#000;
    border-color:#000
}
.btn-close{
    box-sizing:content-box;
    width:1em;
    height:1em;
    padding:.25em .25em;
    color:#000;
    background:transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
    border:0;
    border-radius:5px;
    opacity:.5
}
.btn-close:hover{
    color:#000;
    text-decoration:none;
    opacity:.75
}
.btn-close:focus{
    outline:0;
    box-shadow:0 0 0 .25rem rgba(235,22,22,0.25);
    opacity:1
}
.btn-close:disabled,.btn-close.disabled{
    pointer-events:none;
    user-select:none;
    opacity:.25
}
.btn-close-white{
    filter:invert(1) grayscale(100%) brightness(200%)
}
.toast{
    width:350px;
    max-width:100%;
    font-size:.875rem;
    pointer-events:auto;
    background-color:rgba(255,255,255,0.85);
    background-clip:padding-box;
    border:1px solid rgba(0,0,0,0.1);
    box-shadow:0 0.5rem 1rem rgba(0,0,0,0.15);
    border-radius:5px
}
.toast:not(.showing):not(.show){
    opacity:0
}
.toast.hide{
    display:none
}
.toast-container{
    width:max-content;
    max-width:100%;
    pointer-events:none
}
.toast-container>:not(:last-child){
    margin-bottom:.75rem
}
.toast-header{
    display:flex;
    align-items:center;
    padding:.5rem .75rem;
    color:#6c757d;
    background-color:rgba(255,255,255,0.85);
    background-clip:padding-box;
    border-bottom:1px solid rgba(0,0,0,0.05);
    border-top-left-radius:4px;
    border-top-right-radius:4px
}
.toast-header .btn-close{
    margin-right:-.375rem;
    margin-left:.75rem
}
.toast-body{
    padding:.75rem;
    word-wrap:break-word
}
.modal-open{
    overflow:hidden
}
.modal-open .modal{
    overflow-x:hidden;
    overflow-y:auto
}
.modal{
    position:fixed;
    top:0;
    left:0;
    z-index:1060;
    display:none;
    width:100%;
    height:100%;
    overflow:hidden;
    outline:0
}
.modal-dialog{
    position:relative;
    width:auto;
    margin:.5rem;
    pointer-events:none
}
.modal.fade .modal-dialog{
    transition:transform 0.3s ease-out;
    transform:translate(0, -50px)
}
@media (prefers-reduced-motion: reduce){
    .modal.fade .modal-dialog{
        transition:none
    }
}
.modal.show .modal-dialog{
    transform:none
}
.modal.modal-static .modal-dialog{
    transform:scale(1.02)
}
.modal-dialog-scrollable{
    height:calc(100% - 1rem)
}
.modal-dialog-scrollable .modal-content{
    max-height:100%;
    overflow:hidden
}
.modal-dialog-scrollable .modal-body{
    overflow-y:auto
}
.modal-dialog-centered{
    display:flex;
    align-items:center;
    min-height:calc(100% - 1rem)
}
.modal-content{
    position:relative;
    display:flex;
    flex-direction:column;
    width:100%;
    pointer-events:auto;
    background-color:#fff;
    background-clip:padding-box;
    border:1px solid rgba(0,0,0,0.2);
    border-radius:.3rem;
    outline:0
}
.modal-backdrop{
    position:fixed;
    top:0;
    left:0;
    z-index:1040;
    width:100vw;
    height:100vh;
    background-color:#000
}
.modal-backdrop.fade{
    opacity:0
}
.modal-backdrop.show{
    opacity:.5
}
.modal-header{
    display:flex;
    flex-shrink:0;
    align-items:center;
    justify-content:space-between;
    padding:1rem 1rem;
    border-bottom:1px solid #000;
    border-top-left-radius:calc(.3rem - 1px);
    border-top-right-radius:calc(.3rem - 1px)
}
.modal-header .btn-close{
    padding:.5rem .5rem;
    margin:-.5rem -.5rem -.5rem auto
}
.modal-title{
    margin-bottom:0;
    line-height:1.5
}
.modal-body{
    position:relative;
    flex:1 1 auto;
    padding:1rem
}
.modal-footer{
    display:flex;
    flex-wrap:wrap;
    flex-shrink:0;
    align-items:center;
    justify-content:flex-end;
    padding:.75rem;
    border-top:1px solid #000;
    border-bottom-right-radius:calc(.3rem - 1px);
    border-bottom-left-radius:calc(.3rem - 1px)
}
.modal-footer>*{
    margin:.25rem
}
@media (min-width: 576px){
    .modal-dialog{
        max-width:500px;
        margin:1.75rem auto
    }
    .modal-dialog-scrollable{
        height:calc(100% - 3.5rem)
    }
    .modal-dialog-centered{
        min-height:calc(100% - 3.5rem)
    }
    .modal-sm{
        max-width:300px
    }
}
@media (min-width: 992px){
    .modal-lg,.modal-xl{
        max-width:800px
    }
}
@media (min-width: 1200px){
    .modal-xl{
        max-width:1140px
    }
}
.modal-fullscreen{
    width:100vw;
    max-width:none;
    height:100%;
    margin:0
}
.modal-fullscreen .modal-content{
    height:100%;
    border:0;
    border-radius:0
}
.modal-fullscreen .modal-header{
    border-radius:0
}
.modal-fullscreen .modal-body{
    overflow-y:auto
}
.modal-fullscreen .modal-footer{
    border-radius:0
}
@media (max-width: 575.98px){
    .modal-fullscreen-sm-down{
        width:100vw;
        max-width:none;
        height:100%;
        margin:0
    }
    .modal-fullscreen-sm-down .modal-content{
        height:100%;
        border:0;
        border-radius:0
    }
    .modal-fullscreen-sm-down .modal-header{
        border-radius:0
    }
    .modal-fullscreen-sm-down .modal-body{
        overflow-y:auto
    }
    .modal-fullscreen-sm-down .modal-footer{
        border-radius:0
    }
}
@media (max-width: 767.98px){
    .modal-fullscreen-md-down{
        width:100vw;
        max-width:none;
        height:100%;
        margin:0
    }
    .modal-fullscreen-md-down .modal-content{
        height:100%;
        border:0;
        border-radius:0
    }
    .modal-fullscreen-md-down .modal-header{
        border-radius:0
    }
    .modal-fullscreen-md-down .modal-body{
        overflow-y:auto
    }
    .modal-fullscreen-md-down .modal-footer{
        border-radius:0
    }
}
@media (max-width: 991.98px){
    .modal-fullscreen-lg-down{
        width:100vw;
        max-width:none;
        height:100%;
        margin:0
    }
    .modal-fullscreen-lg-down .modal-content{
        height:100%;
        border:0;
        border-radius:0
    }
    .modal-fullscreen-lg-down .modal-header{
        border-radius:0
    }
    .modal-fullscreen-lg-down .modal-body{
        overflow-y:auto
    }
    .modal-fullscreen-lg-down .modal-footer{
        border-radius:0
    }
}
@media (max-width: 1199.98px){
    .modal-fullscreen-xl-down{
        width:100vw;
        max-width:none;
        height:100%;
        margin:0
    }
    .modal-fullscreen-xl-down .modal-content{
        height:100%;
        border:0;
        border-radius:0
    }
    .modal-fullscreen-xl-down .modal-header{
        border-radius:0
    }
    .modal-fullscreen-xl-down .modal-body{
        overflow-y:auto
    }
    .modal-fullscreen-xl-down .modal-footer{
        border-radius:0
    }
}
@media (max-width: 1399.98px){
    .modal-fullscreen-xxl-down{
        width:100vw;
        max-width:none;
        height:100%;
        margin:0
    }
    .modal-fullscreen-xxl-down .modal-content{
        height:100%;
        border:0;
        border-radius:0
    }
    .modal-fullscreen-xxl-down .modal-header{
        border-radius:0
    }
    .modal-fullscreen-xxl-down .modal-body{
        overflow-y:auto
    }
    .modal-fullscreen-xxl-down .modal-footer{
        border-radius:0
    }
}
.tooltip{
    position:absolute;
    z-index:1080;
    display:block;
    margin:0;
    font-family:"Open Sans",sans-serif;
    font-style:normal;
    font-weight:400;
    line-height:1.5;
    text-align:left;
    text-align:start;
    text-decoration:none;
    text-shadow:none;
    text-transform:none;
    letter-spacing:normal;
    word-break:normal;
    word-spacing:normal;
    white-space:normal;
    line-break:auto;
    font-size:.875rem;
    word-wrap:break-word;
    opacity:0
}
.tooltip.show{
    opacity:.9
}
.tooltip .tooltip-arrow{
    position:absolute;
    display:block;
    width:.8rem;
    height:.4rem
}
.tooltip .tooltip-arrow::before{
    position:absolute;
    content:"";
    border-color:transparent;
    border-style:solid
}
.bs-tooltip-top,.bs-tooltip-auto[data-popper-placement^="top"]{
    padding:.4rem 0
}
.bs-tooltip-top .tooltip-arrow,.bs-tooltip-auto[data-popper-placement^="top"] .tooltip-arrow{
    bottom:0
}
.bs-tooltip-top .tooltip-arrow::before,.bs-tooltip-auto[data-popper-placement^="top"] .tooltip-arrow::before{
    top:-1px;
    border-width:.4rem .4rem 0;
    border-top-color:#000
}
.bs-tooltip-end,.bs-tooltip-auto[data-popper-placement^="right"]{
    padding:0 .4rem
}
.bs-tooltip-end .tooltip-arrow,.bs-tooltip-auto[data-popper-placement^="right"] .tooltip-arrow{
    left:0;
    width:.4rem;
    height:.8rem
}
.bs-tooltip-end .tooltip-arrow::before,.bs-tooltip-auto[data-popper-placement^="right"] .tooltip-arrow::before{
    right:-1px;
    border-width:.4rem .4rem .4rem 0;
    border-right-color:#000
}
.bs-tooltip-bottom,.bs-tooltip-auto[data-popper-placement^="bottom"]{
    padding:.4rem 0
}
.bs-tooltip-bottom .tooltip-arrow,.bs-tooltip-auto[data-popper-placement^="bottom"] .tooltip-arrow{
    top:0
}
.bs-tooltip-bottom .tooltip-arrow::before,.bs-tooltip-auto[data-popper-placement^="bottom"] .tooltip-arrow::before{
    bottom:-1px;
    border-width:0 .4rem .4rem;
    border-bottom-color:#000
}
.bs-tooltip-start,.bs-tooltip-auto[data-popper-placement^="left"]{
    padding:0 .4rem
}
.bs-tooltip-start .tooltip-arrow,.bs-tooltip-auto[data-popper-placement^="left"] .tooltip-arrow{
    right:0;
    width:.4rem;
    height:.8rem
}
.bs-tooltip-start .tooltip-arrow::before,.bs-tooltip-auto[data-popper-placement^="left"] .tooltip-arrow::before{
    left:-1px;
    border-width:.4rem 0 .4rem .4rem;
    border-left-color:#000
}
.tooltip-inner{
    max-width:200px;
    padding:.25rem .5rem;
    color:#fff;
    text-align:center;
    background-color:#000;
    border-radius:5px
}
.popover{
    position:absolute;
    top:0;
    left:0 
    /* rtl:ignore */
    ;
    z-index:1070;
    display:block;
    max-width:276px;
    font-family:"Open Sans",sans-serif;
    font-style:normal;
    font-weight:400;
    line-height:1.5;
    text-align:left;
    text-align:start;
    text-decoration:none;
    text-shadow:none;
    text-transform:none;
    letter-spacing:normal;
    word-break:normal;
    word-spacing:normal;
    white-space:normal;
    line-break:auto;
    font-size:.875rem;
    word-wrap:break-word;
    background-color:#fff;
    background-clip:padding-box;
    border:1px solid rgba(0,0,0,0.2);
    border-radius:.3rem
}
.popover .popover-arrow{
    position:absolute;
    display:block;
    width:1rem;
    height:.5rem
}
.popover .popover-arrow::before,.popover .popover-arrow::after{
    position:absolute;
    display:block;
    content:"";
    border-color:transparent;
    border-style:solid
}
.bs-popover-top>.popover-arrow,.bs-popover-auto[data-popper-placement^="top"]>.popover-arrow{
    bottom:calc(-.5rem - 1px)
}
.bs-popover-top>.popover-arrow::before,.bs-popover-auto[data-popper-placement^="top"]>.popover-arrow::before{
    bottom:0;
    border-width:.5rem .5rem 0;
    border-top-color:rgba(0,0,0,0.25)
}
.bs-popover-top>.popover-arrow::after,.bs-popover-auto[data-popper-placement^="top"]>.popover-arrow::after{
    bottom:1px;
    border-width:.5rem .5rem 0;
    border-top-color:#fff
}
.bs-popover-end>.popover-arrow,.bs-popover-auto[data-popper-placement^="right"]>.popover-arrow{
    left:calc(-.5rem - 1px);
    width:.5rem;
    height:1rem
}
.bs-popover-end>.popover-arrow::before,.bs-popover-auto[data-popper-placement^="right"]>.popover-arrow::before{
    left:0;
    border-width:.5rem .5rem .5rem 0;
    border-right-color:rgba(0,0,0,0.25)
}
.bs-popover-end>.popover-arrow::after,.bs-popover-auto[data-popper-placement^="right"]>.popover-arrow::after{
    left:1px;
    border-width:.5rem .5rem .5rem 0;
    border-right-color:#fff
}
.bs-popover-bottom>.popover-arrow,.bs-popover-auto[data-popper-placement^="bottom"]>.popover-arrow{
    top:calc(-.5rem - 1px)
}
.bs-popover-bottom>.popover-arrow::before,.bs-popover-auto[data-popper-placement^="bottom"]>.popover-arrow::before{
    top:0;
    border-width:0 .5rem .5rem .5rem;
    border-bottom-color:rgba(0,0,0,0.25)
}
.bs-popover-bottom>.popover-arrow::after,.bs-popover-auto[data-popper-placement^="bottom"]>.popover-arrow::after{
    top:1px;
    border-width:0 .5rem .5rem .5rem;
    border-bottom-color:#fff
}
.bs-popover-bottom .popover-header::before,.bs-popover-auto[data-popper-placement^="bottom"] .popover-header::before{
    position:absolute;
    top:0;
    left:50%;
    display:block;
    width:1rem;
    margin-left:-.5rem;
    content:"";
    border-bottom:1px solid #f0f0f0
}
.bs-popover-start>.popover-arrow,.bs-popover-auto[data-popper-placement^="left"]>.popover-arrow{
    right:calc(-.5rem - 1px);
    width:.5rem;
    height:1rem
}
.bs-popover-start>.popover-arrow::before,.bs-popover-auto[data-popper-placement^="left"]>.popover-arrow::before{
    right:0;
    border-width:.5rem 0 .5rem .5rem;
    border-left-color:rgba(0,0,0,0.25)
}
.bs-popover-start>.popover-arrow::after,.bs-popover-auto[data-popper-placement^="left"]>.popover-arrow::after{
    right:1px;
    border-width:.5rem 0 .5rem .5rem;
    border-left-color:#fff
}
.popover-header{
    padding:.5rem 1rem;
    margin-bottom:0;
    font-size:1rem;
    color:#fff;
    background-color:#f0f0f0;
    border-bottom:1px solid #d8d8d8;
    border-top-left-radius:calc(.3rem - 1px);
    border-top-right-radius:calc(.3rem - 1px)
}
.popover-header:empty{
    display:none
}
.popover-body{
    padding:1rem 1rem;
    color:#6C7293
}
.carousel{
    position:relative
}
.carousel.pointer-event{
    touch-action:pan-y
}
.carousel-inner{
    position:relative;
    width:100%;
    overflow:hidden
}
.carousel-inner::after{
    display:block;
    clear:both;
    content:""
}
.carousel-item{
    position:relative;
    display:none;
    float:left;
    width:100%;
    margin-right:-100%;
    backface-visibility:hidden;
    transition:transform .6s ease-in-out
}
@media (prefers-reduced-motion: reduce){
    .carousel-item{
        transition:none
    }
}
.carousel-item.active,.carousel-item-next,.carousel-item-prev{
    display:block
}
.carousel-item-next:not(.carousel-item-start),.active.carousel-item-end{
    transform:translateX(100%)
}
.carousel-item-prev:not(.carousel-item-end),.active.carousel-item-start{
    transform:translateX(-100%)
}
.carousel-fade .carousel-item{
    opacity:0;
    transition-property:opacity;
    transform:none
}
.carousel-fade .carousel-item.active,.carousel-fade .carousel-item-next.carousel-item-start,.carousel-fade .carousel-item-prev.carousel-item-end{
    z-index:1;
    opacity:1
}
.carousel-fade .active.carousel-item-start,.carousel-fade .active.carousel-item-end{
    z-index:0;
    opacity:0;
    transition:opacity 0s .6s
}
@media (prefers-reduced-motion: reduce){
    .carousel-fade .active.carousel-item-start,.carousel-fade .active.carousel-item-end{
        transition:none
    }
}
.carousel-control-prev,.carousel-control-next{
    position:absolute;
    top:0;
    bottom:0;
    z-index:1;
    display:flex;
    align-items:center;
    justify-content:center;
    width:15%;
    padding:0;
    color:#fff;
    text-align:center;
    background:none;
    border:0;
    opacity:.5;
    transition:opacity 0.15s ease
}
@media (prefers-reduced-motion: reduce){
    .carousel-control-prev,.carousel-control-next{
        transition:none
    }
}
.carousel-control-prev:hover,.carousel-control-prev:focus,.carousel-control-next:hover,.carousel-control-next:focus{
    color:#fff;
    text-decoration:none;
    outline:0;
    opacity:.9
}
.carousel-control-prev{
    left:0
}
.carousel-control-next{
    right:0
}
.carousel-control-prev-icon,.carousel-control-next-icon{
    display:inline-block;
    width:2rem;
    height:2rem;
    background-repeat:no-repeat;
    background-position:50%;
    background-size:100% 100%
}
.carousel-control-prev-icon{
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e")
}
.carousel-control-next-icon{
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e")
}
.carousel-indicators{
    position:absolute;
    right:0;
    bottom:0;
    left:0;
    z-index:2;
    display:flex;
    justify-content:center;
    padding:0;
    margin-right:15%;
    margin-bottom:1rem;
    margin-left:15%;
    list-style:none
}
.carousel-indicators [data-bs-target]{
    box-sizing:content-box;
    flex:0 1 auto;
    width:30px;
    height:3px;
    padding:0;
    margin-right:3px;
    margin-left:3px;
    text-indent:-999px;
    cursor:pointer;
    background-color:#fff;
    background-clip:padding-box;
    border:0;
    border-top:10px solid transparent;
    border-bottom:10px solid transparent;
    opacity:.5;
    transition:opacity 0.6s ease
}
@media (prefers-reduced-motion: reduce){
    .carousel-indicators [data-bs-target]{
        transition:none
    }
}
.carousel-indicators .active{
    opacity:1
}
.carousel-caption{
    position:absolute;
    right:15%;
    bottom:1.25rem;
    left:15%;
    padding-top:1.25rem;
    padding-bottom:1.25rem;
    color:#fff;
    text-align:center
}
.carousel-dark .carousel-control-prev-icon,.carousel-dark .carousel-control-next-icon{
    filter:invert(1) grayscale(100)
}
.carousel-dark .carousel-indicators [data-bs-target]{
    background-color:#000
}
.carousel-dark .carousel-caption{
    color:#000
}
@keyframes spinner-border{
    to{
        transform:rotate(360deg) 
        /* rtl:ignore */
    }
}
.spinner-border{
    display:inline-block;
    width:2rem;
    height:2rem;
    vertical-align:-.125em;
    border:.25em solid currentColor;
    border-right-color:transparent;
    border-radius:50%;
    animation:.75s linear infinite spinner-border
}
.spinner-border-sm{
    width:1rem;
    height:1rem;
    border-width:.2em
}
@keyframes spinner-grow{
    0%{
        transform:scale(0)
    }
    50%{
        opacity:1;
        transform:none
    }
}
.spinner-grow{
    display:inline-block;
    width:2rem;
    height:2rem;
    vertical-align:-.125em;
    background-color:currentColor;
    border-radius:50%;
    opacity:0;
    animation:.75s linear infinite spinner-grow
}
.spinner-grow-sm{
    width:1rem;
    height:1rem
}
@media (prefers-reduced-motion: reduce){
    .spinner-border,.spinner-grow{
        animation-duration:1.5s
    }
}
.offcanvas{
    position:fixed;
    bottom:0;
    z-index:1050;
    display:flex;
    flex-direction:column;
    max-width:100%;
    visibility:hidden;
    background-color:#fff;
    background-clip:padding-box;
    outline:0;
    transition:transform .3s ease-in-out
}
@media (prefers-reduced-motion: reduce){
    .offcanvas{
        transition:none
    }
}
.offcanvas-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:1rem 1rem
}
.offcanvas-header .btn-close{
    padding:.5rem .5rem;
    margin:-.5rem -.5rem -.5rem auto
}
.offcanvas-title{
    margin-bottom:0;
    line-height:1.5
}
.offcanvas-body{
    flex-grow:1;
    padding:1rem 1rem;
    overflow-y:auto
}
.offcanvas-start{
    top:0;
    left:0;
    width:400px;
    border-right:1px solid rgba(0,0,0,0.2);
    transform:translateX(-100%)
}
.offcanvas-end{
    top:0;
    right:0;
    width:400px;
    border-left:1px solid rgba(0,0,0,0.2);
    transform:translateX(100%)
}
.offcanvas-top{
    top:0;
    right:0;
    left:0;
    height:30vh;
    max-height:100%;
    border-bottom:1px solid rgba(0,0,0,0.2);
    transform:translateY(-100%)
}
.offcanvas-bottom{
    right:0;
    left:0;
    height:30vh;
    max-height:100%;
    border-top:1px solid rgba(0,0,0,0.2);
    transform:translateY(100%)
}
.offcanvas.show{
    transform:none
}
.clearfix::after{
    display:block;
    clear:both;
    content:""
}
.link-primary{
    color:#6af7e5
}
.link-primary:hover,.link-primary:focus{
    color:#6af7e5
}
.link-secondary{
    color:#191C24
}
.link-secondary:hover,.link-secondary:focus{
    color:#14161d
}
.link-success{
    color:#198754
}
.link-success:hover,.link-success:focus{
    color:#146c43
}
.link-info{
    color:#0dcaf0
}
.link-info:hover,.link-info:focus{
    color:#3dd5f3
}
.link-warning{
    color:#ffc107
}
.link-warning:hover,.link-warning:focus{
    color:#ffcd39
}
.link-danger{
    color:#6af7e5
}
.link-danger:hover,.link-danger:focus{
    color:#b02a37
}
.link-light{
    color:#6C7293
}
.link-light:hover,.link-light:focus{
    color:#565b76
}
.link-dark{
    color:#000
}
.link-dark:hover,.link-dark:focus{
    color:#000
}
.ratio{
    position:relative;
    width:100%
}
.ratio::before{
    display:block;
    padding-top:var(--bs-aspect-ratio);
    content:""
}
.ratio>*{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%
}
.ratio-1x1{
    --bs-aspect-ratio: 100%
}
.ratio-4x3{
    --bs-aspect-ratio: calc(3 / 4 * 100%)
}
.ratio-16x9{
    --bs-aspect-ratio: calc(9 / 16 * 100%)
}
.ratio-21x9{
    --bs-aspect-ratio: calc(9 / 21 * 100%)
}
.fixed-top{
    position:fixed;
    top:0;
    right:0;
    left:0;
    z-index:1030
}
.fixed-bottom{
    position:fixed;
    right:0;
    bottom:0;
    left:0;
    z-index:1030
}
.sticky-top{
    position:sticky;
    top:0;
    z-index:1020
}
@media (min-width: 576px){
    .sticky-sm-top{
        position:sticky;
        top:0;
        z-index:1020
    }
}
@media (min-width: 768px){
    .sticky-md-top{
        position:sticky;
        top:0;
        z-index:1020
    }
}
@media (min-width: 992px){
    .sticky-lg-top{
        position:sticky;
        top:0;
        z-index:1020
    }
}
@media (min-width: 1200px){
    .sticky-xl-top{
        position:sticky;
        top:0;
        z-index:1020
    }
}
@media (min-width: 1400px){
    .sticky-xxl-top{
        position:sticky;
        top:0;
        z-index:1020
    }
}
.visually-hidden,.visually-hidden-focusable:not(:focus):not(:focus-within){
    position:absolute !important;
    width:1px !important;
    height:1px !important;
    padding:0 !important;
    margin:-1px !important;
    overflow:hidden !important;
    clip:rect(0, 0, 0, 0) !important;
    white-space:nowrap !important;
    border:0 !important
}
.stretched-link::after{
    position:absolute;
    top:0;
    right:0;
    bottom:0;
    left:0;
    z-index:1;
    content:""
}
.text-truncate{
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap
}
.align-baseline{
    vertical-align:baseline !important
}
.align-top{
    vertical-align:top !important
}
.align-middle{
    vertical-align:middle !important
}
.align-bottom{
    vertical-align:bottom !important
}
.align-text-bottom{
    vertical-align:text-bottom !important
}
.align-text-top{
    vertical-align:text-top !important
}
.float-start{
    float:left !important
}
.float-end{
    float:right !important
}
.float-none{
    float:none !important
}
.overflow-auto{
    overflow:auto !important
}
.overflow-hidden{
    overflow:hidden !important
}
.overflow-visible{
    overflow:visible !important
}
.overflow-scroll{
    overflow:scroll !important
}
.d-inline{
    display:inline !important
}
.d-inline-block{
    display:inline-block !important
}
.d-block{
    display:block !important
}
.d-grid{
    display:grid !important
}
.d-table{
    display:table !important
}
.d-table-row{
    display:table-row !important
}
.d-table-cell{
    display:table-cell !important
}
.d-flex{
    display:flex !important
}
.d-inline-flex{
    display:inline-flex !important
}
.d-none{
    display:none !important
}
.shadow{
    box-shadow:0 0.5rem 1rem rgba(0,0,0,0.15) !important
}
.shadow-sm{
    box-shadow:0 0.125rem 0.25rem rgba(0,0,0,0.075) !important
}
.shadow-lg{
    box-shadow:0 1rem 3rem rgba(0,0,0,0.175) !important
}
.shadow-none{
    box-shadow:none !important
}
.position-static{
    position:static !important
}
.position-relative{
    position:relative !important
}
.position-absolute{
    position:absolute !important
}
.position-fixed{
    position:fixed !important
}
.position-sticky{
    position:sticky !important
}
.top-0{
    top:0 !important
}
.top-50{
    top:50% !important
}
.top-100{
    top:100% !important
}
.bottom-0{
    bottom:0 !important
}
.bottom-50{
    bottom:50% !important
}
.bottom-100{
    bottom:100% !important
}
.start-0{
    left:0 !important
}
.start-50{
    left:50% !important
}
.start-100{
    left:100% !important
}
.end-0{
    right:0 !important
}
.end-50{
    right:50% !important
}
.end-100{
    right:100% !important
}
.translate-middle{
    transform:translate(-50%, -50%) !important
}
.translate-middle-x{
    transform:translateX(-50%) !important
}
.translate-middle-y{
    transform:translateY(-50%) !important
}
.border{
    border:1px solid #000 !important
}
.border-0{
    border:0 !important
}
.border-top{
    border-top:1px solid #000 !important
}
.border-top-0{
    border-top:0 !important
}
.border-end{
    border-right:1px solid #000 !important
}
.border-end-0{
    border-right:0 !important
}
.border-bottom{
    border-bottom:1px solid #000 !important
}
.border-bottom-0{
    border-bottom:0 !important
}
.border-start{
    border-left:1px solid #000 !important
}
.border-start-0{
    border-left:0 !important
}
.border-primary{
    border-color:#6af7e5 !important
}
.border-secondary{
    border-color:#191C24 !important
}
.border-success{
    border-color:#198754 !important
}
.border-info{
    border-color:#0dcaf0 !important
}
.border-warning{
    border-color:#ffc107 !important
}
.border-danger{
    border-color:#6af7e5 !important
}
.border-light{
    border-color:#6C7293 !important
}
.border-dark{
    border-color:#000 !important
}
.border-white{
    border-color:#fff !important
}
.border-1{
    border-width:1px !important
}
.border-2{
    border-width:2px !important
}
.border-3{
    border-width:3px !important
}
.border-4{
    border-width:4px !important
}
.border-5{
    border-width:5px !important
}
.w-25{
    width:25% !important
}
.w-50{
    width:50% !important
}
.w-75{
    width:75% !important
}
.w-100{
    width:100% !important
}
.w-auto{
    width:auto !important
}
.mw-100{
    max-width:100% !important
}
.vw-100{
    width:100vw !important
}
.min-vw-100{
    min-width:100vw !important
}
.h-25{
    height:25% !important
}
.h-50{
    height:50% !important
}
.h-75{
    height:75% !important
}
.h-100{
    height:100% !important
}
.h-auto{
    height:auto !important
}
.mh-100{
    max-height:100% !important
}
.vh-100{
    height:100vh !important
}
.min-vh-100{
    min-height:100vh !important
}
.flex-fill{
    flex:1 1 auto !important
}
.flex-row{
    flex-direction:row !important
}
.flex-column{
    flex-direction:column !important
}
.flex-row-reverse{
    flex-direction:row-reverse !important
}
.flex-column-reverse{
    flex-direction:column-reverse !important
}
.flex-grow-0{
    flex-grow:0 !important
}
.flex-grow-1{
    flex-grow:1 !important
}
.flex-shrink-0{
    flex-shrink:0 !important
}
.flex-shrink-1{
    flex-shrink:1 !important
}
.flex-wrap{
    flex-wrap:wrap !important
}
.flex-nowrap{
    flex-wrap:nowrap !important
}
.flex-wrap-reverse{
    flex-wrap:wrap-reverse !important
}
.gap-0{
    gap:0 !important
}
.gap-1{
    gap:.25rem !important
}
.gap-2{
    gap:.5rem !important
}
.gap-3{
    gap:1rem !important
}
.gap-4{
    gap:1.5rem !important
}
.gap-5{
    gap:3rem !important
}
.justify-content-start{
    justify-content:flex-start !important
}
.justify-content-end{
    justify-content:flex-end !important
}
.justify-content-center{
    justify-content:center !important
}
.justify-content-between{
    justify-content:space-between !important
}
.justify-content-around{
    justify-content:space-around !important
}
.justify-content-evenly{
    justify-content:space-evenly !important
}
.align-items-start{
    align-items:flex-start !important
}
.align-items-end{
    align-items:flex-end !important
}
.align-items-center{
    align-items:center !important
}
.align-items-baseline{
    align-items:baseline !important
}
.align-items-stretch{
    align-items:stretch !important
}
.align-content-start{
    align-content:flex-start !important
}
.align-content-end{
    align-content:flex-end !important
}
.align-content-center{
    align-content:center !important
}
.align-content-between{
    align-content:space-between !important
}
.align-content-around{
    align-content:space-around !important
}
.align-content-stretch{
    align-content:stretch !important
}
.align-self-auto{
    align-self:auto !important
}
.align-self-start{
    align-self:flex-start !important
}
.align-self-end{
    align-self:flex-end !important
}
.align-self-center{
    align-self:center !important
}
.align-self-baseline{
    align-self:baseline !important
}
.align-self-stretch{
    align-self:stretch !important
}
.order-first{
    order:-1 !important
}
.order-0{
    order:0 !important
}
.order-1{
    order:1 !important
}
.order-2{
    order:2 !important
}
.order-3{
    order:3 !important
}
.order-4{
    order:4 !important
}
.order-5{
    order:5 !important
}
.order-last{
    order:6 !important
}
.m-0{
    margin:0 !important
}
.m-1{
    margin:.25rem !important
}
.m-2{
    margin:.5rem !important
}
.m-3{
    margin:1rem !important
}
.m-4{
    margin:1.5rem !important
}
.m-5{
    margin:3rem !important
}
.m-auto{
    margin:auto !important
}
.mx-0{
    margin-right:0 !important;
    margin-left:0 !important
}
.mx-1{
    margin-right:.25rem !important;
    margin-left:.25rem !important
}
.mx-2{
    margin-right:.5rem !important;
    margin-left:.5rem !important
}
.mx-3{
    margin-right:1rem !important;
    margin-left:1rem !important
}
.mx-4{
    margin-right:1.5rem !important;
    margin-left:1.5rem !important
}
.mx-5{
    margin-right:3rem !important;
    margin-left:3rem !important
}
.mx-auto{
    margin-right:auto !important;
    margin-left:auto !important
}
.my-0{
    margin-top:0 !important;
    margin-bottom:0 !important
}
.my-1{
    margin-top:.25rem !important;
    margin-bottom:.25rem !important
}
.my-2{
    margin-top:.5rem !important;
    margin-bottom:.5rem !important
}
.my-3{
    margin-top:1rem !important;
    margin-bottom:1rem !important
}
.my-4{
    margin-top:1.5rem !important;
    margin-bottom:1.5rem !important
}
.my-5{
    margin-top:3rem !important;
    margin-bottom:3rem !important
}
.my-auto{
    margin-top:auto !important;
    margin-bottom:auto !important
}
.mt-0{
    margin-top:0 !important
}
.mt-1{
    margin-top:.25rem !important
}
.mt-2{
    margin-top:.5rem !important
}
.mt-3{
    margin-top:1rem !important
}
.mt-4{
    margin-top:1.5rem !important
}
.mt-5{
    margin-top:3rem !important
}
.mt-auto{
    margin-top:auto !important
}
.me-0{
    margin-right:0 !important
}
.me-1{
    margin-right:.25rem !important
}
.me-2{
    margin-right:.5rem !important
}
.me-3{
    margin-right:1rem !important
}
.me-4{
    margin-right:1.5rem !important
}
.me-5{
    margin-right:3rem !important
}
.me-auto{
    margin-right:auto !important
}
.mb-0{
    margin-bottom:0 !important
}
.mb-1{
    margin-bottom:.25rem !important
}
.mb-2{
    margin-bottom:.5rem !important
}
.mb-3{
    margin-bottom:1rem !important
}
.mb-4{
    margin-bottom:1.5rem !important
}
.mb-5{
    margin-bottom:3rem !important
}
.mb-auto{
    margin-bottom:auto !important
}
.ms-0{
    margin-left:0 !important
}
.ms-1{
    margin-left:.25rem !important
}
.ms-2{
    margin-left:.5rem !important
}
.ms-3{
    margin-left:1rem !important
}
.ms-4{
    margin-left:1.5rem !important
}
.ms-5{
    margin-left:3rem !important
}
.ms-auto{
    margin-left:auto !important
}
.m-n1{
    margin:-.25rem !important
}
.m-n2{
    margin:-.5rem !important
}
.m-n3{
    margin:-1rem !important
}
.m-n4{
    margin:-1.5rem !important
}
.m-n5{
    margin:-3rem !important
}
.mx-n1{
    margin-right:-.25rem !important;
    margin-left:-.25rem !important
}
.mx-n2{
    margin-right:-.5rem !important;
    margin-left:-.5rem !important
}
.mx-n3{
    margin-right:-1rem !important;
    margin-left:-1rem !important
}
.mx-n4{
    margin-right:-1.5rem !important;
    margin-left:-1.5rem !important
}
.mx-n5{
    margin-right:-3rem !important;
    margin-left:-3rem !important
}
.my-n1{
    margin-top:-.25rem !important;
    margin-bottom:-.25rem !important
}
.my-n2{
    margin-top:-.5rem !important;
    margin-bottom:-.5rem !important
}
.my-n3{
    margin-top:-1rem !important;
    margin-bottom:-1rem !important
}
.my-n4{
    margin-top:-1.5rem !important;
    margin-bottom:-1.5rem !important
}
.my-n5{
    margin-top:-3rem !important;
    margin-bottom:-3rem !important
}
.mt-n1{
    margin-top:-.25rem !important
}
.mt-n2{
    margin-top:-.5rem !important
}
.mt-n3{
    margin-top:-1rem !important
}
.mt-n4{
    margin-top:-1.5rem !important
}
.mt-n5{
    margin-top:-3rem !important
}
.me-n1{
    margin-right:-.25rem !important
}
.me-n2{
    margin-right:-.5rem !important
}
.me-n3{
    margin-right:-1rem !important
}
.me-n4{
    margin-right:-1.5rem !important
}
.me-n5{
    margin-right:-3rem !important
}
.mb-n1{
    margin-bottom:-.25rem !important
}
.mb-n2{
    margin-bottom:-.5rem !important
}
.mb-n3{
    margin-bottom:-1rem !important
}
.mb-n4{
    margin-bottom:-1.5rem !important
}
.mb-n5{
    margin-bottom:-3rem !important
}
.ms-n1{
    margin-left:-.25rem !important
}
.ms-n2{
    margin-left:-.5rem !important
}
.ms-n3{
    margin-left:-1rem !important
}
.ms-n4{
    margin-left:-1.5rem !important
}
.ms-n5{
    margin-left:-3rem !important
}
.p-0{
    padding:0 !important
}
.p-1{
    padding:.25rem !important
}
.p-2{
    padding:.5rem !important
}
.p-3{
    padding:1rem !important
}
.p-4{
    padding:1.5rem !important
}
.p-5{
    padding:3rem !important
}
.px-0{
    padding-right:0 !important;
    padding-left:0 !important
}
.px-1{
    padding-right:.25rem !important;
    padding-left:.25rem !important
}
.px-2{
    padding-right:.5rem !important;
    padding-left:.5rem !important
}
.px-3{
    padding-right:1rem !important;
    padding-left:1rem !important
}
.px-4{
    padding-right:1.5rem !important;
    padding-left:1.5rem !important
}
.px-5{
    padding-right:3rem !important;
    padding-left:3rem !important
}
.py-0{
    padding-top:0 !important;
    padding-bottom:0 !important
}
.py-1{
    padding-top:.25rem !important;
    padding-bottom:.25rem !important
}
.py-2{
    padding-top:.5rem !important;
    padding-bottom:.5rem !important
}
.py-3{
    padding-top:1rem !important;
    padding-bottom:1rem !important
}
.py-4{
    padding-top:1.5rem !important;
    padding-bottom:1.5rem !important
}
.py-5{
    padding-top:3rem !important;
    padding-bottom:3rem !important
}
.pt-0{
    padding-top:0 !important
}
.pt-1{
    padding-top:.25rem !important
}
.pt-2{
    padding-top:.5rem !important
}
.pt-3{
    padding-top:1rem !important
}
.pt-4{
    padding-top:1.5rem !important
}
.pt-5{
    padding-top:3rem !important
}
.pe-0{
    padding-right:0 !important
}
.pe-1{
    padding-right:.25rem !important
}
.pe-2{
    padding-right:.5rem !important
}
.pe-3{
    padding-right:1rem !important
}
.pe-4{
    padding-right:1.5rem !important
}
.pe-5{
    padding-right:3rem !important
}
.pb-0{
    padding-bottom:0 !important
}
.pb-1{
    padding-bottom:.25rem !important
}
.pb-2{
    padding-bottom:.5rem !important
}
.pb-3{
    padding-bottom:1rem !important
}
.pb-4{
    padding-bottom:1.5rem !important
}
.pb-5{
    padding-bottom:3rem !important
}
.ps-0{
    padding-left:0 !important
}
.ps-1{
    padding-left:.25rem !important
}
.ps-2{
    padding-left:.5rem !important
}
.ps-3{
    padding-left:1rem !important
}
.ps-4{
    padding-left:1.5rem !important
}
.ps-5{
    padding-left:3rem !important
}
.font-monospace{
    font-family:var(--bs-font-monospace) !important
}
.fs-1{
    font-size:calc(1.375rem + 1.5vw) !important
}
.fs-2{
    font-size:calc(1.325rem + .9vw) !important
}
.fs-3{
    font-size:calc(1.3rem + .6vw) !important
}
.fs-4{
    font-size:calc(1.275rem + .3vw) !important
}
.fs-5{
    font-size:1.25rem !important
}
.fs-6{
    font-size:1rem !important
}
.fst-italic{
    font-style:italic !important
}
.fst-normal{
    font-style:normal !important
}
.fw-light{
    font-weight:300 !important
}
.fw-lighter{
    font-weight:lighter !important
}
.fw-normal{
    font-weight:400 !important
}
.fw-bold{
    font-weight:700 !important
}
.fw-bolder{
    font-weight:bolder !important
}
.lh-1{
    line-height:1 !important
}
.lh-sm{
    line-height:1.25 !important
}
.lh-base{
    line-height:1.5 !important
}
.lh-lg{
    line-height:2 !important
}
.text-start{
    text-align:left !important
}
.text-end{
    text-align:right !important
}
.text-center{
    text-align:center !important
}
.text-decoration-none{
    text-decoration:none !important
}
.text-decoration-underline{
    text-decoration:underline !important
}
.text-decoration-line-through{
    text-decoration:line-through !important
}
.text-lowercase{
    text-transform:lowercase !important
}
.text-uppercase{
    text-transform:uppercase !important
}
.text-capitalize{
    text-transform:capitalize !important
}
.text-wrap{
    white-space:normal !important
}
.text-nowrap{
    white-space:nowrap !important
}
.text-break{
    word-wrap:break-word !important;
    word-break:break-word !important
}
.text-primary{
    color:#6af7e5 !important
}
.text-secondary{
    color:#191C24 !important
}
.text-success{
    color:#198754 !important
}
.text-info{
    color:#0dcaf0 !important
}
.text-warning{
    color:#ffc107 !important
}
.text-danger{
    color:#6af7e5 !important
}
.text-light{
    color:#6C7293 !important
}
.text-dark{
    color:#000 !important
}
.text-white{
    color:#fff !important
}
.text-body{
    color:#6C7293 !important
}
.text-muted{
    color:#6c757d !important
}
.text-black-50{
    color:rgba(0,0,0,0.5) !important
}
.text-white-50{
    color:rgba(255,255,255,0.5) !important
}
.text-reset{
    color:inherit !important
}
.bg-primary{
    background-color:#6af7e5 !important
}
.bg-secondary{
    background-color: var(--primary-color) !important
}
.bg-success{
    background-color:#198754 !important
}
.bg-info{
    background-color:#0dcaf0 !important
}
.bg-warning{
    background-color:#ffc107 !important
}
.bg-danger{
    background-color:#6af7e5 !important
}
.bg-light{
    background-color:#6C7293 !important
}
.bg-dark{
    background-color:rgb(197, 197, 197);
}
.bg-body{
    background-color:#000 !important
}
.bg-white{
    background-color:#fff !important
}
.bg-transparent{
    background-color:rgba(0,0,0,0) !important
}
.bg-gradient{
    background-image:var(--bs-gradient) !important
}
.user-select-all{
    user-select:all !important
}
.user-select-auto{
    user-select:auto !important
}
.user-select-none{
    user-select:none !important
}
.pe-none{
    pointer-events:none !important
}
.pe-auto{
    pointer-events:auto !important
}
.rounded{
    border-radius:20px;
}
.rounded-0{
    border-radius:0 !important
}
.rounded-1{
    border-radius:.2rem !important
}
.rounded-2{
    border-radius:5px !important
}
.rounded-3{
    border-radius:.3rem !important
}
.rounded-circle{
    border-radius:50% !important
}
.rounded-pill{
    border-radius:50rem !important
}
.rounded-top{
    border-top-left-radius:5px !important;
    border-top-right-radius:5px !important
}
.rounded-end{
    border-top-right-radius:5px !important;
    border-bottom-right-radius:5px !important
}
.rounded-bottom{
    border-bottom-right-radius:5px !important;
    border-bottom-left-radius:5px !important
}
.rounded-start{
    border-bottom-left-radius:5px !important;
    border-top-left-radius:5px !important
}
.visible{
    visibility:visible !important
}
.invisible{
    visibility:hidden !important
}
@media (min-width: 576px){
    .float-sm-start{
        float:left !important
    }
    .float-sm-end{
        float:right !important
    }
    .float-sm-none{
        float:none !important
    }
    .d-sm-inline{
        display:inline !important
    }
    .d-sm-inline-block{
        display:inline-block !important
    }
    .d-sm-block{
        display:block !important
    }
    .d-sm-grid{
        display:grid !important
    }
    .d-sm-table{
        display:table !important
    }
    .d-sm-table-row{
        display:table-row !important
    }
    .d-sm-table-cell{
        display:table-cell !important
    }
    .d-sm-flex{
        display:flex !important
    }
    .d-sm-inline-flex{
        display:inline-flex !important
    }
    .d-sm-none{
        display:none !important
    }
    .flex-sm-fill{
        flex:1 1 auto !important
    }
    .flex-sm-row{
        flex-direction:row !important
    }
    .flex-sm-column{
        flex-direction:column !important
    }
    .flex-sm-row-reverse{
        flex-direction:row-reverse !important
    }
    .flex-sm-column-reverse{
        flex-direction:column-reverse !important
    }
    .flex-sm-grow-0{
        flex-grow:0 !important
    }
    .flex-sm-grow-1{
        flex-grow:1 !important
    }
    .flex-sm-shrink-0{
        flex-shrink:0 !important
    }
    .flex-sm-shrink-1{
        flex-shrink:1 !important
    }
    .flex-sm-wrap{
        flex-wrap:wrap !important
    }
    .flex-sm-nowrap{
        flex-wrap:nowrap !important
    }
    .flex-sm-wrap-reverse{
        flex-wrap:wrap-reverse !important
    }
    .gap-sm-0{
        gap:0 !important
    }
    .gap-sm-1{
        gap:.25rem !important
    }
    .gap-sm-2{
        gap:.5rem !important
    }
    .gap-sm-3{
        gap:1rem !important
    }
    .gap-sm-4{
        gap:1.5rem !important
    }
    .gap-sm-5{
        gap:3rem !important
    }
    .justify-content-sm-start{
        justify-content:flex-start !important
    }
    .justify-content-sm-end{
        justify-content:flex-end !important
    }
    .justify-content-sm-center{
        justify-content:center !important
    }
    .justify-content-sm-between{
        justify-content:space-between !important
    }
    .justify-content-sm-around{
        justify-content:space-around !important
    }
    .justify-content-sm-evenly{
        justify-content:space-evenly !important
    }
    .align-items-sm-start{
        align-items:flex-start !important
    }
    .align-items-sm-end{
        align-items:flex-end !important
    }
    .align-items-sm-center{
        align-items:center !important
    }
    .align-items-sm-baseline{
        align-items:baseline !important
    }
    .align-items-sm-stretch{
        align-items:stretch !important
    }
    .align-content-sm-start{
        align-content:flex-start !important
    }
    .align-content-sm-end{
        align-content:flex-end !important
    }
    .align-content-sm-center{
        align-content:center !important
    }
    .align-content-sm-between{
        align-content:space-between !important
    }
    .align-content-sm-around{
        align-content:space-around !important
    }
    .align-content-sm-stretch{
        align-content:stretch !important
    }
    .align-self-sm-auto{
        align-self:auto !important
    }
    .align-self-sm-start{
        align-self:flex-start !important
    }
    .align-self-sm-end{
        align-self:flex-end !important
    }
    .align-self-sm-center{
        align-self:center !important
    }
    .align-self-sm-baseline{
        align-self:baseline !important
    }
    .align-self-sm-stretch{
        align-self:stretch !important
    }
    .order-sm-first{
        order:-1 !important
    }
    .order-sm-0{
        order:0 !important
    }
    .order-sm-1{
        order:1 !important
    }
    .order-sm-2{
        order:2 !important
    }
    .order-sm-3{
        order:3 !important
    }
    .order-sm-4{
        order:4 !important
    }
    .order-sm-5{
        order:5 !important
    }
    .order-sm-last{
        order:6 !important
    }
    .m-sm-0{
        margin:0 !important
    }
    .m-sm-1{
        margin:.25rem !important
    }
    .m-sm-2{
        margin:.5rem !important
    }
    .m-sm-3{
        margin:1rem !important
    }
    .m-sm-4{
        margin:1.5rem !important
    }
    .m-sm-5{
        margin:3rem !important
    }
    .m-sm-auto{
        margin:auto !important
    }
    .mx-sm-0{
        margin-right:0 !important;
        margin-left:0 !important
    }
    .mx-sm-1{
        margin-right:.25rem !important;
        margin-left:.25rem !important
    }
    .mx-sm-2{
        margin-right:.5rem !important;
        margin-left:.5rem !important
    }
    .mx-sm-3{
        margin-right:1rem !important;
        margin-left:1rem !important
    }
    .mx-sm-4{
        margin-right:1.5rem !important;
        margin-left:1.5rem !important
    }
    .mx-sm-5{
        margin-right:3rem !important;
        margin-left:3rem !important
    }
    .mx-sm-auto{
        margin-right:auto !important;
        margin-left:auto !important
    }
    .my-sm-0{
        margin-top:0 !important;
        margin-bottom:0 !important
    }
    .my-sm-1{
        margin-top:.25rem !important;
        margin-bottom:.25rem !important
    }
    .my-sm-2{
        margin-top:.5rem !important;
        margin-bottom:.5rem !important
    }
    .my-sm-3{
        margin-top:1rem !important;
        margin-bottom:1rem !important
    }
    .my-sm-4{
        margin-top:1.5rem !important;
        margin-bottom:1.5rem !important
    }
    .my-sm-5{
        margin-top:3rem !important;
        margin-bottom:3rem !important
    }
    .my-sm-auto{
        margin-top:auto !important;
        margin-bottom:auto !important
    }
    .mt-sm-0{
        margin-top:0 !important
    }
    .mt-sm-1{
        margin-top:.25rem !important
    }
    .mt-sm-2{
        margin-top:.5rem !important
    }
    .mt-sm-3{
        margin-top:1rem !important
    }
    .mt-sm-4{
        margin-top:1.5rem !important
    }
    .mt-sm-5{
        margin-top:3rem !important
    }
    .mt-sm-auto{
        margin-top:auto !important
    }
    .me-sm-0{
        margin-right:0 !important
    }
    .me-sm-1{
        margin-right:.25rem !important
    }
    .me-sm-2{
        margin-right:.5rem !important
    }
    .me-sm-3{
        margin-right:1rem !important
    }
    .me-sm-4{
        margin-right:1.5rem !important
    }
    .me-sm-5{
        margin-right:3rem !important
    }
    .me-sm-auto{
        margin-right:auto !important
    }
    .mb-sm-0{
        margin-bottom:0 !important
    }
    .mb-sm-1{
        margin-bottom:.25rem !important
    }
    .mb-sm-2{
        margin-bottom:.5rem !important
    }
    .mb-sm-3{
        margin-bottom:1rem !important
    }
    .mb-sm-4{
        margin-bottom:1.5rem !important
    }
    .mb-sm-5{
        margin-bottom:3rem !important
    }
    .mb-sm-auto{
        margin-bottom:auto !important
    }
    .ms-sm-0{
        margin-left:0 !important
    }
    .ms-sm-1{
        margin-left:.25rem !important
    }
    .ms-sm-2{
        margin-left:.5rem !important
    }
    .ms-sm-3{
        margin-left:1rem !important
    }
    .ms-sm-4{
        margin-left:1.5rem !important
    }
    .ms-sm-5{
        margin-left:3rem !important
    }
    .ms-sm-auto{
        margin-left:auto !important
    }
    .m-sm-n1{
        margin:-.25rem !important
    }
    .m-sm-n2{
        margin:-.5rem !important
    }
    .m-sm-n3{
        margin:-1rem !important
    }
    .m-sm-n4{
        margin:-1.5rem !important
    }
    .m-sm-n5{
        margin:-3rem !important
    }
    .mx-sm-n1{
        margin-right:-.25rem !important;
        margin-left:-.25rem !important
    }
    .mx-sm-n2{
        margin-right:-.5rem !important;
        margin-left:-.5rem !important
    }
    .mx-sm-n3{
        margin-right:-1rem !important;
        margin-left:-1rem !important
    }
    .mx-sm-n4{
        margin-right:-1.5rem !important;
        margin-left:-1.5rem !important
    }
    .mx-sm-n5{
        margin-right:-3rem !important;
        margin-left:-3rem !important
    }
    .my-sm-n1{
        margin-top:-.25rem !important;
        margin-bottom:-.25rem !important
    }
    .my-sm-n2{
        margin-top:-.5rem !important;
        margin-bottom:-.5rem !important
    }
    .my-sm-n3{
        margin-top:-1rem !important;
        margin-bottom:-1rem !important
    }
    .my-sm-n4{
        margin-top:-1.5rem !important;
        margin-bottom:-1.5rem !important
    }
    .my-sm-n5{
        margin-top:-3rem !important;
        margin-bottom:-3rem !important
    }
    .mt-sm-n1{
        margin-top:-.25rem !important
    }
    .mt-sm-n2{
        margin-top:-.5rem !important
    }
    .mt-sm-n3{
        margin-top:-1rem !important
    }
    .mt-sm-n4{
        margin-top:-1.5rem !important
    }
    .mt-sm-n5{
        margin-top:-3rem !important
    }
    .me-sm-n1{
        margin-right:-.25rem !important
    }
    .me-sm-n2{
        margin-right:-.5rem !important
    }
    .me-sm-n3{
        margin-right:-1rem !important
    }
    .me-sm-n4{
        margin-right:-1.5rem !important
    }
    .me-sm-n5{
        margin-right:-3rem !important
    }
    .mb-sm-n1{
        margin-bottom:-.25rem !important
    }
    .mb-sm-n2{
        margin-bottom:-.5rem !important
    }
    .mb-sm-n3{
        margin-bottom:-1rem !important
    }
    .mb-sm-n4{
        margin-bottom:-1.5rem !important
    }
    .mb-sm-n5{
        margin-bottom:-3rem !important
    }
    .ms-sm-n1{
        margin-left:-.25rem !important
    }
    .ms-sm-n2{
        margin-left:-.5rem !important
    }
    .ms-sm-n3{
        margin-left:-1rem !important
    }
    .ms-sm-n4{
        margin-left:-1.5rem !important
    }
    .ms-sm-n5{
        margin-left:-3rem !important
    }
    .p-sm-0{
        padding:0 !important
    }
    .p-sm-1{
        padding:.25rem !important
    }
    .p-sm-2{
        padding:.5rem !important
    }
    .p-sm-3{
        padding:1rem !important
    }
    .p-sm-4{
        padding:1.5rem !important
    }
    .p-sm-5{
        padding:3rem !important
    }
    .px-sm-0{
        padding-right:0 !important;
        padding-left:0 !important
    }
    .px-sm-1{
        padding-right:.25rem !important;
        padding-left:.25rem !important
    }
    .px-sm-2{
        padding-right:.5rem !important;
        padding-left:.5rem !important
    }
    .px-sm-3{
        padding-right:1rem !important;
        padding-left:1rem !important
    }
    .px-sm-4{
        padding-right:1.5rem !important;
        padding-left:1.5rem !important
    }
    .px-sm-5{
        padding-right:3rem !important;
        padding-left:3rem !important
    }
    .py-sm-0{
        padding-top:0 !important;
        padding-bottom:0 !important
    }
    .py-sm-1{
        padding-top:.25rem !important;
        padding-bottom:.25rem !important
    }
    .py-sm-2{
        padding-top:.5rem !important;
        padding-bottom:.5rem !important
    }
    .py-sm-3{
        padding-top:1rem !important;
        padding-bottom:1rem !important
    }
    .py-sm-4{
        padding-top:1.5rem !important;
        padding-bottom:1.5rem !important
    }
    .py-sm-5{
        padding-top:3rem !important;
        padding-bottom:3rem !important
    }
    .pt-sm-0{
        padding-top:0 !important
    }
    .pt-sm-1{
        padding-top:.25rem !important
    }
    .pt-sm-2{
        padding-top:.5rem !important
    }
    .pt-sm-3{
        padding-top:1rem !important
    }
    .pt-sm-4{
        padding-top:1.5rem !important
    }
    .pt-sm-5{
        padding-top:3rem !important
    }
    .pe-sm-0{
        padding-right:0 !important
    }
    .pe-sm-1{
        padding-right:.25rem !important
    }
    .pe-sm-2{
        padding-right:.5rem !important
    }
    .pe-sm-3{
        padding-right:1rem !important
    }
    .pe-sm-4{
        padding-right:1.5rem !important
    }
    .pe-sm-5{
        padding-right:3rem !important
    }
    .pb-sm-0{
        padding-bottom:0 !important
    }
    .pb-sm-1{
        padding-bottom:.25rem !important
    }
    .pb-sm-2{
        padding-bottom:.5rem !important
    }
    .pb-sm-3{
        padding-bottom:1rem !important
    }
    .pb-sm-4{
        padding-bottom:1.5rem !important
    }
    .pb-sm-5{
        padding-bottom:3rem !important
    }
    .ps-sm-0{
        padding-left:0 !important
    }
    .ps-sm-1{
        padding-left:.25rem !important
    }
    .ps-sm-2{
        padding-left:.5rem !important
    }
    .ps-sm-3{
        padding-left:1rem !important
    }
    .ps-sm-4{
        padding-left:1.5rem !important
    }
    .ps-sm-5{
        padding-left:3rem !important
    }
    .text-sm-start{
        text-align:left !important
    }
    .text-sm-end{
        text-align:right !important
    }
    .text-sm-center{
        text-align:center !important
    }
}
@media (min-width: 768px){
    .float-md-start{
        float:left !important
    }
    .float-md-end{
        float:right !important
    }
    .float-md-none{
        float:none !important
    }
    .d-md-inline{
        display:inline !important
    }
    .d-md-inline-block{
        display:inline-block !important
    }
    .d-md-block{
        display:block !important
    }
    .d-md-grid{
        display:grid !important
    }
    .d-md-table{
        display:table !important
    }
    .d-md-table-row{
        display:table-row !important
    }
    .d-md-table-cell{
        display:table-cell !important
    }
    .d-md-flex{
        display:flex !important
    }
    .d-md-inline-flex{
        display:inline-flex !important
    }
    .d-md-none{
        display:none !important
    }
    .flex-md-fill{
        flex:1 1 auto !important
    }
    .flex-md-row{
        flex-direction:row !important
    }
    .flex-md-column{
        flex-direction:column !important
    }
    .flex-md-row-reverse{
        flex-direction:row-reverse !important
    }
    .flex-md-column-reverse{
        flex-direction:column-reverse !important
    }
    .flex-md-grow-0{
        flex-grow:0 !important
    }
    .flex-md-grow-1{
        flex-grow:1 !important
    }
    .flex-md-shrink-0{
        flex-shrink:0 !important
    }
    .flex-md-shrink-1{
        flex-shrink:1 !important
    }
    .flex-md-wrap{
        flex-wrap:wrap !important
    }
    .flex-md-nowrap{
        flex-wrap:nowrap !important
    }
    .flex-md-wrap-reverse{
        flex-wrap:wrap-reverse !important
    }
    .gap-md-0{
        gap:0 !important
    }
    .gap-md-1{
        gap:.25rem !important
    }
    .gap-md-2{
        gap:.5rem !important
    }
    .gap-md-3{
        gap:1rem !important
    }
    .gap-md-4{
        gap:1.5rem !important
    }
    .gap-md-5{
        gap:3rem !important
    }
    .justify-content-md-start{
        justify-content:flex-start !important
    }
    .justify-content-md-end{
        justify-content:flex-end !important
    }
    .justify-content-md-center{
        justify-content:center !important
    }
    .justify-content-md-between{
        justify-content:space-between !important
    }
    .justify-content-md-around{
        justify-content:space-around !important
    }
    .justify-content-md-evenly{
        justify-content:space-evenly !important
    }
    .align-items-md-start{
        align-items:flex-start !important
    }
    .align-items-md-end{
        align-items:flex-end !important
    }
    .align-items-md-center{
        align-items:center !important
    }
    .align-items-md-baseline{
        align-items:baseline !important
    }
    .align-items-md-stretch{
        align-items:stretch !important
    }
    .align-content-md-start{
        align-content:flex-start !important
    }
    .align-content-md-end{
        align-content:flex-end !important
    }
    .align-content-md-center{
        align-content:center !important
    }
    .align-content-md-between{
        align-content:space-between !important
    }
    .align-content-md-around{
        align-content:space-around !important
    }
    .align-content-md-stretch{
        align-content:stretch !important
    }
    .align-self-md-auto{
        align-self:auto !important
    }
    .align-self-md-start{
        align-self:flex-start !important
    }
    .align-self-md-end{
        align-self:flex-end !important
    }
    .align-self-md-center{
        align-self:center !important
    }
    .align-self-md-baseline{
        align-self:baseline !important
    }
    .align-self-md-stretch{
        align-self:stretch !important
    }
    .order-md-first{
        order:-1 !important
    }
    .order-md-0{
        order:0 !important
    }
    .order-md-1{
        order:1 !important
    }
    .order-md-2{
        order:2 !important
    }
    .order-md-3{
        order:3 !important
    }
    .order-md-4{
        order:4 !important
    }
    .order-md-5{
        order:5 !important
    }
    .order-md-last{
        order:6 !important
    }
    .m-md-0{
        margin:0 !important
    }
    .m-md-1{
        margin:.25rem !important
    }
    .m-md-2{
        margin:.5rem !important
    }
    .m-md-3{
        margin:1rem !important
    }
    .m-md-4{
        margin:1.5rem !important
    }
    .m-md-5{
        margin:3rem !important
    }
    .m-md-auto{
        margin:auto !important
    }
    .mx-md-0{
        margin-right:0 !important;
        margin-left:0 !important
    }
    .mx-md-1{
        margin-right:.25rem !important;
        margin-left:.25rem !important
    }
    .mx-md-2{
        margin-right:.5rem !important;
        margin-left:.5rem !important
    }
    .mx-md-3{
        margin-right:1rem !important;
        margin-left:1rem !important
    }
    .mx-md-4{
        margin-right:1.5rem !important;
        margin-left:1.5rem !important
    }
    .mx-md-5{
        margin-right:3rem !important;
        margin-left:3rem !important
    }
    .mx-md-auto{
        margin-right:auto !important;
        margin-left:auto !important
    }
    .my-md-0{
        margin-top:0 !important;
        margin-bottom:0 !important
    }
    .my-md-1{
        margin-top:.25rem !important;
        margin-bottom:.25rem !important
    }
    .my-md-2{
        margin-top:.5rem !important;
        margin-bottom:.5rem !important
    }
    .my-md-3{
        margin-top:1rem !important;
        margin-bottom:1rem !important
    }
    .my-md-4{
        margin-top:1.5rem !important;
        margin-bottom:1.5rem !important
    }
    .my-md-5{
        margin-top:3rem !important;
        margin-bottom:3rem !important
    }
    .my-md-auto{
        margin-top:auto !important;
        margin-bottom:auto !important
    }
    .mt-md-0{
        margin-top:0 !important
    }
    .mt-md-1{
        margin-top:.25rem !important
    }
    .mt-md-2{
        margin-top:.5rem !important
    }
    .mt-md-3{
        margin-top:1rem !important
    }
    .mt-md-4{
        margin-top:1.5rem !important
    }
    .mt-md-5{
        margin-top:3rem !important
    }
    .mt-md-auto{
        margin-top:auto !important
    }
    .me-md-0{
        margin-right:0 !important
    }
    .me-md-1{
        margin-right:.25rem !important
    }
    .me-md-2{
        margin-right:.5rem !important
    }
    .me-md-3{
        margin-right:1rem !important
    }
    .me-md-4{
        margin-right:1.5rem !important
    }
    .me-md-5{
        margin-right:3rem !important
    }
    .me-md-auto{
        margin-right:auto !important
    }
    .mb-md-0{
        margin-bottom:0 !important
    }
    .mb-md-1{
        margin-bottom:.25rem !important
    }
    .mb-md-2{
        margin-bottom:.5rem !important
    }
    .mb-md-3{
        margin-bottom:1rem !important
    }
    .mb-md-4{
        margin-bottom:1.5rem !important
    }
    .mb-md-5{
        margin-bottom:3rem !important
    }
    .mb-md-auto{
        margin-bottom:auto !important
    }
    .ms-md-0{
        margin-left:0 !important
    }
    .ms-md-1{
        margin-left:.25rem !important
    }
    .ms-md-2{
        margin-left:.5rem !important
    }
    .ms-md-3{
        margin-left:1rem !important
    }
    .ms-md-4{
        margin-left:1.5rem !important
    }
    .ms-md-5{
        margin-left:3rem !important
    }
    .ms-md-auto{
        margin-left:auto !important
    }
    .m-md-n1{
        margin:-.25rem !important
    }
    .m-md-n2{
        margin:-.5rem !important
    }
    .m-md-n3{
        margin:-1rem !important
    }
    .m-md-n4{
        margin:-1.5rem !important
    }
    .m-md-n5{
        margin:-3rem !important
    }
    .mx-md-n1{
        margin-right:-.25rem !important;
        margin-left:-.25rem !important
    }
    .mx-md-n2{
        margin-right:-.5rem !important;
        margin-left:-.5rem !important
    }
    .mx-md-n3{
        margin-right:-1rem !important;
        margin-left:-1rem !important
    }
    .mx-md-n4{
        margin-right:-1.5rem !important;
        margin-left:-1.5rem !important
    }
    .mx-md-n5{
        margin-right:-3rem !important;
        margin-left:-3rem !important
    }
    .my-md-n1{
        margin-top:-.25rem !important;
        margin-bottom:-.25rem !important
    }
    .my-md-n2{
        margin-top:-.5rem !important;
        margin-bottom:-.5rem !important
    }
    .my-md-n3{
        margin-top:-1rem !important;
        margin-bottom:-1rem !important
    }
    .my-md-n4{
        margin-top:-1.5rem !important;
        margin-bottom:-1.5rem !important
    }
    .my-md-n5{
        margin-top:-3rem !important;
        margin-bottom:-3rem !important
    }
    .mt-md-n1{
        margin-top:-.25rem !important
    }
    .mt-md-n2{
        margin-top:-.5rem !important
    }
    .mt-md-n3{
        margin-top:-1rem !important
    }
    .mt-md-n4{
        margin-top:-1.5rem !important
    }
    .mt-md-n5{
        margin-top:-3rem !important
    }
    .me-md-n1{
        margin-right:-.25rem !important
    }
    .me-md-n2{
        margin-right:-.5rem !important
    }
    .me-md-n3{
        margin-right:-1rem !important
    }
    .me-md-n4{
        margin-right:-1.5rem !important
    }
    .me-md-n5{
        margin-right:-3rem !important
    }
    .mb-md-n1{
        margin-bottom:-.25rem !important
    }
    .mb-md-n2{
        margin-bottom:-.5rem !important
    }
    .mb-md-n3{
        margin-bottom:-1rem !important
    }
    .mb-md-n4{
        margin-bottom:-1.5rem !important
    }
    .mb-md-n5{
        margin-bottom:-3rem !important
    }
    .ms-md-n1{
        margin-left:-.25rem !important
    }
    .ms-md-n2{
        margin-left:-.5rem !important
    }
    .ms-md-n3{
        margin-left:-1rem !important
    }
    .ms-md-n4{
        margin-left:-1.5rem !important
    }
    .ms-md-n5{
        margin-left:-3rem !important
    }
    .p-md-0{
        padding:0 !important
    }
    .p-md-1{
        padding:.25rem !important
    }
    .p-md-2{
        padding:.5rem !important
    }
    .p-md-3{
        padding:1rem !important
    }
    .p-md-4{
        padding:1.5rem !important
    }
    .p-md-5{
        padding:3rem !important
    }
    .px-md-0{
        padding-right:0 !important;
        padding-left:0 !important
    }
    .px-md-1{
        padding-right:.25rem !important;
        padding-left:.25rem !important
    }
    .px-md-2{
        padding-right:.5rem !important;
        padding-left:.5rem !important
    }
    .px-md-3{
        padding-right:1rem !important;
        padding-left:1rem !important
    }
    .px-md-4{
        padding-right:1.5rem !important;
        padding-left:1.5rem !important
    }
    .px-md-5{
        padding-right:3rem !important;
        padding-left:3rem !important
    }
    .py-md-0{
        padding-top:0 !important;
        padding-bottom:0 !important
    }
    .py-md-1{
        padding-top:.25rem !important;
        padding-bottom:.25rem !important
    }
    .py-md-2{
        padding-top:.5rem !important;
        padding-bottom:.5rem !important
    }
    .py-md-3{
        padding-top:1rem !important;
        padding-bottom:1rem !important
    }
    .py-md-4{
        padding-top:1.5rem !important;
        padding-bottom:1.5rem !important
    }
    .py-md-5{
        padding-top:3rem !important;
        padding-bottom:3rem !important
    }
    .pt-md-0{
        padding-top:0 !important
    }
    .pt-md-1{
        padding-top:.25rem !important
    }
    .pt-md-2{
        padding-top:.5rem !important
    }
    .pt-md-3{
        padding-top:1rem !important
    }
    .pt-md-4{
        padding-top:1.5rem !important
    }
    .pt-md-5{
        padding-top:3rem !important
    }
    .pe-md-0{
        padding-right:0 !important
    }
    .pe-md-1{
        padding-right:.25rem !important
    }
    .pe-md-2{
        padding-right:.5rem !important
    }
    .pe-md-3{
        padding-right:1rem !important
    }
    .pe-md-4{
        padding-right:1.5rem !important
    }
    .pe-md-5{
        padding-right:3rem !important
    }
    .pb-md-0{
        padding-bottom:0 !important
    }
    .pb-md-1{
        padding-bottom:.25rem !important
    }
    .pb-md-2{
        padding-bottom:.5rem !important
    }
    .pb-md-3{
        padding-bottom:1rem !important
    }
    .pb-md-4{
        padding-bottom:1.5rem !important
    }
    .pb-md-5{
        padding-bottom:3rem !important
    }
    .ps-md-0{
        padding-left:0 !important
    }
    .ps-md-1{
        padding-left:.25rem !important
    }
    .ps-md-2{
        padding-left:.5rem !important
    }
    .ps-md-3{
        padding-left:1rem !important
    }
    .ps-md-4{
        padding-left:1.5rem !important
    }
    .ps-md-5{
        padding-left:3rem !important
    }
    .text-md-start{
        text-align:left !important
    }
    .text-md-end{
        text-align:right !important
    }
    .text-md-center{
        text-align:center !important
    }
}
@media (min-width: 992px){
    .float-lg-start{
        float:left !important
    }
    .float-lg-end{
        float:right !important
    }
    .float-lg-none{
        float:none !important
    }
    .d-lg-inline{
        display:inline !important
    }
    .d-lg-inline-block{
        display:inline-block !important
    }
    .d-lg-block{
        display:block !important
    }
    .d-lg-grid{
        display:grid !important
    }
    .d-lg-table{
        display:table !important
    }
    .d-lg-table-row{
        display:table-row !important
    }
    .d-lg-table-cell{
        display:table-cell !important
    }
    .d-lg-flex{
        display:flex !important
    }
    .d-lg-inline-flex{
        display:inline-flex !important
    }
    .d-lg-none{
        display:none !important
    }
    .flex-lg-fill{
        flex:1 1 auto !important
    }
    .flex-lg-row{
        flex-direction:row !important
    }
    .flex-lg-column{
        flex-direction:column !important
    }
    .flex-lg-row-reverse{
        flex-direction:row-reverse !important
    }
    .flex-lg-column-reverse{
        flex-direction:column-reverse !important
    }
    .flex-lg-grow-0{
        flex-grow:0 !important
    }
    .flex-lg-grow-1{
        flex-grow:1 !important
    }
    .flex-lg-shrink-0{
        flex-shrink:0 !important
    }
    .flex-lg-shrink-1{
        flex-shrink:1 !important
    }
    .flex-lg-wrap{
        flex-wrap:wrap !important
    }
    .flex-lg-nowrap{
        flex-wrap:nowrap !important
    }
    .flex-lg-wrap-reverse{
        flex-wrap:wrap-reverse !important
    }
    .gap-lg-0{
        gap:0 !important
    }
    .gap-lg-1{
        gap:.25rem !important
    }
    .gap-lg-2{
        gap:.5rem !important
    }
    .gap-lg-3{
        gap:1rem !important
    }
    .gap-lg-4{
        gap:1.5rem !important
    }
    .gap-lg-5{
        gap:3rem !important
    }
    .justify-content-lg-start{
        justify-content:flex-start !important
    }
    .justify-content-lg-end{
        justify-content:flex-end !important
    }
    .justify-content-lg-center{
        justify-content:center !important
    }
    .justify-content-lg-between{
        justify-content:space-between !important
    }
    .justify-content-lg-around{
        justify-content:space-around !important
    }
    .justify-content-lg-evenly{
        justify-content:space-evenly !important
    }
    .align-items-lg-start{
        align-items:flex-start !important
    }
    .align-items-lg-end{
        align-items:flex-end !important
    }
    .align-items-lg-center{
        align-items:center !important
    }
    .align-items-lg-baseline{
        align-items:baseline !important
    }
    .align-items-lg-stretch{
        align-items:stretch !important
    }
    .align-content-lg-start{
        align-content:flex-start !important
    }
    .align-content-lg-end{
        align-content:flex-end !important
    }
    .align-content-lg-center{
        align-content:center !important
    }
    .align-content-lg-between{
        align-content:space-between !important
    }
    .align-content-lg-around{
        align-content:space-around !important
    }
    .align-content-lg-stretch{
        align-content:stretch !important
    }
    .align-self-lg-auto{
        align-self:auto !important
    }
    .align-self-lg-start{
        align-self:flex-start !important
    }
    .align-self-lg-end{
        align-self:flex-end !important
    }
    .align-self-lg-center{
        align-self:center !important
    }
    .align-self-lg-baseline{
        align-self:baseline !important
    }
    .align-self-lg-stretch{
        align-self:stretch !important
    }
    .order-lg-first{
        order:-1 !important
    }
    .order-lg-0{
        order:0 !important
    }
    .order-lg-1{
        order:1 !important
    }
    .order-lg-2{
        order:2 !important
    }
    .order-lg-3{
        order:3 !important
    }
    .order-lg-4{
        order:4 !important
    }
    .order-lg-5{
        order:5 !important
    }
    .order-lg-last{
        order:6 !important
    }
    .m-lg-0{
        margin:0 !important
    }
    .m-lg-1{
        margin:.25rem !important
    }
    .m-lg-2{
        margin:.5rem !important
    }
    .m-lg-3{
        margin:1rem !important
    }
    .m-lg-4{
        margin:1.5rem !important
    }
    .m-lg-5{
        margin:3rem !important
    }
    .m-lg-auto{
        margin:auto !important
    }
    .mx-lg-0{
        margin-right:0 !important;
        margin-left:0 !important
    }
    .mx-lg-1{
        margin-right:.25rem !important;
        margin-left:.25rem !important
    }
    .mx-lg-2{
        margin-right:.5rem !important;
        margin-left:.5rem !important
    }
    .mx-lg-3{
        margin-right:1rem !important;
        margin-left:1rem !important
    }
    .mx-lg-4{
        margin-right:1.5rem !important;
        margin-left:1.5rem !important
    }
    .mx-lg-5{
        margin-right:3rem !important;
        margin-left:3rem !important
    }
    .mx-lg-auto{
        margin-right:auto !important;
        margin-left:auto !important
    }
    .my-lg-0{
        margin-top:0 !important;
        margin-bottom:0 !important
    }
    .my-lg-1{
        margin-top:.25rem !important;
        margin-bottom:.25rem !important
    }
    .my-lg-2{
        margin-top:.5rem !important;
        margin-bottom:.5rem !important
    }
    .my-lg-3{
        margin-top:1rem !important;
        margin-bottom:1rem !important
    }
    .my-lg-4{
        margin-top:1.5rem !important;
        margin-bottom:1.5rem !important
    }
    .my-lg-5{
        margin-top:3rem !important;
        margin-bottom:3rem !important
    }
    .my-lg-auto{
        margin-top:auto !important;
        margin-bottom:auto !important
    }
    .mt-lg-0{
        margin-top:0 !important
    }
    .mt-lg-1{
        margin-top:.25rem !important
    }
    .mt-lg-2{
        margin-top:.5rem !important
    }
    .mt-lg-3{
        margin-top:1rem !important
    }
    .mt-lg-4{
        margin-top:1.5rem !important
    }
    .mt-lg-5{
        margin-top:3rem !important
    }
    .mt-lg-auto{
        margin-top:auto !important
    }
    .me-lg-0{
        margin-right:0 !important
    }
    .me-lg-1{
        margin-right:.25rem !important
    }
    .me-lg-2{
        margin-right:.5rem !important
    }
    .me-lg-3{
        margin-right:1rem !important
    }
    .me-lg-4{
        margin-right:1.5rem !important
    }
    .me-lg-5{
        margin-right:3rem !important
    }
    .me-lg-auto{
        margin-right:auto !important
    }
    .mb-lg-0{
        margin-bottom:0 !important
    }
    .mb-lg-1{
        margin-bottom:.25rem !important
    }
    .mb-lg-2{
        margin-bottom:.5rem !important
    }
    .mb-lg-3{
        margin-bottom:1rem !important
    }
    .mb-lg-4{
        margin-bottom:1.5rem !important
    }
    .mb-lg-5{
        margin-bottom:3rem !important
    }
    .mb-lg-auto{
        margin-bottom:auto !important
    }
    .ms-lg-0{
        margin-left:0 !important
    }
    .ms-lg-1{
        margin-left:.25rem !important
    }
    .ms-lg-2{
        margin-left:.5rem !important
    }
    .ms-lg-3{
        margin-left:1rem !important
    }
    .ms-lg-4{
        margin-left:1.5rem !important
    }
    .ms-lg-5{
        margin-left:3rem !important
    }
    .ms-lg-auto{
        margin-left:auto !important
    }
    .m-lg-n1{
        margin:-.25rem !important
    }
    .m-lg-n2{
        margin:-.5rem !important
    }
    .m-lg-n3{
        margin:-1rem !important
    }
    .m-lg-n4{
        margin:-1.5rem !important
    }
    .m-lg-n5{
        margin:-3rem !important
    }
    .mx-lg-n1{
        margin-right:-.25rem !important;
        margin-left:-.25rem !important
    }
    .mx-lg-n2{
        margin-right:-.5rem !important;
        margin-left:-.5rem !important
    }
    .mx-lg-n3{
        margin-right:-1rem !important;
        margin-left:-1rem !important
    }
    .mx-lg-n4{
        margin-right:-1.5rem !important;
        margin-left:-1.5rem !important
    }
    .mx-lg-n5{
        margin-right:-3rem !important;
        margin-left:-3rem !important
    }
    .my-lg-n1{
        margin-top:-.25rem !important;
        margin-bottom:-.25rem !important
    }
    .my-lg-n2{
        margin-top:-.5rem !important;
        margin-bottom:-.5rem !important
    }
    .my-lg-n3{
        margin-top:-1rem !important;
        margin-bottom:-1rem !important
    }
    .my-lg-n4{
        margin-top:-1.5rem !important;
        margin-bottom:-1.5rem !important
    }
    .my-lg-n5{
        margin-top:-3rem !important;
        margin-bottom:-3rem !important
    }
    .mt-lg-n1{
        margin-top:-.25rem !important
    }
    .mt-lg-n2{
        margin-top:-.5rem !important
    }
    .mt-lg-n3{
        margin-top:-1rem !important
    }
    .mt-lg-n4{
        margin-top:-1.5rem !important
    }
    .mt-lg-n5{
        margin-top:-3rem !important
    }
    .me-lg-n1{
        margin-right:-.25rem !important
    }
    .me-lg-n2{
        margin-right:-.5rem !important
    }
    .me-lg-n3{
        margin-right:-1rem !important
    }
    .me-lg-n4{
        margin-right:-1.5rem !important
    }
    .me-lg-n5{
        margin-right:-3rem !important
    }
    .mb-lg-n1{
        margin-bottom:-.25rem !important
    }
    .mb-lg-n2{
        margin-bottom:-.5rem !important
    }
    .mb-lg-n3{
        margin-bottom:-1rem !important
    }
    .mb-lg-n4{
        margin-bottom:-1.5rem !important
    }
    .mb-lg-n5{
        margin-bottom:-3rem !important
    }
    .ms-lg-n1{
        margin-left:-.25rem !important
    }
    .ms-lg-n2{
        margin-left:-.5rem !important
    }
    .ms-lg-n3{
        margin-left:-1rem !important
    }
    .ms-lg-n4{
        margin-left:-1.5rem !important
    }
    .ms-lg-n5{
        margin-left:-3rem !important
    }
    .p-lg-0{
        padding:0 !important
    }
    .p-lg-1{
        padding:.25rem !important
    }
    .p-lg-2{
        padding:.5rem !important
    }
    .p-lg-3{
        padding:1rem !important
    }
    .p-lg-4{
        padding:1.5rem !important
    }
    .p-lg-5{
        padding:3rem !important
    }
    .px-lg-0{
        padding-right:0 !important;
        padding-left:0 !important
    }
    .px-lg-1{
        padding-right:.25rem !important;
        padding-left:.25rem !important
    }
    .px-lg-2{
        padding-right:.5rem !important;
        padding-left:.5rem !important
    }
    .px-lg-3{
        padding-right:1rem !important;
        padding-left:1rem !important
    }
    .px-lg-4{
        padding-right:1.5rem !important;
        padding-left:1.5rem !important
    }
    .px-lg-5{
        padding-right:3rem !important;
        padding-left:3rem !important
    }
    .py-lg-0{
        padding-top:0 !important;
        padding-bottom:0 !important
    }
    .py-lg-1{
        padding-top:.25rem !important;
        padding-bottom:.25rem !important
    }
    .py-lg-2{
        padding-top:.5rem !important;
        padding-bottom:.5rem !important
    }
    .py-lg-3{
        padding-top:1rem !important;
        padding-bottom:1rem !important
    }
    .py-lg-4{
        padding-top:1.5rem !important;
        padding-bottom:1.5rem !important
    }
    .py-lg-5{
        padding-top:3rem !important;
        padding-bottom:3rem !important
    }
    .pt-lg-0{
        padding-top:0 !important
    }
    .pt-lg-1{
        padding-top:.25rem !important
    }
    .pt-lg-2{
        padding-top:.5rem !important
    }
    .pt-lg-3{
        padding-top:1rem !important
    }
    .pt-lg-4{
        padding-top:1.5rem !important
    }
    .pt-lg-5{
        padding-top:3rem !important
    }
    .pe-lg-0{
        padding-right:0 !important
    }
    .pe-lg-1{
        padding-right:.25rem !important
    }
    .pe-lg-2{
        padding-right:.5rem !important
    }
    .pe-lg-3{
        padding-right:1rem !important
    }
    .pe-lg-4{
        padding-right:1.5rem !important
    }
    .pe-lg-5{
        padding-right:3rem !important
    }
    .pb-lg-0{
        padding-bottom:0 !important
    }
    .pb-lg-1{
        padding-bottom:.25rem !important
    }
    .pb-lg-2{
        padding-bottom:.5rem !important
    }
    .pb-lg-3{
        padding-bottom:1rem !important
    }
    .pb-lg-4{
        padding-bottom:1.5rem !important
    }
    .pb-lg-5{
        padding-bottom:3rem !important
    }
    .ps-lg-0{
        padding-left:0 !important
    }
    .ps-lg-1{
        padding-left:.25rem !important
    }
    .ps-lg-2{
        padding-left:.5rem !important
    }
    .ps-lg-3{
        padding-left:1rem !important
    }
    .ps-lg-4{
        padding-left:1.5rem !important
    }
    .ps-lg-5{
        padding-left:3rem !important
    }
    .text-lg-start{
        text-align:left !important
    }
    .text-lg-end{
        text-align:right !important
    }
    .text-lg-center{
        text-align:center !important
    }
}
@media (min-width: 1200px){
    .float-xl-start{
        float:left !important
    }
    .float-xl-end{
        float:right !important
    }
    .float-xl-none{
        float:none !important
    }
    .d-xl-inline{
        display:inline !important
    }
    .d-xl-inline-block{
        display:inline-block !important
    }
    .d-xl-block{
        display:block !important
    }
    .d-xl-grid{
        display:grid !important
    }
    .d-xl-table{
        display:table !important
    }
    .d-xl-table-row{
        display:table-row !important
    }
    .d-xl-table-cell{
        display:table-cell !important
    }
    .d-xl-flex{
        display:flex !important
    }
    .d-xl-inline-flex{
        display:inline-flex !important
    }
    .d-xl-none{
        display:none !important
    }
    .flex-xl-fill{
        flex:1 1 auto !important
    }
    .flex-xl-row{
        flex-direction:row !important
    }
    .flex-xl-column{
        flex-direction:column !important
    }
    .flex-xl-row-reverse{
        flex-direction:row-reverse !important
    }
    .flex-xl-column-reverse{
        flex-direction:column-reverse !important
    }
    .flex-xl-grow-0{
        flex-grow:0 !important
    }
    .flex-xl-grow-1{
        flex-grow:1 !important
    }
    .flex-xl-shrink-0{
        flex-shrink:0 !important
    }
    .flex-xl-shrink-1{
        flex-shrink:1 !important
    }
    .flex-xl-wrap{
        flex-wrap:wrap !important
    }
    .flex-xl-nowrap{
        flex-wrap:nowrap !important
    }
    .flex-xl-wrap-reverse{
        flex-wrap:wrap-reverse !important
    }
    .gap-xl-0{
        gap:0 !important
    }
    .gap-xl-1{
        gap:.25rem !important
    }
    .gap-xl-2{
        gap:.5rem !important
    }
    .gap-xl-3{
        gap:1rem !important
    }
    .gap-xl-4{
        gap:1.5rem !important
    }
    .gap-xl-5{
        gap:3rem !important
    }
    .justify-content-xl-start{
        justify-content:flex-start !important
    }
    .justify-content-xl-end{
        justify-content:flex-end !important
    }
    .justify-content-xl-center{
        justify-content:center !important
    }
    .justify-content-xl-between{
        justify-content:space-between !important
    }
    .justify-content-xl-around{
        justify-content:space-around !important
    }
    .justify-content-xl-evenly{
        justify-content:space-evenly !important
    }
    .align-items-xl-start{
        align-items:flex-start !important
    }
    .align-items-xl-end{
        align-items:flex-end !important
    }
    .align-items-xl-center{
        align-items:center !important
    }
    .align-items-xl-baseline{
        align-items:baseline !important
    }
    .align-items-xl-stretch{
        align-items:stretch !important
    }
    .align-content-xl-start{
        align-content:flex-start !important
    }
    .align-content-xl-end{
        align-content:flex-end !important
    }
    .align-content-xl-center{
        align-content:center !important
    }
    .align-content-xl-between{
        align-content:space-between !important
    }
    .align-content-xl-around{
        align-content:space-around !important
    }
    .align-content-xl-stretch{
        align-content:stretch !important
    }
    .align-self-xl-auto{
        align-self:auto !important
    }
    .align-self-xl-start{
        align-self:flex-start !important
    }
    .align-self-xl-end{
        align-self:flex-end !important
    }
    .align-self-xl-center{
        align-self:center !important
    }
    .align-self-xl-baseline{
        align-self:baseline !important
    }
    .align-self-xl-stretch{
        align-self:stretch !important
    }
    .order-xl-first{
        order:-1 !important
    }
    .order-xl-0{
        order:0 !important
    }
    .order-xl-1{
        order:1 !important
    }
    .order-xl-2{
        order:2 !important
    }
    .order-xl-3{
        order:3 !important
    }
    .order-xl-4{
        order:4 !important
    }
    .order-xl-5{
        order:5 !important
    }
    .order-xl-last{
        order:6 !important
    }
    .m-xl-0{
        margin:0 !important
    }
    .m-xl-1{
        margin:.25rem !important
    }
    .m-xl-2{
        margin:.5rem !important
    }
    .m-xl-3{
        margin:1rem !important
    }
    .m-xl-4{
        margin:1.5rem !important
    }
    .m-xl-5{
        margin:3rem !important
    }
    .m-xl-auto{
        margin:auto !important
    }
    .mx-xl-0{
        margin-right:0 !important;
        margin-left:0 !important
    }
    .mx-xl-1{
        margin-right:.25rem !important;
        margin-left:.25rem !important
    }
    .mx-xl-2{
        margin-right:.5rem !important;
        margin-left:.5rem !important
    }
    .mx-xl-3{
        margin-right:1rem !important;
        margin-left:1rem !important
    }
    .mx-xl-4{
        margin-right:1.5rem !important;
        margin-left:1.5rem !important
    }
    .mx-xl-5{
        margin-right:3rem !important;
        margin-left:3rem !important
    }
    .mx-xl-auto{
        margin-right:auto !important;
        margin-left:auto !important
    }
    .my-xl-0{
        margin-top:0 !important;
        margin-bottom:0 !important
    }
    .my-xl-1{
        margin-top:.25rem !important;
        margin-bottom:.25rem !important
    }
    .my-xl-2{
        margin-top:.5rem !important;
        margin-bottom:.5rem !important
    }
    .my-xl-3{
        margin-top:1rem !important;
        margin-bottom:1rem !important
    }
    .my-xl-4{
        margin-top:1.5rem !important;
        margin-bottom:1.5rem !important
    }
    .my-xl-5{
        margin-top:3rem !important;
        margin-bottom:3rem !important
    }
    .my-xl-auto{
        margin-top:auto !important;
        margin-bottom:auto !important
    }
    .mt-xl-0{
        margin-top:0 !important
    }
    .mt-xl-1{
        margin-top:.25rem !important
    }
    .mt-xl-2{
        margin-top:.5rem !important
    }
    .mt-xl-3{
        margin-top:1rem !important
    }
    .mt-xl-4{
        margin-top:1.5rem !important
    }
    .mt-xl-5{
        margin-top:3rem !important
    }
    .mt-xl-auto{
        margin-top:auto !important
    }
    .me-xl-0{
        margin-right:0 !important
    }
    .me-xl-1{
        margin-right:.25rem !important
    }
    .me-xl-2{
        margin-right:.5rem !important
    }
    .me-xl-3{
        margin-right:1rem !important
    }
    .me-xl-4{
        margin-right:1.5rem !important
    }
    .me-xl-5{
        margin-right:3rem !important
    }
    .me-xl-auto{
        margin-right:auto !important
    }
    .mb-xl-0{
        margin-bottom:0 !important
    }
    .mb-xl-1{
        margin-bottom:.25rem !important
    }
    .mb-xl-2{
        margin-bottom:.5rem !important
    }
    .mb-xl-3{
        margin-bottom:1rem !important
    }
    .mb-xl-4{
        margin-bottom:1.5rem !important
    }
    .mb-xl-5{
        margin-bottom:3rem !important
    }
    .mb-xl-auto{
        margin-bottom:auto !important
    }
    .ms-xl-0{
        margin-left:0 !important
    }
    .ms-xl-1{
        margin-left:.25rem !important
    }
    .ms-xl-2{
        margin-left:.5rem !important
    }
    .ms-xl-3{
        margin-left:1rem !important
    }
    .ms-xl-4{
        margin-left:1.5rem !important
    }
    .ms-xl-5{
        margin-left:3rem !important
    }
    .ms-xl-auto{
        margin-left:auto !important
    }
    .m-xl-n1{
        margin:-.25rem !important
    }
    .m-xl-n2{
        margin:-.5rem !important
    }
    .m-xl-n3{
        margin:-1rem !important
    }
    .m-xl-n4{
        margin:-1.5rem !important
    }
    .m-xl-n5{
        margin:-3rem !important
    }
    .mx-xl-n1{
        margin-right:-.25rem !important;
        margin-left:-.25rem !important
    }
    .mx-xl-n2{
        margin-right:-.5rem !important;
        margin-left:-.5rem !important
    }
    .mx-xl-n3{
        margin-right:-1rem !important;
        margin-left:-1rem !important
    }
    .mx-xl-n4{
        margin-right:-1.5rem !important;
        margin-left:-1.5rem !important
    }
    .mx-xl-n5{
        margin-right:-3rem !important;
        margin-left:-3rem !important
    }
    .my-xl-n1{
        margin-top:-.25rem !important;
        margin-bottom:-.25rem !important
    }
    .my-xl-n2{
        margin-top:-.5rem !important;
        margin-bottom:-.5rem !important
    }
    .my-xl-n3{
        margin-top:-1rem !important;
        margin-bottom:-1rem !important
    }
    .my-xl-n4{
        margin-top:-1.5rem !important;
        margin-bottom:-1.5rem !important
    }
    .my-xl-n5{
        margin-top:-3rem !important;
        margin-bottom:-3rem !important
    }
    .mt-xl-n1{
        margin-top:-.25rem !important
    }
    .mt-xl-n2{
        margin-top:-.5rem !important
    }
    .mt-xl-n3{
        margin-top:-1rem !important
    }
    .mt-xl-n4{
        margin-top:-1.5rem !important
    }
    .mt-xl-n5{
        margin-top:-3rem !important
    }
    .me-xl-n1{
        margin-right:-.25rem !important
    }
    .me-xl-n2{
        margin-right:-.5rem !important
    }
    .me-xl-n3{
        margin-right:-1rem !important
    }
    .me-xl-n4{
        margin-right:-1.5rem !important
    }
    .me-xl-n5{
        margin-right:-3rem !important
    }
    .mb-xl-n1{
        margin-bottom:-.25rem !important
    }
    .mb-xl-n2{
        margin-bottom:-.5rem !important
    }
    .mb-xl-n3{
        margin-bottom:-1rem !important
    }
    .mb-xl-n4{
        margin-bottom:-1.5rem !important
    }
    .mb-xl-n5{
        margin-bottom:-3rem !important
    }
    .ms-xl-n1{
        margin-left:-.25rem !important
    }
    .ms-xl-n2{
        margin-left:-.5rem !important
    }
    .ms-xl-n3{
        margin-left:-1rem !important
    }
    .ms-xl-n4{
        margin-left:-1.5rem !important
    }
    .ms-xl-n5{
        margin-left:-3rem !important
    }
    .p-xl-0{
        padding:0 !important
    }
    .p-xl-1{
        padding:.25rem !important
    }
    .p-xl-2{
        padding:.5rem !important
    }
    .p-xl-3{
        padding:1rem !important
    }
    .p-xl-4{
        padding:1.5rem !important
    }
    .p-xl-5{
        padding:3rem !important
    }
    .px-xl-0{
        padding-right:0 !important;
        padding-left:0 !important
    }
    .px-xl-1{
        padding-right:.25rem !important;
        padding-left:.25rem !important
    }
    .px-xl-2{
        padding-right:.5rem !important;
        padding-left:.5rem !important
    }
    .px-xl-3{
        padding-right:1rem !important;
        padding-left:1rem !important
    }
    .px-xl-4{
        padding-right:1.5rem !important;
        padding-left:1.5rem !important
    }
    .px-xl-5{
        padding-right:3rem !important;
        padding-left:3rem !important
    }
    .py-xl-0{
        padding-top:0 !important;
        padding-bottom:0 !important
    }
    .py-xl-1{
        padding-top:.25rem !important;
        padding-bottom:.25rem !important
    }
    .py-xl-2{
        padding-top:.5rem !important;
        padding-bottom:.5rem !important
    }
    .py-xl-3{
        padding-top:1rem !important;
        padding-bottom:1rem !important
    }
    .py-xl-4{
        padding-top:1.5rem !important;
        padding-bottom:1.5rem !important
    }
    .py-xl-5{
        padding-top:3rem !important;
        padding-bottom:3rem !important
    }
    .pt-xl-0{
        padding-top:0 !important
    }
    .pt-xl-1{
        padding-top:.25rem !important
    }
    .pt-xl-2{
        padding-top:.5rem !important
    }
    .pt-xl-3{
        padding-top:1rem !important
    }
    .pt-xl-4{
        padding-top:1.5rem !important
    }
    .pt-xl-5{
        padding-top:3rem !important
    }
    .pe-xl-0{
        padding-right:0 !important
    }
    .pe-xl-1{
        padding-right:.25rem !important
    }
    .pe-xl-2{
        padding-right:.5rem !important
    }
    .pe-xl-3{
        padding-right:1rem !important
    }
    .pe-xl-4{
        padding-right:1.5rem !important
    }
    .pe-xl-5{
        padding-right:3rem !important
    }
    .pb-xl-0{
        padding-bottom:0 !important
    }
    .pb-xl-1{
        padding-bottom:.25rem !important
    }
    .pb-xl-2{
        padding-bottom:.5rem !important
    }
    .pb-xl-3{
        padding-bottom:1rem !important
    }
    .pb-xl-4{
        padding-bottom:1.5rem !important
    }
    .pb-xl-5{
        padding-bottom:3rem !important
    }
    .ps-xl-0{
        padding-left:0 !important
    }
    .ps-xl-1{
        padding-left:.25rem !important
    }
    .ps-xl-2{
        padding-left:.5rem !important
    }
    .ps-xl-3{
        padding-left:1rem !important
    }
    .ps-xl-4{
        padding-left:1.5rem !important
    }
    .ps-xl-5{
        padding-left:3rem !important
    }
    .text-xl-start{
        text-align:left !important
    }
    .text-xl-end{
        text-align:right !important
    }
    .text-xl-center{
        text-align:center !important
    }
}
@media (min-width: 1400px){
    .float-xxl-start{
        float:left !important
    }
    .float-xxl-end{
        float:right !important
    }
    .float-xxl-none{
        float:none !important
    }
    .d-xxl-inline{
        display:inline !important
    }
    .d-xxl-inline-block{
        display:inline-block !important
    }
    .d-xxl-block{
        display:block !important
    }
    .d-xxl-grid{
        display:grid !important
    }
    .d-xxl-table{
        display:table !important
    }
    .d-xxl-table-row{
        display:table-row !important
    }
    .d-xxl-table-cell{
        display:table-cell !important
    }
    .d-xxl-flex{
        display:flex !important
    }
    .d-xxl-inline-flex{
        display:inline-flex !important
    }
    .d-xxl-none{
        display:none !important
    }
    .flex-xxl-fill{
        flex:1 1 auto !important
    }
    .flex-xxl-row{
        flex-direction:row !important
    }
    .flex-xxl-column{
        flex-direction:column !important
    }
    .flex-xxl-row-reverse{
        flex-direction:row-reverse !important
    }
    .flex-xxl-column-reverse{
        flex-direction:column-reverse !important
    }
    .flex-xxl-grow-0{
        flex-grow:0 !important
    }
    .flex-xxl-grow-1{
        flex-grow:1 !important
    }
    .flex-xxl-shrink-0{
        flex-shrink:0 !important
    }
    .flex-xxl-shrink-1{
        flex-shrink:1 !important
    }
    .flex-xxl-wrap{
        flex-wrap:wrap !important
    }
    .flex-xxl-nowrap{
        flex-wrap:nowrap !important
    }
    .flex-xxl-wrap-reverse{
        flex-wrap:wrap-reverse !important
    }
    .gap-xxl-0{
        gap:0 !important
    }
    .gap-xxl-1{
        gap:.25rem !important
    }
    .gap-xxl-2{
        gap:.5rem !important
    }
    .gap-xxl-3{
        gap:1rem !important
    }
    .gap-xxl-4{
        gap:1.5rem !important
    }
    .gap-xxl-5{
        gap:3rem !important
    }
    .justify-content-xxl-start{
        justify-content:flex-start !important
    }
    .justify-content-xxl-end{
        justify-content:flex-end !important
    }
    .justify-content-xxl-center{
        justify-content:center !important
    }
    .justify-content-xxl-between{
        justify-content:space-between !important
    }
    .justify-content-xxl-around{
        justify-content:space-around !important
    }
    .justify-content-xxl-evenly{
        justify-content:space-evenly !important
    }
    .align-items-xxl-start{
        align-items:flex-start !important
    }
    .align-items-xxl-end{
        align-items:flex-end !important
    }
    .align-items-xxl-center{
        align-items:center !important
    }
    .align-items-xxl-baseline{
        align-items:baseline !important
    }
    .align-items-xxl-stretch{
        align-items:stretch !important
    }
    .align-content-xxl-start{
        align-content:flex-start !important
    }
    .align-content-xxl-end{
        align-content:flex-end !important
    }
    .align-content-xxl-center{
        align-content:center !important
    }
    .align-content-xxl-between{
        align-content:space-between !important
    }
    .align-content-xxl-around{
        align-content:space-around !important
    }
    .align-content-xxl-stretch{
        align-content:stretch !important
    }
    .align-self-xxl-auto{
        align-self:auto !important
    }
    .align-self-xxl-start{
        align-self:flex-start !important
    }
    .align-self-xxl-end{
        align-self:flex-end !important
    }
    .align-self-xxl-center{
        align-self:center !important
    }
    .align-self-xxl-baseline{
        align-self:baseline !important
    }
    .align-self-xxl-stretch{
        align-self:stretch !important
    }
    .order-xxl-first{
        order:-1 !important
    }
    .order-xxl-0{
        order:0 !important
    }
    .order-xxl-1{
        order:1 !important
    }
    .order-xxl-2{
        order:2 !important
    }
    .order-xxl-3{
        order:3 !important
    }
    .order-xxl-4{
        order:4 !important
    }
    .order-xxl-5{
        order:5 !important
    }
    .order-xxl-last{
        order:6 !important
    }
    .m-xxl-0{
        margin:0 !important
    }
    .m-xxl-1{
        margin:.25rem !important
    }
    .m-xxl-2{
        margin:.5rem !important
    }
    .m-xxl-3{
        margin:1rem !important
    }
    .m-xxl-4{
        margin:1.5rem !important
    }
    .m-xxl-5{
        margin:3rem !important
    }
    .m-xxl-auto{
        margin:auto !important
    }
    .mx-xxl-0{
        margin-right:0 !important;
        margin-left:0 !important
    }
    .mx-xxl-1{
        margin-right:.25rem !important;
        margin-left:.25rem !important
    }
    .mx-xxl-2{
        margin-right:.5rem !important;
        margin-left:.5rem !important
    }
    .mx-xxl-3{
        margin-right:1rem !important;
        margin-left:1rem !important
    }
    .mx-xxl-4{
        margin-right:1.5rem !important;
        margin-left:1.5rem !important
    }
    .mx-xxl-5{
        margin-right:3rem !important;
        margin-left:3rem !important
    }
    .mx-xxl-auto{
        margin-right:auto !important;
        margin-left:auto !important
    }
    .my-xxl-0{
        margin-top:0 !important;
        margin-bottom:0 !important
    }
    .my-xxl-1{
        margin-top:.25rem !important;
        margin-bottom:.25rem !important
    }
    .my-xxl-2{
        margin-top:.5rem !important;
        margin-bottom:.5rem !important
    }
    .my-xxl-3{
        margin-top:1rem !important;
        margin-bottom:1rem !important
    }
    .my-xxl-4{
        margin-top:1.5rem !important;
        margin-bottom:1.5rem !important
    }
    .my-xxl-5{
        margin-top:3rem !important;
        margin-bottom:3rem !important
    }
    .my-xxl-auto{
        margin-top:auto !important;
        margin-bottom:auto !important
    }
    .mt-xxl-0{
        margin-top:0 !important
    }
    .mt-xxl-1{
        margin-top:.25rem !important
    }
    .mt-xxl-2{
        margin-top:.5rem !important
    }
    .mt-xxl-3{
        margin-top:1rem !important
    }
    .mt-xxl-4{
        margin-top:1.5rem !important
    }
    .mt-xxl-5{
        margin-top:3rem !important
    }
    .mt-xxl-auto{
        margin-top:auto !important
    }
    .me-xxl-0{
        margin-right:0 !important
    }
    .me-xxl-1{
        margin-right:.25rem !important
    }
    .me-xxl-2{
        margin-right:.5rem !important
    }
    .me-xxl-3{
        margin-right:1rem !important
    }
    .me-xxl-4{
        margin-right:1.5rem !important
    }
    .me-xxl-5{
        margin-right:3rem !important
    }
    .me-xxl-auto{
        margin-right:auto !important
    }
    .mb-xxl-0{
        margin-bottom:0 !important
    }
    .mb-xxl-1{
        margin-bottom:.25rem !important
    }
    .mb-xxl-2{
        margin-bottom:.5rem !important
    }
    .mb-xxl-3{
        margin-bottom:1rem !important
    }
    .mb-xxl-4{
        margin-bottom:1.5rem !important
    }
    .mb-xxl-5{
        margin-bottom:3rem !important
    }
    .mb-xxl-auto{
        margin-bottom:auto !important
    }
    .ms-xxl-0{
        margin-left:0 !important
    }
    .ms-xxl-1{
        margin-left:.25rem !important
    }
    .ms-xxl-2{
        margin-left:.5rem !important
    }
    .ms-xxl-3{
        margin-left:1rem !important
    }
    .ms-xxl-4{
        margin-left:1.5rem !important
    }
    .ms-xxl-5{
        margin-left:3rem !important
    }
    .ms-xxl-auto{
        margin-left:auto !important
    }
    .m-xxl-n1{
        margin:-.25rem !important
    }
    .m-xxl-n2{
        margin:-.5rem !important
    }
    .m-xxl-n3{
        margin:-1rem !important
    }
    .m-xxl-n4{
        margin:-1.5rem !important
    }
    .m-xxl-n5{
        margin:-3rem !important
    }
    .mx-xxl-n1{
        margin-right:-.25rem !important;
        margin-left:-.25rem !important
    }
    .mx-xxl-n2{
        margin-right:-.5rem !important;
        margin-left:-.5rem !important
    }
    .mx-xxl-n3{
        margin-right:-1rem !important;
        margin-left:-1rem !important
    }
    .mx-xxl-n4{
        margin-right:-1.5rem !important;
        margin-left:-1.5rem !important
    }
    .mx-xxl-n5{
        margin-right:-3rem !important;
        margin-left:-3rem !important
    }
    .my-xxl-n1{
        margin-top:-.25rem !important;
        margin-bottom:-.25rem !important
    }
    .my-xxl-n2{
        margin-top:-.5rem !important;
        margin-bottom:-.5rem !important
    }
    .my-xxl-n3{
        margin-top:-1rem !important;
        margin-bottom:-1rem !important
    }
    .my-xxl-n4{
        margin-top:-1.5rem !important;
        margin-bottom:-1.5rem !important
    }
    .my-xxl-n5{
        margin-top:-3rem !important;
        margin-bottom:-3rem !important
    }
    .mt-xxl-n1{
        margin-top:-.25rem !important
    }
    .mt-xxl-n2{
        margin-top:-.5rem !important
    }
    .mt-xxl-n3{
        margin-top:-1rem !important
    }
    .mt-xxl-n4{
        margin-top:-1.5rem !important
    }
    .mt-xxl-n5{
        margin-top:-3rem !important
    }
    .me-xxl-n1{
        margin-right:-.25rem !important
    }
    .me-xxl-n2{
        margin-right:-.5rem !important
    }
    .me-xxl-n3{
        margin-right:-1rem !important
    }
    .me-xxl-n4{
        margin-right:-1.5rem !important
    }
    .me-xxl-n5{
        margin-right:-3rem !important
    }
    .mb-xxl-n1{
        margin-bottom:-.25rem !important
    }
    .mb-xxl-n2{
        margin-bottom:-.5rem !important
    }
    .mb-xxl-n3{
        margin-bottom:-1rem !important
    }
    .mb-xxl-n4{
        margin-bottom:-1.5rem !important
    }
    .mb-xxl-n5{
        margin-bottom:-3rem !important
    }
    .ms-xxl-n1{
        margin-left:-.25rem !important
    }
    .ms-xxl-n2{
        margin-left:-.5rem !important
    }
    .ms-xxl-n3{
        margin-left:-1rem !important
    }
    .ms-xxl-n4{
        margin-left:-1.5rem !important
    }
    .ms-xxl-n5{
        margin-left:-3rem !important
    }
    .p-xxl-0{
        padding:0 !important
    }
    .p-xxl-1{
        padding:.25rem !important
    }
    .p-xxl-2{
        padding:.5rem !important
    }
    .p-xxl-3{
        padding:1rem !important
    }
    .p-xxl-4{
        padding:1.5rem !important
    }
    .p-xxl-5{
        padding:3rem !important
    }
    .px-xxl-0{
        padding-right:0 !important;
        padding-left:0 !important
    }
    .px-xxl-1{
        padding-right:.25rem !important;
        padding-left:.25rem !important
    }
    .px-xxl-2{
        padding-right:.5rem !important;
        padding-left:.5rem !important
    }
    .px-xxl-3{
        padding-right:1rem !important;
        padding-left:1rem !important
    }
    .px-xxl-4{
        padding-right:1.5rem !important;
        padding-left:1.5rem !important
    }
    .px-xxl-5{
        padding-right:3rem !important;
        padding-left:3rem !important
    }
    .py-xxl-0{
        padding-top:0 !important;
        padding-bottom:0 !important
    }
    .py-xxl-1{
        padding-top:.25rem !important;
        padding-bottom:.25rem !important
    }
    .py-xxl-2{
        padding-top:.5rem !important;
        padding-bottom:.5rem !important
    }
    .py-xxl-3{
        padding-top:1rem !important;
        padding-bottom:1rem !important
    }
    .py-xxl-4{
        padding-top:1.5rem !important;
        padding-bottom:1.5rem !important
    }
    .py-xxl-5{
        padding-top:3rem !important;
        padding-bottom:3rem !important
    }
    .pt-xxl-0{
        padding-top:0 !important
    }
    .pt-xxl-1{
        padding-top:.25rem !important
    }
    .pt-xxl-2{
        padding-top:.5rem !important
    }
    .pt-xxl-3{
        padding-top:1rem !important
    }
    .pt-xxl-4{
        padding-top:1.5rem !important
    }
    .pt-xxl-5{
        padding-top:3rem !important
    }
    .pe-xxl-0{
        padding-right:0 !important
    }
    .pe-xxl-1{
        padding-right:.25rem !important
    }
    .pe-xxl-2{
        padding-right:.5rem !important
    }
    .pe-xxl-3{
        padding-right:1rem !important
    }
    .pe-xxl-4{
        padding-right:1.5rem !important
    }
    .pe-xxl-5{
        padding-right:3rem !important
    }
    .pb-xxl-0{
        padding-bottom:0 !important
    }
    .pb-xxl-1{
        padding-bottom:.25rem !important
    }
    .pb-xxl-2{
        padding-bottom:.5rem !important
    }
    .pb-xxl-3{
        padding-bottom:1rem !important
    }
    .pb-xxl-4{
        padding-bottom:1.5rem !important
    }
    .pb-xxl-5{
        padding-bottom:3rem !important
    }
    .ps-xxl-0{
        padding-left:0 !important
    }
    .ps-xxl-1{
        padding-left:.25rem !important
    }
    .ps-xxl-2{
        padding-left:.5rem !important
    }
    .ps-xxl-3{
        padding-left:1rem !important
    }
    .ps-xxl-4{
        padding-left:1.5rem !important
    }
    .ps-xxl-5{
        padding-left:3rem !important
    }
    .text-xxl-start{
        text-align:left !important
    }
    .text-xxl-end{
        text-align:right !important
    }
    .text-xxl-center{
        text-align:center !important
    }
}
@media (min-width: 1200px){
    .fs-1{
        font-size:2.5rem !important
    }
    .fs-2{
        font-size:2rem !important
    }
    .fs-3{
        font-size:1.75rem !important
    }
    .fs-4{
        font-size:1.5rem !important
    }
}
@media print{
    .d-print-inline{
        display:inline !important
    }
    .d-print-inline-block{
        display:inline-block !important
    }
    .d-print-block{
        display:block !important
    }
    .d-print-grid{
        display:grid !important
    }
    .d-print-table{
        display:table !important
    }
    .d-print-table-row{
        display:table-row !important
    }
    .d-print-table-cell{
        display:table-cell !important
    }
    .d-print-flex{
        display:flex !important
    }
    .d-print-inline-flex{
        display:inline-flex !important
    }
    .d-print-none{
        display:none !important
    }
}
 
</style>
