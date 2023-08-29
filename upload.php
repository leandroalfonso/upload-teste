<?php
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
                echo "Arquivo enviado com sucesso!";
            } else {
                echo "Erro ao mover o arquivo para o diretório de uploads.";
            }
        } else {
            echo "Extensão de arquivo não permitida. Apenas .jpg e .png são permitidos.";
        }
    } else {
        echo "Erro no upload do arquivo.";
    }
}
?>
