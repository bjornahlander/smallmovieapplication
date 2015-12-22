<?php

require('Db.php');
require('FileUtil.php');

//Remove movie
if(isset($_POST['remove'])) {
	$id = intval(trim($_POST['id']));
	if(Db::removeMovie($id)) {
		$files = glob('./movies/movie'.$id.'.*');
		unlink($files[0]);
		header("HTTP/1.1 200 OK");
		echo 'Successfull removal...';
	} else {
		header("HTTP/1.1 400 Bad Request");
		echo 'Uh Oh..';
	}
}

//Submit movie
if(isset($_POST['submit'])) {
	$title = trim($_POST['movie-title']);
	$desc = trim($_POST['movie-desc']);
	$rating = intval($_POST['movie-rating']);
	$id = Db::addMovie($title,$desc,$rating);
	if($id){
		$file = $_FILES['poster'];
		$file['id'] = $id;
		if(FileUtil::saveImage($file)) {
			header("HTTP/1.1 201 Created");
			echo $id;
		} else {
			header('HTTP/1.1 400 Bad Request');
			echo 'File not Please try a different file...';
		}
	} else {
		header("HTTP/1.1 500 Server error");
		echo 'Could not save movie...';
	}
}

	
?>