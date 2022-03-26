<!DOCTYPE html>
<html lang="pl">
<?php include "./head.html";
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
						setcookie('username', '', time() - 3600, "/");
						setcookie('role', '', time() - 3600, "/");
						echo "Logged out successfully";
						?>
					</div>
                </div>
            </div>
            <?php include "./footer.html";
			?>
        </main>
    </div>
</body>
</html>