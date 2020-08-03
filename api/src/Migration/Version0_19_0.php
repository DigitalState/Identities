<?php

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Migrations\Version;
use Ds\Component\Acl\Migration\Version0_19_0 as Acl;

/**
 * Class Version0_19_0
 */
final class Version0_19_0 extends AbstractMigration
{
    /**
     * @var \Ds\Component\Acl\Migration\Version0_19_0
     */
    private $acl;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Migrations\Version  $version
     */
    public function __construct(Version $version)
    {
        parent::__construct($version);
        $this->acl = new Acl($version);
    }

    /**
     * Up migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->acl->up($schema);
        $this->addSql('ALTER TABLE app_anonymous_role ADD entity_uuids JSON DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN app_anonymous_role.entity_uuids IS \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE app_individual_role ADD entity_uuids JSON DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN app_individual_role.entity_uuids IS \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE app_organization_role ADD entity_uuids JSON DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN app_organization_role.entity_uuids IS \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE app_staff_role ADD entity_uuids JSON DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN app_staff_role.entity_uuids IS \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE app_system_role ADD entity_uuids JSON DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN app_system_role.entity_uuids IS \'(DC2Type:json_array)\'');
        $this->addSql('
            UPDATE
                app_anonymous_role
            SET
                entity_uuids = (
                    SELECT
                        array_to_json(array_agg(app_bu.uuid))
                    FROM
                        app_anonymous_role_bu
                    INNER JOIN
                        app_bu ON
                        app_bu.id = app_anonymous_role_bu.business_unit_id
                    WHERE
                        app_anonymous_role_bu.anonymous_role_id = app_anonymous_role.id
                )
        ');
        $this->addSql('UPDATE app_anonymous_role SET entity_uuids = \'[]\' WHERE entity_uuids IS NULL');
        $this->addSql('
            UPDATE
                app_individual_role
            SET
                entity_uuids = (
                    SELECT
                        array_to_json(array_agg(app_bu.uuid))
                    FROM
                        app_individual_role_bu
                    INNER JOIN
                        app_bu ON
                        app_bu.id = app_individual_role_bu.business_unit_id
                    WHERE
                        app_individual_role_bu.individual_role_id = app_individual_role.id
                )
        ');
        $this->addSql('UPDATE app_individual_role SET entity_uuids = \'[]\' WHERE entity_uuids IS NULL');
        $this->addSql('
            UPDATE
                app_organization_role
            SET
                entity_uuids = (
                    SELECT
                        array_to_json(array_agg(app_bu.uuid))
                    FROM
                        app_organization_role_bu
                    INNER JOIN
                        app_bu ON
                        app_bu.id = app_organization_role_bu.business_unit_id
                    WHERE
                        app_organization_role_bu.organization_role_id = app_organization_role.id
                )
        ');
        $this->addSql('UPDATE app_organization_role SET entity_uuids = \'[]\' WHERE entity_uuids IS NULL');
        $this->addSql('
            UPDATE
                app_staff_role
            SET
                entity_uuids = (
                    SELECT
                        array_to_json(array_agg(app_bu.uuid))
                    FROM
                        app_staff_role_bu
                    INNER JOIN
                        app_bu ON
                        app_bu.id = app_staff_role_bu.business_unit_id
                    WHERE
                        app_staff_role_bu.staff_role_id = app_staff_role.id
                )
        ');
        $this->addSql('UPDATE app_staff_role SET entity_uuids = \'[]\' WHERE entity_uuids IS NULL');
        $this->addSql('
            UPDATE
                app_system_role
            SET
                entity_uuids = (
                    SELECT
                        array_to_json(array_agg(app_bu.uuid))
                    FROM
                        app_system_role_bu
                    INNER JOIN
                        app_bu ON
                        app_bu.id = app_system_role_bu.business_unit_id
                    WHERE
                        app_system_role_bu.system_role_id = app_system_role.id
                )
        ');
        $this->addSql('UPDATE app_system_role SET entity_uuids = \'[]\' WHERE entity_uuids IS NULL');
        $this->addSql('ALTER TABLE app_anonymous_role ALTER entity_uuids SET NOT NULL');
        $this->addSql('ALTER TABLE app_individual_role ALTER entity_uuids SET NOT NULL');
        $this->addSql('ALTER TABLE app_organization_role ALTER entity_uuids SET NOT NULL');
        $this->addSql('ALTER TABLE app_staff_role ALTER entity_uuids SET NOT NULL');
        $this->addSql('ALTER TABLE app_system_role ALTER entity_uuids SET NOT NULL');
        $this->addSql('DROP TABLE app_anonymous_role_bu');
        $this->addSql('DROP TABLE app_individual_role_bu');
        $this->addSql('DROP TABLE app_organization_role_bu');
        $this->addSql('DROP TABLE app_staff_role_bu');
        $this->addSql('DROP TABLE app_system_role_bu');
    }

    /**
     * Down migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->acl->down($schema);
        $this->addSql('CREATE TABLE app_anonymous_role_bu (anonymous_role_id INT NOT NULL, business_unit_id INT NOT NULL, PRIMARY KEY(anonymous_role_id, business_unit_id))');
        $this->addSql('CREATE INDEX IDX_B09CAAD23089E0B ON app_anonymous_role_bu (anonymous_role_id)');
        $this->addSql('CREATE INDEX IDX_B09CAADA58ECB40 ON app_anonymous_role_bu (business_unit_id)');
        $this->addSql('CREATE TABLE app_individual_role_bu (individual_role_id INT NOT NULL, business_unit_id INT NOT NULL, PRIMARY KEY(individual_role_id, business_unit_id))');
        $this->addSql('CREATE INDEX IDX_68A9160EFDFA321 ON app_individual_role_bu (individual_role_id)');
        $this->addSql('CREATE INDEX IDX_68A9160A58ECB40 ON app_individual_role_bu (business_unit_id)');
        $this->addSql('CREATE TABLE app_organization_role_bu (organization_role_id INT NOT NULL, business_unit_id INT NOT NULL, PRIMARY KEY(organization_role_id, business_unit_id))');
        $this->addSql('CREATE INDEX IDX_79C5DB011BD1AAEF ON app_organization_role_bu (organization_role_id)');
        $this->addSql('CREATE INDEX IDX_79C5DB01A58ECB40 ON app_organization_role_bu (business_unit_id)');
        $this->addSql('CREATE TABLE app_staff_role_bu (staff_role_id INT NOT NULL, business_unit_id INT NOT NULL, PRIMARY KEY(staff_role_id, business_unit_id))');
        $this->addSql('CREATE INDEX IDX_998CF18F8AB5351A ON app_staff_role_bu (staff_role_id)');
        $this->addSql('CREATE INDEX IDX_998CF18FA58ECB40 ON app_staff_role_bu (business_unit_id)');
        $this->addSql('CREATE TABLE app_system_role_bu (system_role_id INT NOT NULL, business_unit_id INT NOT NULL, PRIMARY KEY(system_role_id, business_unit_id))');
        $this->addSql('CREATE INDEX IDX_6CCE35F83A705E3F ON app_system_role_bu (system_role_id)');
        $this->addSql('CREATE INDEX IDX_6CCE35F8A58ECB40 ON app_system_role_bu (business_unit_id)');
        $this->addSql('
            INSERT INTO app_anonymous_role_bu (
                anonymous_role_id,
                business_unit_id
            )
            SELECT
                app_anonymous_role.id,
                app_bu.id
            FROM
                app_anonymous_role,
                app_bu
            WHERE
                app_anonymous_role.entity_uuids::text LIKE CONCAT(\'%\', app_bu.uuid, \'%\')
        ');
        $this->addSql('
            INSERT INTO app_individual_role_bu (
                individual_role_id,
                business_unit_id
            )
            SELECT
                app_individual_role.id,
                app_bu.id
            FROM
                app_individual_role,
                app_bu
            WHERE
                app_individual_role.entity_uuids::text LIKE CONCAT(\'%\', app_bu.uuid, \'%\')
        ');
        $this->addSql('
            INSERT INTO app_organization_role_bu (
                organization_role_id,
                business_unit_id
            )
            SELECT
                app_organization_role.id,
                app_bu.id
            FROM
                app_organization_role,
                app_bu
            WHERE
                app_organization_role.entity_uuids::text LIKE CONCAT(\'%\', app_bu.uuid, \'%\')
        ');
        $this->addSql('
            INSERT INTO app_staff_role_bu (
                staff_role_id,
                business_unit_id
            )
            SELECT
                app_staff_role.id,
                app_bu.id
            FROM
                app_staff_role,
                app_bu
            WHERE
                app_staff_role.entity_uuids::text LIKE CONCAT(\'%\', app_bu.uuid, \'%\')
        ');
        $this->addSql('
            INSERT INTO app_system_role_bu (
                system_role_id,
                business_unit_id
            )
            SELECT
                app_system_role.id,
                app_bu.id
            FROM
                app_system_role,
                app_bu
            WHERE
                app_system_role.entity_uuids::text LIKE CONCAT(\'%\', app_bu.uuid, \'%\')
        ');
        $this->addSql('ALTER TABLE app_anonymous_role DROP entity_uuids');
        $this->addSql('ALTER TABLE app_individual_role DROP entity_uuids');
        $this->addSql('ALTER TABLE app_organization_role DROP entity_uuids');
        $this->addSql('ALTER TABLE app_staff_role DROP entity_uuids');
        $this->addSql('ALTER TABLE app_system_role DROP entity_uuids');
    }
}
