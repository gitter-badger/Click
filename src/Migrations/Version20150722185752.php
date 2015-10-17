<?php

namespace OctoLab\Click\Migrations;

use OctoLab\Common\Doctrine\Migration\DriverBasedMigration;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
class Version20150722185752 extends DriverBasedMigration
{
    public function prePdoPgsqlUp()
    {
        $this->queries[] = 'CREATE FUNCTION set_created_at() RETURNS TRIGGER AS $set_created_at$
          BEGIN
            NEW.created_at = CURRENT_TIMESTAMP;
            RETURN NEW;
          END;
        $set_created_at$ LANGUAGE plpgsql';
        $this->queries[] = 'CREATE FUNCTION set_updated_at() RETURNS TRIGGER AS $set_updated_at$
          BEGIN
            NEW.updated_at = CURRENT_TIMESTAMP;
            RETURN NEW;
          END;
        $set_updated_at$ LANGUAGE plpgsql';
        $this->queries[] = 'CREATE TABLE link (
            id BIGSERIAL NOT NULL,
            env VARCHAR(32) NOT NULL,
            urn VARCHAR(128) NOT NULL,
            uri VARCHAR(255) NOT NULL,
            alias VARCHAR(32) NULL DEFAULT NULL,
            created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            deleted_at TIMESTAMP(0) WITHOUT TIME ZONE NULL DEFAULT NULL,
            PRIMARY KEY (id),
            CONSTRAINT link_urn UNIQUE (env, urn),
            CONSTRAINT link_alias UNIQUE (alias)
        )';
        $this->queries[] = 'CREATE TRIGGER create_link BEFORE INSERT ON link
        FOR EACH ROW EXECUTE PROCEDURE set_created_at()';
        $this->queries[] = 'CREATE TRIGGER update_link BEFORE INSERT OR UPDATE ON link
        FOR EACH ROW EXECUTE PROCEDURE set_updated_at()';
    }

    public function prePdoPgsqlDown()
    {
        $this->queries[] = 'DROP TRIGGER update_link ON link';
        $this->queries[] = 'DROP TRIGGER create_link ON link';
        $this->queries[] = 'DROP TABLE link';
        $this->queries[] = 'DROP FUNCTION set_updated_at()';
        $this->queries[] = 'DROP FUNCTION set_created_at()';
    }
}
