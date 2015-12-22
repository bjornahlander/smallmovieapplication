<?php
require('Db.php');

class HtmlGen {

	// Returns html for the mosaic view of movies
	public static function getMovies($type) {
		$html = '';

		$movies_arr = Db::getAllMovies();
		error_log(print_r($movies_arr,TRUE));

		if($type == 'mosaic') {
			foreach ($movies_arr as $movie)  {
				$html .= self::mosaicHtml($movie);
			}
		} else {
			foreach ($movies_arr as $movie)  {
				$html .= self::tableHtml($movie);
			}
		}

		return $html;
	}

	// Returns
	private static function tableHtml($data) {
		$html = '<tr>
					<td>'.$data['title'].'</td>
					<td>'.$data['description'].'</td>
					<td>'.$data['rating'].'</td>
					<td ><img src="images/remove_icon.png" class="remove" id="'.$data['id'].'"><span>Ta Bort</span></td>
				</tr>';
		return $html;


	}
	
	//Returns html for one movie to put in a mosaic view
	private static function mosaicHtml($data) {
		$html = '<div class="movie">';
		//Only include if file exist
		$files = glob('./movies/movie'.$data['id'].'.*');

		$html .= file_exists($files[0]) ?
					'<div class="image"><img src="'.$files[0].'"></div>' : '';
		$html .= '<div class="information">
					<div class="title">'.$data['title'].'</div>
					<div class="desc">'.$data['description'].'</div>
					'.self::ratingHtml($data).'
					<div class="readme button">Läs mer</div>
				</div>
			</div>';
		return $html;
	}
	
	//Calculates what type of stars should be imported depending on rating
	private static function ratingHtml($data) {
		$rating = intval($data['rating']);
		$html = '<div class="rating"><span>Betyg</span>';
		for($i = 1; $i <= $rating; $i++) {
			$html .= '<img src="images/star_yellow.png">';
		}
		for($i = $rating + 1; $i <= 5; $i++) {
			$html .= '<img src="images/star_grey.png">';
		}
		$html .= '</div>';
		return $html;
	}
}

?>