<?php include_once '../../config/header.php';
header("Access-Control-Allow-Methods: POST, OPTIONS");

include_once '../../config/database.php';
include_once '../objects/users.php';
include_once '../_libs/validateEmail.php';

$database = new Database();
$db = $database->getConnection();
 
$users = new Users($db);

$data = json_decode(file_get_contents("php://input"));

$validateEmail = new ValidateEmail();

if ($data->usu_name == '' || $data->usu_email == '' || $data->usu_cel == '') {
    
    http_response_code(400);
    echo json_encode(array(
        'type' => 'alert',
        'title' => 'Campos vazios',
        'message' => 'Antes de continuar, preencha todos os campos'
    ));
    
} else {

    if ($validateEmail->validate($data->usu_email)) {
        
        $users->usu_name = $data->usu_name;
        $users->usu_email = $data->usu_email;
        $users->usu_cel = $data->usu_cel;
        $users->usu_level = $data->usu_level;
        
        if ($users->create()) {
            
            http_response_code(201);
            echo json_encode(array(
                'type' => 'success',
                'title' => 'Sucesso',
                'message' => 'Novo voluntário cadastrado com sucesso'
            ));
            
        } else {
            
            http_response_code(503);
            echo json_encode(array(
                'type' => 'error',
                'title' => 'Algo aconteceu...',
                'message' => 'Não foi possível cadastrar novo usuário. Tente novamente'
            ));
            
        }

    } else {

        http_response_code(400);
        echo json_encode(array(
            'type' => 'error',
            'title' => 'Não é válido',
            'message' => 'O e-mail informado não é válido. Verifique a informação digitada e tente novamente'
        ));

    }
    
} ?>