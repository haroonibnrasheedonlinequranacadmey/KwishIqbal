<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/site-data.php';
try {
    $projects = db()->query('SELECT * FROM projects ORDER BY featured DESC, sort_order ASC, created_at DESC')->fetchAll();
    $settings = db()->query('SELECT setting_key, setting_value FROM site_settings')->fetchAll();
    foreach ($settings as $setting) {
        if ($setting['setting_key'] === 'tagline') $profile['tagline'] = $setting['setting_value'];
        if ($setting['setting_key'] === 'contact_email') $profile['email'] = $setting['setting_value'];
        if ($setting['setting_key'] === 'contact_phone') $profile['phone'] = $setting['setting_value'];
    }
} catch (Throwable $e) {
    $projects = [
        ['id'=>1,'title'=>'Online Quran Academy','category'=>'Education','summary'=>'A website for presenting online Quran learning services.','live_url'=>'https://haroonibnrasheedonlinequranacadmey.github.io/Haroon-Ibn--Rasheed-Online-Quran-Acadmey/','source_url'=>'','technologies'=>'HTML, CSS, JavaScript','image_url'=>'','featured'=>1],
        ['id'=>2,'title'=>'Meeqan Travel & Tours','category'=>'Travel & Tourism','summary'=>'A travel and tours website experience.','live_url'=>'https://haroonibnrasheedonlinequranacadmey.github.io/meeqan-travel-tours/index.html','source_url'=>'','technologies'=>'HTML, CSS, JavaScript','image_url'=>'','featured'=>1],
        ['id'=>3,'title'=>'The Legal Choice Lawyer Portal','category'=>'Professional Services','summary'=>'A professional website for legal services.','live_url'=>'https://thelegalchoicelawyerportal.github.io/The-Leagal-Choice-Lawyer-Portal/index.html','source_url'=>'','technologies'=>'HTML, CSS, JavaScript','image_url'=>'','featured'=>1],
    ];
}
$pageTitle = 'Kawish Iqbal | Full Stack Web Developer';
require __DIR__ . '/includes/header.php';
?>
<main id="main">
<section class="hero section-pad">
  <div class="hero-glow glow-one"></div><div class="hero-glow glow-two"></div>
  <div class="container hero-grid">
    <div class="hero-copy reveal">
      <p class="eyebrow"><span class="status-dot"></span> AVAILABLE FOR SELECT PROJECTS</p>
      <h1>Hi, I'm <span class="gradient-text">Kawish Iqbal.</span><br>Full Stack Web Developer<span class="accent-dot">.</span></h1>
      <p class="hero-lead">I build modern, responsive and reliable digital experiences — from polished websites to powerful web applications.</p>
      <div class="hero-actions"><a class="button button-primary" href="#projects">Explore my work <span>↗</span></a><a class="button button-secondary" href="#contact">Start a project</a></div>
      <div class="hero-proof"><div class="avatar-stack"><span>K</span><span>&lt;/&gt;</span><span>✦</span></div><p><b>20+ projects</b><br><small>Building useful digital solutions</small></p></div>
    </div>
    <div class="hero-visual reveal">
      <div class="visual-orbit orbit-a"></div><div class="visual-orbit orbit-b"></div>
      <div class="code-card">
        <div class="code-top"><span></span><span></span><span></span><small>developer.js</small></div>
        <pre><code><i>const</i> developer = {
  name: <em>"Kawish Iqbal"</em>,
  role: <em>"Full Stack Developer"</em>,
  focus: [
    <em>"Clean UI"</em>,
    <em>"Reliable systems"</em>,
    <em>"Great UX"</em>
  ],
  build: () <b>=&gt;</b> <strong>"Ideas into reality"</strong>
};</code></pre>
        <div class="code-footer"><span class="pulse"></span> Crafting digital experiences <span>✦</span></div>
      </div>
      <div class="floating-chip chip-top"><span>✳</span> Responsive by design</div>
      <div class="floating-chip chip-bottom"><span>↗</span> Built for real-world use</div>
    </div>
  </div>
  <div class="container hero-bottom"><span>SCROLL TO EXPLORE</span><span class="scroll-line"></span><span>01 — 06</span></div>
</section>

<section class="stats-strip"><div class="container stats-grid"><div><strong>20<span>+</span></strong><small>Projects completed*</small></div><div><strong>3<span>+</span></strong><small>Years experience*</small></div><div><strong>4</strong><small>Core skill areas</small></div><div><strong>100<span>%</span></strong><small>Commitment to quality</small></div></div></section>

<section id="about" class="section-pad"><div class="container two-col">
  <div class="section-heading reveal"><p class="eyebrow">01 / ABOUT ME</p><h2>Good code.<br><span class="muted-text">Thoughtful design.</span><br>Useful outcomes.</h2><p class="section-note">Technology should solve real problems and feel effortless to use.</p></div>
  <div class="about-copy reveal"><p class="large-copy">I'm Kawish Iqbal, a Full Stack Web Developer with a technical education from <b>Government College of Technology (GCT), Rawalpindi.</b></p><p>I work across the web development process — shaping interfaces, building application functionality, connecting data, and preparing projects for deployment. I care about responsive layouts, maintainable code, clear communication and details that make a product feel complete.</p><p>My project experience includes business websites, educational platforms, travel websites, professional service portals, dashboards and custom web applications.</p><div class="about-facts"><div><small>EDUCATION</small><b>GCT Rawalpindi</b></div><div><small>FOCUS</small><b>Full Stack Development</b></div></div></div>
</div></section>

<section id="skills" class="section-pad section-soft"><div class="container"><div class="section-heading centered reveal"><p class="eyebrow">02 / TOOLKIT</p><h2>Technologies I work with<span class="accent-dot">.</span></h2><p class="section-note">A broad toolkit for building, integrating and shipping web experiences.</p></div><div class="skills-grid">
<?php foreach ($skills as $group => $items): ?><article class="skill-card reveal"><div class="skill-card-head"><span class="skill-icon"><?= $group === 'Frontend' ? '◫' : ($group === 'Backend' ? '⌘' : ($group === 'Databases' ? '▤' : '⚙')) ?></span><h3><?= e($group) ?></h3></div><div class="tag-list"><?php foreach ($items as $item): ?><span class="tag"><?= e($item) ?></span><?php endforeach; ?></div></article><?php endforeach; ?>
</div></div></section>

<section id="projects" class="section-pad"><div class="container"><div class="section-heading section-heading-row reveal"><div><p class="eyebrow">03 / SELECTED WORK</p><h2>Projects with a purpose<span class="accent-dot">.</span></h2><p class="section-note">A selection of websites and digital experiences.</p></div><span class="project-count"><?= count($projects) ?> FEATURED PROJECTS</span></div>
<div class="filter-row" role="group" aria-label="Filter projects"><button class="filter-btn active" data-filter="all">All work</button><button class="filter-btn" data-filter="education">Education</button><button class="filter-btn" data-filter="travel">Travel</button><button class="filter-btn" data-filter="professional">Professional</button><button class="filter-btn" data-filter="other">Other</button></div>
<div class="projects-grid">
<?php foreach ($projects as $i => $project):
$category = strtolower((string)($project['category'] ?? 'other'));
$filter = str_contains($category,'education') ? 'education' : (str_contains($category,'travel') ? 'travel' : ((str_contains($category,'professional') || str_contains($category,'legal')) ? 'professional' : 'other'));
$techs = array_filter(array_map('trim', explode(',', (string)($project['technologies'] ?? 'Web Development'))));
?>
<article class="project-card reveal" data-category="<?= e($filter) ?>">
  <div class="project-art art-<?= ($i % 3)+1 ?>"><div class="browser-frame"><div class="browser-bar"><span></span><span></span><span></span><i><?= e(parse_url((string)($project['live_url'] ?? ''), PHP_URL_HOST) ?: 'project-preview') ?></i></div><div class="browser-content"><span class="preview-kicker"><?= e(strtoupper((string)$project['category'])) ?></span><strong><?= e((string)$project['title']) ?></strong><span class="preview-lines"></span><span class="preview-button">Explore ↗</span></div></div><span class="project-number"><?= str_pad((string)($i+1),2,'0',STR_PAD_LEFT) ?></span></div>
  <div class="project-info"><div class="project-meta"><span><?= e((string)$project['category']) ?></span><?php if (!empty($project['featured'])): ?><span class="featured-label">FEATURED</span><?php endif; ?></div><h3><?= e((string)$project['title']) ?></h3><p><?= e((string)$project['summary']) ?></p><div class="tag-list project-tags"><?php foreach (array_slice($techs,0,4) as $tech): ?><span class="tag"><?= e($tech) ?></span><?php endforeach; ?></div><div class="project-links"><?php if (!empty($project['live_url'])): ?><a href="<?= e((string)$project['live_url']) ?>" target="_blank" rel="noopener noreferrer">Live website <span>↗</span></a><?php endif; ?><?php if (!empty($project['source_url'])): ?><a href="<?= e((string)$project['source_url']) ?>" target="_blank" rel="noopener noreferrer">Source code <span>↗</span></a><?php endif; ?></div></div>
</article>
<?php endforeach; ?>
</div><p class="small-disclaimer">*Experience and project counts are based on information supplied by Kawish. Project summaries and technologies should be reviewed for accuracy before publication.</p>
</div></section>

<section id="services" class="section-pad section-soft"><div class="container"><div class="section-heading centered reveal"><p class="eyebrow">04 / WHAT I DO</p><h2>Services built around your goals<span class="accent-dot">.</span></h2><p class="section-note">From the first idea to a polished, production-ready experience.</p></div><div class="services-grid"><?php foreach ($services as $service): ?><article class="service-card reveal"><span class="service-icon"><?= e($service['icon']) ?></span><h3><?= e($service['title']) ?></h3><p><?= e($service['description']) ?></p><a href="#contact" aria-label="Enquire about <?= e($service['title']) ?>">Discuss a project <span>↗</span></a></article><?php endforeach; ?></div></div></section>

<section class="process-section section-pad"><div class="container process-grid"><div class="section-heading reveal"><p class="eyebrow">05 / HOW I WORK</p><h2>A clear process.<br><span class="muted-text">Better outcomes.</span></h2><p class="section-note">A collaborative approach keeps the work focused, transparent and purposeful.</p></div><div class="process-list"><?php foreach ([['01','Discover','Understand your goals, audience, requirements and priorities.'],['02','Plan & Design','Map the experience, structure the content and define the visual direction.'],['03','Build & Test','Develop responsive features, integrate data and test key journeys.'],['04','Launch & Improve','Deploy carefully, review performance and plan ongoing improvements.']] as $step): ?><div class="process-item reveal"><span><?= $step[0] ?></span><div><h3><?= $step[1] ?></h3><p><?= $step[2] ?></p></div></div><?php endforeach; ?></div></div></section>

<section id="contact" class="section-pad contact-section"><div class="container contact-grid"><div class="section-heading reveal"><p class="eyebrow">06 / LET'S CONNECT</p><h2>Have an idea?<br><span class="gradient-text">Let's build it.</span></h2><p class="section-note">Tell me a little about your project and what you want to achieve. I'll get back to you using the details you provide.</p><div class="contact-direct"><a href="mailto:<?= e($profile['email']) ?>"><span class="contact-symbol">@</span><span><small>EMAIL ME</small><b><?= e($profile['email']) ?></b></span><span>↗</span></a><a href="https://wa.me/<?= e($profile['whatsapp']) ?>" target="_blank" rel="noopener noreferrer"><span class="contact-symbol">◉</span><span><small>WHATSAPP</small><b><?= e($profile['phone']) ?></b></span><span>↗</span></a></div></div>
<form class="contact-form reveal" action="contact-submit.php" method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Your name<input name="name" required maxlength="120" autocomplete="name" placeholder="Full name"></label><label>Email address<input type="email" name="email" required maxlength="190" autocomplete="email" placeholder="you@example.com"></label><label>Subject<input name="subject" maxlength="180" placeholder="What would you like to build?"></label><label>Project details<textarea name="message" required minlength="10" maxlength="5000" rows="5" placeholder="Tell me about your idea, goals and timeline..."></textarea></label><button class="button button-primary full-button" type="submit">Send project inquiry <span>↗</span></button><p class="form-note">Your details will only be used to respond to your inquiry.</p></form></div></section>
</main>
<footer class="site-footer"><div class="container footer-top"><a class="brand" href="index.php"><span class="brand-mark">&lt;/&gt;</span><span>Kawish <b>Iqbal</b><small>FULL STACK DEVELOPER</small></span></a><p>Building useful things for the web.</p><a href="#main" class="back-top">Back to top ↑</a></div><div class="container footer-bottom"><span>© <?= date('Y') ?> Kawish Iqbal. All rights reserved.</span><span>Designed with purpose · Built for the web</span><a href="index.php#contact">Privacy-minded contact</a></div></footer>
<script src="assets/js/main.js"></script>
</body></html>
