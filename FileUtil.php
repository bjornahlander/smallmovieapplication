<?php

class FileUtil {

	/**
	 * Saves image to target directory
	 *
	 * @param $file = assoc array with following values
	 * tmp_name => string
	 * name => string
	 * id => integer
	 * size => integer
	 *
	 * @return bool
	 */
	public static function saveImage($file) {
		$dir = './movies/';
		$size = getimagesize($file['tmp_name']);
		$isImage = $size !== FALSE;
		$noDuplicate = !file_exists($dir . $file['name']);
		$okSize = $file['size'] < 500000;
		$isUploaded = FALSE;
		$new_path = $dir . 'movie' . $file['id'] . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
		if($isImage && $noDuplicate && $okSize) {
			$isUploaded = move_uploaded_file($file['tmp_name'], $new_path);
		}
		return $isUploaded;
	}
}