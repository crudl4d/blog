<?php
$host="localhost";
$user="root";
$password="";
$dbname="blog";
$con=mysqli_connect($host,$user,$password,$dbname);
if(!$con) {
  echo 'Connection error';
}

class Post
{
	public $title = '';
	public $content = '';
}
?>

<!DOCTYPE html>
<html lang="pl">
<?php include "./head.html" ?>
<body>
	<?php include "./header.html"?>
    <div class="container-fluid">
        <main class="tm-main">
            <?php include "./search.html"?>          
            <div class="row tm-row">
			<?php 
				$sql = "SELECT id, subject, author, category, content FROM posts";
				$result = $con->query($sql);
				$posts = array();
				if ($result->num_rows > 0) {
				  // output data of each row
				  while($row = $result->fetch_assoc()) {
					$post = new Post();
					$post->title = $row["subject"];
					$post->content = $row["content"];
					array_push($posts, $post);
				  }
				} else {
				  echo "0 results";
				}
				$page = $_GET['page'];
				$results_per_page = 4;  
				if($page <= 0){
					$page = 1;
					$_GET['page'] = 1;
				} else if($page > ceil(mysqli_num_rows($result) / $results_per_page)){
					$page = ceil(mysqli_num_rows($result) / $results_per_page);
					$_GET['page'] = floor(mysqli_num_rows($result) / $results_per_page);
				}
				$page_first_result = ($page-1) * $results_per_page;
				if(is_numeric($_GET['page'])){			
					for($i = $page_first_result; $i < $results_per_page * $page; $i++){
						if($i > mysqli_num_rows($result)-1){
							break;
						}?>
						<article class="col-12 col-md-6 tm-post">
							<hr class="tm-hr-primary">
							<a href="<?php echo "post.php?postId=" . $i + 1?>" class="effect-lily tm-post-link tm-pt-60">
								<div class="tm-post-link-inner">
									<img src="img/img-01.jpg" alt="Image" class="img-fluid">                            
								</div>
								<h2 class="tm-pt-30 tm-color-primary tm-post-title"><?=$posts[$i]->title;?></h2>
							</a>
							<p class="tm-pt-30">
								<?=$posts[$i]->content;?>
							</p>
						</article>
					<?php }}else{
						echo "error";	
						}; ?>
            </div>
            <div class="row tm-row tm-mt-100 tm-mb-75">
                <div class="tm-prev-next-wrapper">
                    <a href="<?php echo "index.php?page=" . $_GET['page'] - 1?>" class="mb-2 tm-btn tm-btn-primary tm-prev-next disabled tm-mr-20">Prev</a>
                    <a href="<?php echo "index.php?page=" . $_GET['page'] + 1?>" class="mb-2 tm-btn tm-btn-primary tm-prev-next">Next</a>
                </div>
                <div class="tm-paging-wrapper">
                </div>                
            </div>            
            <?php include "./footer.html" ?>
        </main>
    </div>
</body>
</html>