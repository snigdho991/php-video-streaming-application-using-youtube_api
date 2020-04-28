<?php include 'includes/header.php';?>

<?php
    if(!isset($_GET['id']) || $_GET['id'] == NULL || empty($_GET['id'])){
        echo "<script>window.location = 'empty.php'; </script>";
    } else {
        $nwid = preg_replace('/[^-a-zA-z0-9_]/', '', $_GET['id']);
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
        $getdetails = $nw->getSingleNewsDetails($nwid);
        if($getdetails){
            while ($result = $getdetails->fetch_assoc()) {
              
    ?>

                
                <!-- breadcrumbs start -->
                <section class="breadcrumbs-area ptb-110 bg-2 breadcrumbs-img">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="breadcrumbs">
                                    <h2 class="page-title">news details</h2>
                                    <ul>
                                <?php
                                    $id = $result['CategoryId'];
                                    $getct = $ct->getCtById($id);
                                    if($getct){
                                        while($ctresult = $getct->fetch_assoc()){
                                ?>

                                        <li>
                                            <a class="active" href="index.php">Home</a>
                                        </li>
                                        <li>
                                            <a class="active" href="all-news.php">News
                                            </a>
                                        </li>
                                        <li>
                                            <a class="active" href="news.php?ctid=<?php echo $ctresult['id']; ?>"><?php echo $ctresult['CategoryName']; ?>
                                            </a>
                                        </li>
                                <?php } } ?>

                                        <li><?php echo $fm->textShorten($result['PostTitle'],25); ?></li>
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
                                    <img style="width: 855px; height: 420px; margin-left: 15px;" src="admin/postimages/<?php echo $result['PostImage']; ?>">                          
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

            $getviews = $nw->getViewsByNewsId($views, $nwid);
            
        ?>

                                            <div class="single-video-content">
                                                <ul style="color: #666; font-weight: bold;">
                                                
                                                    
                                                    <li><i class="icofont icofont-eye-alt" style="color: #e55c5c;"></i><?php echo $result['views']+1; ?> views</li>

                                                    <li><i class="icofont icofont-ui-calendar" style="color: #e55c5c;"></i><?php echo $fm->formatDate($result['PostingDate']); ?></li>

                                                    <li><i class="icofont icofont-ui-clock" style="color: #e55c5c;"></i><?php echo $fm->get_time_ago(strtotime($result['PostingDate'])); ?></li>

                                                </ul>
                                            </div>
                                            <h3 class="pt-30"><?php echo $result['PostTitle']; ?></h3>
                                            <p><?php echo $result['PostDetails']; ?></p>
                                            <blockquote><?php echo $result['quote']; ?></blockquote>
                                            <p><?php echo $result['paragraph']; ?></p>
                                        </div>
                                    </div>
                                    <div class="leave-comment mt-40">
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
                </section>
                            </div>
                             <!--sidebar-->
                            <div class="col-lg-3">
                                <div class="blog-right-sidebar">
                                    
                                    <div class="blog-right-sidebar-top mb-60">
                                        <h3 class="leave-comment-text">Related News</h3>
                <?php
                    $getrelated = $nw->getRelatedNews($id);
                    if($getrelated){
                        while($reresult = $getrelated->fetch_assoc()){
                            $nid = $reresult['id'];
                            if($nid != $nwid){
                ?>
                                        <div class="blog-sitebar-video">
                                            
                                            <div class="single-site-video">
                                                <div class="blog-video-img">
                                                    <a href="news-details.php?id=<?php echo $reresult['id']; ?>"><img style="height: 75px" src="admin/postimages/<?php echo $reresult['PostImage']; ?>" alt="" ></a>
                                                </div>
                                                <div class="blog-video-text">
                                                    <h3><a href="#"><?php echo $fm->textShorten($reresult['PostTitle'], 24); ?></a></h3>
                                                    <span><?php echo $reresult['views']; ?> views</span><br>
                                                    <span><?php echo $fm->get_time_ago(strtotime($reresult['PostingDate'])); ?></span>
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