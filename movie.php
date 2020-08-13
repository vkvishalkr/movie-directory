<?php require_once("include/connect.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Find Movie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<?php include_once("include/navbar.php");?>
	<div class="container mt-5">
		<div class="row">
			<div class="col-lg-3">
			<!-- categories-->
			    <?php include "side.php";?>
			</div>

			<div class="col-lg-9">
				<!-- business list-->

				<div class="row">
					<?php
					if(isset($_GET['movie_id'])){
						$id = $_GET['movie_id'];

						$calling =callingQuery("SELECT * FROM records JOIN categories ON records.category = categories.cat_id WHERE records.m_id='$id'");
					

					foreach($calling as $data);
					?>

					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-12">
								<h4 class="text-uppercase font-weight-bolder"><?=$data['title'];?></h4>
							</div>
						</div>
						<div class="card mb-2 bg-light">
							<div class="row">
								<div class="col-lg-4">
									<img src="photo/<?=$data['image'];?>" class="w-100" style="object-fit: cover; height: 260px;">
								</div>
								<div class="col-lg-8">
									<table class="table table-striped">
										<tr>
											<td class="font-italic font-weight-bolder">Category</td>
											<td><?= $data['cat_title'];?></td>
										</tr>
										<tr>
											<td class="font-italic font-weight-bolder">Cast:</td>
											<td><?=$data['cast'];?></td>
										</tr>
										<tr>
											<td class="font-italic font-weight-bolder">Producer:</td>
											<td><?=$data['producer'];?></td>
										</tr>
										<tr>
											<td class="font-italic font-weight-bolder">Director</td>
											<td><?=$data['director'];?></td>
										</tr>
										<tr>
											<td class="font-italic font-weight-bolder">Relesed Year:</td>
											<td><?=$data['release_year'];?></td>
										</tr>
										<tr>
											<td class="font-italic font-weight-bolder">Budget:</td>
											<td><?=$data['budget'];?></td>
										</tr>
										<tr>
											<td class="font-italic font-weight-bolder">Box-office-collection:</td>
											<td><?=$data['box_office'];?></td>
										</tr>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="card border-primary">
										<div class="card-header bg-primary text-white">Description</div>
										<div class="card-body">
											<p class="small text-justify"><?=$data['description'];?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php }?>
					
					</div>
                                 <!--related movies-->

					<div class="row">
						<div class="col-lg-12">
							<h2>Related Movies</h2>
						</div>

						<?php

						$id = $_GET['movie_id'];

						$calling = callingQuery("SELECT * FROM records JOIN categories ON records.category = categories.cat_id where records.m_id !='$id'");

						foreach($calling as $data):
						?>
						<div class="col-lg-6 mb-2">
							<div class="card  bg-light">
							<div class="row">
								<div class="col-lg-4">
									<img src="photo/<?=$data['image'];?>" class="" style = "object-fit: cover;height: 260px; width: 150px;">
								</div>
								<div class="col-lg-8">
									<div class="card-body">
								    <h5 class="text-uppercase text-truncate"><?=$data['title'];?></h5>
								    <span class="badge bg-primary"><?= $data['cat_title'];?></span>
								    <h6 class="text-uppercase text-truncate">CAST: <?=$data['cast'];?></h6>
								    <p class="small text-justify"><?= substr($data['description'],0,125);?></p>
								     <h5 class="text-truncate">Director: <?=$data['director'];?></h5>
								     <p class="text-white btn-sm bg-dark">Budget: <?=$data['budget'];?></p>
								     <p class="text-white btn-sm bg-danger">Box-office: <?=$data['box_office'];?></p>
								    
								    <a href="movie.php?movie_id=<?=$data['m_id'];?>" class="btn btn-success float-right">Read More</a>
								    
							        </div>
								</div>
							</div>	
						   </div>
						</div>
						 <?php endforeach;?>
					</div> 
				</div>
			</div>			
        </div>	
	</div>
</body>
</html>