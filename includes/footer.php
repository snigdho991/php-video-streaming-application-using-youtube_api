 <!-- Start of Footer area -->
 

 
  <?php                                       
 $query=mysqli_query($con,"Select *from  tblcontact");
while($row=mysqli_fetch_array($query))
{
?>  
                <footer class="footer-area text-center">
                    <div class="main-footer ptb-90">
                        <div class="container">                            
                            <div class="row">    
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="footer-widget mrg-md-bottom">
                                        <h2>about us</h2>
                                        <p><?php echo htmlentities($row['description']);?></p>
                                        <div class="top-right text-left">
                                            <ul>
                                                <li><a href="<?php echo htmlentities($row['youtube']);?>"><i class="icofont icofont-social-youtube"></i></a></li>
                                                <li><a href="<?php echo htmlentities($row['facebook']);?>"><i class="icofont icofont-social-facebook"></i></a></li>
                                                <li><a href="<?php echo htmlentities($row['instragram']);?>"><i class="icofont icofont-social-instagram"></i></a></li>
                                                <li><a href="<?php echo htmlentities($row['linkedIn']);?>"><i class="icofont icofont-social-linkedin"></i></a></li>
                                                <li><a href="<?php echo htmlentities($row['twitter']);?>"><i class="icofont icofont-social-twitter"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>    
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="footer-widget footer-widget-2 mrg-md-bottom">
                                        <h2>important link</h2>
                                        <ul>
                                            <li><a href="#">privacy &amp; Policy</a></li>
                                            <li><a href="#">terms &amp; conditions</a></li>
                                            <li><a href="#">support</a></li>
                                            <li><a href="#">video contain</a></li>
                                            <li><a href="#">about Roaring Bangladesh</a></li>
                                        </ul>
                                    </div>
                                </div> 
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="footer-widget">
                                        <h2>quick contact</h2>                                       
                                        
                                        <p><?php echo htmlentities($row['mobile']);?></p>
                                    <p><?php echo htmlentities($row['mobile2']);?></p>
                                        <p><?php echo htmlentities($row['email']);?></p>
                                        <p><a href="<?php echo htmlentities($row['web']);?>"><?php echo htmlentities($row['youtube']);?></a></p>
<!--                                        <p>Flor. 4, House. 15, Block-C-->
                                        <p><?php echo htmlentities($row['address']);?></p>
                                        <p><?php echo htmlentities($row['district']);?></p>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="footer-widget">
                                        <h2>recent videos</h2>
                                        <div class="footer-img">
                <?php

                    $getrecent = $vd->getRecentVideos();
                    if($getrecent){
                    while ($reresult = $getrecent->fetch_assoc()) {

                      $api_key = 'AIzaSyCs_2jPyKVmfyOb5fz4jMzkU_pV_zLjFiw';

                      $video_url = $reresult['VideoUrlLink'];

                      $api_url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' . $vd->getYouTubeVideoID($video_url) . '&key=' . $api_key;
                            
                      $data = json_decode(file_get_contents($api_url));
                
                      
                ?>         
                                            <a href="video-details.php?id=<?php echo $reresult['id']; ?>"><img style="height: 70px; width: 70px;" src="<?php echo $data->items[0]->snippet->thumbnails->medium->url ?>" alt="" ></a>
                <?php } } ?>

                                            
                                        </div>    
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>    
                    <div class="footer-bottom mt-25px mb-25px">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <p>&copy; Roaring Bangladesh 2020. Developed by <a href="https://www.facebook.com/mdshamim.hossain.7169"><span style="color: #aaa;">Md.Samim hossain</span></a></p>
                                </div>
                            </div>
                        </div>
                    </div>   
                </footer>
                <!-- End of Footer area -->
<!--            </div>   
            End of Bg White 
        </div>    
        End of Main Wrapper Area -->
       
        
        <!-- all js here -->
        <script src="js/vendor/jquery-1.12.4.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>    
        <script src="js/isotope.pkgd.min.js"></script>      
        <script src="js/jquery.meanmenu.js"></script>  
        <script src="js/imagesloaded.pkgd.min.js"></script> 
        <script src="js/jquery.magnific-popup.js"></script>
        <script src="js/ajax-mail.js"></script>             
        <script src="js/jquery.ajaxchimp.min.js"></script>          
        <script src="js/plugins.js"></script>               
        <script src="js/main.js"></script>
    </body>


</html>

<?php } ?>