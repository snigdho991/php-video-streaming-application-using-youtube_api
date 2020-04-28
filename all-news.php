<?php include 'includes/header.php'; ?>

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

            <!-- breadcrumbs start -->
<section class="breadcrumbs-area ptb-110 bg-2 breadcrumbs-img">
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="breadcrumbs">
                <h2 class="page-title">All News</h2>
                <ul>
                    <li>
                        <a class="active" href="index.php">Home</a>
                    </li>
                    <li>news</li>
                </ul>
            </div>
        </div>
    </div>
</div>
</section>
<!-- breadcrumbs end -->

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

<section class="blog-details-area ptb-90">
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <!--  News div of Blog page Start-->
                
        <?php
            $getnw = $nw->getAllNews($start_from, $total_pages);
            if($getnw){
                while ($result = $getnw->fetch_assoc()){
        
        ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="single-video-area mb-30">
                        <div class="video-img video-img-hover">
                            <div class="game">
                                <a href="news-details.php?id=<?php echo $result['id']; ?>"><img style="height: 260px; width: 270px" src="admin/postimages/<?php echo $result['PostImage']; ?>" alt=""></a>
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
                
        <?php } ?>    
                <!--  News div of Blog page End-->
                
            </div>

<!--- Pagination --->
<?php 
    $query  = "SELECT * FROM tblposts";
    $result = $db->select($query);
    $total_rows = mysqli_num_rows($result);
    $total_records = ceil($total_rows/$total_pages); 
?>
    <!-- Pagination Start-->
            <div class="row">
                <div class="col-md-12">
                    <div class="another-pages text-center">
                        <ul>
                            <li><a href="all-news.php?page=1"><i class="icofont icofont-double-left"></i></a></li>
                            <li><?php for ($i = 1; $i <= $total_records; $i++) { ?>
     <a
    <?php
    if(isset($_GET['page']) && $_GET['page'] == $i){
                echo 'class="active"';
    } ?>
     href="all-news.php?page=<?php echo $i; ?>"><?php echo $i; ?> </a>
<?php
} ?></li>
                            <li><a href="all-news.php?page=<?php echo $total_records; ?>"><i class="icofont icofont-double-right"></i></a></li>
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
                <div class="blog-search mb-60">
                    <h3 class="leave-comment-text">Search</h3>
                    <form action="search-news.php" method="get">
                        <input name="search" placeholder="Search" type="text">
                        <button class="submit" name="submit" type="submit"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                    </form>
                </div>
            
               
                <!--  News categories  div start-->
                <div class="blog-right-sidebar-top mb-56">
                    <h3 class="leave-comment-text">Categories</h3>
        <?php
        $getCt = $ct->getAllCategories();
            if($getCt){
                while ($result = $getCt->fetch_assoc()) {
            
        ?> 
                    <ul>
                        <li><a href="news.php?ctid=<?php echo $result['id']; ?>"><?php echo $result['CategoryName']; ?></a></li>
        <?php } } ?>                
                    </ul>
                </div>
                <!--  News categories  div end-->

                <!-- Recent news div start-->
                <div class="blog-right-sidebar-top mb-57">
                    <h3 class="leave-comment-text">Recent News</h3>
                    <div class="blog-sitebar-video">
        <?php
            $getrc = $nw->getRecentNews();
            if($getrc){
                while ($result = $getrc->fetch_assoc()){
        
        ?>            
                        <div class="single-site-video">
                            <div class="blog-video-img">
                                <a href="news-details.php?id=<?php echo $result['id']; ?>"><img style="height: 71px; width: 102px" src="admin/postimages/<?php echo $result['PostImage']; ?>" alt="" ></a>
                            </div>
                            <div class="blog-video-text">
                                <h3><a href="news-details.php?id=<?php echo $result['id']; ?>"><?php echo $fm->textShorten($result['PostTitle'], 25); ?></a></h3>
                                <span><?php echo $result['views']; ?> views</span><br>
                                <span><?php echo $fm->get_time_ago(strtotime($result['PostingDate'])); ?></span>
                            </div>
                        </div>
        <?php } } ?>                
                    </div>
                </div>
                <!-- Recent news div End-->

                <!-- Popular news div start-->
                <div class="blog-right-sidebar-top mb-57">
                    <h3 class="leave-comment-text">Popular News</h3>
                    <div class="blog-sitebar-video">
        <?php
            $getpu = $nw->getPopularNews();
            if($getpu){
                while ($result = $getpu->fetch_assoc()){
        
        ?>            
                        <div class="single-site-video">
                            <div class="blog-video-img">
                                <a href="news-details.php?id=<?php echo $result['id']; ?>"><img style="height: 71px; width: 102px" src="admin/postimages/<?php echo $result['PostImage']; ?>" alt="" ></a>
                            </div>
                            <div class="blog-video-text">
                                <h3><a href="news-details.php?id=<?php echo $result['id']; ?>"><?php echo $fm->textShorten($result['PostTitle'], 25); ?></a></h3>
                                <span><?php echo $result['views']; ?> views</span><br>
                                <span><?php echo $fm->get_time_ago(strtotime($result['PostingDate'])); ?></span>
                            </div>
                        </div>
        <?php } } ?>                
                    </div>
                </div>
                <!-- Popular news div End-->
                
            </div>
        </div>
         <!--  Right side bar div of Blog page end-->
    </div>
</div>
</section>

<?php include 'includes/footer.php'; ?>