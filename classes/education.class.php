<?php 

class Education{
    // Variabel för att enklare komma åt tabellen i databasen
    private $db_table = "education";
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // Funktion för att hämta alla kurser
    public function getEducations(){
            // SQL-fråga
            $sql = $this->conn->prepare("SELECT * FROM " . $this->db_table . "");
            $sql->execute();
        
            /* Hämtar alla rader från databasen */
            return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
    // Funktion för att hämta en specifik kurs
    public function getSpecifikEducation($id){
            // SQL-fråga
            $sql = $this->conn->prepare("SELECT * FROM " . $this->db_table ." WHERE id = $id");
            $sql->execute();
        
            /* Hämtar specifik rad från databasen*/
            return $result = $sql->fetch(PDO::FETCH_ASSOC);  
    }
    // Funktion för att lägga till en kurs
    public function addEducation($edu_name, $program_name, $start_year, $end_year){
        // SQL-fråga som skriver till databasen med värden
        $sql = "INSERT INTO education (edu_name, program_name, start_year, end_year)
        VALUES ('$edu_name', '$program_name','$start_year','$end_year')";
        // use exec() because no results are returned
        $this->conn->exec($sql);
    }

    // Funktion för att uppdatera en kurs
    public function updateEducation($id, $edu_name, $program_name, $start_year,$end_year){
        // SQL-fråga som uppdaterar kurs genom att skicka med nya värden
        $sql = "UPDATE education SET edu_name = '$edu_name', program_name = '$program_name', start_year = '$start_year',end_year = '$end_year' WHERE id = $id";
        $this->conn->exec($sql);

    }

    // Funktion för att radera en kurs
    public function deleteEducation($id){
        // SQL-fråga för att radera en kurs med specifikt id
        $sql = "DELETE FROM ". $this->db_table." WHERE id = $id";
        $this->conn->exec($sql);
    }

}

?>