<?php
require_once __DIR__ . '/../includes/config.php';
require_admin();
$notice = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $id = (int)($_POST['id'] ?? 0);
    if (($_POST['action'] ?? '') === 'delete') {
        $stmt = db()->prepare('DELETE FROM messages WHERE id=?'); $stmt->execute([$id]); $notice = 'Message deleted.';
    } elseif (($_POST['action'] ?? '') === 'read') {
        $stmt = db()->prepare('UPDATE messages SET is_read=1 WHERE id=?'); $stmt->execute([$id]); $notice = 'Message marked as read.';
    }
}
$messages = db()->query('SELECT * FROM messages ORDER BY created_at DESC')->fetchAll();
$adminTitle = 'Messages';
require __DIR__ . '/_header.php';
?>
<div class="admin-content"><div class="admin-page-heading"><div><p class="eyebrow">INBOX</p><h1>Contact messages</h1><p>Messages sent through the public contact form.</p></div></div><?php if ($notice): ?><div class="notice"><?= e($notice) ?></div><?php endif; ?>
<?php foreach ($messages as $message): ?><article class="message-card <?= $message['is_read'] ? '' : 'message-unread' ?>"><div class="message-head"><div><h3><?= e($message['name']) ?> <?= !$message['is_read'] ? '<span class="unread-pill">New</span>' : '' ?></h3><a href="mailto:<?= e($message['email']) ?>"><?= e($message['email']) ?></a></div><small><?= e($message['created_at']) ?></small></div><?php if ($message['subject']): ?><b><?= e($message['subject']) ?></b><?php endif; ?><p><?= nl2br(e($message['message'])) ?></p><div class="table-actions"><a href="mailto:<?= e($message['email']) ?>?subject=Re%3A%20<?= rawurlencode((string)$message['subject']) ?>">Reply by email ↗</a><?php if (!$message['is_read']): ?><form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><input type="hidden" name="action" value="read"><input type="hidden" name="id" value="<?= (int)$message['id'] ?>"><button>Mark read</button></form><?php endif; ?><form method="post" onsubmit="return confirm('Delete this message?')"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$message['id'] ?>"><button>Delete</button></form></div></article><?php endforeach; ?><?php if (!$messages): ?><div class="admin-panel"><p>No messages yet. New contact form submissions will appear here.</p></div><?php endif; ?></div>
<?php require __DIR__ . '/_footer.php'; ?>
