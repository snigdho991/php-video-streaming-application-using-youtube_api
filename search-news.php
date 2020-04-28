<?php include 'includes/header.php'; ?>

<?php
    $searchid = mysqli_real_escape_string($db->link, $_GET['search']);

    if(!isset($searchid)){
        echo "<script>window.location = '404.php';</script>";
    } elseif ($searchid == NULL){
?>
        <script type="text/javascript">
            alert("Search keyword shouldn't be empty !");
            window.history.back();
        </script>
<?php
    } else {
        $search = $searchid;
    }
?>

<script type="text/javascript">
    function goBack() {
      window.history.back();
    }
</script>

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

    .blog-right-sidebar-top > ul li a.activate {
        color: #e55c5c !important;
        transition: all .3s ease 0s !important; 
        font-weight: bold;
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
    $total_pages = 6;
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
                    <h2 class="page-title">Search News</h2>
                    <ul style="text-transform: none;">
                        <li style="color: #e55c5c;" >You searched for </li>
                        <li><?php echo $search; ?></li>
                        
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
                <div class="row">
                    <!--  News div of Blog page Start-->
                    
            <?php
                $getnw = $nw->searchNews($search, $start_from, $total_pages);
                if(!$getnw){ 
            ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <blockquote style="border-left: 2px solid #065fd4;width: 400px;"><p style="color: #065fd4;"><b>No result found related to your search keyword !
                    </b></p></blockquote>

                    
                    <br><div class="form-button">
                        <button class="contact-submit" onclick="goBack()"><i class="icofont icofont-double-left"></i> Go Back</button>
                    </div>
                
                </div>

            <?php
                }
                else if($getnw){
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
                <!-- Pagination Start-->
<!--- Pagination --->
<?php 
    $query  = "SELECT * FROM tblposts WHERE PostTitle LIKE '%$search%' OR quote LIKE '%$search%'";
    $result = $db->select($query);
    $total_rows = mysqli_num_rows($result);
    $total_records = ceil($total_rows/$total_pages); 
?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="another-pages text-center">
                            <ul>
                            <li><a href="search-news.php?search=<?php echo $search; ?>&submit=&&page=1"><i class="icofont icofont-double-left"></i></a></li>
                            <li><?php for ($i = 1; $i <= $total_records; $i++) { ?>
     <a
    <?php
    if(isset($_GET['page']) && $_GET['page'] == $i){
                echo 'class="active"';
    } ?>
     href="search-news.php?search=<?php echo $search; ?>&submit=&&page=<?php echo $i; ?>"><?php echo $i; ?> </a>
<?php
} ?></li>
                            <li><a href="search-news.php?search=<?php echo $search; ?>&submit=&&page=<?php echo $total_records; ?>"><i class="icofont icofont-double-right"></i></a></li>
                        </ul>
                        </div>
                    </div>
                </div>

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
                    <div class="blog-right-sidebar-top mb-57">
                        <h3 class="leave-comment-text">Categories</h3>
            <?php
            $getCt = $ct->getAllCategories();
                if($getCt){
                    while ($result = $getCt->fetch_assoc()) {
                    
            ?> 
                        <ul>
                            <li><a href="news.php?ctid=<?php echo $result['id']; ?>"><?php echo $result['CategoryName']; ?></a> </li>                
                        </ul>
            <?php } } ?>
                    </div>
                    <!--  News categories  div end-->

                    
                </div>
            </div>
    <?php } else {
        echo "<script>window.location = '404.php';</script>";
    } ?>
             <!--  Right side bar div of Blog page end-->
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>