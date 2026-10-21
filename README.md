# Kawish Iqbal — Full Stack Developer Portfolio

A responsive, premium white/navy portfolio website built with PHP 8+, MySQL, HTML, CSS and JavaScript. Includes a protected admin panel for managing projects, viewing contact messages, and editing basic site settings.

## Features
- Responsive modern portfolio with light/dark theme toggle
- Home, About, Skills, Projects, Services, Contact, and Privacy sections
- Project showcase with category filters and live/source links
- Contact form stored in MySQL
- Admin login with password hashing, session protection, CSRF tokens and prepared statements
- Admin dashboard: manage projects, view/delete messages, update site settings
- SEO meta tags, canonical-friendly URLs, `robots.txt`, `sitemap.xml` starter
- SQL schema and sample portfolio projects
- No third-party paid dependencies

## Requirements
- PHP 8.1+ (PDO MySQL extension enabled)
- MySQL 5.7+ or MariaDB
- Apache/cPanel or another PHP-capable host

> GitHub Pages does not execute PHP or connect to MySQL. Use PHP hosting/cPanel for this version. If you want a free static GitHub Pages version later, the admin/database features must be replaced with a separate backend service.

## Setup
1. Upload the project files to your PHP hosting `public_html` folder or a subfolder.
2. Create a MySQL database and database user in your hosting control panel.
3. Import `database/schema.sql` using phpMyAdmin.
4. Open `includes/config.php` and enter your database host, name, username and password.
5. Visit `https://your-domain.example/setup-admin.php` once to create your first admin account.
6. Log in at `/admin/login.php`.
7. **Immediately delete `setup-admin.php` after creating your admin account.**
8. Update project links, profile links, contact details, and site copy in the admin panel or `includes/site-data.php`.
9. Enable HTTPS in hosting settings before using the site publicly.

## Default content to customize
- Email: `kawishiqbal24@gmail.com`
- Phone / WhatsApp: `03470262608`
- Education: Government College of Technology (GCT), Rawalpindi
- Experience: 3+ years (as provided)
- Live projects: Quran Academy, Meeqan Travel & Tours, The Legal Choice Lawyer Portal

Only publish experience claims, testimonials, certificates, or client results that you can verify.

## Directory structure
```text
kawish-iqbal-portfolio/
├── admin/
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── database/
├── includes/
├── index.php
├── contact-submit.php
├── setup-admin.php
├── robots.txt
└── sitemap.xml
```
