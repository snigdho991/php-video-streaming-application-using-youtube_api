<?php include 'includes/header.php';?>


                <!-- breadcrumbs start -->
                <section class="breadcrumbs-area ptb-110 bg-2 breadcrumbs-img">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="breadcrumbs">
                                    <h2 class="page-title">Contact Us</h2>
                                    <ul>
                                        <li>
                                            <a class="active" href="#">Home</a>
                                        </li>
                                        <li>Contact Us</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- breadcrumbs end -->
                <!--Start of contact Area-->
                <div class="contact-area text-left ptb-90">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="contact-contnt">
                                    <div class="sml-titel">
                                        <h3>Contact With us</h3>
                                    </div>
                                <!-- You can write something in this div-->  
                                <?php echo $test;?>
                                </div>
                                 <?php
                                        $query=mysqli_query($con,"Select *from  tblcontact");
                                         while($row=mysqli_fetch_array($query))
                                           {                                       
                                         ?>
                                <div class="contact-address fix">
                                    <div class="contact-single pt-40">
                                        <div class="fres-titel">
                                            <h5>Office</h5>
                                        </div>
                                        <div class="cntct-adrs">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <p><?php echo htmlentities($row['address']); ?> </p>
                                            <p><?php echo htmlentities($row['district']); ?> </p>
                                        </div>
                                    </div>
                                    <div class="contact-single pt-40">
                                        <div class="fres-titel">
                                            <h5>Call Me</h5>
                                        </div>
                                        <div class="cntct-adrs">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <p>Telephone : (+88) <?php echo htmlentities($row['mobile']); ?> </p>
                                            <p>Telephone : (+88) <?php echo htmlentities($row['mobile2']); ?> </p>
                                        </div>
                                    </div>
                                    <div class="contact-single pt-40">
                                        <div class="fres-titel">
                                            <h5>Mail & Youtube</h5>
                                        </div>
                                        <div class="cntct-adrs">
                                            <i class="fa fa-globe" aria-hidden="true"></i>
                                            <p>Email : <?php echo htmlentities($row['email']); ?></p>
                                            <p>Youtube : <a href="<?php echo htmlentities($row['youtube']); ?>">Roaring Bangladesh</a></p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $fm->validation($_POST['name']);
        $mobile = $fm->validation($_POST['mobile']);
        $email = $fm->validation($_POST['email']);
        $subject  = $fm->validation($_POST['subject']);
        $message  = $fm->validation($_POST['message']);
        

        $name = mysqli_real_escape_string($db->link, $name);
        $mobile = mysqli_real_escape_string($db->link, $mobile);
        $email = mysqli_real_escape_string($db->link, $email);
        $subject  = mysqli_real_escape_string($db->link, $subject);
        $message  = mysqli_real_escape_string($db->link, $message);

        if ($name == "" && $mobile == "" && $email == "" && $subject == "" && $message == ""){
            $error = "Error ! All Fields Are Empty !";
        } elseif (empty($name)) {
            $error = "Error ! Please Provide Your Name.";
        } elseif (empty($mobile)) {
            $error = "Error ! Please Provide Your Mobile.";
        } elseif (empty($email)) {
            $error = "Error ! Please Provide Your Email Address.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Provided Email Address Is Invalid !";
        } elseif (empty($subject)) {
            $error = "Error ! Please Provide Your Message.";
        } elseif (empty($message)) {
            $error = "Error ! Please Provide Your Message.";
        } else {

            $query = "INSERT INTO tblmessages(name,mobile,email,subject,message) VALUES('$name','$mobile','$email','$subject','$message')";

            $inserted_rows = $db->insert($query);
            if ($inserted_rows) {
                $msg = "Message Sent Successfully ! Thank You For Contacting With Us.";
            } else {
                $error = "Message Not Sent ! Please Try Again Later.";
            }
        }
    }
?>
                                <div id="contact" class="as-titel pt-40">
                <?php
                    if(isset($msg)){
                ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong><?php echo $msg; ?></strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                <?php
                    }
                ?>
                                    <h4>Leave a Message</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="leave-comment">
                <?php
                    if(isset($error)){
                ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong><?php echo $error; ?></strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                <?php
                    }
                ?>

                                            <form action="" class="form-group" method="post">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-single">
                                                            <label>Name*</label>
                                                            <input id="name" class="form-control" name="name" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-single two">
                                                            <label>E-mail*</label>
                                                            <input id="email" class="form-control" name="email" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-single">
                                                            <label>Phone*</label>
                                                            <input id="phone" class="form-control" name="mobile" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-single two">
                                                            <label>Subject*</label>
                                                            <input id="subject" class="form-control" name="subject" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-textarea">
                                                            <label>Message*</label>
                                                            <textarea id="message" class="form-control" name="message" rows="9"></textarea>
                                                        </div>
                                                        <div class="form-button">
                                                            <button class="contact-submit" type="submit" name="submit">SEND MESSAGE</button>
                     
                                                </div>      
                                                    </div>
                                                </div>
                                            </form>
<!--                                            <p class="form-messege"></p>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php include 'includes/footer.php'; ?>