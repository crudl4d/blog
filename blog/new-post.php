<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<?php include "./head.html" ?>
<body>
	<?php include "./header.html"?>
    <div class="container-fluid">
        <main class="tm-main">
            <?php include "./search.html"?>
				<form method="POST" action="http://localhost/blog/new-post-check.php">
				<input name="subject" class="form-control tm-search-input" type="text" placeholder="Title" 
				value="<?php if(isset($_SESSION['subject'])) echo $_SESSION['subject']?>"><br>
				<input name="newPost" class="form-control tm-search-input" name="query" type="text" placeholder="Write post" 
				value="<?php if(isset($_SESSION['post'])) echo $_SESSION['post']?>"><br>
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
							$captchaErr='';
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
							?>
							<div>
							<strong><?php echo($dzialanie)?></strong>
							<input type="text" name="captcha">
							
							<span style="color:red"><?php echo $captchaErr;?></span>
						</div>
						<?php if(isset($_COOKIE['role']) &&($_COOKIE['role']=="USER" || $_COOKIE['role']=="ADMIN")){?>
				<button class="tm-search-button" type="submit" value="Submit">
					Dodaj
				</button>  
						<?php } else echo "<p style='color:red'>You are not logged in!"?>
				</form>
            <?php include "./footer.html" ?>
        </main>
    </div>
</body>
</html>