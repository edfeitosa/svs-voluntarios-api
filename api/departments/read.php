<?php include_once '../../config/header.php';
header("Access-Control-Allow-Methods: GET");

include_once '../../config/database.php';
include_once '../objects/departments.php';

$database = new Database();
$db = $database->getConnection();
 
$departments = new Departments($db);
$stmt = $departments->read();
$num = $stmt->rowCount();

if ($num > 0) {
    
    $departments_arr["departments"] = array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        extract($row);
 
        $departments_item = array(
            "dep_id" => $dep_id,
            "dep_name" => $dep_name,
            "dep_status" => $dep_status
        );
        
        array_push($departments_arr["departments"], $departments_item);
    }

    http_response_code(201);
    echo json_encode($departments_arr);
    
} else {
    
    http_response_code(404);
    echo json_encode(array(
        "type" => 'alert',
        "title" => "Está vazio",
        "message" => "Nada foi encontrado. Não existem itens cadastrados"
    ));
    
} ?>