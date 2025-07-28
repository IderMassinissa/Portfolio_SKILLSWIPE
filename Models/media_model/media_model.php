<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$db = getDbConnection();

function uploadImage() {
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/";
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $filename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $result = [
        'success' => false,
        'message' => '',
        'url' => '',
        'name' => $filename
    ];

    // Vérifie que c'est une image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check === false) {
        $result['message'] = "Ce fichier n'est pas une image.";
        return $result;
    }

    // Vérifie si le fichier existe déjà
    if (file_exists($target_file)) {
        $result['message'] = "Ce fichier existe déjà.";
        return $result;
    }

    // Vérifie la taille
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
        $result['message'] = "Le fichier est trop lourd.";
        return $result;
    }

    // Vérifie le type
    $allowedTypes = ["jpg", "jpeg", "png", "gif", "pdf", "word"];
    if (!in_array($imageFileType, $allowedTypes)) {
        $result['message'] = "Seuls les fichiers JPG, JPEG, PNG, GIF, PDF et WORD sont autorisés.";
        return $result;
    }

    // Upload
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $result['success'] = true;
        $result['message'] = "Le fichier a été uploadé avec succès.";
        $result['url'] = "./public/uploads/" . $filename;
    } else {
        $result['message'] = "Erreur lors de l'upload du fichier.";
    }

    return $result;
}

function addMedia($SenderID, $DocumentNom, $DocumentPath) {
    global $db;

    try {
        $db->beginTransaction();

        $sql = "INSERT INTO Media (Name, Path, User_ID) VALUES (:DocumentNom, :DocumentPath, :id)";
        $requete = $db->prepare($sql);
        $requete->execute([
            ":DocumentNom" => $DocumentNom,
            ":DocumentPath" => $DocumentPath,
            ":id" => $SenderID
        ]);

        $lastId = $db->lastInsertId();

        $db->commit();

        return $lastId;
    } catch (PDOException $e) {
        $db->rollBack();
        return false;
    }
}

function embedMediaInText($text) {

    $text = preg_replace_callback('/(https?:\/\/[^\s]+)/i', function($matches) {
        $url = $matches[0];

        $embedUrl = getEmbedUrl($url);
        if ($embedUrl !== $url) {
            return '<iframe width="450" height="253" src="' . htmlspecialchars($embedUrl) . '" frameborder="0" allowfullscreen></iframe><br>';
        }

        return htmlspecialchars($url);
    }, $text);

    return $text;
}

function getEmbedUrl($url) {

    require_once __DIR__. '/videoPattern.php';

    foreach ($patterns as $pattern => $replacement) {
        if (preg_match($pattern, $url, $matches)) {
            if (strpos($replacement, 'facebook.com') !== false || $replacement === '') {
                
                return 'https://www.facebook.com/plugins/video.php?href=' . rawurlencode($url) . '&show_text=1&width=200';
            }

            
            return str_replace('$1', $matches[1], $replacement);
        }
    }

    return $url;
}
