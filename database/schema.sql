CREATE TABLE IF NOT EXISTS admins (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS projects (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(180) NOT NULL,
  category VARCHAR(100) NOT NULL DEFAULT 'Web Development',
  summary VARCHAR(500) NOT NULL,
  image_url VARCHAR(500) DEFAULT NULL,
  live_url VARCHAR(500) DEFAULT NULL,
  source_url VARCHAR(500) DEFAULT NULL,
  technologies VARCHAR(500) DEFAULT NULL,
  featured TINYINT(1) NOT NULL DEFAULT 0,
  sort_order INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS messages (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL,
  subject VARCHAR(180) DEFAULT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  is_read TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS site_settings (
  setting_key VARCHAR(100) PRIMARY KEY,
  setting_value TEXT NOT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO projects (title, category, summary, live_url, technologies, featured, sort_order)
SELECT 'Haroon Ibn Rasheed Online Quran Academy', 'Education',
       'An online Quran academy website designed to introduce classes and help visitors enquire about learning options.',
       'https://haroonibnrasheedonlinequranacadmey.github.io/Haroon-Ibn--Rasheed-Online-Quran-Acadmey/',
       'HTML, CSS, JavaScript', 1, 1
WHERE NOT EXISTS (SELECT 1 FROM projects WHERE title = 'Haroon Ibn Rasheed Online Quran Academy');

INSERT INTO projects (title, category, summary, live_url, technologies, featured, sort_order)
SELECT 'Meeqan Travel & Tours', 'Travel & Tourism',
       'A travel and tours website concept presenting travel services and destination information.',
       'https://haroonibnrasheedonlinequranacadmey.github.io/meeqan-travel-tours/index.html',
       'HTML, CSS, JavaScript', 1, 2
WHERE NOT EXISTS (SELECT 1 FROM projects WHERE title = 'Meeqan Travel & Tours');

INSERT INTO projects (title, category, summary, live_url, technologies, featured, sort_order)
SELECT 'The Legal Choice Lawyer Portal', 'Professional Services',
       'A lawyer portal website designed to present legal services and provide a clear path for client enquiries.',
       'https://thelegalchoicelawyerportal.github.io/The-Leagal-Choice-Lawyer-Portal/index.html',
       'HTML, CSS, JavaScript', 1, 3
WHERE NOT EXISTS (SELECT 1 FROM projects WHERE title = 'The Legal Choice Lawyer Portal');

INSERT INTO site_settings (setting_key, setting_value)
VALUES
('site_title', 'Kawish Iqbal | Full Stack Web Developer'),
('tagline', 'Building modern, responsive and reliable digital experiences.'),
('contact_email', 'kawishiqbal24@gmail.com'),
('contact_phone', '03470262608')
ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value);
