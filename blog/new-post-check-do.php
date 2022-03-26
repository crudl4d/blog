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
							if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['insert']))
								{
									insert();
								}
							function insert(){
								global $con;
								$content = $_SESSION["validatedPost"];
								if($con->query("INSERT INTO posts (Subject, Author, Category, Content) VALUES('$_SESSION[subject]', 'User', 'category', '$content')")==true)
									echo("Post added successfully");
								else
									echo("Error while adding post");
							}
							$con->close();
							?>
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