<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php

	if(!isset($_SESSION['username'])) {
    	header("location: ".APPURL."");
  	}

    //veriyi çekme işlemi

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $select = $conn->query("SELECT * FROM replies WHERE id = '$id'");
        $select->execute();

        $reply = $select->fetch(PDO::FETCH_OBJ);

        if($reply->user_id != $_SESSION['user_id']) {
            header("location: ".APPURL."");
        }
    }

	if(isset($_POST['submit'])) {

		if(empty($_POST['reply'])) {
			echo "<script>alert('bilgileriniz eksik');</script>";
		} 	else {

			$reply = $_POST['reply'];
	
			

			$update = $conn->prepare("UPDATE replies SET reply = :reply WHERE id = '$id'");

			$update->execute([
    				":reply" => $reply,

                    
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
						<h1 class="pull-left">Tartisma yarat</h1>
						<h4 class="pull-right">OHA</h4>
						<div class="clearfix"></div>
						<hr>
						<form role="form" method="POST" action="update.php?id=<? echo $id; ?>">
							<div class="form-group">
								<label>Yanitla</label>
								<input type="text" value="<?php echo $reply->reply; ?>" class="form-control" name="reply" placeholder="Enter reply">
							</div>
							
							<button type="submit" name="submit" class="color btn btn-default">Güncelle</button>
						</form>
					</div>
				</div>
			</div>
<?php require "../includes/footer.php"; ?>