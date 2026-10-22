<?php
require_once __DIR__ . '/config.php';
$pageTitle = $pageTitle ?? SITE_NAME;
$metaDescription = $metaDescription ?? 'Kawish Iqbal — Full Stack Web Developer building modern, responsive and reliable web experiences.';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?></title>
  <meta name="description" content="<?= e($metaDescription) ?>">
  <meta name="theme-color" content="#102b50">
  <link rel="stylesheet" href="assets/css/style.css">
  <script>try{document.documentElement.dataset.theme=localStorage.getItem('ki-theme')||'light'}catch(e){}</script>
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header">
  <div class="container nav-wrap">
    <a class="brand" href="index.php" aria-label="Kawish Iqbal home"><span class="brand-mark">&lt;/&gt;</span><span>Kawish <b>Iqbal</b><small>FULL STACK DEVELOPER</small></span></a>
    <button class="menu-toggle" aria-label="Toggle navigation" aria-expanded="false">☰</button>
    <nav class="main-nav" aria-label="Main navigation">
      <a href="index.php#about">About</a><a href="index.php#skills">Skills</a><a href="index.php#projects">Projects</a><a href="index.php#services">Services</a><a href="index.php#contact">Contact</a>
      <button class="theme-toggle" type="button" aria-label="Toggle light and dark theme">◐</button>
      <a class="nav-cta" href="index.php#contact">Let's Talk <span>↗</span></a>
    </nav>
  </div>
</header>
