<!DOCTYPE html>
<html lang="pl">
<?php include "./head.html";
session_start();
?>
<body>
	<?php include "./header.html"?>
    <div class="container-fluid">
        <main class="tm-main">
            <?php include "./search.html"?>        
            <div class="row tm-row">
                <div class="col-lg-8 tm-post-col">
                    <div class="tm-post-full">                    
						<?php
						$host="localhost";
						$user="root";
						$password="";
						$dbname="blog";
						$con=mysqli_connect($host,$user,$password,$dbname);
						if(!$con) {
						  echo 'Connection error';
						}

						$numbers = array(
							"zero",
							"jeden",
							"dwa",
							"trzy",
							"cztery",
							"pięć",
							"sześć",
							"siedem",
							"osiem",
							"dziewięć",
							);
							$nameErr = $mailErr = $commentErr = $captchaErr =  $passwordErr = "";
							if ($_SERVER["REQUEST_METHOD"] == "POST") {
								$_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
								if (empty($_POST["name"])) {
									$nameErr = "Name is required";
								  } else {
									$name = $_POST["name"];
									}
								if (empty($_POST["email"])) {
									$mailErr = "Mail is required";
								  } else {
									$email = $_POST["email"];
									}
								if (empty($_POST["comment"])) {
									$commentErr = "Comment is required";
								  } else {
									$comment = $_POST["comment"];
									}
								if($numbers[$_SESSION["result"]] != $_POST["captcha"]){
									$captchaErr = "wrong result";
									echo "Wrong result";
								} else {$captchaErr = "";}
								if($nameErr =="" && $mailErr =="" && $captchaErr =="" && $passwordErr ==""){
									global $con;
									if($con->query("INSERT INTO user (Role, Email, Login, Password) VALUES('USER', '$_POST[email]', '$_POST[login]', '$_POST[password]')")==true)
										echo("User added successfully");
									else
										echo("Adding user failed");
										}
									}
								$con->close();
						?>
					</div>
                </div>
                <aside class="col-lg-4 tm-aside-col">
                    <div class="tm-post-sidebar">
                        <hr class="mb-3 tm-hr-primary">
                        <h2 class="mb-4 tm-post-title tm-color-primary">Categories</h2>
                        <ul class="tm-mb-75 pl-5 tm-category-list">
                            <li><a href="#" class="tm-color-primary">Visual Designs</a></li>
                            <li><a href="#" class="tm-color-primary">Travel Events</a></li>
                            <li><a href="#" class="tm-color-primary">Web Development</a></li>
                            <li><a href="#" class="tm-color-primary">Video and Audio</a></li>
                            <li><a href="#" class="tm-color-primary">Etiam auctor ac arcu</a></li>
                            <li><a href="#" class="tm-color-primary">Sed im justo diam</a></li>
                        </ul>
                        <hr class="mb-3 tm-hr-primary">
                        <h2 class="tm-mb-40 tm-post-title tm-color-primary">Related Posts</h2>
                        <a href="#" class="d-block tm-mb-40">
                            <figure>
                                <img src="img/img-02.jpg" alt="Image" class="mb-3 img-fluid">
                                <figcaption class="tm-color-primary">Duis mollis diam nec ex viverra scelerisque a sit</figcaption>
                            </figure>
                        </a>
                        <a href="#" class="d-block tm-mb-40">
                            <figure>
                                <img src="img/img-05.jpg" alt="Image" class="mb-3 img-fluid">
                                <figcaption class="tm-color-primary">Integer quis lectus eget justo ullamcorper ullamcorper</figcaption>
                            </figure>
                        </a>
                        <a href="#" class="d-block tm-mb-40">
                            <figure>
                                <img src="img/img-06.jpg" alt="Image" class="mb-3 img-fluid">
                                <figcaption class="tm-color-primary">Nam lobortis nunc sed faucibus commodo</figcaption>
                            </figure>
                        </a>
                    </div>                    
                </aside>
            </div>
            <?php include "./footer.html";
			session_destroy();
			?>
        </main>
    </div>
</body>
</html>