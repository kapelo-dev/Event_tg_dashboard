-- Supprimer l'ancien admin s'il existe
DELETE FROM users WHERE email = 'admin@kapelo.com';

-- Insérer le nouvel admin
INSERT INTO `users` (
    `username`,
    `email`,
    `password`,
    `first_name`,
    `last_name`,
    `status`,
    `role`,
    `created_at`,
    `updated_at`
) VALUES (
    'admin2023',
    'admin@kapelo.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- password: 'password'
    'Administrateur',
    'System',
    'ACTIVE',
    'ADMIN',
    NOW(),
    NOW()
); 