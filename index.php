<?php include 'includes/header.php'; ?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $email = $_POST['email'];

        $insertPro = $nw->newsLetter($email);
    }
?>
                <!-- Start Slider Area-->
                <section id="slider-container"> 
                    <div class="video-owl-slider owl-carousel"> 
                        <!-- Start Slingle Slide -->
                        <div class="single-slide height-100vh" style="background-image: url(images/slider/1.jpg)">
                            <!-- Start Slider Content -->
                            <div class="slider-content-area d-flex align-items-center text-center">  
                                <div class="container">
                                    <div class="slide-content">
                                        <h4 class="animated">Roaring Bangladesh</h4>
                                        <h1 class="animated">THE WORLD BEST <span>VIDEO</span></h1>
                                        <h2 class="animated"><span>BLOG</span> WEBSITE</h2>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Slider Content -->
                        </div>
                        <!-- End Slingle Slide -->
                        <!-- Start Slingle Slide -->
                        <div class="single-slide height-100vh" style="background-image: url(images/slider/3.jpg)">
                            <!-- Start Slider Content -->
                            <div class="slider-content-area d-flex align-items-center">   
                                <div class="container">
                                    <div class="slide-content text-center">
                                        <h4 class="animated">Roaring Bangladesh</h4>
                                        <h1 class="animated">THE WORLD BEST <span>VIDEO</span></h1>
                                        <h2 class="animated"><span>BLOG</span> WEBSITE</h2>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Slider Content -->
                        </div>
                        <!-- End Slingle Slide -->							
                    </div>
                </section>
                <!-- End Slider Area -->

                <!--Start of Latest Videos Area-->
                <div class="latest-area text-left ptb-90">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="section-title text-center">
                                    <h2 class="text-uppercase">latest videos</h2>
                                    <i class="icofont icofont-video-cam"></i>
                                    <p>“Autumn is a momentum of the natures golden beauty, so the same it’s time to find your momentum of life.” ― Rashedur Ryan Rahman. Enjoy our latest videos.</p>
                                </div>
                            </div>
                        </div>
                        <div class="latest-owl owl-carousel mb-40">
            <?php

                $getrecent = $vd->getRecentVideos();
                if($getrecent){
                while ($reresult = $getrecent->fetch_assoc()) {

                  $api_key = 'AIzaSyCs_2jPyKVmfyOb5fz4jMzkU_pV_zLjFiw';

                  $video_url = $reresult['VideoUrlLink'];

                  $api_url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' . $vd->getYouTubeVideoID($video_url) . '&key=' . $api_key;
                        
                  $data = json_decode(file_get_contents($api_url));
                 
            ?>                            
                            <div class="single-video-area">
                                <div class="video-img video-img-hover">
                                    <div class="game">
                                        <a href="video-details.php?id=<?php echo $reresult['id']; ?>"><img src="<?php echo $data->items[0]->snippet->thumbnails->medium->url ?>" alt=""></a>
                                    </div>
                                    <div class="video-icon">
                                        <a href="video-details.php?id=<?php echo $reresult['id']; ?>">
                                            <i class="icofont icofont-play-alt-2"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="single-video-content">
                                    <h5><a href="video-details.php?id=<?php echo $reresult['id']; ?>"><?php echo $fm->textShorten($data->items[0]->snippet->title, 22); ?></a></h5>
                                    <p><i class="icofont icofont-eye-alt" style="color: #aaaaaa; margin-right: 3px;"></i> <?php echo $data->items[0]->statistics->viewCount ?> views</p>
                                    <ul>
                                        <li><i class="icofont icofont-like"></i><?php echo $data->items[0]->statistics->likeCount ?> likes</li>
                                                    
                                                    <li><i class="icofont icofont-ui-clock"></i><?php echo $fm->get_time_ago(strtotime($data->items[0]->snippet->publishedAt)); ?></li>
                                    </ul>
                                </div>
                            </div> 
            <?php } } ?>                               
                        </div>
                    </div>
                </div>
                <!-- End of Latest video Area -->
                <!-- Start of Category area -->
                <div class="category-area pt-75 pb-75">
                    <div class="container">
                        <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="advertizement">
                                            <a href="#"><img src="images/addvertizement/1.jpg" alt=""></a>
                                            <h2><a href="https://www.youtube.com/channel/UCUx9kckQCarDpkJPGG41O5A" target="_blank">Stay with <span style="color: #e55c5c;">roaring bangladesh</span> on youtube !</a></h2>
                                        </div>
                                    
                                    </div> 
                        </div>
                    </div>
                </div> 
                     
                    <!-- End of Category Area -->
                <!-- Start of Latest news Area -->
                <div class="movie-area pt-90 pb-90">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="section-title text-center">
                                    <h2 class="text-uppercase">latest news</h2>
                                    <i class="icofont icofont-news"></i>
                                    <p>“News is something somebody doesn't want printed; all else is advertising.” ― William Randolph Hearst. You can stay tuned with our latest news.</p>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <?php
                                $getrc = $nw->getRecentNews();
                                if($getrc){
                                    while ($result = $getrc->fetch_assoc()){
                            
                            ?>     
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="single-video-area mb-30">
                                            <div class="video-img video-img-hover">
                                                <div class="game">
                                                    <a href="news-details.php?id=<?php echo $result['id']; ?>"><img style="width: 100%; height: 260px" src="admin/postimages/<?php echo $result['PostImage']; ?>" alt=""></a>
                                                </div>

                                                <div class="video-icon">
                                                    <a href="news-details.php?id=<?php echo $result['id']; ?>">
                                                        <i class="icofont icofont-news"></i>
                                                    </a>
                                                </div>
                                            </div> 
                                            <div class="single-video-content">
                                                <h5><a href="news-details.php?id=<?php echo $result['id']; ?>"><?php echo $fm->textShorten($result['PostTitle'], 22); ?></a></h5>
                                                <p><?php echo $fm->textShorten($result['quote'], 50); ?></p>
                                                <ul>
                                                    <li><i class="icofont icofont-eye-alt"></i><?php echo $result['views']; ?> views</li>
                                                    <li><i class="icofont icofont-ui-clock"></i><?php echo $fm->get_time_ago(strtotime($result['PostingDate'])); ?></li>
                                                </ul>
                                            </div>
                                        </div>      
                                    </div>
                            <?php } } ?>           
                        </div>
                    </div>
                    <!-- Start of  news later area -->
                    <div class="container">
                        <div class="newsletter-area mt-10">
                            <div class="row">
                                <div class="col-lg-8 ml-auto mr-auto col-12">
                                    <div class="newsletter text-center">
                <?php
                    if(isset($insertPro)){
                ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                          <strong><?php echo $insertPro; ?></strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                <?php
                    }
                ?>

                                        <h2>newsletter</h2>
                                        <p> Keep touched with us by subscribing our newsletter. </p>
                                        <form action="" method="post" class="mc-form fix">
                                            <input id="mc-email" type="text" name="email" placeholder="E-mail">
                                            <button id="mc-submit" name="submit" type="submit">Subscribe</button>
                                        </form>
                                        <!-- mailchimp-alerts Start -->
                                        <div class="mailchimp-alerts text-centre fix text-small">
                                            <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                            <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                            <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                                        </div>
                                        <!-- mailchimp-alerts end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of  news later area -->
                </div>
                
              <!-- Start of popular news area -->  
            <div class="popular-area pt-90 pb-90">
                <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="section-title text-center">
                                    <h2 class="text-uppercase">Popular news</h2>
                                    <i class="icofont icofont-news"></i>
                                    <p>“News travels fast in places where nothing much ever happens.” ― Charles Bukowski, Ham on Rye. Stay tuned with us and enjoy our popular news.</p>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <?php
                                $getpu = $nw->getPopularNews();
                                if($getpu){
                                    while ($result = $getpu->fetch_assoc()){
                            
                            ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="single-video-area mb-30">
                                            <div class="video-img video-img-hover">
                                                <div class="game">
                                                    <a href="news-details.php?id=<?php echo $result['id']; ?>"><img style="width: 100%; height: 260px" src="admin/postimages/<?php echo $result['PostImage']; ?>" alt=""></a>
                                                </div>

                                                <div class="video-icon">
                                                    <a href="news-details.php?id=<?php echo $result['id']; ?>">
                                                        <i class="icofont icofont-news"></i>
                                                    </a>
                                                </div>
                                            </div> 
                                            <div class="single-video-content">
                                                <h5><a href="news-details.php?id=<?php echo $result['id']; ?>"><?php echo $fm->textShorten($result['PostTitle'], 22); ?></a></h5>
                                                <p><?php echo $fm->textShorten($result['quote'], 50); ?></p>
                                                <ul>
                                                    <li><i class="icofont icofont-eye-alt"></i><?php echo $result['views']; ?> views</li>
                                                    <li><i class="icofont icofont-ui-clock"></i><?php echo $fm->get_time_ago(strtotime($result['PostingDate'])); ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>      
                                    </div>
                            <?php } } ?>       
                        </div>
                    </div>
            </div>
                <!-- End of popular news area -->
                <!-- Start of popular videos  area -->
                <div class="movie-area pt-90 pb-90">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="section-title text-center">
                                    <h2 class="text-uppercase">popular videos</h2>
                                    <i class="icofont icofont-video-cam"></i>
                                    <p>“A delayed game is eventually good, a bad game is bad forever.” ― Shigeru Miyamoto. Stay tuned with us and enjoy our popular videos.</p>
                                </div>
                            </div>
                        </div> 
                        <div class="latest-owl owl-carousel mb-40">
                              
    <?php

        $getpopuvd = $vd->getPopularVideos();
        if($getpopuvd){
        while ($poresult = $getpopuvd->fetch_assoc()) {

          $api_key = 'AIzaSyCs_2jPyKVmfyOb5fz4jMzkU_pV_zLjFiw';

          $video_url = $poresult['VideoUrlLink'];

          $api_url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' . $vd->getYouTubeVideoID($video_url) . '&key=' . $api_key;
                
          $data = json_decode(file_get_contents($api_url));
    
          
    ?>  
                            <div class="single-video-area">
                                <div class="video-img video-img-hover">
                                    <div class="game">
                                        <a href="#"><img src="<?php echo $data->items[0]->snippet->thumbnails->medium->url ?>" alt=""></a>
                                    </div>
                                    <div class="video-icon">
                                        <a href="video-details.php?id=<?php echo $poresult['id']; ?>">
                                            <i class="icofont icofont-play-alt-2"></i>
                                        </a>
                                    </div> 
                                </div> 
                                <div class="single-video-content">
                                    <h5><a href="video-details.php?id=<?php echo $poresult['id']; ?>"><?php echo $fm->textShorten($data->items[0]->snippet->title, 25); ?></a></h5>
                                    <p><?php echo $fm->textShorten($data->items[0]->snippet->description, 90); ?></p></p>
                                    <ul>
                                        <li><i class="icofont icofont-like"></i><?php echo $data->items[0]->statistics->likeCount ?></li>
                                        <li><i class="icofont icofont-eye-alt"></i><?php echo $data->items[0]->statistics->viewCount ?></li>
                                        <li><i class="icofont icofont-ui-clock"></i><?php echo $fm->get_time_ago(strtotime($data->items[0]->snippet->publishedAt)); ?></li>
                                    </ul>
                                </div>
                            </div>  
    <?php } } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="advertizement">
                                    <a href="#"><img src="images/addvertizement/1.jpg" alt="Advertizement"></a>
                                    <h2><a target="_blank" href="https://www.facebook.com/snigdho.majumder">Want to make a website ? Contact us.</a></h2>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
                 <!-- End of popular videos  area -->
<?php include 'includes/footer.php'; ?>