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
      return $songArray[0]['song_id'];
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