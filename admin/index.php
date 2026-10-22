<?php
require_once __DIR__ . '/../includes/config.php';
require_admin();
$projectCount = (int)db()->query('SELECT COUNT(*) FROM projects')->fetchColumn();
$messageCount = (int)db()->query('SELECT COUNT(*) FROM messages')->fetchColumn();
$unreadCount = (int)db()->query('SELECT COUNT(*) FROM messages WHERE is_read=0')->fetchColumn();
$recent = db()->query('SELECT id,title,category,created_at FROM projects ORDER BY created_at DESC LIMIT 5')->fetchAll();
$adminTitle = 'Dashboard';
require __DIR__ . '/_header.php';
?>
<div class="admin-content"><div class="admin-page-heading"><div><p class="eyebrow">OVERVIEW</p><h1>Dashboard</h1><p>Manage your public portfolio from one place.</p></div><a class="button button-primary" href="projects.php">Manage projects ↗</a></div>
<div class="admin-stats"><article><small>TOTAL PROJECTS</small><strong><?= $projectCount ?></strong><a href="projects.php">View projects →</a></article><article><small>TOTAL MESSAGES</small><strong><?= $messageCount ?></strong><a href="messages.php">Open inbox →</a></article><article><small>UNREAD MESSAGES</small><strong><?= $unreadCount ?></strong><a href="messages.php">Review messages →</a></article></div>
<section class="admin-panel"><div class="admin-panel-head"><h2>Recent projects</h2><a href="projects.php">Manage all →</a></div><div class="admin-table-wrap"><table><thead><tr><th>Project</th><th>Category</th><th>Added</th></tr></thead><tbody><?php foreach ($recent as $row): ?><tr><td><?= e($row['title']) ?></td><td><?= e($row['category']) ?></td><td><?= e($row['created_at']) ?></td></tr><?php endforeach; ?><?php if (!$recent): ?><tr><td colspan="3">No projects yet.</td></tr><?php endif; ?></tbody></table></div></section>
<div class="admin-panel"><h2>Quick tips</h2><ul class="admin-tips"><li>Use accurate project descriptions and verified links.</li><li>Check the contact inbox regularly.</li><li>Back up your database before making major changes.</li><li>Keep PHP and your hosting environment updated.</li></ul></div></div>
<?php require __DIR__ . '/_footer.php'; ?>
