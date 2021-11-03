<?php 

class Employment{
    // Variabel för att enklare komma åt tabellen i databasen
    private $db_table = "employment";
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // Funktion för att hämta alla kurser
    public function getEmployments(){
            // SQL-fråga
            $sql = $this->conn->prepare("SELECT * FROM " . $this->db_table . "");
            $sql->execute();
        
            /* Hämtar alla rader från databasen */
            return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
    // Funktion för att hämta en specifik kurs
    public function getSpecifikEmployment($id){
            // SQL-fråga
            $sql = $this->conn->prepare("SELECT * FROM " . $this->db_table ." WHERE id = $id");
            $sql->execute();
        
            /* Hämtar specifik rad från databasen*/
            return $result = $sql->fetch(PDO::FETCH_ASSOC);  
    }
    // Funktion för att lägga till en kurs
    public function addEmployment($place, $title,$start_year,$end_year){
        // SQL-fråga som skriver till databasen med värden
        $sql = "INSERT INTO employment (place, title, start_year,end_year)
        VALUES ('$place', '$title','$start_year','$end_year')";
        // use exec() because no results are returned
        $this->conn->exec($sql);
    }

    // Funktion för att uppdatera en kurs
    public function updateEmployment($id, $place, $title, $start_year, $end_year){
        // SQL-fråga som uppdaterar kurs genom att skicka med nya värden
        $sql = "UPDATE employment SET place = '$place', title = '$title', start_year = '$start_year',end_year = '$end_year' WHERE id = $id";
        $this->conn->exec($sql);

    }

    // Funktion för att radera en kurs
    public function deleteEmployment($id){
        // SQL-fråga för att radera en kurs med specifikt id
        $sql = "DELETE FROM ". $this->db_table." WHERE id = $id";
        $this->conn->exec($sql);
    }

}

?>