-- Renommer les colonnes pour correspondre au nouveau modèle
ALTER TABLE ActivityLog
CHANGE COLUMN subject_type entityType VARCHAR(255) NULL COMMENT 'Type de l''entité concernée (ex: App\\Models\\TicketType)',
CHANGE COLUMN subject_id entityId BIGINT UNSIGNED NULL COMMENT 'ID de l''entité concernée',
CHANGE COLUMN description action VARCHAR(255) NULL COMMENT 'Type d''action (create_ticket_type, add_quantity, remove_quantity)',
CHANGE COLUMN properties details JSON NULL COMMENT 'Données JSON additionnelles (ex: {"quantity": 5})',
CHANGE COLUMN created_at createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
CHANGE COLUMN updated_at updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Recréer les index avec les nouveaux noms de colonnes
DROP INDEX idx_activity_log_subject ON ActivityLog;
DROP INDEX idx_activity_log_description ON ActivityLog;

CREATE INDEX idx_activity_log_entity ON ActivityLog(entityType, entityId);
CREATE INDEX idx_activity_log_action ON ActivityLog(action);
