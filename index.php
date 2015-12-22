<?php
require('HtmlGen.php');
?>

<!DOCTYPE HTML>
<html>
	<head>
		<link href='https://fonts.googleapis.com/css?family=Oswald:300|Roboto+Condensed:300|Roboto:300' rel='stylesheet' type='text/css'>
		<link href="./stylesheets/main.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="page">
			<header>
				<img src="images/header.jpg">
				<img id="logo" src="images/logo.png">
				<div id="nav">
					<ul>
						<li id="overview">ÖVERSIKT</li>
						<li id="add-new">LÄGG TILL</li>
					</ul>
				</div>
			</header>
			<div id="content">
				<div id="content-overview">
					<?php echo HtmlGen::getMovies('mosaic') ?>
				</div>
				<div id="content-add-new">
					<div id="table">
						<table>
							<thead>
								<tr>
									<th>TITEL</th>
									<th>BESKRIVNING</th>
									<th>BETYG</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php echo HtmlGen::getMovies('table'); ?>
							</tbody>
						</table>
					</div>
					<form id="add-form">
						<label for="movie-title">Lägg till ny film</label>
						<input type="text" name="movie-title" id="movie-title" placeholder="Titel"/>
						<textarea name="movie-desc" id="movie-desc" placeholder="Beskrivning"></textarea>
						<select name="movie-rating" id="movie-rating">
							<option value="" disabled selected>Betyg</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
						<input type="file" name="poster" id="poster"/>
						<input class="button" type="submit" value="Lägg till ny"/>
					</form>
				</div>
				
			</div>
		</div>

		<script src="./js/main.js"></script>
	</body>
</html>
