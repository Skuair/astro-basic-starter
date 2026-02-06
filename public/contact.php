<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        http_response_code(400);
        echo json_encode(['error' => 'Tous les champs sont requis']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['error' => 'Email invalide']);
        exit;
    }

    $to = 'votre-email@exemple.com';
    $subject = 'Nouveau message depuis le site';
    $body = "Nom: $name\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message";

    $headers = "From: noreply@votredomaine.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(['success' => true, 'message' => 'Message envoyé avec succès']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Erreur lors de l\'envoi du message']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
}
