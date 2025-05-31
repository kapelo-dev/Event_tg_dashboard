-- Insertion de l'administrateur
INSERT INTO `users` (
    `username`,
    `email`,
    `password`,
    `first_name`,
    `last_name`,
    `phone`,
    `status`,
    `role`,
    `created_at`,
    `updated_at`
) VALUES (
    'admin',
    'admin@kapelo.com',
    '$2y$10$kWmmZu5KLdPro1nok2MaVu8OIUz3ponD3KrtrHsX/y20yBze1y2xO', -- Mot de passe haché pour 'Admin@123'
    'Administrateur',
    'System',
    NULL,
    'ACTIVE',
    'ADMIN',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
); 