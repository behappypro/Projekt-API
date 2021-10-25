<?php
    require 'includes/config.php';
    require 'includes/Database.php';
    require 'classes/Projects.class.php';

    $database = new Database();
    $db = $database->connect();

    $project = new Project($db);

 // Läser in vilken metod som skiatts och lagrar i en variabel
    $method = $_SERVER['REQUEST_METHOD'];
    $data = json_decode(file_get_contents('php://input'), true);

    // Om ett id är skickat med lagras den i en variabel
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    // Lagrar värden i variabler
    if(isset($data)){
        $title = $data["title"];
        $project_desc = $data["project_desc"];
        $image = $data["image"];
        $url = $data["url"];
    }

    // Switch som går igenom olika typer av request
    switch($method){
        case "GET":
            if(isset($id)){
                //Skriver ut en specifik kurs
                $response = $project->getSpecifikProject($id); 
            }
            else{
                //Skriver ut alla kurser
                $response = $project->getProjects();
            }
            break;
            
        case "POST":
            http_response_code(201); // Skapat
            $response = array("Message" => "Project Created");
            $project->addProject($title, $project_desc, $image, $url);
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
                $project->updateProject($id, $title, $project_desc ,$image,$url);
                $response = array("Message" => "Project with id = $id is updated");
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
                $response = array("Message" => "Project with id = $id is deleted");
                $project->deleteProject($id);
            }
            break;
    }

    echo json_encode($response);

    $db = $database->close();

?>