CREATE DATABASE IF NOT EXISTS db_sistem_login
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE db_sistem_login;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY users_email_unique (email)
) ENGINE=InnoDB
  DEFAULT CHARACTER SET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Hash dibuat dengan PHP password_hash('admin123', PASSWORD_DEFAULT).
INSERT IGNORE INTO users (name, email, password)
VALUES (
    'Administrator',
    'admin@gmail.com',
    '$2y$10$g7VGCeBDtJvh6ivkJJBxFOZTYjGOtft27llwiWW9YMephjPM45LgC'
);
