<?php
require_once __DIR__ . '/../includes/config.php';
if (!empty($_SESSION['admin_id'])) redirect('index.php');
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $stmt = db()->prepare('SELECT id,name,email,password_hash FROM admins WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $admin = $stmt->fetch();
    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = (int)$admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        $_SESSION['admin_email'] = $admin['email'];
        redirect('index.php');
    }
    $error = 'Email or password was incorrect.';
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Admin Login | Kawish Portfolio</title><link rel="stylesheet" href="../assets/css/style.css"></head><body class="admin-body"><main class="admin-auth"><a class="brand" href="../index.php"><span class="brand-mark">&lt;/&gt;</span><span>Kawish <b>Iqbal</b><small>ADMIN PANEL</small></span></a><h1>Welcome back.</h1><p>Sign in to manage your portfolio.</p><?php if ($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><form method="post" class="contact-form"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Email address<input type="email" name="email" required autocomplete="username"></label><label>Password<input type="password" name="password" required autocomplete="current-password"></label><button class="button button-primary full-button">Sign in securely <span>↗</span></button></form><a class="back-link" href="../index.php">← Back to website</a></main></body></html>
