<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>EMS | Event Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript"> 
addEventListener("load", function() { 
    setTimeout(hideURLbar, 0); 
}, false); 
function hideURLbar(){ 
    window.scrollTo(0,1); 
} 
</script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<!--//end-animate-->
</head>
<body>
<?php include('includes/header.php');?>
<!-- Search Form -->
<div class="container">
    <form action="" method="post">
        <div class="input-group">
            <select name="location" class="form-control">
                <option value="">Select Location</option>
                <option value="Bangalore">Bangalore</option>
                <option value="Mumbai">Mumbai</option>
                <option value="Gujarat">Gujarat</option>
                <option value="Delhi">Delhi</option>
                <option value="Hyderabad">Hyderabad</option>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" name="search">Search</button>
            </span>
        </div>
    </form>
</div>

<div class="banner">
    <div class="container">
        <!-- <h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;" style="color:#000 !important"> EMS - Mosaic Events</h1> -->
    </div>
</div>
<!---pool ----->
<div class="poll">
    <div class="question"></div>
    <div class="answers"></div>
</div>



<!---holiday---->
<div class="container">
    <div class="holiday">
        <h3>Event List</h3>

        <?php
        $location = isset($_POST['location']) ? $_POST['location'] : '';
        if (isset($_POST['search']) && !empty($location)) {
            $location = "%$location%";
            $sql = "SELECT * FROM tbltourpackages WHERE PackageLocation LIKE :location ORDER BY rand() LIMIT 4";
            $query = $dbh->prepare($sql);
            $query->bindParam(':location', $location, PDO::PARAM_STR);
        } else {
            $sql = "SELECT * FROM tbltourpackages ORDER BY rand() LIMIT 4";
            $query = $dbh->prepare($sql);
        }
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>
                <div class="rom-btm">
                    <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
                        <img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage); ?>" class="img-responsive" alt="">
                    </div>
                    <div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
                        <h4>Event Name: <?php echo htmlentities($result->PackageName); ?></h4>
                        <h6>Event Type : <?php echo htmlentities($result->PackageType); ?></h6>
                        <p><b>Event Location :</b> <?php echo htmlentities($result->PackageLocation); ?></p>
                        <p><b>Features</b> <?php echo htmlentities($result->PackageFetures); ?></p>
                    </div>
                    <div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
                        <h5>USD <?php echo htmlentities($result->PackagePrice); ?></h5>
                        <a href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId); ?>" class="view">Details</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php }
        } else {
            echo "<h5>No events found for the searched location.</h5>";
        } ?>
        
        <div><a href="package-list.php" class="view">View More Events</a></div>
    </div>
    <h3 style="font-weight: bold;">A Word From Our Customers</h3>
     <!-- Testimonials Section -->
     <div class="testimonials">
            <div class="testimonial">
                <p>"The team was very swift in getting the deals for all the hotels we had requested them. The final quotes from the hotels were definitely way less than the market price, so have to say, Mosaic Events does get you value for money. Keep up the good work!"</p>

                <div class="author">Varun Sharma</div>
                <h4>Booked a Corporate Party Venue</h4>
            </div>
            <div class="testimonial">
                <p>"Very quick response to my query for searching the venue. I was provided with many options which made my choice quite clear and according to my budget. Thanks Mosaic Events for quick response and making things very clear before I could finalize everything."</p>
                <div class="author">Sunny Jain, Snapdeal</div> 
                    <h4>Booked a Team Party Venue</h4>
            </div>
            <div class="testimonial">
                <p>" I was provided with many options which made my choice quite clear and according to my budget. Thanks Mosaic Events for quick response and making things very clear before I could finalize everything."</p>
                <div class="author">Sunny Jain, Snapdeal</div> 
                    <h4>Booked a Team Party Venue</h4>
            </div>
            <div class="testimonial">
                <p>"I really appreciate from the bottom of my heart the service you provide. it was really hard to find a perfect venue for a big corporate party in DELHI NCR region but Mosaic Event made it to easy.""
</p>
<div class="author">Sunny Jain, Snapdeal </div>
                <h4 class="author">- Booked a Team Party Venue</h4>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<!--- routes ---->
<div class="routes">
    <div class="container">
        <div class="col-md-4 routes-left wow fadeInRight animated" data-wow-delay=".5s">
            <div class="rou-left">
                <a href="#"><i class="glyphicon glyphicon-list-alt"></i></a>
            </div>
            <div class="rou-rgt wow fadeInDown animated" data-wow-delay=".5s">
                <h3>80000</h3>
                <p>Enquiries</p>
            </div>
                <div class="clearfix"></div>
        </div>
        <div class="col-md-4 routes-left">
            <div class="rou-left">
                <a href="#"><i class="fa fa-user"></i></a>
            </div>
            <div class="rou-rgt">
                <h3>1900</h3>
                <p>Registered users</p>
            </div>
                <div class="clearfix"></div>
        </div>
        <div class="col-md-4 routes-left wow fadeInRight animated" data-wow-delay=".5s">
            <div class="rou-left">
                <a href="#"><i class="fa fa-ticket"></i></a>
            </div>
            <div class="rou-rgt">
                <h3>7,00,00,000+</h3>
                <p>Booking</p>
            </div>
                <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
<!-- signup -->
<?php include('includes/signup.php'); ?>            
<!-- //signup -->
<!-- signin -->
<?php include('includes/signin.php'); ?>            
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php'); ?>            
<!-- //write us -->
</body>
</html>
