<?php
require_once __DIR__ . '/../includes/config.php';
require_admin();
$notice = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $action = (string)($_POST['action'] ?? '');
    if ($action === 'delete') {
        $stmt = db()->prepare('DELETE FROM projects WHERE id=?');
        $stmt->execute([(int)($_POST['id'] ?? 0)]);
        $notice = 'Project deleted.';
    } elseif ($action === 'save') {
        $id = (int)($_POST['id'] ?? 0);
        $data = [
            trim((string)($_POST['title'] ?? '')),
            trim((string)($_POST['category'] ?? 'Web Development')),
            trim((string)($_POST['summary'] ?? '')),
            trim((string)($_POST['image_url'] ?? '')),
            trim((string)($_POST['live_url'] ?? '')),
            trim((string)($_POST['source_url'] ?? '')),
            trim((string)($_POST['technologies'] ?? '')),
            isset($_POST['featured']) ? 1 : 0,
            (int)($_POST['sort_order'] ?? 0)
        ];
        if ($data[0] !== '' && $data[2] !== '') {
            if ($id > 0) {
                $data[] = $id;
                $stmt = db()->prepare('UPDATE projects SET title=?,category=?,summary=?,image_url=?,live_url=?,source_url=?,technologies=?,featured=?,sort_order=? WHERE id=?');
                $stmt->execute($data);
                $notice = 'Project updated.';
            } else {
                $stmt = db()->prepare('INSERT INTO projects (title,category,summary,image_url,live_url,source_url,technologies,featured,sort_order) VALUES (?,?,?,?,?,?,?,?,?)');
                $stmt->execute($data);
                $notice = 'Project added.';
            }
        } else $notice = 'Title and summary are required.';
    }
}
$edit = null;
if (isset($_GET['edit'])) {
    $stmt = db()->prepare('SELECT * FROM projects WHERE id=?');
    $stmt->execute([(int)$_GET['edit']]);
    $edit = $stmt->fetch() ?: null;
}
$projects = db()->query('SELECT * FROM projects ORDER BY sort_order ASC, created_at DESC')->fetchAll();
$adminTitle = 'Projects';
require __DIR__ . '/_header.php';
?>
<div class="admin-content"><div class="admin-page-heading"><div><p class="eyebrow">PORTFOLIO CONTENT</p><h1>Projects</h1><p>Add, edit, feature or remove portfolio projects.</p></div></div>
<?php if ($notice): ?><div class="notice"><?= e($notice) ?></div><?php endif; ?>
<section class="admin-panel"><h2><?= $edit ? 'Edit project' : 'Add a project' ?></h2><form method="post" class="admin-form"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= (int)($edit['id'] ?? 0) ?>">
<div class="admin-form-grid"><label>Project title *<input name="title" required maxlength="180" value="<?= e($edit['title'] ?? '') ?>"></label><label>Category<input name="category" maxlength="100" value="<?= e($edit['category'] ?? 'Web Development') ?>"></label><label class="span-2">Short summary *<textarea name="summary" required maxlength="500" rows="3"><?= e($edit['summary'] ?? '') ?></textarea></label><label>Preview image URL<input name="image_url" type="url" value="<?= e($edit['image_url'] ?? '') ?>"></label><label>Live website URL<input name="live_url" type="url" value="<?= e($edit['live_url'] ?? '') ?>"></label><label>Source code URL<input name="source_url" type="url" value="<?= e($edit['source_url'] ?? '') ?>"></label><label>Technologies (comma separated)<input name="technologies" value="<?= e($edit['technologies'] ?? '') ?>"></label><label>Sort order<input type="number" name="sort_order" value="<?= (int)($edit['sort_order'] ?? 0) ?>"></label><label class="check-label"><input type="checkbox" name="featured" <?= !empty($edit['featured']) ? 'checked' : '' ?>> Feature this project</label></div><div class="admin-actions"><button class="button button-primary">Save project</button><?php if ($edit): ?><a class="button button-secondary" href="projects.php">Cancel</a><?php endif; ?></div></form></section>
<section class="admin-panel"><div class="admin-panel-head"><h2>All projects (<?= count($projects) ?>)</h2></div><div class="admin-table-wrap"><table><thead><tr><th>Title</th><th>Category</th><th>Featured</th><th>Actions</th></tr></thead><tbody><?php foreach ($projects as $project): ?><tr><td><b><?= e($project['title']) ?></b><small class="table-sub"><?= e($project['technologies'] ?? '') ?></small></td><td><?= e($project['category']) ?></td><td><?= $project['featured'] ? 'Yes' : 'No' ?></td><td><div class="table-actions"><a href="projects.php?edit=<?= (int)$project['id'] ?>">Edit</a><form method="post" onsubmit="return confirm('Delete this project?')"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$project['id'] ?>"><button>Delete</button></form></div></td></tr><?php endforeach; ?><?php if (!$projects): ?><tr><td colspan="4">No projects found.</td></tr><?php endif; ?></tbody></table></div></section></div>
<?php require __DIR__ . '/_footer.php'; ?>
