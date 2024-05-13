<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php

	if(!isset($_SESSION['username'])) {
    	header("location: ".APPURL."");
  	}

	if(isset($_POST['submit'])) {

		if(empty($_POST['title']) OR empty($_POST['category']) OR empty($_POST['body'])) {
			echo "<script>alert('bilgileriniz eksik');</script>";
		} 	else {

			$title = $_POST['title'];
			$category = $_POST['category'];
			$body = $_POST['body'];
			$user_name = $_SESSION['name'];
			$user_image = $_SESSION['user_image'];
			

			$insert = $conn->prepare("INSERT INTO topics (title, category, body, user_name, user_image)
                 VALUES (:title, :category, :body, :user_name, :user_image)");

			$insert->execute([
    				":title" => $title,
    				":category" => $category,
    				":body" => $body,
    				":user_name" => $user_name,
					":user_image" => $user_image,
			]);
				header("location: ".APPURL."");
		}

	}
	


?>

    <div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left">Tartisma Yarat</h1>
						<h4 class="pull-right">OHA</h4>
						<div class="clearfix"></div>
						<hr>
						<form role="form" method="POST" action="create.php">
							<div class="form-group">
								<label>Konu Basligi</label>
								<input type="text" class="form-control" name="title" placeholder="Konu Başligi Girin">
							</div>
							<div class="form-group">
								<label>Kategoriler</label>
								<select name="category" class="form-control">
									<option value="Haberler">Haberler</option>
									<option value="Futbol">Futbol</option>
									<option value="Oyunlar">Oyunlar</option>
									<option value="Ekonomi">Ekonomi</option>
									<option value="Sanat">Sanat</option>
							</select>
							</div>
								<div class="form-group">
									<label>Topic Body</label>
									<textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
									<script>CKEDITOR.replace('body');</script>
								</div>
							<button type="submit" name="submit" class="color btn btn-default">Olustur</button>
						</form>
					</div>
				</div>
			</div>
<?php require "../includes/footer.php"; ?>