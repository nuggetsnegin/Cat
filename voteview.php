<?php
session_start(); // Starting Session
require_once('config.php');
	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die ('Your DB connection is misconfigured. Enter the correct values and try again.');
	$user = $_SESSION['login_user'];
	$query = mysqli_query($link, "SELECT idUsers FROM Users WHERE user = '$user'");
	$row=mysqli_fetch_array($query);
	$userID=$row['idUsers'];
?>


<html>
    <head>
        <title>SUPER AWESOME CAT PHOTOS</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Project, INFX2670">
		<meta name="author" content="Negin Sauermann & Richard Sage">
		
		<!-- Bootstrap/CSS Import FrontEnd Framework -->
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
	
		<!-- Custom Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
		<!-- Plugin CSS -->
		<link rel="stylesheet" href="css/animate.min.css" type="text/css">
		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/creative.css" type="text/css">	
	</head>
	
	<body>
	
	<?php include 'navigation.php';?>
	
	<h1> Welcome, <?php 
	echo $_SESSION['login_user']; ?> !</h1>
		
 <!-- Source http://www.9lessons.info/2009/08/vote-with-jquery-ajax-and-php.html-->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
				libs/jquery/1.3.0/jquery.min.js"></script>
				<script type="text/javascript">
				$(function() {
				$(".vote").click(function() 
				{
					var id = $(this).attr("id");
					var name = $(this).attr("name");
					var dataString = 'id='+ id ;
					var parent = $(this);
					//document.write(dataString);
					if (name=='up')
					{
						$(this).fadeIn(200).html('<img src="dot.gif" />');
						$.ajax({
						type: "POST",
						url: "up_vote.php",
						data: dataString, 
						cache: false,

						success: function(html)
				{
					parent.html(html);
				} 
				});
				}
				return false;
					});
					});
				</script>
				
				
				
	<section class="bg-primary" id="about">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-2 text-center">
					<h1> Voting: </h1>
				Vote for your favorite cat pictures~<br><br>
		 

				<?php
					$sql=mysqli_query($link, "SELECT idImages, filepath, votes, userId FROM Images LIMIT 100");
					while($row=mysqli_fetch_array($sql))
					{
						$votes=$row['votes'];
						$fpath=$row['filepath'];
						$idImages=$row['idImages'];
						$userId=$row['userId'];
				?>

			
	<!-- div resize -->			
	<section class="no-padding" id="portfolio">
        <div class="container-fluid">

                <div class="col-lg-4 col-sm-6">
					<?php echo "<img src=" . $fpath . " class=\"img-responsive\" alt=\"\">";?>
					<!--upvote buton -->
					<div class="main"> 
					<div class="box1">
					<div class='up'>
						<a href="" class="vote" id="<?php echo $idImages; ?>" name="up">
					<?php echo $votes; ?></a></div>		
					</div></div></div>
                </div>
			
				<?php } ?>
		</div></div></div>
	</section>

		<!-- scripts from Creative -->
		 <!-- jQuery -->
		<script src="js/jquery.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Plugin JavaScript -->
		<script src="js/jquery.easing.min.js"></script>
		<script src="js/jquery.fittext.js"></script>
		<script src="js/wow.min.js"></script>
		<!-- Custom Theme JavaScript -->
		<script src="js/creative.js"></script>
	</body>
</html>