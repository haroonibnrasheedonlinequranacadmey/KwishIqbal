<?php
require_once __DIR__ . '/includes/config.php';
$count = (int)db()->query('SELECT COUNT(*) FROM admins')->fetchColumn();
$message = '';
if ($count > 0) {
    $message = 'An admin account already exists. Delete this setup file from the server.';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim((string)($_POST['name'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 12) {
        $message = 'Enter a name, valid email and a password of at least 12 characters.';
    } else {
        $stmt = db()->prepare('INSERT INTO admins (name,email,password_hash) VALUES (?,?,?)');
        $stmt->execute([$name,$email,password_hash($password, PASSWORD_DEFAULT)]);
        $message = 'Admin account created. Delete setup-admin.php now, then sign in at admin/login.php.';
    }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Set up admin</title><link rel="stylesheet" href="assets/css/style.css"></head><body class="admin-body"><main class="admin-auth"><a class="brand" href="index.php"><span class="brand-mark">&lt;/&gt;</span><span>Kawish <b>Iqbal</b><small>PORTFOLIO SETUP</small></span></a><h1>Create admin account</h1><p>Use a unique password with at least 12 characters.</p><?php if ($message): ?><div class="notice"><?= e($message) ?></div><?php endif; ?><?php if ($count===0 && !str_contains($message,'created')): ?><form method="post" class="contact-form"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Name<input name="name" required maxlength="120"></label><label>Email<input name="email" type="email" required maxlength="190"></label><label>Password<input name="password" type="password" minlength="12" required autocomplete="new-password"></label><button class="button button-primary full-button">Create admin</button></form><?php endif; ?><p class="form-note">Security: remove this file from your server immediately after creating the account.</p></main></body></html>
