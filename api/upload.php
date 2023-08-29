<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = 'uploads/';
    $allowedExtensions = ['jpg', 'png'];
    
    $uploadedFile = $_FILES['imagem'];

    // Verifica se há algum erro no upload
    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
        $extension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);

        // Verifica se a extensão é permitida
        if (in_array($extension, $allowedExtensions)) {
            $newFileName = uniqid() . '.' . $extension;
            $destination = $uploadDir . $newFileName;

            // Move o arquivo para o diretório de uploads
            if (move_uploaded_file($uploadedFile['tmp_name'], $destination)) {
                echo json_encode(['success' => true, 'message' => 'Arquivo enviado com sucesso!']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Erro ao mover o arquivo para o diretório de uploads.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Extensão de arquivo não permitida. Apenas .jpg e .png são permitidos.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Erro no upload do arquivo.']);
    }
}
?>
