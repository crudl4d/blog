<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<?php include "../head.html" ?>
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
		<nav class="tm-nav" id="tm-nav">            
			<ul>
				<li class="tm-nav-item active"><a href="../index.php?page=1" class="tm-nav-link">
					<i class="fas fa-home"></i>
					Homepage
				</a></li>
				<li class="tm-nav-item"><a href="../about.php" class="tm-nav-link">
					<i class="fas fa-users"></i>
					About Me
				</a></li>
				<li class="tm-nav-item"><a href="../contact.php" class="tm-nav-link">
					<i class="far fa-comments"></i>
					Contact Me
				</a></li>
				<li class="tm-nav-item"><a href="../new-post.php" class="tm-nav-link">
					<i class="far fa-comments"></i>
					New Post
				</a></li>
				<li class="tm-nav-item"><a href="../register.php" class="tm-nav-link">
					<i class="far fa-comments"></i>
					Register
				</a></li>
				<li class="tm-nav-item"><a href="admin-panel.php" class="tm-nav-link">
					<i class="far fa-comments"></i>
					Admin Panel
				</a></li>
				<li class="tm-nav-item"><a href="../login.php" class="tm-nav-link">
					<i class="far fa-comments"></i>
					Log in
				</a></li>
				<li class="tm-nav-item"><a href="../logout.php" class="tm-nav-link">
					<i class="far fa-comments"></i>
					Log out
				</a></li>
			</ul>
		</nav>
		<div class="tm-mb-65">
			<a rel="nofollow" href="https://fb.com/templatemo" class="tm-social-link">
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
            <?php include "../search.html"?>
			<?php
				$host="localhost";
				$user="root";
				$password="";
				$dbname="blog";
				$con = new mysqli($host,$user,$password,$dbname);
				if(!$con) {
				  echo 'Connection error';
				}
				$result = $con->query("SELECT ID, Email, Login, Password, Active FROM user WHERE ID=" . $_GET['id']);
				if ($result->num_rows > 0) {
				  // output data of each row
				  ?>
				  <table id="users" style="collapse-border:collapse; border: 1px solid black"><th>ID</th><th>Email</th><th>Nick</th><th>Aktywny</th><th>Zapisz</th>
				  <?php
				  while($row = $result->fetch_assoc()) {
					echo "<tr style='collapse-border:collapse; border: 1px solid black'>";
					echo "<td  style='collapse-border:collapse; border: 1px solid black'>" . 
					"<form method='POST' action='admin-edit.php?id=".$row["ID"]."'>".
					$row["ID"] . "</td>". "<td style='collapse-border:collapse; border: 1px solid black'>" . 
					"<textarea rows=1 name='email'>". $row["Email"]."</textarea>" . "</td>". "<td  style='collapse-border:collapse; border: 1px solid black'>" . 
					"<textarea rows=1 name='login'>". $row["Login"]."</textarea>" . "</td>" . "<td  style='collapse-border:collapse; border: 1px solid black'>".
					"<textarea rows=1 name='active'>". $row["Active"]."</textarea>" . "</td>" . "<td  style='collapse-border:collapse; border: 1px solid black'>".
					"<input type='submit' name='save'/></form>";
				  }
				} else {
				  echo "0 results";
				}
				
				if(isset($_POST['save']))
				{
				   save();
				} 
				
				function save(){
					global $con;
					if(isset($_POST)){
						if($con->query("UPDATE user SET email= '".$_POST['email']."', login= '".$_POST['login']."', active= '".$_POST['active'].
						  "' WHERE ID= " .$_GET['id'])==true)
							echo("Changes saved successfully");
						else
							echo("Saving changes to user failed");
					}
				}
			?>
			</table>
			<div>
			
			</div>
            <?php include "../footer.html" ?>
        </main>
    </div>
</body>
</html>
<?php session_destroy()?>