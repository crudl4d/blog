<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Blog</title>
	<link rel="stylesheet" href="fontawesome/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-blog.css" rel="stylesheet">
</head>
<body>
	<header class="tm-header" id="tm-header">
        <div class="tm-header-wrapper">
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="tm-site-header">
                <div class="mb-3 mx-auto tm-site-logo"><i class="fas fa-times fa-2x"></i></div>            
                <h1 class="text-center">My Blog</h1>
            </div>
			<?php include "./header.html"?>
            <div class="tm-mb-65">
                <a href="https://facebook.com" class="tm-social-link">
                    <i class="fab fa-facebook tm-social-icon"></i>
                </a>
                <a href="https://twitter.com" class="tm-social-link">
                    <i class="fab fa-twitter tm-social-icon"></i>
                </a>
                <a href="https://instagram.com" class="tm-social-link">
                    <i class="fab fa-instagram tm-social-icon"></i>
                </a>
                <a href="https://linkedin.com" class="tm-social-link">
                    <i class="fab fa-linkedin tm-social-icon"></i>
                </a>
            </div>
            <p class="tm-mb-80 pr-5 text-white">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
        </div>
    </header>
    <div class="container-fluid">
        <main class="tm-main">
            <!-- Search form -->
            <div class="row tm-row">
                <div class="col-12">
                    <form method="GET" class="form-inline tm-mb-80 tm-search-form">                
                        <input class="form-control tm-search-input" name="query" type="text" placeholder="Search..." aria-label="Search">
                        <button class="tm-search-button" type="submit">
                            <i class="fas fa-search tm-search-icon" aria-hidden="true"></i>
                        </button>                                
                    </form>
                </div>                
            </div>  
			<?php
			try{
			if(isset($_POST['message'])){
				$to = "damiankaczmarczyk0@gmail.com";
				$subject = $_POST['subject'];
				$txt = $_POST['message'];
				$headers = "From: " . $_POST['email'] . "\r\n";

				mail($to,$subject,$txt,$headers);
			}
			}catch(Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			?>			
            <div class="row tm-row tm-mb-45">
                <div class="col-12">
                    <hr class="tm-hr-primary tm-mb-55">
                    <div class="gmap_canvas"> <!-- Google Map -->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2143.190840182298!2d19.136310722263936!3d50
						.29756880245591!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4716da83f9e846e1%3A0x3ff406cf0f2cb7dd!2s
						Instytut%20Informatyki%2C%20Wydzia%C5%82%20Nauk%20%C5%9Acis%C5%82ych%20i%20Technicznych%2C%20Uniwersytet%20%C5%9Al%C4%85ski!5e0!3m2!1spl!2spl!4v1635267679237!5m2!1spl!2spl" 
						width="1000" height="600" style="border:0" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>                
            </div>
            <div class="row tm-row tm-mb-120">
                <div class="col-12">
                    <h2 class="tm-color-primary tm-post-title tm-mb-60">Contact me</h2>
                </div>
                <div class="col-lg-7 tm-contact-left">
                    <form method="POST" action="" class="mb-5 ml-auto mr-0 tm-contact-form">                        
                        <div class="form-group row mb-4">
                            <label for="name" class="col-sm-3 col-form-label text-right tm-color-primary">Name</label>
                            <div class="col-sm-9">
                                <input class="form-control mr-0 ml-auto" name="name" id="name" type="text" required>                            
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="email" class="col-sm-3 col-form-label text-right tm-color-primary">Email</label>
                            <div class="col-sm-9">
                                <input class="form-control mr-0 ml-auto" name="email" id="email" type="email" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="subject" class="col-sm-3 col-form-label text-right tm-color-primary">Subject</label>
                            <div class="col-sm-9">
                                <input class="form-control mr-0 ml-auto" name="subject" id="subject" type="text" required>
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <label for="message" class="col-sm-3 col-form-label text-right tm-color-primary">Message</label>
                            <div class="col-sm-9">
                                <textarea class="form-control mr-0 ml-auto" name="message" id="message" rows="8" required></textarea>                                
                            </div>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col-12">
							<form method="POST" action="contact.php" name="send">
                                <button class="tm-btn tm-btn-primary tm-btn-small">Submit</button>
							</form>								
                            </div>                            
                        </div>                                
                    </form>
                </div>
                <div class="col-lg-5 tm-contact-right">
                    <address class="mb-4 tm-color-gray">
                        120 Lorem ipsum dolor sit amet,
                        consectetur adipiscing 10550
                    </address>
                    <span class="d-block">
                        Tel:
                        <a href="tel:123 456 789" class="tm-color-gray">123 456 789</a>
                    </span>
                    <span class="mb-4 d-block">
                        Email:
                        <a href="mailto:damiankaczmarczyk0@gmail.com" class="tm-color-gray">damiankaczmarczyk0@gmail.com</a>
                    </span>
                    <p class="mb-5 tm-line-height-short">
                        Maecenas eu mi eu dui cursus
                        consequat non eu metus. Morbi ac
                        turpis eleifend, commodo purus
                        eget, commodo mauris.
                    </p>
                    <ul class="tm-social-links">
                        <li class="mb-2">
                            <a href="https://facebook.com" class="d-flex align-items-center justify-content-center">
                                <i class="fab fa-facebook"></i>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://twitter.com" class="d-flex align-items-center justify-content-center">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://youtube.com" class="d-flex align-items-center justify-content-center">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://instagram.com" class="d-flex align-items-center justify-content-center mr-0">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>      
            <footer class="row tm-row">
                <div class="col-md-6 col-12 tm-color-gray tm-copyright">
                    Copyright 2021 Damian Kaczmarczyk
                </div>
            </footer>
        </main>
    </div>
</body>
</html>