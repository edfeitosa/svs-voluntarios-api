<?php include_once '../../config/header.php';
header("Access-Control-Allow-Methods: GET");

include_once '../../config/database.php';
include_once '../objects/users.php';

$database = new Database();
$db = $database->getConnection();
 
$users = new Users($db);
$stmt = $users->read();
$num = $stmt->rowCount();

if ($num > 0) {
    
    $users_arr["users"] = array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        extract($row);
 
        $users_item = array(
            "usu_id" => $usu_id,
            "usu_name" => $usu_name,
            "usu_email" => $usu_email,
            "usu_cel" => $usu_cel,
            "usu_level" => $usu_level
        );
        
        array_push($users_arr["users"], $users_item);
    }

    echo json_encode($users_arr);
    
} else {
    
    echo json_encode(array(
        "type" => 'alert',
        "title" => "Está vazio",
        "message" => "Nada foi encontrado. Não existem itens cadastrados"
    ));
    
} ?>