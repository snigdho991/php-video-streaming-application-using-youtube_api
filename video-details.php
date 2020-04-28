<?php include 'includes/header.php';?>

<?php
    if(!isset($_GET['id']) || $_GET['id'] == NULL || empty($_GET['id'])){
        echo "<script>window.location = 'empty.php'; </script>";
    } else {
        $vdid = preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['id']);
    }
?>

<style type="text/css">
    .single-video-content ul {
        margin: 0px 31px 0;
        padding: 0px;
        border-top: 0px solid #444;
    }

    .single-video-content {
        background: #ddd none repeat scroll 0 0;
        padding: 18px 22px 12px;
    }


    .single-site-video {
        display: block;
        margin-bottom: 15px;
        overflow: hidden;
        width: 340px;
    }


    .blog-video-img {
        display: inline-block;
        float: left;
        width: 33%;
    }

</style>


            <?php
                $getdetails = $vd->getSingleVideoDetails($vdid);
                if($getdetails){
                    while ($result = $getdetails->fetch_assoc()) {
                      $api_key = 'AIzaSyCs_2jPyKVmfyOb5fz4jMzkU_pV_zLjFiw';

                      $video_url = $result['VideoUrlLink'];
                      $video_id = str_replace('https://www.youtube.com/watch?v=','', $video_url);

                      $api_url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' . $vd->getYouTubeVideoID($video_url) . '&key=' . $api_key;
                            
                      $data = json_decode(file_get_contents($api_url));


            ?>

                <!-- breadcrumbs start -->
                <section class="breadcrumbs-area ptb-110 bg-2 breadcrumbs-img">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="breadcrumbs">
                                    <h2 class="page-title">video details</h2>
                                    <ul>
                                <?php
                                    $id = $result['PlaylistId'];
                                    $getpl = $pl->getPlById($id);
                                    if($getpl){
                                        while($plresult = $getpl->fetch_assoc()){
                                ?>

                                        <li>
                                            <a class="active" href="index.php">Home
                                            </a>
                                        </li>
                                        <li>
                                            <a class="active" href="all-videos.php">Videos
                                            </a>
                                        </li>
                                        <li>
                                            <a class="active" href="videos.php?plid=<?php echo $plresult['id']; ?>"><?php echo $plresult['PlaylistName']; ?>
                                            </a>
                                        </li>

                                <?php } } ?>

                                        <li><?php echo $fm->textShorten($data->items[0]->snippet->title, 25); ?></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- breadcrumbs end -->
                <div class="full-video pt-90">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">                               
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe width="560" height="315" src=" https://www.youtube.com/embed/<?php echo $video_id; ?>" allowfullscreen></iframe>
                                </div>                         
                                <section class="blog-details-area pt-30 pb-90">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="blog-details-left">
                                    <div class="blog-part">
                                        <div class="blog-info">

                                <?php
                                    $views = $result['views'];
                                    if(($views == 0) || ($views == null)){
                                        $views = 1;
                                    } else {
                                        $views += 1;
                                    }

                                    $getviews = $vd->getViewsById($views, $vdid);
                                    
                                ?>

                                            <div class="single-video-content">
                                                <ul style="color: #666; font-weight: bold;">
                                                
                                                    
                                                    <li><i class="icofont icofont-brand-youtube" style="color: #e55c5c;"></i><?php echo $data->items[0]->snippet->channelTitle ?></li>


                                                    <li><i class="icofont icofont-eye-alt" style="color: #e55c5c;"></i><?php echo $data->items[0]->statistics->viewCount ?> views</li>


                                                    <li><i class="icofont icofont-like" style="color: #e55c5c;"></i><?php echo $data->items[0]->statistics->likeCount ?> likes</li>

                                                    <li><i class="icofont icofont-exclamation-tringle" style="color: #e55c5c;"></i><?php echo $data->items[0]->statistics->dislikeCount ?> dislikes</li>

                                                    <li><i class="icofont icofont-comment" style="color: #e55c5c;"></i><?php echo $data->items[0]->statistics->commentCount ?> comments</li>


                                                    <li><i class="icofont icofont-ui-calendar" style="color: #e55c5c;"></i><?php echo $fm->formatDate($data->items[0]->snippet->publishedAt); ?></li>

                                                    <li><i class="icofont icofont-ui-clock" style="color: #e55c5c;"></i><?php echo $fm->get_time_ago(strtotime($data->items[0]->snippet->publishedAt)); ?></li>

                                                </ul>
                                            </div>

                                            <blockquote><h6><?php echo $data->items[0]->snippet->title ?></h6></blockquote>

                                            <blockquote><p><?php echo $data->items[0]->snippet->description ?></p></blockquote>


                                            <blockquote style="border-left: 2px solid #065fd4;"><p style="color: #065fd4;"><b><?php $tag = $data->items[0]->snippet->tags; $string = implode(' #', $tag); echo "#".$string; ?>
                                            </b></p></blockquote>
                                            
                                        </div>
                                    </div>
                                    <div class="news-details-bottom mtb-60">
                                       <div class="leave-comment mt-77">
                                    <h3 class="leave-comment-text">Comments Zone</h3>
                                    <div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://roaringbd.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            </div>
                                    </div>
                                    
                                </div>
                            </div>
                           
                            
                        </div>
                    </div>
                </section>
                            </div>
                             <!--sidebar-->
                            <div class="col-lg-3">
                                <div class="blog-right-sidebar">

                            
                                    <div class="blog-right-sidebar-top mb-60">
                                        <h3 class="leave-comment-text">Related Videos</h3>

                                    <?php 
                                        $getrelated = $vd->getRelatedVideos($id);
                                            if($getrelated){
                                                while($reresult = $getrelated->fetch_assoc()){

                                                  $api_key = 'AIzaSyCs_2jPyKVmfyOb5fz4jMzkU_pV_zLjFiw';

                                                  $vid = $reresult['id'];

                                                  $video_url = $reresult['VideoUrlLink'];

                                                  $video_id = str_replace('https://www.youtube.com/watch?v=','', $video_url);

                                                  $api_url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' . $vd->getYouTubeVideoID($video_url) . '&key=' . $api_key;
                                                        
                                                  $data = json_decode(file_get_contents($api_url));
                                                  if($vid != $vdid){
                                    ?>
                                    
                                        <div class="blog-sitebar-video">
                                            
                                            <div class="single-site-video">
                                                <div class="blog-video-img">
                                                    <a href="video-details.php?id=<?php echo $reresult['id']; ?>"><img style="height: 100px" src="<?php echo $data->items[0]->snippet->thumbnails->medium->url ?>" alt="" ></a>
                                                </div>
                                                <div class="blog-video-text">
                                                    <h3><a href="video-details.php?id=<?php echo $reresult['id']; ?>"><?php echo $fm->textShorten($data->items[0]->snippet->title, 24); ?></a></h3>
                                                    <span><?php echo $data->items[0]->statistics->viewCount ?> views</span><br>
                                                    <span><?php echo $data->items[0]->statistics->likeCount ?> likes</span><br>
                                                    <span><?php echo $fm->get_time_ago(strtotime($data->items[0]->snippet->publishedAt)); ?></span>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                    <?php } } } ?>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } } else {
                echo "<script>window.location = 'empty.php'; </script>";
            } ?>
                
<?php include 'includes/footer.php'; ?>