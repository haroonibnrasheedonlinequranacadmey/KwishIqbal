<?php
require_once __DIR__ . '/includes/config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('index.php#contact');
verify_csrf();
$name = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$subject = trim((string)($_POST['subject'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));
if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($message) < 10) {
    $_SESSION['flash'] = ['type'=>'error','message'=>'Please check your details and try again.'];
    redirect('index.php#contact');
}
try {
    $stmt = db()->prepare('INSERT INTO messages (name,email,subject,message) VALUES (:name,:email,:subject,:message)');
    $stmt->execute(['name'=>mb_substr($name,0,120),'email'=>mb_substr($email,0,190),'subject'=>mb_substr($subject,0,180),'message'=>mb_substr($message,0,5000)]);
    $_SESSION['flash'] = ['type'=>'success','message'=>'Thanks for reaching out. Your message has been received.'];
} catch (Throwable $e) {
    $_SESSION['flash'] = ['type'=>'error','message'=>'The message could not be saved right now. Please email directly instead.'];
}
redirect('index.php#contact');
