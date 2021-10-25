<?php
    require 'includes/config.php';
    require 'includes/Database.php';
    require 'classes/Education.class.php';

    $database = new Database();
    $db = $database->connect();

    $education = new Education($db);

 // Läser in vilken metod som skiatts och lagrar i en variabel
    $method = $_SERVER['REQUEST_METHOD'];
    $data = json_decode(file_get_contents('php://input'), true);

    // Om ett id är skickat med lagras den i en variabel
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    // Lagrar värden i variabler
    if(isset($data)){
        $edu_name = $data["edu_name"];
        $program_name = $data["program_name"];
        $year = $data["year"];
    }

    // Switch som går igenom olika typer av request
    switch($method){
        case "GET":
            if(isset($id)){
                //Skriver ut en specifik kurs
                $response = $education->getSpecifikEducation($id); 
            }
            else{
                //Skriver ut alla kurser
                $response = $education->getEducations();
            }
            break;
            
        case "POST":
            http_response_code(201); // Skapat
            $response = array("Message" => "Education Created");
            $education->addEducation($edu_name, $program_name, $year);
            break;

        case "PUT":
            // Om inget id är angivet, skriver ut felmeddelande
            if(!isset($id)){
                http_response_code(400);
                $response = array("Message" => "No ID is sent");
            }
            else{
                // Om id finns så kallas nedanstående funktion och meddelande skrivs ut till användaren
                http_response_code(202);
                $education->updateEducation($id, $edu_name, $program_name, $year);
                $response = array("Message" => "Post with id = $id is updated");
            }
            break;

        case "DELETE":
            // Om inget id är angivet, skriver ut felmeddelande
            if(!isset($id)){
                http_response_code(400);
                $response = array("Message" => "No id is sent");
            }
            else{
                // Om id finns så kallas nedanstående funktion och meddelande skrivs ut till användaren
                http_response_code(200);
                $response = array("Message" => "Post with id = $id is deleted");
                $education->deleteEducation($id);
            }
            break;
    }

    echo json_encode($response);

    $db = $database->close();

?>