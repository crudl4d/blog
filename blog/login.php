<!DOCTYPE html>
<html lang="pl">
<?php
session_start();
 include "./head.html" ?>
<body>
	<?php include "./header.html"?>
    <div class="container-fluid">
        <main class="tm-main">
            <?php include "./search.html"?>        
            <div class="row tm-row">
                <div class="col-lg-8 tm-post-col">
                    <div class="tm-post-full">                    
						<?php
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
							$dzialanie = '';
							$znak;
							$result = 10;
							function randomize($numbers){
								global $result;
								global $znak;
								global $dzialanie;
								while($result >= 10 || $result < 0){
									try{
										$znak = rand(0,3);
										$num1 =  rand(0, 9);
										$num2 =  rand(0, 9);
										switch($znak){
											case 0:
												$znak = "+";
												$result = $num1 + $num2;
												break;
											case 1:
												$znak = "-";
												$result = $num1 - $num2;
												break;
											case 2:
												$znak = "*";
												$result = $num1 * $num2;
												break;
											case 3:
												$znak = "/";
												$result = $num1 / $num2;
												break;
										}
									} catch(DivisionByZeroError $e){
										continue;
									}
								}
								$dzialanie .= ($numbers[$num1] .  ' ' . $znak . ' ' . $numbers[$num2] . ' = ');
								$_SESSION["result"]= $result;
							}
							randomize($numbers);
							$name = $email = $comment = $nameErr = $mailErr = $commentErr = $captcha =
								$captchaErr = "";
							if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
								if($numbers[$result] != $_POST["captcha"]){
									$captchaErr = "wrong result";
									echo "wrong result";
								}else{$captchaErr = "";}
							}
						?>
						<div>
						<!-- form -->	
							<form name="login" method="POST"  action="login-do.php">
								<p><label for="imie">Login:</label>
								<input name="login" type="text" placeholder="Wpisz swój login" required autofocus></p>
								
								<p><label for="nazwisko">Hasło:</label>
								<input name="password" type="password" placeholder="Wpisz swoje hasło" required></p>
								
								<div>
									<strong><?php echo($dzialanie)?></strong>
									<input type="text" name="captcha">
									
									<span style="color:red"><?php echo $captchaErr;?></span>
								</div>
								
								<p><input type="submit" value="zaloguj"></p>
							</form>
						</div>
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
			//session_destroy();
			?>
        </main>
    </div>
</body>
</html>