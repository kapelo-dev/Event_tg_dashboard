-- Migrer les données des anciennes colonnes vers les nouvelles
UPDATE ActivityLog 
SET subject_type = entityType,
    subject_id = entityId,
    description = action,
    properties = details
WHERE subject_type IS NULL;

-- Supprimer les anciennes colonnes
ALTER TABLE ActivityLog
DROP COLUMN entityType,
DROP COLUMN entityId,
DROP COLUMN action,
DROP COLUMN details;
