<?php require_once("../include/connect.php");
session_start();

if(!isset($_SESSION['admin_log'])){
	redirect('login');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Fid Movie</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

	<div class="container mt-5">
		<div class="row">
			<div class="col-lg-3">
				<?php include "side.php";?>
			</div>

			<div class="col-lg-9">
				<table class="table table-striped">
					<tr>
						<th>Id</th>
						<th>Title</th>
						<th>Cast</th>
						<th>Year</th>
						<th>Director</th>
						<th>Box office</th>
						<th>Action</th>
					</tr>

					<?php
					$movie_calling = callingQuery("SELECT * from records");
					foreach($movie_calling as $movie):
					?>
					<tr>
						<td><?=$movie['m_id'];?></td>
						<td><?= $movie['title'];?></td>
						<td><?= $movie['cast'];?></td>
						<td><?= $movie['release_year'];?></td>
						<td><?= $movie['director'];?></td>
						<td><?= $movie['box_office'];?></td>
						<td>
							<a href="" class="btn btn-info btn-sm">Edit</a>
							<a href="delete_movie.php?delete_movie=<?=$movie['m_id'];?>" class="btn btn-danger btn-sm">Delete</a>
						</td>
					</tr>
				<?php endforeach;?>
				</table>
			</div>
		</div>
	</div>

</body>
</html> 