<?php
class DatabaseHelper { 
 /* Returns a connection object to a database */
 public static function createConnection( $values=array() ) { 
    $connString = $values[0]; 
    $user = $values[1]; 
    $password = $values[2]; 
    $pdo = new PDO($connString,$user,$password); 
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
   
   public function __construct($connection) { 
       $this->pdo = $connection; 
   } 

   public function getAll() { 
      $sql = self::$baseSQL; 
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
      $sql = self::$baseSQL . " WHERE artists.Artist_ID=?";
      $statement = DatabaseHelper::runQuery($this->pdo, $sql, Array($artistID)); 
      $artistArray = $statement->fetchAll();
      return $artistArray[0]["artist_name"]; 
     }
}
 ?>