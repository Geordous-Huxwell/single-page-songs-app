<?php
class DatabaseHelper {
 /* Returns a connection object to a database */
 public static function createConnection( $values=array() ) {
    $connString = $values[0];
    $user = $values[1];
    $password = $values[2];
    $pdo = new PDO($connString, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
    PDO::FETCH_ASSOC);
    return $pdo;
 }

  /*
 Runs the specified SQL query using the passed connection and
 the passed array of parameters (null if none)
 */
public static function runQuery($connection, $sql, $parameters) {
   $statement = null;
   // if there are parameters then do a prepared statement
   if (isset($parameters)) {
   // Ensure parameters are in an array
       if (!is_array($parameters)) {
           $parameters = array($parameters);
       }
       // Use a prepared statement if parameters
       $statement = $connection->prepare($sql);
       $executedOk = $statement->execute($parameters);
       if (! $executedOk) throw new PDOException;
   } else {
   // Execute a normal query
       $statement = $connection->query($sql);
       if (!$statement) throw new PDOException;
   }
return $statement;
}
}

// TODO: Surround DB functions in try-catches
class SongDB {

   private static $baseSQL = "SELECT * FROM songs";
   //TODO: be explicit about columns being grabbed
   
   public function __construct($connection) {
       $this->pdo = $connection;
   }

   public function getAll() {
      $sql = self::$baseSQL;
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
      return $statement->fetchAll();
  }

   public function getSongData($songID) {
      $sql = self::$baseSQL . " WHERE song_id=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($songID));
      return $statement->fetchAll();
   }

   public function getSongID($songTitle) {
      $sql = self::$baseSQL . " WHERE title=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($songTitle));
      $songArray = $statement->fetchAll();
      if ($songArray){
         return $songArray[0]['song_id'];
      }
      else {
         return rand(1001, 1318);
      }
   }

   public function getSongMetrics($songID) {
      $sql = "SELECT bpm, energy, danceability as 'dance', liveness as 'live',
      valence, acousticness as 'acoustic', speechiness as 'speech', popularity
      FROM songs
      WHERE song_id=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($songID));
      return $statement->fetchAll();
   }

   public function filterSongs($search) {
      $search= '%'.$search.'%';
      $sql = self::$baseSQL . " WHERE title LIKE ?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($search));
      return $statement->fetchAll();
   }

   public function getAllByArtist($artistID) {
      $sql = self::$baseSQL . " WHERE artist_id=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($artistID));
      return $statement->fetchAll();
   }

   public function getAllByGenre($genreID)
   {
      $sql = self::$baseSQL . " WHERE genre_id=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($genreID));
      return $statement->fetchAll();
   }

   public function getAllByYear($year) {
      $sql = self::$baseSQL . " WHERE year=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($year));
      return $statement->fetchAll();
   }

   public function getAllBeforeYear($year) {
      $sql = self::$baseSQL . " WHERE year<=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($year));
      return $statement->fetchAll();
   }
   
   public function getAllAfterYear($year) {
      $sql = self::$baseSQL . " WHERE year>=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($year));
      return $statement->fetchAll();
   }

   public function getAllByPop($pop) {
      $sql = self::$baseSQL . " WHERE popularity=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($pop));
      return $statement->fetchAll();
   }

   public function getAllLowerPop($pop) {
      $sql = self::$baseSQL . " WHERE popularity<=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($pop));
      return $statement->fetchAll();
   }
   
   public function getAllGreaterPop($pop) {
      $sql = self::$baseSQL . " WHERE popularity>=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($pop));
      return $statement->fetchAll();
   }

   public function getTopSongs() {
      $sql = "SELECT song_id, title, artist_name, popularity
      FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id
      ORDER BY popularity DESC
      LIMIT 10;";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
      return $statement->fetchAll();
   }

   public function getOneHitWonders() {
      $sql = "SELECT title, artist_name, popularity, COUNT(artist_name) AS artist_count
      FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id
      GROUP BY artist_name
      HAVING artist_count=1
      ORDER BY popularity DESC
      LIMIT 10;";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
      return $statement->fetchAll();
   }



   public function getAcousticSong()
   {
      $sql = "SELECT song_id, title, artist_name, acousticness
            FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id
            WHERE acousticness > 40 
            ORDER BY acousticness DESC
            LIMIT 10;"; 
            $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
            return $statement->fetchAll();
   }

   public function getTheClub()
   {
      $sql = "SELECT song_id, title, artist_name, danceability, ((danceability*1.6) + (energy*1.4)) AS CLUBINESS             
         FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id   
         WHERE Danceability > 80
         ORDER BY Clubiness DESC 
         LIMIT 10;"; 
               $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
               return $statement->fetchAll();
   } 

   public function getRunningSong()
   {
      $sql = "SELECT song_id, title, artist_name, bpm, ((valence*1.6) + (energy*1.3)) AS RUNNINESS             
         FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id 
         WHERE bpm >= 120 AND bpm <= 125      
         ORDER BY Runniness DESC 
         LIMIT 10;"; 
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
      return $statement->fetchAll();
   }

   public function getStudying()
   {
      $sql = "SELECT song_id, title, artist_name, bpm, speechiness, ((acousticness*0.8) + (100 - speechiness) + (100 - valence)) AS STUDINESS             
         FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id  
         WHERE bpm >= 100 AND bpm <= 115 AND speechiness <=20      
         ORDER BY Studiness DESC 
         LIMIT 10;"; 
       $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
       return $statement->fetchAll();
   }

   
    

}

class ArtistDB {
   private static $baseSQL = "SELECT * FROM artists";
   
   public function __construct($connection) {
       $this->pdo = $connection;
   }

   public function getAll() {
      $sql = self::$baseSQL;
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
      return $statement->fetchAll();
  }
  
   public function getArtistName($artistID) {
      $sql = self::$baseSQL . " WHERE Artist_ID=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($artistID));
      $artistArray = $statement->fetchAll();
      // echo json_encode($artistArray);
      return $artistArray[0]["artist_name"];
     }

     public function getArtistID($artistName) {
      $sql = self::$baseSQL . " WHERE Artist_Name=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($artistName));
      return $statement->fetchAll()[0]["artist_id"];
     }

     public function getTopArtists() {
      $sql = "SELECT title, artist_name, COUNT(artist_name) AS artist_count
      FROM songs INNER JOIN artists on songs.artist_id=artists.artist_id
      GROUP BY artist_name
      ORDER BY artist_count DESC
      LIMIT 10;";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
      return $statement->fetchAll();
   }
}

class GenreDb
{
   private static $baseSQL = "SELECT * FROM genres";
   
   public function __construct($connection) {
       $this->pdo = $connection;
   }

   public function getAll() {
      $sql = self::$baseSQL;
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
      return $statement->fetchAll();
  }

   public function getGenreName($genreID) {
      $sql = self::$baseSQL . " WHERE GENRE_ID=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($genreID));
      $genreArray = $statement->fetchAll();
      //   echo json_encode($genreArray);
      return $genreArray[0]["genre_name"];
     }

   public function getGenreID($genreName) {
      $sql = self::$baseSQL . " WHERE Genre_Name=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($genreName));
      return $statement->fetchAll()[0]["genre_id"];
     }

   public function getTopGenres() {
      $sql = "SELECT title, genre_name, COUNT(genre_name) AS genre_count
      FROM songs INNER JOIN genres on songs.genre_id=genres.genre_id
      GROUP BY genre_name
      ORDER BY genre_count DESC
      LIMIT 10;";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
      return $statement->fetchAll();
   }

}

class TypeDb
{
   private static $baseSQL = "SELECT * FROM artists";
   
   public function __construct($connection) {
       $this->pdo = $connection;
   }

   public function getAll() {
      $sql = self::$baseSQL;
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, null);
      return $statement->fetchAll();
  }


  //   public function getArtistName($artistID) {
//    $sql = self::$baseSQL . " WHERE Artist_ID=?";
//    $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($artistID));
//    $artistArray = $statement->fetchAll();
//    // echo json_encode($artistArray);
//    return $artistArray[0]["artist_name"];
  
   public function getType($artistID) {
      $sql = self::$baseSQL . " WHERE ARTIST_ID=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($artistID));
      $typeArray = $statement->fetchAll();
      return $typeArray[0]["artist_type_id"];
     }

}


 ?>