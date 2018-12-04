<?php include_once '../../config/header.php';
header("Access-Control-Allow-Methods: POST, OPTIONS");

include_once '../../config/database.php';
include_once '../objects/departments.php';

$database = new Database();
$db = $database->getConnection();
 
$departments = new Departments($db);

$data = json_decode(file_get_contents("php://input"));

if ($data->dep_name == '') {
    
    echo json_encode(array(
        'type' => 'alert',
        'title' => 'Campos vazios',
        'message' => 'Antes de continuar, preencha todos os campos'
    ));
    exit;
    
}

$departments->dep_name = $data->dep_name;

if ($departments->create()) {

    http_response_code(201);
    echo json_encode(array(
        'type' => 'success',
        'title' => 'Sucesso',
        'message' => 'Nova igreja cadastrado com sucesso'
    ));

} else {

    http_response_code(503);
    echo json_encode(array(
        'type' => 'error',
        'title' => 'Algo aconteceu...',
        'message' => 'Não foi possível cadastrar nova igreja. Tente novamente'
    ));

} ?>