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
							if($_SERVER["REQUEST_METHOD"] != "POST"){
								randomize($numbers);
							}
							$name = $email = $comment = $nameErr = $mailErr = $commentErr = $captcha =
								$captchaErr = "";
							if ($_SERVER["REQUEST_METHOD"] == "POST") {
								if (empty($_POST["login"])) {
									$nameErr = "Name is required";
								  } else {
									$name = $_POST["login"];
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
							<form name="register" method="POST"  action="register-action.php">
								<p><label for="imie">Imie:</label>
								<input name="name" type="text" placeholder="Wpisz swoje imie" required autofocus></p>
								
								<p><label for="nazwisko">Login:</label>
								<input name="login" type="text" placeholder="Wpisz swój login" required></p>
								
								<p><label for="email">Email:</label>
								<input name="email" type="email" placeholder="Wpisz swój email" required></p>
								
								<p><label for="password">Hasło:</label>
								<input name="password" type="password" placeholder="Wpisz swoje hasło" required></p>
								
								<p><label for="dataUrodzenia">Data urodzenia:</label>
								<input name="dataUrodzenia" type="datetime-local" placeholder="Podaj swoją datę urodzenia"></p>
								
								<p><label for="stronaInternetowa">Strona internetowa:</label>
								<input name="stronaInternetowa" type="text" placeholder="Podaj swoją stronę internetową"></p>
								
								<p><label for="kolor">Ulubiony kolor:</label>
								<input name="kolor" type="color"></p>
								
								<div>
									<strong><?php echo($dzialanie)?></strong>
									<input type="text" name="captcha">
									
									<span style="color:red"><?php echo $captchaErr;?></span>
								</div>
								
								<p><input type="submit" value="zarejestruj"></p>
							</form>

							<script type="text/javascript">
								function invalidHandler(evt) {
									// Znajdz label dla kontrolki, ktora nie zostala wyswietlona
									var label = evt.srcElement.parentElement.getElementsByTagName("label")[0];
									var input = evt.srcElement.parentElement.getElementsByTagName("input")[0];
									// ustaw kolor na czerwony
									if(evt.srcElement.validity.valueMissing){
										label.style.color = 'red';
										input.style.background = 'red';
									}
									// zatrzymaj powiadamianie o zdarzeniu dalej
									evt.stopPropagation();
									// zatrzymaj domyslne zachowanie przegladarki
									evt.preventDefault();
								}
								function zarejestruj() {
									// zarejestruj procedure obslugi zdarzenia 
									document.register.addEventListener("invalid", invalidHandler, true);
								}
								window.addEventListener("load", zarejestruj, false);
							</script>
						</div>
					</div>
                </div>
            </div>
            <?php include "./footer.html";
			?>
        </main>
    </div>
</body>
</html>