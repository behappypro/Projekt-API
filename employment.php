<?php
    require 'includes/config.php';
    require 'includes/Database.php';
    require 'classes/Employment.class.php';

    $database = new Database();
    $db = $database->connect();

    $employment = new Employment($db);

 // Läser in vilken metod som skiatts och lagrar i en variabel
    $method = $_SERVER['REQUEST_METHOD'];
    $data = json_decode(file_get_contents('php://input'), true);

    // Om ett id är skickat med lagras den i en variabel
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    // Lagrar värden i variabler
    if(isset($data)){
        $place = $data["place"];
        $title = $data["title"];
        $start_year = $data["start_year"];
        $end_year = $data["end_year"];
    }

    // Switch som går igenom olika typer av request
    switch($method){
        case "GET":
            if(isset($id)){
                //Skriver ut en specifik kurs
                $response = $employment->getSpecifikEmployment($id); 
            }
            else{
                //Skriver ut alla kurser
                $response = $employment->getEmployments();
            }
            break;
            
        case "POST":
            http_response_code(201); // Skapat
            
            if(!($place && $title && $start_year && $end_year)){
                $response = array("Message" => "Alla fält måste skickas med"); 
            }

            else{
                $employment->addEmployment($place, $title, $start_year, $end_year);
                $response = array("Message" => "Employment Created"); 
            }

            break;

        case "PUT":
            // Om inget id är angivet, skriver ut felmeddelande
            if(!isset($id)){
                http_response_code(400);
                $response = array("Message" => "No ID is sent");
            }
            else{
                if(!($place && $title && $start_year && $end_year)){
                    $response = array("Message" => "Alla fält måste skickas med"); 
                }
                
                // Om id finns så kallas nedanstående funktion och meddelande skrivs ut till användaren
                else{
                    $employment->updateEmployment($id, $place, $title, $start_year,$end_year);
                    $response = array("Message" => "Post with id = $id is updated");
                    http_response_code(202);
                }
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
                $employment->deleteEmployment($id);
                http_response_code(200);
            }
            break;
    }

    echo json_encode($response);

    $db = $database->close();

?>