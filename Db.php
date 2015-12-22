<?php
class DB {
	private static $conn = NULL;
	private static function connect() {
		self::$conn = new mysqli('localhost', 'root', 'root', 'arbetsprov');
		
		if (self::$conn->connect_error)
		{
			error_log('Connection to database failed!');
		}
	}

	/**
	 * Add a movie to the database
	 *
	 * @param $title
	 * @param $desc
	 * @param $rating
	 *
	 * @return bool
	 */
	public static function addMovie($title,$desc,$rating)
	{
		self::connect();
		if($rating < 1 || $rating > 5)
		{
			error_log('Rating out of bounds');
			return FALSE;
		}
		if(!($stmt = self::$conn->prepare('INSERT INTO movies(title,description,rating) VALUES(?,?,?)')))
		{
			error_log('Couldn\'t prepare statement: '. self::$conn->error);
		}
		
		$stmt->bind_param('ssd',$title,$desc,$rating);
		$success = $stmt->execute();
		$id = $stmt->insert_id;
		error_log(print_r(get_defined_vars(),TRUE));
		$stmt->close();
		self::$conn->close();
		
		return $success ? $id : FALSE;
	}

	/**
	 * Removes a movie from the database with corresponding $id
	 *
	 * @param $id
	 */
	public static function removeMovie($id) {
		self::connect();
		if(!($stmt = self::$conn->prepare('DELETE FROM movies WHERE id = ?;')))
		{
			error_log('Couldn\'t prepare statement: '. self::$conn->error);
		}

		$stmt->bind_param('d',$id);
		$success = $stmt->execute();
		error_log(print_r(get_defined_vars(),TRUE));
		$stmt->close();
		self::$conn->close();
		return $success;
	}
	/*
	*	Get all movies as an assoc. array
	*/
	public static function getAllMovies() 
	{
		self::connect();
		$result = NULL;
		$select = 'SELECT * FROM movies;';
		$sql = self::$conn->query($select);
		while ($row = $sql->fetch_assoc())
		{
			$result[] = $row;
		}
		return $result;
	}
	
	
	
}
?>