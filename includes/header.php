<?php
    include 'lib/Database.php';
    include 'helpers/Format.php';

    spl_autoload_register(function($class){
        include_once "classes/".$class.".php";
    });

    $db = new Database();
    $fm = new Format();
    $vd = new Videos();
    $pl = new Playlist();
    $nw = new News();
    $ct = new Category();

    error_reporting(0);

?>

<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
    header("Cache-Control: max-age=2592000");
?>


<!doctype html>
<html class="no-js" lang="zxx">
    
<!-- Mirrored from demo.hasthemes.com/videodune-preview/videodune/about-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Dec 2019 04:11:26 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Roaring Bangladesh</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- favicon
============================================ -->		
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

<!-- All css files are included here
============================================ -->  		
<link rel="stylesheet" href="css/bootstrap.min.css"> 
<link rel="stylesheet" href="css/icofont.css">
<link rel="stylesheet" href="css/core.css">     
<link rel="stylesheet" href="css/meanmenu.css">     
<link rel="stylesheet" href="css/magnific-popup.css">  
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/responsive.css">

<!-- Modernizr JS -->
<script src="js/vendor/modernizr-2.8.3.min.js"></script>    
</head>  
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience</p>
<![endif]-->  
<!--Main Wrapper Start-->
<div class="wrapper bg-white fix">
    <!--Bg White Start-->
<div class="bg-white">
<!--Header Area Start-->
<header class="header-area">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12 col-sm-6">
                <!--You can write something in this div-->
                </div>
                <div class="col-md-6 col-12 col-sm-6">
                    <div class="top-right">
 <?php                                       
 $query=mysqli_query($con,"select * from tblcontact");
while($row=mysqli_fetch_array($query))
{
?>  
                                        
                                        <ul>
                                            <li><a href="<?php echo htmlentities($row['youtube']);?>"><i class="icofont icofont-social-youtube"></i></a></li>
                                            <li><a href="<?php echo htmlentities($row['facebook']);?>"><i class="icofont icofont-social-facebook"></i></a></li>
                                            <li><a href="<?php echo htmlentities($row['linkedIn']);?>"><i class="icofont icofont-social-linkedin"></i></a></li>
                                            <li><a href="<?php echo htmlentities($row['instragram']);?>"><i class="icofont icofont-social-instagram"></i></a></li>
                                            <li><a href="<?php echo htmlentities($row['twitter']);?>"><i class="icofont icofont-social-twitter"></i></a></li>
                                            
                                            
                                        </ul>
                     <?php } ?>
                                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-logo-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-8">
                    <div class="header-logo">
                        <a href="index.php"><h3 class="animated"><span>Roaring Bangladesh</h3></a>
                    </div>
                </div>

<?php
$path = $_SERVER['SCRIPT_FILENAME'];
$currentpage = basename($path, '.php');
?>

                <div class="col-lg-9 col-12">
                    <div class="main-menu text-right">
                        <nav>
                            <ul>
                                <li <?php if ($currentpage == 'index') {echo 'class="active"';}
                                ?>>
                                    <a href="index.php">Home</a>
                                </li>
                                <li <?php if ($currentpage == 'about-us') {echo 'class="active"';}
                                ?>><a href="about-us.php">About us</a></li>

                                <li <?php if ($currentpage == 'videos' || $currentpage == 'all-videos' || $currentpage == 'video-details') {echo 'class="active"';}
                                ?>><a href="#">Videos</a>
                                    <ul>
                                        <li><a href="all-videos.php">All Videos</a></li>
                                        <?php
                                            $getPl = $pl->getAllPlaylist();
                                                if($getPl){
                                                    while ($result = $getPl->fetch_assoc()) {
                                                
                                        ?>
                                            <li><a href="videos.php?plid=<?php echo $result['id']; ?>"><?php echo $result['PlaylistName']; ?></a></li>
                                        <?php } } ?> 
                                    </ul>
                                </li>
                                <li <?php if ($currentpage == 'news' || $currentpage == 'search-news' || $currentpage == 'all-news' || $currentpage == 'news-details') {echo 'class="active"';}
                                ?>><a href="all-news.php">News</a>
                                </li>

                                <li <?php if ($currentpage == 'contact-us') {echo 'class="active"';}
                                ?>><a href="contact-us.php">contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>             
</header>
        <!-- End of Header Area -->