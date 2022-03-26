<?php
session_start();
$host="localhost";
$user="root";
$password="";
$dbname="blog";
$con=mysqli_connect($host,$user,$password,$dbname);
if(!$con) {
  echo 'Connection error';
}
?>

<!DOCTYPE html>
<html lang="pl">
<?php include "./head.html" ?>
<body>
	<?php include "./header.html"?>
    <div class="container-fluid">
        <main class="tm-main">
            <?php include "./search.html";
				$title = $author = $category = $content = $subject = '';
				$postId = $_GET['postId'];
				$sql = "SELECT id, subject, author, category, content FROM posts WHERE id=$postId";
				$result = $con->query($sql);
				$posts = array();
				if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
					$content = $row["content"];
					$category = $row["category"];
					$author = $row["author"];
					$subject = $row["subject"];
				} else {
				  echo "0 results";
				}
			?>
				<form id="editForm" method="POST" action="http://localhost/blog/edit-post-do.php?postId=<?php echo $_GET['postId']?>">
				<textarea name="subject" id = "sub" form="editForm"><?php echo $subject ?>
				</textarea><br>
				<textarea name="editedPost" id = "ep" form="editForm"><?php echo $content ?>
				</textarea><br>
				<?php if(isset($_COOKIE['role']) &&($_COOKIE['role']=="USER" || $_COOKIE['role']=="ADMIN")){?>
				<button class="tm-search-button" type="submit" value="Zapisz">
					Zapisz
				</button>  
				<?php } else echo "<p style='color:red'>You are not logged in!"?>
				</form>
            <?php include "./footer.html" ?>
        </main>
    </div>
</body>
</html>
<?php session_destroy()?>