<?php
$host="localhost";
$user="root";
$password="";
$dbname="blog";
$con=mysqli_connect($host,$user,$password,$dbname);
if(!$con) {
  echo 'Connection error';
}
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
				<form method="POST" action="http://localhost/blog/edit-post.php?postId=<?php echo $_GET['postId']?>">
				<button class="tm-search-button" type="submit" value="Submit">
					Edytuj
				</button>
				</form>
				<form method="POST" action="http://localhost/blog/delete-post.php?postId=<?php echo $_GET['postId']?>">
				<button class="tm-search-button" type="submit" value="Submit">
					Usuń
				</button>				
				</form>			
            <div class="row tm-row">
                <div class="col-12">
                    <hr class="tm-hr-primary tm-mb-55">
                    <img src="img/img-post.jpg" width="1000" height="600"></img>
                </div>
            </div>
			<?php
			$title = $author = $category = $content = $subject = '';
			$postId = $_GET['postId'];
			$sql = "SELECT id, subject, author, category, content FROM posts WHERE id=$postId";
			$result = $con->query($sql);
			$posts = array();
			if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
				$title = $row["subject"];
				$content = $row["content"];
				$category = $row["category"];
				$author = $row["author"];
				$subject = $row["subject"];
			} else {
			  echo "Post empty.";
			}
			?>
            <div class="row tm-row">
                <div class="col-lg-8 tm-post-col">
                    <div class="tm-post-full">                    
                        <div class="mb-4">
                            <h2 class="pt-2 tm-color-primary tm-post-title"><?php echo $title?></h2>
                            <p class="tm-mb-40">posted by <?php echo $author ?></p>
                            <p>
                                <?php echo $content ?>
							</p>
                            <span class="d-block text-right tm-color-primary"><?php echo $category ?></span>
                        </div>
                        
                        <!-- Comments -->
                        <div>
                            <h2 class="tm-color-primary tm-post-title">Comments</h2>                          
							<?php 
								class Comment{
										public $author = '';
										public $content = '';
								}
								$sql = "SELECT id, content, author FROM comments WHERE post='$_GET[postId]'";
								$result = $con->query($sql);
								$comments = array();
								if ($result->num_rows > 0) {
								  // output data of each row
								  while($row = $result->fetch_assoc()) {
									$comment = new Comment();
									$comment->author = $row["author"];
									$comment->content = $row["content"];
									array_push($comments, $comment);
								  }
								} else {
								  echo "No comments";
								}		
								for($i = 0; $i < mysqli_num_rows($result); $i++){?>
									<hr class="tm-hr-primary tm-mb-45">
									<figure class="tm-comment-figure">
										<figcaption class="tm-color-primary text-center"><?=$comments[$i]->author ?></figcaption>
									</figure>
									<div>
										<p>
											<?=$comments[$i]->content ?>
										</p>                                             
									</div> 
								<?php }; ?>
							</div>
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
										$captchaErr = "Wrong captcha";
									}else{$captchaErr = "";}
								}
							?>
                            <div class="tm-comment-reply tm-mb-45">
                                <hr>
                                <div class="tm-comment">
                                    <figure class="tm-comment-figure">
                                        <figcaption class="tm-color-primary text-center"><?php echo $name?></figcaption>    
                                    </figure>
                                </div>                                
                            </div>	
                            <form action="<?php echo 'add-comment.php?postId=' . $_GET['postId']?>" class="mb-5 tm-comment-form" method="post">
                                <h2 class="tm-color-primary tm-post-title mb-4">Twój komentarz</h2>
                                <div class="mb-4">
                                    <strong>Nick*</strong><input class="form-control" name="name" type="text">
									<span style="color:red"><?php echo $nameErr;?></span>
                                </div>
                                <div class="mb-4">
                                    <strong>E-mail*</strong><input class="form-control" name="email" type="text">
									<span style="color:red"><?php echo $mailErr;?></span>
                                </div>
                                <div class="mb-4">
                                    <strong>Treść komentarza*</strong><textarea class="form-control" name="comment" rows="6"></textarea>
									<span style="color:red"><?php echo $commentErr;?></span>
                                </div>
								<div>
									<strong><?php echo($dzialanie)?></strong>
									<input type="text" name="captcha">
									
									<span style="color:red"><?php echo $captchaErr;?></span>
								</div>
                                <div class="text-right">
                                    <input type="submit"  value="Submit">                    
                                </div>                            
                            </form>						
                        </div>
                    </div>
                </div>
            </div>
            <?php include "./footer.html" ?>
        </main>
    </div>
</body>
</html>