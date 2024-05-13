<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php

	if(isset($SESSION['username'])) {
    header("location: ".APPURL."");
  	}

	if(isset($_POST['submit'])) {

		if(empty($_POST['name']) OR empty($_POST['email']) OR empty($_POST['username'])
		OR empty($_POST['password']) OR empty($_POST['about'])) {
			echo "<script>alert('bilgileriniz eksik');</script>";
		} 	else {

			$name = $_POST['name'];
			$email = $_POST['email'];
			$username = $_POST['username'];
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$about = $_POST['about'];
			$avatar = $_FILES['avatar']['name'];

			$dir = "img/" . basename($avatar);

			$insert = $conn->prepare("INSERT INTO users (name, email, username, password,
			about, avatar) VALUES (:name, :email, :username, :password, :about, :avatar)");

			$insert->execute([
				":name" => $name,
				":email" => $email,
				":username" => $username,
				":password" => $password,
				":about" => $about,
				":avatar" => $avatar,
			]);

			header("location: login.php");
		}

	}
	


?>

    <div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left">Kaydol</h1>
						<h4 class="pull-right">OHA</h4>
						<div class="clearfix"></div>
						<hr>
						<form role="form" enctype="multipart/form-data" method="post" action="register.php">
							<div class="form-group">
								<label>İsim*</label> <input type="text" class="form-control"
							name="name" placeholder="Enter Your Name">
							</div>
							<div class="form-group">
							<label>Email Adresi*</label> <input type="email" class="form-control"
							name="email" placeholder="Enter Your Email Address">
							</div>
						<div class="form-group">
					<label>Kullanici Adi*</label> <input type="text"
							class="form-control" name="username" placeholder="Create A Username">
						</div>
					<div class="form-group">
					<label>Şifre*</label> <input type="password" class="form-control"
				name="password" placeholder="Enter A Password">
				</div>
				<div class="form-group">
					<label>Resim Yükle</label>
				<input type="file" name="avatar">
				<p class="help-block"></p>
					</div>
					<div class="form-group">
					<label>Hakkimda</label>
					<textarea id="about" rows="6" cols="80" class="form-control"
					name="about" placeholder="Bize kendinden bahset (Opsiyonel)"></textarea>
			</div>
			<input name="submit" type="submit" class="color btn btn-default" value="Kaydol" />
</form>
					</div>
				</div>
			</div>

<?php require "../includes/footer.php"; ?>