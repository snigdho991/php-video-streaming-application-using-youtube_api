<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    
   if(isset($_POST['submit'])){
       $id=intval($_GET['id']);
$name=$_POST['name'];
$designation=$_POST['designation'];
$facebookId=$_POST['facebookId'];
$twitterId=$_POST['twitterId'];
$linkedInId=$_POST['linkedInId'];
$instragramId=$_POST['instragramId'];
$imgfile=$_FILES["memberImage"]["name"];

$imgnewfile=($imgfile).$extension;
//// Code for move image into directory
move_uploaded_file($_FILES["memberImage"]["tmp_name"],"teamMemberImages/".$imgnewfile);


$query=mysqli_query($con,"Update tblmember set Name='$name',Designation='$designation',FacebookId='$facebookId',TwitterId='$twitterId',LinkedInId='$linkedInId',InstragramId='$instragramId',MemberImage='$imgnewfile' where id = '$id' ");
if($query)
{
$msg="Member successfully Updated ";
}
else{
$error1="Something went wrong . Please try again.";    
} 


}
    
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
            <meta name="author" content="Coderthemes">

            <!-- App favicon -->
            <link rel="shortcut icon" href="assets/images/favicon.ico">
            <!-- App title -->
            <title>Roaring Bangladesh | Edit team member</title>

            <!-- Summernote css -->
            <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

            <!-- Select2 -->
            <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

            <!-- Jquery filer css -->
            <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
            <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

            <!-- App css -->
            <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
            <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
            <script src="assets/js/modernizr.min.js"></script>
            
            
            

        </head>


        <body class="fixed-left">

            <!-- Begin page -->
            <div id="wrapper">

                <!-- Top Bar Start -->
    <?php include('includes/topheader.php'); ?>
                <!-- ========== Left Sidebar Start ========== -->
    <?php include('includes/leftsidebar.php'); ?>
                <!-- Left Sidebar End -->



                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="content-page">
                    <!-- Start content -->
                    <div class="content">
                        <div class="container">


                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Edit Team Member  </h4>
                                        <ol class="breadcrumb p-0 m-0">
                                            <li>
                                                <a href="#">Pages</a>
                                            </li>

                                            <li class="active">
                                                Edit Team Member 
                                            </li>
                                        </ol>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-sm-6">  
                                    <!---Success Message--->  
    <?php if ($msg) { ?>
                                        <div class="alert alert-success" role="alert">
                                            <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                        </div>
    <?php } ?>

                                    <!---Error Message--->
    <?php if ($error) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?></div>
                                    <?php } ?>


                                </div>
                            </div>
                                  

                               
                            <br>

                            <div class="container-fluid">                       
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="m-t-0 header-title"><b>Edit Team Member </b></h4>
                                        <hr />

<?php 
$id=intval($_GET['id']);
$query=mysqli_query($con,"Select *from  tblmember where Is_Active=1 and id='$id'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>



                                        <div class="row">
                                            <div class="col-md-11">
                                                <form name="aboutus" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="form-group m-b-20">
                                                        <h4 class="col-md-2 header-title control-label"><b>Name</b></h4>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['Name']);?>" name="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h4 class="col-md-2 header-title control-label"><b>Designation</b></h4>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['Designation']);?>" name="designation" required>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="form-group">                                                       
                                                        <h4 class="col-md-2 header-title control-label"><b>Facebook ID Link</b></h4>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['FacebookId']);?>" name="facebookId" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">                                                       
                                                        <h4 class="col-md-2 header-title control-label"><b>LinkedIn ID Link</b></h4>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['LinkedInId']);?>" name="linkedInId" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">                                                        
                                                        <h4 class="col-md-2 header-title control-label"><b>Twitter ID Link</b></h4>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['TwitterId']);?>" name="twitterId" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h4 class="col-md-2 header-title control-label"><b>Instragram ID Link</b></h4>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" value="<?php echo htmlentities($row['InstragramId']);?>" name="instragramId" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h4 class="col-md-2 header-title control-label"><b>Member Image</b></h4>                    
                                                        <div class="col-md-10">
                                                            <input type="file" class="form-control" id="memberImage" name="memberImage" required>
                                                        </div>
                                                    </div>
                                                    
      
                                                   

                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">&nbsp;</label>
                                                        <div class="col-md-10">
                                                            <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">
                                                                Submit</button>
                                                        </div>
                                                    </div>

                                                </form> 
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end row -->

                            </div>
 
                        </div> <!-- container -->

                    </div> <!-- content -->

    <?php include('includes/footer.php'); ?>

                </div>


                <!-- ============================================================== -->
                <!-- End Right content here -->
                <!-- ============================================================== -->


            </div>
            <!-- END wrapper -->



            <script>
                var resizefunc = [];
            </script>

            <!-- jQuery  -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/detect.js"></script>
            <script src="assets/js/fastclick.js"></script>
            <script src="assets/js/jquery.blockUI.js"></script>
            <script src="assets/js/waves.js"></script>
            <script src="assets/js/jquery.slimscroll.js"></script>
            <script src="assets/js/jquery.scrollTo.min.js"></script>
            <script src="../plugins/switchery/switchery.min.js"></script>

            <!--Summernote js-->
            <script src="../plugins/summernote/summernote.min.js"></script>
            <!-- Select 2 -->
            <script src="../plugins/select2/js/select2.min.js"></script>
            <!-- Jquery filer js -->
            <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

            <!-- page specific js -->
            <script src="assets/pages/jquery.blog-add.init.js"></script>

            <!-- App js -->
            <script src="assets/js/jquery.core.js"></script>
            <script src="assets/js/jquery.app.js"></script>

            <script src="../plugins/switchery/switchery.min.js"></script>

            <!--Summernote js-->
            <script src="../plugins/summernote/summernote.min.js"></script>




        </body>
    </html>
<?php }}?>