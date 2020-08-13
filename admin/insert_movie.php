<?php require_once("../include/connect.php");
session_start();

if (!isset($_SESSION['admin_log'])) {
	redirect('login');
}

$titleError = $castError = $budgetError = $box_officeError = $directorError = $producerError = $descriptionError = $release_yearError = $imageError = "";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Find Movie</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<?php include "nav.php";?>

	<div class="container mt-5">
		<div class="row">
			<div class="col-lg-3">
				<?php include "side.php";?>
			</div>
			<div class="col-lg-9">
				
				<?php

				if(isset($_POST['insert'])){
					$title = $_POST['title'];
					$cast = $_POST['cast'];
					$category = $_POST['category'];
					$budget = $_POST['budget'];
					$box_office = $_POST['box_office'];
					$director = $_POST['director'];
					$producer = $_POST['producer'];
					$description = $_POST['description'];
					$release_year = $_POST['release_year'];

					if (!preg_match('/^[A-z ]+/', $title)) {
						$titleError = "Please type valid name";
					}

					elseif (!preg_match('/^[A-z ]+$/', $cast)) {
						$castError = "please type valid cast(actors)";
					}
                    
                    elseif (!preg_match('/^[0-9 A-z ]{2,}$/', $budget)) {
                    	$budgetError = "please type in crores";
                    }

                    elseif (!preg_match('/^[0-9 A-z ]{2,}$/', $box_office)) {
                    	$box_officeError = "please type in crores";
                    }

                    elseif (!preg_match('/^[A-z ]{5,}$/', $director)) {
                    	$directorError = "Plese type valid director";
                    }

                    elseif (!preg_match('/^[A-z ]{5,}$/', $producer)) {
                    	$producerError = "Plese type valid producer";
                    }

                    elseif (!preg_match('/^[0-9 A-z ]{10,}$/', $description)) {
                    	$descriptionError = "description cant be too short.";
                    }

                    elseif (!preg_match('/^[0-9]{4}$/', $release_year)) {
                    	$release_yearError = "Plese type valid year";
                    }

					else{

					$image = $_FILES['image']['name'];

					$tmp_image = $_FILES['image']['tmp_name'];

					$allow_extension = array(
						"jpg",
						"png",
						"jpeg"

					);

					$file_extension = pathinfo($image,PATHINFO_EXTENSION);

					if (!file_exists($tmp_image)) {
						$imageError = "please upload image first";
					}
					elseif (!in_array($file_extension,$allow_extension)) {
						$imageError = "This is not a valid image";
					}
					else{

					move_uploaded_file($tmp_image, "../photo/$image");

					$query = "INSERT INTO records(title,cast,category,budget,box_office,director,producer,description,release_year,image)value('$title','$cast','$category','$budget','$box_office','$director','$producer','$description','$release_year','$image')";
					if (runQuery($query)) {
						redirect('movie');
					}
					else{
						echo "fail";
					}
				    }

				}

			    }

				?>

                <!--form-->

				<form action="insert_movie.php" method="post" enctype="multipart/form-data">
					
					<div class="mb-3">
						<label>Title</label>
						<input type="text" name="title" class="form-control">

						<?php
						if ($titleError != "") {
							echo "<p class= 'small text-danger'>$titleError</p>";
						}
						?>

					</div>

					<div class="mb-3">
						<label>Cast</label>
						<input type="text" name="cast" class="form-control">

						<?php
						if ($castError != "") {
							echo "<p class= 'small text-danger'>$castError</p>";
						}
						?>

					</div>

					<div class="mb-3">
						<label>Category</label>
						<select name="category" class="form-control">
							<?php
							$cat_calling = callingquery("select * from categories");
							foreach($cat_calling as $cat):
							?>
							<option value="<?= $cat['cat_id'];?>"><?=$cat['cat_title'];?></option>
						    <?php endforeach;?>
						</select>
						
					</div>

					<div class="mb-3">
						<label>Budget</label>
						<input type="text" name="budget" class="form-control">

						<?php
						if ($budgetError != "") {
							echo "<p class= 'small text-danger'>$budgetError</p>";
						}
						?>

					</div>

					<div class="mb-3">
						<label>Box Office</label>
						<input type="text" name="box_office" class="form-control">

						<?php
						if ($box_officeError != "") {
							echo "<p class= 'small text-danger'>$box_officeError</p>";
						}
						?>

					</div>

					<div class="row">
						<div class="mb-3 col-6">
						<label>Director</label>
						<input type="text" name="director" class="form-control">

						<?php
						if ($directorError != "") {
							echo "<p class= 'small text-danger'>$directorError</p>";
						}
						?>

					</div>

					<div class="mb-3 col-6">
						<label>Producer</label>
						<input type="text" name="producer" class="form-control">

						<?php
						if ($producerError != "") {
							echo "<p class= 'small text-danger'>$producerError</p>";
						}
						?>

					</div>
					</div>

					<div class="mb-3">
						<label>Description</label>
						<textarea rows="5" name="description" class="form-control"></textarea>

						<?php
						if ($descriptionError != "") {
							echo "<p class= 'small text-danger'>$descriptionError</p>";
						}
						?>

					</div>

					<div class="mb-3">
						<label>Year of release</label>
						<input type="text" name="release_year" class="form-control">

						<?php
						if ($release_yearError != "") {
							echo "<p class= 'small text-danger'>$release_yearError</p>";
						}
						?>

					</div>

					<div class="mb-3">
						<label>image</label>
						<input type="file" name="image" class="form-control">

						<?php
						if($imageError !=""){
							echo "<p class ='small text-danger'>$imageError</p>";
						}
						?>

					</div>

					<div class="mb-3">
						<input type="submit" name="insert" class="btn btn-success btn-block" >
					</div>

				</form>
			</div>
		</div>
	</div>

</body>
</html>