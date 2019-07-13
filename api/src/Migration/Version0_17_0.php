<?php

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Migrations\Version;
use Ds\Component\Acl\Migration\Version0_17_0 as Acl;

/**
 * Class Version0_17_0
 */
final class Version0_17_0 extends AbstractMigration
{
    /**
     * @var \Ds\Component\Acl\Migration\Version0_17_0
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

        $this->addSql('ALTER TABLE app_anonymous_role RENAME TO app_anonymous_role_prev');
        $this->addSql('DROP INDEX IDX_E2D1EAF6FA93803');
        $this->addSql('DROP INDEX IDX_E2D1EAF6D60322AC');
        $this->addSql('ALTER TABLE app_individual_role RENAME TO app_individual_role_prev');
        $this->addSql('DROP INDEX IDX_C5713550AE271C0D');
        $this->addSql('DROP INDEX IDX_C5713550D60322AC');
        $this->addSql('ALTER TABLE app_organization_role RENAME TO app_organization_role_prev');
        $this->addSql('DROP INDEX IDX_CF25196832C8A3DE');
        $this->addSql('DROP INDEX IDX_CF251968D60322AC');
        $this->addSql('ALTER TABLE app_staff_role RENAME TO app_staff_role_prev');
        $this->addSql('DROP INDEX IDX_E3445799D4D57CD');
        $this->addSql('DROP INDEX IDX_E3445799D60322AC');
        $this->addSql('ALTER TABLE app_system_role RENAME TO app_system_role_prev');
        $this->addSql('DROP INDEX IDX_1F401F20D0952FA5');
        $this->addSql('DROP INDEX IDX_1F401F20D60322AC');

        $this->addSql('CREATE SEQUENCE app_anonymous_role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_individual_role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_organization_role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_staff_role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_system_role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE app_anonymous_role (id INT NOT NULL, anonymous_id INT DEFAULT NULL, role_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E2D1EAF6D17F50A6 ON app_anonymous_role (uuid)');
        $this->addSql('CREATE INDEX IDX_E2D1EAF6FA93803 ON app_anonymous_role (anonymous_id)');
        $this->addSql('CREATE INDEX IDX_E2D1EAF6D60322AC ON app_anonymous_role (role_id)');
        $this->addSql('CREATE TABLE app_anonymous_role_bu (anonymous_role_id INT NOT NULL, business_unit_id INT NOT NULL, PRIMARY KEY(anonymous_role_id, business_unit_id))');
        $this->addSql('CREATE INDEX IDX_B09CAAD23089E0B ON app_anonymous_role_bu (anonymous_role_id)');
        $this->addSql('CREATE INDEX IDX_B09CAADA58ECB40 ON app_anonymous_role_bu (business_unit_id)');
        $this->addSql('CREATE TABLE app_individual_role (id INT NOT NULL, individual_id INT DEFAULT NULL, role_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C5713550D17F50A6 ON app_individual_role (uuid)');
        $this->addSql('CREATE INDEX IDX_C5713550AE271C0D ON app_individual_role (individual_id)');
        $this->addSql('CREATE INDEX IDX_C5713550D60322AC ON app_individual_role (role_id)');
        $this->addSql('CREATE TABLE app_individual_role_bu (individual_role_id INT NOT NULL, business_unit_id INT NOT NULL, PRIMARY KEY(individual_role_id, business_unit_id))');
        $this->addSql('CREATE INDEX IDX_68A9160EFDFA321 ON app_individual_role_bu (individual_role_id)');
        $this->addSql('CREATE INDEX IDX_68A9160A58ECB40 ON app_individual_role_bu (business_unit_id)');
        $this->addSql('CREATE TABLE app_organization_role (id INT NOT NULL, organization_id INT DEFAULT NULL, role_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF251968D17F50A6 ON app_organization_role (uuid)');
        $this->addSql('CREATE INDEX IDX_CF25196832C8A3DE ON app_organization_role (organization_id)');
        $this->addSql('CREATE INDEX IDX_CF251968D60322AC ON app_organization_role (role_id)');
        $this->addSql('CREATE TABLE app_organization_role_bu (organization_role_id INT NOT NULL, business_unit_id INT NOT NULL, PRIMARY KEY(organization_role_id, business_unit_id))');
        $this->addSql('CREATE INDEX IDX_79C5DB011BD1AAEF ON app_organization_role_bu (organization_role_id)');
        $this->addSql('CREATE INDEX IDX_79C5DB01A58ECB40 ON app_organization_role_bu (business_unit_id)');
        $this->addSql('CREATE TABLE app_staff_role (id INT NOT NULL, staff_id INT DEFAULT NULL, role_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E3445799D17F50A6 ON app_staff_role (uuid)');
        $this->addSql('CREATE INDEX IDX_E3445799D4D57CD ON app_staff_role (staff_id)');
        $this->addSql('CREATE INDEX IDX_E3445799D60322AC ON app_staff_role (role_id)');
        $this->addSql('CREATE TABLE app_staff_role_bu (staff_role_id INT NOT NULL, business_unit_id INT NOT NULL, PRIMARY KEY(staff_role_id, business_unit_id))');
        $this->addSql('CREATE INDEX IDX_998CF18F8AB5351A ON app_staff_role_bu (staff_role_id)');
        $this->addSql('CREATE INDEX IDX_998CF18FA58ECB40 ON app_staff_role_bu (business_unit_id)');
        $this->addSql('CREATE TABLE app_system_role (id INT NOT NULL, system_id INT DEFAULT NULL, role_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F401F20D17F50A6 ON app_system_role (uuid)');
        $this->addSql('CREATE INDEX IDX_1F401F20D0952FA5 ON app_system_role (system_id)');
        $this->addSql('CREATE INDEX IDX_1F401F20D60322AC ON app_system_role (role_id)');
        $this->addSql('CREATE TABLE app_system_role_bu (system_role_id INT NOT NULL, business_unit_id INT NOT NULL, PRIMARY KEY(system_role_id, business_unit_id))');
        $this->addSql('CREATE INDEX IDX_6CCE35F83A705E3F ON app_system_role_bu (system_role_id)');
        $this->addSql('CREATE INDEX IDX_6CCE35F8A58ECB40 ON app_system_role_bu (business_unit_id)');
        $this->addSql('ALTER TABLE app_anonymous_role ADD CONSTRAINT FK_E2D1EAF6FA93803 FOREIGN KEY (anonymous_id) REFERENCES app_anonymous (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_anonymous_role ADD CONSTRAINT FK_E2D1EAF6D60322AC FOREIGN KEY (role_id) REFERENCES app_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_anonymous_role_bu ADD CONSTRAINT FK_B09CAAD23089E0B FOREIGN KEY (anonymous_role_id) REFERENCES app_anonymous_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_anonymous_role_bu ADD CONSTRAINT FK_B09CAADA58ECB40 FOREIGN KEY (business_unit_id) REFERENCES app_bu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_individual_role ADD CONSTRAINT FK_C5713550AE271C0D FOREIGN KEY (individual_id) REFERENCES app_individual (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_individual_role ADD CONSTRAINT FK_C5713550D60322AC FOREIGN KEY (role_id) REFERENCES app_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_individual_role_bu ADD CONSTRAINT FK_68A9160EFDFA321 FOREIGN KEY (individual_role_id) REFERENCES app_individual_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_individual_role_bu ADD CONSTRAINT FK_68A9160A58ECB40 FOREIGN KEY (business_unit_id) REFERENCES app_bu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_organization_role ADD CONSTRAINT FK_CF25196832C8A3DE FOREIGN KEY (organization_id) REFERENCES app_organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_organization_role ADD CONSTRAINT FK_CF251968D60322AC FOREIGN KEY (role_id) REFERENCES app_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_organization_role_bu ADD CONSTRAINT FK_79C5DB011BD1AAEF FOREIGN KEY (organization_role_id) REFERENCES app_organization_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_organization_role_bu ADD CONSTRAINT FK_79C5DB01A58ECB40 FOREIGN KEY (business_unit_id) REFERENCES app_bu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_role ADD CONSTRAINT FK_E3445799D4D57CD FOREIGN KEY (staff_id) REFERENCES app_staff (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_role ADD CONSTRAINT FK_E3445799D60322AC FOREIGN KEY (role_id) REFERENCES app_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_role_bu ADD CONSTRAINT FK_998CF18F8AB5351A FOREIGN KEY (staff_role_id) REFERENCES app_staff_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_role_bu ADD CONSTRAINT FK_998CF18FA58ECB40 FOREIGN KEY (business_unit_id) REFERENCES app_bu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_system_role ADD CONSTRAINT FK_1F401F20D0952FA5 FOREIGN KEY (system_id) REFERENCES app_system (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_system_role ADD CONSTRAINT FK_1F401F20D60322AC FOREIGN KEY (role_id) REFERENCES app_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_system_role_bu ADD CONSTRAINT FK_6CCE35F83A705E3F FOREIGN KEY (system_role_id) REFERENCES app_system_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_system_role_bu ADD CONSTRAINT FK_6CCE35F8A58ECB40 FOREIGN KEY (business_unit_id) REFERENCES app_bu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        $this->addSql('INSERT INTO app_anonymous_role (id, anonymous_id, role_id, uuid, owner, owner_uuid, version, tenant, created_at, updated_at) SELECT nextval(\'app_anonymous_role_id_seq\'), app_anonymous_role_prev.anonymous_id, app_anonymous_role_prev.role_id, uuid_in(md5(random()::text || clock_timestamp()::text)::cstring), app_anonymous.owner, app_anonymous.owner_uuid, 1, app_anonymous.tenant, \'now()\', \'now()\' FROM app_anonymous_role_prev LEFT JOIN app_anonymous ON app_anonymous.id = app_anonymous_role_prev.anonymous_id');
        $this->addSql('DROP TABLE app_anonymous_role_prev');
        $this->addSql('INSERT INTO app_individual_role (id, individual_id, role_id, uuid, owner, owner_uuid, version, tenant, created_at, updated_at) SELECT nextval(\'app_individual_role_id_seq\'), app_individual_role_prev.individual_id, app_individual_role_prev.role_id, uuid_in(md5(random()::text || clock_timestamp()::text)::cstring), app_individual.owner, app_individual.owner_uuid, 1, app_individual.tenant, \'now()\', \'now()\' FROM app_individual_role_prev LEFT JOIN app_individual ON app_individual.id = app_individual_role_prev.individual_id');
        $this->addSql('DROP TABLE app_individual_role_prev');
        $this->addSql('INSERT INTO app_organization_role (id, organization_id, role_id, uuid, owner, owner_uuid, version, tenant, created_at, updated_at) SELECT nextval(\'app_organization_role_id_seq\'), app_organization_role_prev.organization_id, app_organization_role_prev.role_id, uuid_in(md5(random()::text || clock_timestamp()::text)::cstring), app_organization.owner, app_organization.owner_uuid, 1, app_organization.tenant, \'now()\', \'now()\' FROM app_organization_role_prev LEFT JOIN app_organization ON app_organization.id = app_organization_role_prev.organization_id');
        $this->addSql('DROP TABLE app_organization_role_prev');
        $this->addSql('INSERT INTO app_staff_role (id, staff_id, role_id, uuid, owner, owner_uuid, version, tenant, created_at, updated_at) SELECT nextval(\'app_staff_role_id_seq\'), app_staff_role_prev.staff_id, app_staff_role_prev.role_id, uuid_in(md5(random()::text || clock_timestamp()::text)::cstring), app_staff.owner, app_staff.owner_uuid, 1, app_staff.tenant, \'now()\', \'now()\' FROM app_staff_role_prev LEFT JOIN app_staff ON app_staff.id = app_staff_role_prev.staff_id');
        $this->addSql('DROP TABLE app_staff_role_prev');
        $this->addSql('INSERT INTO app_system_role (id, system_id, role_id, uuid, owner, owner_uuid, version, tenant, created_at, updated_at) SELECT nextval(\'app_system_role_id_seq\'), app_system_role_prev.system_id, app_system_role_prev.role_id, uuid_in(md5(random()::text || clock_timestamp()::text)::cstring), app_system.owner, app_system.owner_uuid, 1, app_system.tenant, \'now()\', \'now()\' FROM app_system_role_prev LEFT JOIN app_system ON app_system.id = app_system_role_prev.system_id');
        $this->addSql('DROP TABLE app_system_role_prev');
    }

    /**
     * Down migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->acl->down($schema);
    }
}
