-- Supprimer les anciennes colonnes en camelCase
ALTER TABLE ActivityLog
DROP COLUMN IF EXISTS createdAt,
DROP COLUMN IF EXISTS updatedAt;

-- S'assurer que les nouvelles colonnes existent avec le bon format
ALTER TABLE ActivityLog
MODIFY COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
MODIFY COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
