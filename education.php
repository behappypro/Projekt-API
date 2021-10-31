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
        $start_year = $data["start_year"];
        $end_year = $data["end_year"];
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
            
            if(!($edu_name && $program_name && $start_year && $end_year)){
                $response = array("Message" => "Alla fält måste skickas med"); 
                http_response_code(419); // Saknar vissa argument
            }
            else{
                $education->addEducation($edu_name, $program_name, $start_year, $end_year);
                $response = array("Message" => "Education Created"); 
                http_response_code(201); // Skapat
            }
            break;
        case "PUT":
            // Om inget id är angivet, skriver ut felmeddelande
            if(!isset($id)){
                $response = array("Message" => "No ID is sent");
                http_response_code(400);
            }
            else{
                if(!($edu_name && $program_name && $start_year && $end_year)){
                    $response = array("Message" => "Alla fält måste skickas med"); 
                    http_response_code(419); // Saknar vissa argument
                }
                else{
                    $education->updateEducation($id, $edu_name, $program_name, $start_year,$end_year);
                    $response = array("Message" => "Post with id = $id is updated");
                    http_response_code(202);
                }
                // Om id finns så kallas nedanstående funktion och meddelande skrivs ut till användaren
               
            }
            break;
        case "DELETE":
            // Om inget id är angivet, skriver ut felmeddelande
            if(!isset($id)){
                $response = array("Message" => "No id is sent");
                http_response_code(400);
            }
            else{
                // Om id finns så kallas nedanstående funktion och meddelande skrivs ut till användaren
                $response = array("Message" => "Post with id = $id is deleted");
                $education->deleteEducation($id);
                http_response_code(200);
            }
            break;
    }

    echo json_encode($response);

    $db = $database->close();

?>