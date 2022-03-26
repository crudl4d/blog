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
						$visual="test";
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
							$loginErr = $captchaErr =  $passwordErr = "";
							if ($_SERVER["REQUEST_METHOD"] == "POST") {
								if (empty($_POST["login"])) {
									$nameErr = "Login is required";
								  } else {
									$login = $_POST["login"];
									}
								if (empty($_POST["password"])) {
									$mailErr = "Password is required";
								  } else {
									$password = $_POST["password"];
									}
								if($numbers[$_SESSION["result"]] != $_POST["captcha"]){
									$captchaErr = "wrong result";
									echo "Wrong result";
								} else {$captchaErr = "";}
								if($loginErr =="" && $captchaErr =="" && $passwordErr ==""){
									global $con;
									$login = $password = $active = $role = "";
									$result = $con->query("SELECT role, login, password, active FROM User WHERE login='$_POST[login]'");
									if ($result->num_rows > 0) {
									  while($row = $result->fetch_assoc()) {
										  global $login; global $password; global $role; global $active;
											$login = $row['login'];
											$password = $row['password'];
											$active = $row['active'];
											$role = $row['role'];
										}
									}
									if($login == $_POST["login"] && password_verify($_POST["password"],$password) && $active == '1'){
										setcookie('username', $login, time() + (86400 * 30), "/"); // 86400 = 1 day
										setcookie('role', $role, time() + (86400 * 30), "/"); // 86400 = 1 day
										echo "Logged in succesfully";
									}
								}
								$con->close();
							}
						?>
						<div>
						<!-- form -->	
							
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
			session_destroy();
			?>
        </main>
    </div>
</body>
</html>