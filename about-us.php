<?php include 'includes/header.php';


?>
                <!-- breadcrumbs start -->
                <section class="breadcrumbs-area ptb-110 bg-2 breadcrumbs-img">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="breadcrumbs">
                                    <h2 class="page-title">about us</h2>
                                    <ul>
                                        <li>
                                            <a class="active" href="#">Home</a>
                                        </li>
                                        <li>about us</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- breadcrumbs end -->
                <!--Start about-us Area-->
                <section class="about-us-area ptb-90">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2">                               
                            </div>
                            <div class="col-lg-8" align="center">
                                <div class="about-minimal">
                                    <h2>
                                        WELCOME TO
                                        <strong>Roaring Bangladesh</strong> </h2>                                
                                    <p>
                                        <?php
                                        $query=mysqli_query($con,"Select *from  tblcontact");
                                         while($row=mysqli_fetch_array($query))
                                           {                                       
                                         echo htmlentities($row['description']);
                                           }
                                         ?>
                                    </p>
                                                                       
                                </div>
                            </div>
                            <div class="col-lg-2">
                                
                            </div>
                        </div>
                    </div>
                </section>
                <div class="project-count-area gray-bg pb-60 pt-90">
                    <div class="container">
                        <div class="row">
<?php 
$query=mysqli_query($con,"select * from tblplaylist where Is_Active=1");
$countplaylist=mysqli_num_rows($query);
?>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="single-count mb-30">
                                    <div class="count-icon">
                                        <i class="fa fa-play-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="count-title">
                                        <h2 class="counter"><?php echo htmlentities($countplaylist);?></h2>
                                        <span>Total Playlists</span>
                                    </div>
                                </div>
                            </div>

                            <?php 
$query=mysqli_query($con,"select * from tblvideos where Is_Active=1");
$countvideos=mysqli_num_rows($query);
?>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="single-count mb-30">
                                    <div class="count-icon">
                                        <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    </div>
                                    <div class="count-title">
                                        <h2 class="counter"><?php echo htmlentities($countvideos);?></h2>
                                        <span>Total Videos</span>
                                    </div>
                                </div>
                            </div>
                            <?php 
$query=mysqli_query($con,"select * from tblcategory where Is_Active=1");
$countcat=mysqli_num_rows($query);
?>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="single-count mb-30">
                                    <div class="count-icon">
                                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                                    </div>
                                    <div class="count-title">
                                        <h2 class="counter"><?php echo htmlentities($countcat);?></h2>
                                        <span>Total Categories</span>
                                    </div>
                                </div>
                            </div>
                            <?php 
$query=mysqli_query($con,"select * from tblposts where Is_Active=1");
$countpost=mysqli_num_rows($query);
?>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="single-count mb-30">
                                    <div class="count-icon">
                                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="count-title">
                                        <h2 class="counter"><?php echo htmlentities($countpost);?></h2>
                                        <span>Total News</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-area pt-90 pb-60">
                    <div class="container">
                        <div class="section-title text-center mb-70">
                            <h2>Our Team</h2>
                            <!--You can write something in this div-->
                            </div>          
                        <div class="row">
                            <?php 
$query=mysqli_query($con,"Select *from  tblmember where Is_Active=1");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="team-wrapper mb-30">
                                    <div>
                                        <img src="admin/teamMemberImages/<?php echo htmlentities($row['MemberImage']);?>" alt="" />
                                        <div class="team-icon">
                                            <a href="<?php echo htmlentities($row['FacebookId']);?>"><i class="fa fa-facebook"></i></a>
                                            <a href="<?php echo htmlentities($row['TwitterId']);?>"><i class="fa fa-twitter"></i></a>
                                            <a href="<?php echo htmlentities($row['LinkedInId']);?>"><i class="fa fa-linkedin"></i></a>
                                            <a href="<?php echo htmlentities($row['InstragramId']);?>"><i class="fa fa-instagram"></i></a>
                                        </div>
                                    </div>
                                    <div class="team-info text-center">
                                        <h3><?php echo htmlentities($row['Name']);?></h3>
                                        <span><?php echo htmlentities($row['Designation']);?></span>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
                <!-- end about-us Area-->
               <?php  include 'includes/footer.php'; ?>