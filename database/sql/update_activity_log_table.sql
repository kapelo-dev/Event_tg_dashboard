-- Ajout des colonnes pour le suivi des tickets dans la table ActivityLog
ALTER TABLE ActivityLog
ADD COLUMN subject_type VARCHAR(255) NULL COMMENT 'Type de l''entité concernée (ex: App\\Models\\TicketType)',
ADD COLUMN subject_id BIGINT UNSIGNED NULL COMMENT 'ID de l''entité concernée',
ADD COLUMN description VARCHAR(255) NULL COMMENT 'Type d''action (create_ticket_type, add_quantity, remove_quantity)',
ADD COLUMN properties JSON NULL COMMENT 'Données JSON additionnelles (ex: {"quantity": 5})',
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Ajout d'un index pour améliorer les performances des requêtes de recherche
CREATE INDEX idx_activity_log_subject ON activitylog(subject_type, subject_id);

-- Ajout d'un index pour améliorer les performances des requêtes de logs par description
CREATE INDEX idx_activity_log_description ON activitylog(description);

-- Script de rollback en cas de besoin
-- ALTER TABLE activitylog
-- DROP COLUMN subject_type,
-- DROP COLUMN subject_id,
-- DROP COLUMN description,
-- DROP COLUMN properties,
-- DROP COLUMN created_at,
-- DROP COLUMN updated_at;
-- 
-- DROP INDEX idx_activity_log_subject;
-- DROP INDEX idx_activity_log_description;
