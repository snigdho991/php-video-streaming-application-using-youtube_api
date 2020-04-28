<?php include 'includes/header.php';?>

<script type="text/javascript">
    function goBack() {
      window.history.back();
    }
</script>

<?php
    if(!isset($_GET['plid']) || $_GET['plid'] == NULL){
        echo "<script>window.location = 'empty.php'; </script>";
    } else {
        $id = preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['plid']);
    }
?>

                <!-- breadcrumbs start -->
                <section class="breadcrumbs-area ptb-110 bg-2 breadcrumbs-img">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">

<!--- Pagination --->
<?php
    $total_pages = 6;
    if(isset($_GET["page"])){
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $start_from = ($page-1) * $total_pages;
?>
<!--- Pagination --->

        <?php
            $getpl = $pl->getPlById($id);
            if($getpl){
                while($result = $getpl->fetch_assoc()){
        ?>

                                <div class="breadcrumbs">
                                    <h2 class="page-title"><?php echo $result['PlaylistName']; ?></h2>
                                    <ul style="text-transform: none;">
                                        <li>
                                            <a class="active" href="index.php">Home</a>
                                        </li>
                                        <li><a class="active" href="videos.php?plid=<?php echo $result['id']; ?>">Videos</a></li>
                                        <li><?php echo $result['PlaylistName']; ?></li>
                                    </ul>
                                </div>
        <?php } } ?> 
                            </div>
                        </div>
                    </div>
                </section>
                <!-- breadcrumbs end -->
                <!--Start of Latest Area-->
                <div class="latest-area text-left ptb-90">
                    <div class="container">
                        <div class="row">
                            
                        <?php
                            $getvd = $vd->getVideoByPl($id, $start_from, $total_pages);
                            if(!$getvd){ 
            ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                     <blockquote style="border-left: 2px solid #065fd4;width: 400px;"><p style="color: #065fd4;"><b>No videos found in this playlist !
                        </b></p>
                    </blockquote>

                    <br><div class="form-button">
                            <button class="contact-submit" onclick="goBack()"><i class="icofont icofont-double-left"></i> Go Back</button>
                        </div>
                </div>
                
                <?php
                } else if($getvd){
                                while ($result = $getvd->fetch_assoc()) {
                                  $api_key = 'AIzaSyCs_2jPyKVmfyOb5fz4jMzkU_pV_zLjFiw';

                                  $video_url = $result['VideoUrlLink'];

                                  $api_url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet%2CcontentDetails%2Cstatistics&id=' . $vd->getYouTubeVideoID($video_url) . '&key=' . $api_key;
                                        
                                  $data = json_decode(file_get_contents($api_url));
                        ?>

                            <div class="single-video-area mb-30" style="width: 370px;margin-right: 30px;">
                                <div class="video-img video-img-hover">
                                    <div class="game">
                                        <a href="#"><img src="<?php echo $data->items[0]->snippet->thumbnails->medium->url ?>" alt=""></a>
                                    </div>
                                    <div class="video-icon">
                                        <a href="video-details.php?id=<?php echo $result['id']; ?>">
                                            <i class="icofont icofont-play-alt-2"></i>
                                        </a>
                                    </div> 
                                </div> 
                                <div class="single-video-content">
                                    <h5><a href="video-details.php?id=<?php echo $result['id']; ?>"><?php echo $fm->textShorten($data->items[0]->snippet->title, 25); ?></a></h5>
                                    <p><?php echo $fm->textShorten($data->items[0]->snippet->description, 90); ?></p>
                                    <ul>
                                        <li><i class="icofont icofont-like"></i><?php echo $data->items[0]->statistics->likeCount ?></li>
                                        <li><i class="icofont icofont-eye-alt"></i><?php echo $data->items[0]->statistics->viewCount ?></li>
                                        <li><i class="icofont icofont-ui-clock"></i><?php echo $fm->get_time_ago(strtotime($data->items[0]->snippet->publishedAt)); ?></li>
                                    </ul>
                                </div>
                                
                            
                            </div>
                        <?php } ?>                      
                        </div>
    <!--- Pagination --->
<?php 
    $query  = "SELECT * FROM tblvideos WHERE PlaylistId = '$id'";
    $result = $db->select($query);
    $total_rows = mysqli_num_rows($result);
    $total_records = ceil($total_rows/$total_pages); 
?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="another-pages text-center">
                                    <ul>
                            <li><a href="videos.php?plid=<?php echo $id; ?>&&page=1"><i class="icofont icofont-double-left"></i></a></li>
                            <li><?php for ($i = 1; $i <= $total_records; $i++) { ?>
     <a
    <?php
    if(isset($_GET['page']) && $_GET['page'] == $i){
                echo 'class="active"';
    } ?>
     href="videos.php?plid=<?php echo $id; ?>&&page=<?php echo $i; ?>"><?php echo $i; ?> </a>
<?php
} ?></li>
                            <li><a href="videos.php?plid=<?php echo $id; ?>&&page=<?php echo $total_records; ?>"><i class="icofont icofont-double-right"></i></a></li>
                        </ul>
                                </div>
                            </div>
<?php } else {
    echo "<script>window.location = '404.php';</script>";
} ?>
                        </div>

                    </div>
                </div>
<?php include 'includes/footer.php'; ?>