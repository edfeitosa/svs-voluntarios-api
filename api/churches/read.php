<?php include_once '../../config/header.php';
header("Access-Control-Allow-Methods: GET");

include_once '../../config/database.php';
include_once '../objects/churches.php';

$database = new Database();
$db = $database->getConnection();
 
$churches = new Churches($db);
$stmt = $churches->read();
$num = $stmt->rowCount();

if ($num > 0) {
    
    $churches_arr["churches"] = array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        extract($row);
 
        $churches_item = array(
            "chu_id" => $chu_id,
            "chu_name" => $chu_name,
            "chu_status" => $chu_status
        );
        
        array_push($churches_arr["churches"], $churches_item);
    }

    http_response_code(201);
    echo json_encode($churches_arr);
    
} else {
    
    http_response_code(404);
    echo json_encode(array(
        "type" => 'alert',
        "title" => "Está vazio",
        "message" => "Nada foi encontrado. Não existem itens cadastrados"
    ));
    
} ?>