<?php
require_once __DIR__ . '/../includes/config.php';
require_admin();
$notice = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $allowed = ['site_title','tagline','contact_email','contact_phone'];
    $stmt = db()->prepare('INSERT INTO site_settings (setting_key,setting_value) VALUES (?,?) ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)');
    foreach ($allowed as $key) {
        $value = trim((string)($_POST[$key] ?? ''));
        if ($key === 'contact_email' && $value !== '' && !filter_var($value,FILTER_VALIDATE_EMAIL)) continue;
        $stmt->execute([$key, mb_substr($value,0,500)]);
    }
    $notice = 'Settings saved. Some settings may also require updating includes/site-data.php depending on the field.';
}
$rows = db()->query('SELECT setting_key,setting_value FROM site_settings')->fetchAll();
$settings = [];
foreach ($rows as $row) $settings[$row['setting_key']] = $row['setting_value'];
$adminTitle = 'Settings';
require __DIR__ . '/_header.php';
?>
<div class="admin-content"><div class="admin-page-heading"><div><p class="eyebrow">SITE CONFIGURATION</p><h1>Settings</h1><p>Update the main site title and contact details.</p></div></div><?php if ($notice): ?><div class="notice"><?= e($notice) ?></div><?php endif; ?><section class="admin-panel"><form method="post" class="admin-form"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Site title<input name="site_title" maxlength="500" value="<?= e($settings['site_title'] ?? 'Kawish Iqbal | Full Stack Web Developer') ?>"></label><label>Homepage tagline<input name="tagline" maxlength="500" value="<?= e($settings['tagline'] ?? 'Building modern, responsive and reliable digital experiences.') ?>"></label><label>Contact email<input type="email" name="contact_email" maxlength="500" value="<?= e($settings['contact_email'] ?? 'kawishiqbal24@gmail.com') ?>"></label><label>Contact phone<input name="contact_phone" maxlength="500" value="<?= e($settings['contact_phone'] ?? '03470262608') ?>"></label><button class="button button-primary">Save settings</button></form></section><section class="admin-panel"><h2>Account security</h2><p>Use a unique password with at least 12 characters. Password reset and multi-factor authentication are not configured in this starter version. For production, enable HTTPS and keep your hosting and PHP version updated.</p></section></div>
<?php require __DIR__ . '/_footer.php'; ?>
