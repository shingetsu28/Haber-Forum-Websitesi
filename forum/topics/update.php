<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php

	if(!isset($_SESSION['username'])) {
    	header("location: ".APPURL."");
  	}

    //veriyi çekme işlemi

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $select = $conn->query("SELECT * FROM topics WHERE id = '$id'");
        $select->execute();

        $topic = $select->fetch(PDO::FETCH_OBJ);

        if($topic->user_name != $_SESSION['username']) {
            header("location: ".APPURL."");
        }
    }

	if(isset($_POST['submit'])) {

		if(empty($_POST['title']) OR empty($_POST['category']) OR empty($_POST['body'])) {
			echo "<script>alert('bilgileriniz eksik');</script>";
		} 	else {

			$title = $_POST['title'];
			$category = $_POST['category'];
			$body = $_POST['body'];
			$user_name = $_SESSION['name'];
			

			$update = $conn->prepare("UPDATE topics SET title = :title,
            category = :category, body = :body, user_name = :user_name");

			$update->execute([
    				":title" => $title,
    				":category" => $category,
    				":body" => $body,
    				":user_name" => $user_name,
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
						<h1 class="pull-left">Tartişma Yarat</h1>
						<h4 class="pull-right">OHA</h4>
						<div class="clearfix"></div>
						<hr>
						<form role="form" method="POST" action="update.php?id=<? echo $id; ?>">
							<div class="form-group">
								<label>Topic Title</label>
								<input type="text" value="<?php echo $topic->title; ?>" class="form-control" name="title" placeholder="Enter Post Title">
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
									<textarea id="body" rows="10" cols="80" class="form-control" name="body"><?php echo $topic->body; ?></textarea>
									<script>CKEDITOR.replace('body');</script>
								</div>
							<button type="submit" name="submit" class="color btn btn-default">Güncelle</button>
						</form>
					</div>
				</div>
			</div>
<?php require "../includes/footer.php"; ?>