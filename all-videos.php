<?php include 'includes/header.php';?>


<style type="text/css">
    .single-video-content ul li {
        display: inline-block;
        margin-right: 9px;
        font-size: 11px;
        font-family: 'Open Sans', sans-serif;
        -webkit-transition: all 0.5s ease 0s;
        -o-transition: all 0.5s ease 0s;
        transition: all 0.5s ease 0s;
    }

    .mb-57 {
        margin-bottom: 57px;
    }
    
</style>

<style type="text/css">
    .single-site-video {
        display: block;
        margin-bottom: 15px;
        overflow: hidden;
        width: 340px;
    }

    .blog-video-img {
        display: inline-block;
        float: left;
        width: 30%;
    }

</style>

<!--- Pagination --->
<?php
    $total_pages = 9;
    if(isset($_GET["page"])){
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $start_from = ($page-1) * $total_pages;
?>
<!--- Pagination --->
<!-- breadcrumbs start -->
<section class="breadcrumbs-area ptb-110 bg-2 breadcrumbs-img">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumbs">
                    <h2 class="page-title">all videos</h2>
                    <ul>
                        <li>
                            <a class="active" href="index.php">Home</a>
                        </li>
                        <li>
                            <a class="active" href="all-videos.php">Videos</a>
                        </li>
                        <li>All Videos</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumbs end -->

<section class="blog-details-area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
    <!--- Pagination --->
<?php 
    $query  = "SELECT * FROM tblvideos";
    $result = $db->select($query);
    $total_rows = mysqli_num_rows($result);
    $total_records = ceil($total_rows/$total_pages); 
?>
    <!-- Pagination Start-->
                <div class="row">
                    <!--  News div of Blog page Start-->
            <?php
                $getvd = $vd->getAllVideos($start_from, $total_pages);
                if($getvd){
                    while ($result = $getvd->fetch_assoc()) {
                      $api_key = 'AIzaSyCs_2jPyKVmfyOb5fz4jMzkU_pV_zLjFiw';

                      $video_url = $result['VideoUrlLink'];

                      $api_url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' . $vd->getYouTubeVideoID($video_url) . '&key=' . $api_key;
                            
                      $data = json_decode(file_get_contents($api_url));
                      $views = $data->items[0]->statistics->viewCount;
                      
            ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="single-video-area mb-30">
                            <div class="video-img video-img-hover">
                                <div class="game">
                                    <a href="video-details.php?id=<?php echo $result['id']; ?>"><img src="<?php echo $data->items[0]->snippet->thumbnails->medium->url ?>" alt=""></a>
                                </div>
                                <div class="video-icon">
                                    <a href="video-details.php?id=<?php echo $result['id']; ?>">
                                        <i class="icofont icofont-play-alt-2"></i>
                                    </a>
                                </div> 
                            </div> 
                            <div class="single-video-content">
                                <h5><a href="video-details.php?id=<?php echo $result['id']; ?>"><?php echo $fm->textShorten($data->items[0]->snippet->title, 20); ?></a></h5>
                                <p><?php echo $fm->textShorten($data->items[0]->snippet->description, 30); ?></p>
                                <ul>
                                    <li><i class="icofont icofont-like"></i><?php echo $data->items[0]->statistics->likeCount ?></li>
                                    <li><i class="icofont icofont-eye-alt"></i><?php echo $data->items[0]->statistics->viewCount ?></li>
                                    <li><i class="icofont icofont-ui-clock"></i><?php echo $fm->get_time_ago(strtotime($data->items[0]->snippet->publishedAt)); ?></li>
                                </ul>
                            </div>
                        </div>       
                    </div>
                    
                    <!--  News div of Blog page End-->
            <?php } ?>       
                </div>
                <!-- Pagination Start-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="another-pages text-center">
                        <ul>
                            <li><a href="all-videos.php?page=1"><i class="icofont icofont-double-left"></i></a></li>
                            <li><?php for ($i = 1; $i <= $total_records; $i++) { ?>
     <a
    <?php
    if(isset($_GET['page']) && $_GET['page'] == $i){
                echo 'class="active"';
    } ?>
     href="all-videos.php?page=<?php echo $i; ?>"><?php echo $i; ?> </a>
<?php
} ?></li>
                            <li><a href="all-videos.php?page=<?php echo $total_records; ?>"><i class="icofont icofont-double-right"></i></a></li>
                        </ul>
                        </div>
                    </div>
                </div>
<?php } else {
    echo "<script>window.location = '404.php';</script>";
} ?>
                <!--Pagination  End-->
            </div> 
             
            <!--  Right side bar div of Blog page start-->
            <div class="col-lg-3">
                <div class="blog-right-sidebar">
                    <!-- Popular video div start-->
            

                    <div class="blog-right-sidebar-top mb-57">
                        <h3 class="leave-comment-text">Most Popular</h3>


                        <div class="blog-sitebar-video">

                <?php

                    $getpopuvd = $vd->getPopularVideos();
                    if($getpopuvd){
                    while ($poresult = $getpopuvd->fetch_assoc()) {

                      $api_key = 'AIzaSyCs_2jPyKVmfyOb5fz4jMzkU_pV_zLjFiw';

                      $video_url = $poresult['VideoUrlLink'];

                      $api_url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' . $vd->getYouTubeVideoID($video_url) . '&key=' . $api_key;
                            
                      $data = json_decode(file_get_contents($api_url));
                
                      /*$API_key    = 'AIzaSyCs_2jPyKVmfyOb5fz4jMzkU_pV_zLjFiw';
                      
                      $channelID  = 'UC3CjpLYrGnKVvBUBXRe81dA';
                     
                      $api_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&chart=mostPopular&channelId='.$channelID.'&maxResults=5&order=viewCount&key='.$API_key.'';
                      $data = json_decode(file_get_contents($api_url));
                      foreach($data->items as $item){*/
                
                ?>         
                            <div class="single-site-video">
                                <div class="blog-video-img">
                                    <a href="video-details.php?id=<?php echo $poresult['id']; ?>"><img style="height: 71px" src="<?php echo $data->items[0]->snippet->thumbnails->medium->url ?>" alt="" ></a>
                                </div>
                                <div class="blog-video-text">
                                    <h3><a href="video-details.php?id=<?php echo $poresult['id']; ?>"><?php echo $fm->textShorten($data->items[0]->snippet->title, 25); ?></a></h3>
                                    <span><?php echo $data->items[0]->statistics->likeCount ?> likes</span><br>
                                    <span><?php echo $fm->get_time_ago(strtotime($data->items[0]->snippet->publishedAt)); ?></span>
                                </div>
                            </div>
                <?php } } /* } */ ?>
                        </div>
            
                    </div>
                    <!-- Popular video div End-->


                    <!-- Recent news div start-->
            

                    <div class="blog-right-sidebar-top">
                        <h3 class="leave-comment-text">Recently Added</h3>


                        <div class="blog-sitebar-video">

                <?php

                    $getrecent = $vd->getRecentVideos();
                    if($getrecent){
                    while ($reresult = $getrecent->fetch_assoc()) {

                      $api_key = 'AIzaSyCs_2jPyKVmfyOb5fz4jMzkU_pV_zLjFiw';

                      $video_url = $reresult['VideoUrlLink'];

                      $api_url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' . $vd->getYouTubeVideoID($video_url) . '&key=' . $api_key;
                            
                      $data = json_decode(file_get_contents($api_url));
                
                      
                ?>         
                            <div class="single-site-video">
                                <div class="blog-video-img">
                                    <a href="video-details.php?id=<?php echo $reresult['id']; ?>"><img style="height: 71px" src="<?php echo $data->items[0]->snippet->thumbnails->medium->url ?>" alt="" ></a>
                                </div>
                                <div class="blog-video-text">
                                    <h3><a href="video-details.php?id=<?php echo $reresult['id']; ?>"><?php echo $fm->textShorten($data->items[0]->snippet->title, 25); ?></a></h3>
                                    <span><?php echo $data->items[0]->statistics->viewCount ?> views</span><br>
                                    <span><?php echo $fm->get_time_ago(strtotime($data->items[0]->snippet->publishedAt)); ?></span>
                                </div>
                            </div>
                <?php } } ?>
                        </div>
            
                    </div>
                    <!-- Recent news div End-->
                </div>
            </div>
             <!--  Right side bar div of Blog page end-->
        </div>
    </div>
</section>
            
<?php include 'includes/footer.php'; ?>