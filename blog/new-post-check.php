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
				if (isset($_POST['newPost'])){
					$_SESSION['post'] = $_POST['newPost'];
					$_SESSION['subject'] = $_POST['subject'];
				}
				$searchBbCodes = array(
					'[b]',
					'[/b]',
					'[i]',
					'[/i]',
					'[u]',
					'[/u]',
					'[url]',
					'[/url]'
				);
				$replaceBbCodes = array(
					'<b>',
					'</b>',
					'<i>',
					'</i>',
					'<u>',
					'</u>',
					'<a href=',
					'>link</a>'
				);
				$visual = str_replace($searchBbCodes, $replaceBbCodes, $_SESSION["post"]);
				$_SESSION["validatedPost"] = $visual;
				echo $visual; ?>
				<div>
				<?php
					if($numbers[$_SESSION["result"]] != $_POST["captcha"]){
						echo "<p style='color:red'>Błędna captcha, spróbuj ponownie";
					} else {?>
				<form action = "http://localhost/blog/new-post.php">
					<button class="tm-search-button" type="submit" value="Submit">
						Cofnij
					</button>
				</form>	
				<form action = "http://localhost/blog/new-post-check-do.php" method="post">			
					<button class="tm-search-button" type="submit" name="insert" value="Submit">
						Dodaj
					</button> 
				</form>
					<?php } ?>
				</div>				
			<div>
			
			</div>
            <?php include "./footer.html" ?>
        </main>
    </div>
</body>
</html>