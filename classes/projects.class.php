<?php 

class Project{
    // Variabel för att enklare komma åt tabellen i databasen
    private $db_table = "projects";
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // Funktion för att hämta alla kurser
    public function getProjects(){
            // SQL-fråga
            $sql = $this->conn->prepare("SELECT * FROM " . $this->db_table . "");
            $sql->execute();
        
            /* Hämtar alla rader från databasen */
            return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
    // Funktion för att hämta en specifik kurs
    public function getSpecifikProject($id){
            // SQL-fråga
            $sql = $this->conn->prepare("SELECT * FROM " . $this->db_table ." WHERE id = $id");
            $sql->execute();
        
            /* Hämtar specifik rad från databasen*/
            return $result = $sql->fetch(PDO::FETCH_ASSOC);  
    }
    // Funktion för att lägga till en kurs
    public function addProject($title, $project_desc, $image, $url){
        /*
        $data = [
            'code' => 'test',
            'name' => 'test',
            'progression' => 'A',
            'course_syllabus' => 'test',
        ];
        */
        // SQL-fråga som skriver till databasen med värden
        $sql = "INSERT INTO projects (title, project_desc, image,url)
        VALUES ('$title', '$project_desc','$image','$url')";
        // use exec() because no results are returned
        $this->conn->exec($sql);
    }

    // Funktion för att uppdatera en kurs
    public function updateProject($id, $title, $project_desc, $image,$url){
        // SQL-fråga som uppdaterar kurs genom att skicka med nya värden
        $sql = "UPDATE projects SET title = '$title', project_desc = '$project_desc', image = '$image',url = '$url' WHERE id = $id";
        $this->conn->exec($sql);

    }

    // Funktion för att radera en kurs
    public function deleteProject($id){
        // SQL-fråga för att radera en kurs med specifikt id
        $sql = "DELETE FROM ". $this->db_table." WHERE id = $id";
        $this->conn->exec($sql);
    }

}

?>