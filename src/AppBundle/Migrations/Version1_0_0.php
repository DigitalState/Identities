<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Version1_0_0
 */
class Version1_0_0 extends AbstractMigration
{
    /**
     * Up
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        // Entity schema
        $this->addSql('CREATE SEQUENCE ds_config_id_seq INCREMENT BY 1 MINVALUE 1 START 9');
        $this->addSql('CREATE SEQUENCE ds_parameter_id_seq INCREMENT BY 1 MINVALUE 1 START 4');
        $this->addSql('CREATE SEQUENCE ds_access_id_seq INCREMENT BY 1 MINVALUE 1 START 3');
        $this->addSql('CREATE SEQUENCE ds_access_permission_id_seq INCREMENT BY 1 MINVALUE 1 START 7');
        $this->addSql('CREATE SEQUENCE ds_tenant_id_seq INCREMENT BY 1 MINVALUE 1 START 2');
        $this->addSql('CREATE SEQUENCE app_anonymous_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_anonymous_persona_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_anonymous_persona_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_bu_id_seq INCREMENT BY 1 MINVALUE 1 START 2');
        $this->addSql('CREATE SEQUENCE app_bu_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 2');
        $this->addSql('CREATE SEQUENCE app_individual_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_individual_persona_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_individual_persona_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_organization_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_organization_persona_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_organization_persona_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_role_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_staff_id_seq INCREMENT BY 1 MINVALUE 1 START 2');
        $this->addSql('CREATE SEQUENCE app_staff_persona_id_seq INCREMENT BY 1 MINVALUE 1 START 2');
        $this->addSql('CREATE SEQUENCE app_staff_persona_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 2');
        $this->addSql('CREATE SEQUENCE app_system_id_seq INCREMENT BY 1 MINVALUE 1 START 2');
        $this->addSql('CREATE TABLE ds_config (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, value JSON DEFAULT NULL, enabled BOOLEAN NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F4D17F50A6 ON ds_config (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F48A90ABA94E59C462 ON ds_config (key, tenant)');
        $this->addSql('CREATE TABLE ds_parameter (id INT NOT NULL, "key" VARCHAR(255) NOT NULL, value JSON DEFAULT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3C0FD91F48571EB ON ds_parameter ("key")');
        $this->addSql('CREATE TABLE ds_access (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, assignee VARCHAR(255) DEFAULT NULL, assignee_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A76F41DCD17F50A6 ON ds_access (uuid)');
        $this->addSql('CREATE TABLE ds_access_permission (id INT NOT NULL, access_id INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, entity_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, attributes JSON NOT NULL, tenant UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D46DD4D04FEA67CF ON ds_access_permission (access_id)');
        $this->addSql('CREATE TABLE ds_tenant (id INT NOT NULL, uuid UUID NOT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF5FAEEAD17F50A6 ON ds_tenant (uuid)');
        $this->addSql('CREATE TABLE app_anonymous (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A5EB29BD17F50A6 ON app_anonymous (uuid)');
        $this->addSql('CREATE TABLE app_anonymous_role (anonymous_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(anonymous_id, role_id))');
        $this->addSql('CREATE INDEX IDX_E2D1EAF6FA93803 ON app_anonymous_role (anonymous_id)');
        $this->addSql('CREATE INDEX IDX_E2D1EAF6D60322AC ON app_anonymous_role (role_id)');
        $this->addSql('CREATE TABLE app_anonymous_persona (id INT NOT NULL, anonymous_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5ABA7A3D17F50A6 ON app_anonymous_persona (uuid)');
        $this->addSql('CREATE INDEX IDX_5ABA7A3FA93803 ON app_anonymous_persona (anonymous_id)');
        $this->addSql('CREATE TABLE app_anonymous_persona_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B378E082C2AC5D3 ON app_anonymous_persona_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_anonymous_persona_trans_unique_translation ON app_anonymous_persona_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_bu (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F0C3D814D17F50A6 ON app_bu (uuid)');
        $this->addSql('CREATE TABLE app_bu_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AE7B40C2C2AC5D3 ON app_bu_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_bu_trans_unique_translation ON app_bu_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_individual (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D188576BD17F50A6 ON app_individual (uuid)');
        $this->addSql('CREATE TABLE app_individual_role (individual_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(individual_id, role_id))');
        $this->addSql('CREATE INDEX IDX_C5713550AE271C0D ON app_individual_role (individual_id)');
        $this->addSql('CREATE INDEX IDX_C5713550D60322AC ON app_individual_role (role_id)');
        $this->addSql('CREATE TABLE app_individual_persona (id INT NOT NULL, individual_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_828FC6ED17F50A6 ON app_individual_persona (uuid)');
        $this->addSql('CREATE INDEX IDX_828FC6EAE271C0D ON app_individual_persona (individual_id)');
        $this->addSql('CREATE TABLE app_individual_persona_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2EB6F73E2C2AC5D3 ON app_individual_persona_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_individual_persona_trans_unique_translation ON app_individual_persona_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_organization (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_36079FDD17F50A6 ON app_organization (uuid)');
        $this->addSql('CREATE TABLE app_organization_role (organization_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(organization_id, role_id))');
        $this->addSql('CREATE INDEX IDX_CF25196832C8A3DE ON app_organization_role (organization_id)');
        $this->addSql('CREATE INDEX IDX_CF251968D60322AC ON app_organization_role (role_id)');
        $this->addSql('CREATE TABLE app_organization_persona (id INT NOT NULL, organization_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7767B60FD17F50A6 ON app_organization_persona (uuid)');
        $this->addSql('CREATE INDEX IDX_7767B60F32C8A3DE ON app_organization_persona (organization_id)');
        $this->addSql('CREATE TABLE app_organization_persona_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_63870C2F2C2AC5D3 ON app_organization_persona_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_organization_persona_trans_unique_translation ON app_organization_persona_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_role (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, permissions JSON NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5247AFCAD17F50A6 ON app_role (uuid)');
        $this->addSql('CREATE TABLE app_role_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D1E65DEE2C2AC5D3 ON app_role_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_role_trans_unique_translation ON app_role_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_staff (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_94BD7E5FD17F50A6 ON app_staff (uuid)');
        $this->addSql('CREATE TABLE app_staff_role (staff_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(staff_id, role_id))');
        $this->addSql('CREATE INDEX IDX_E3445799D4D57CD ON app_staff_role (staff_id)');
        $this->addSql('CREATE INDEX IDX_E3445799D60322AC ON app_staff_role (role_id)');
        $this->addSql('CREATE TABLE app_staff_bu (staff_id INT NOT NULL, bu_id INT NOT NULL, PRIMARY KEY(staff_id, bu_id))');
        $this->addSql('CREATE INDEX IDX_8C89CE59D4D57CD ON app_staff_bu (staff_id)');
        $this->addSql('CREATE INDEX IDX_8C89CE59E0319FBC ON app_staff_bu (bu_id)');
        $this->addSql('CREATE TABLE app_staff_persona (id INT NOT NULL, staff_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_972E9C81D17F50A6 ON app_staff_persona (uuid)');
        $this->addSql('CREATE INDEX IDX_972E9C81D4D57CD ON app_staff_persona (staff_id)');
        $this->addSql('CREATE TABLE app_staff_persona_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_83B289352C2AC5D3 ON app_staff_persona_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_staff_persona_trans_unique_translation ON app_staff_persona_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_system (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2C4E7C0BD17F50A6 ON app_system (uuid)');
        $this->addSql('CREATE TABLE app_system_role (system_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(system_id, role_id))');
        $this->addSql('CREATE INDEX IDX_1F401F20D0952FA5 ON app_system_role (system_id)');
        $this->addSql('CREATE INDEX IDX_1F401F20D60322AC ON app_system_role (role_id)');
        $this->addSql('ALTER TABLE ds_access_permission ADD CONSTRAINT FK_D46DD4D04FEA67CF FOREIGN KEY (access_id) REFERENCES ds_access (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_anonymous_role ADD CONSTRAINT FK_E2D1EAF6FA93803 FOREIGN KEY (anonymous_id) REFERENCES app_anonymous (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_anonymous_role ADD CONSTRAINT FK_E2D1EAF6D60322AC FOREIGN KEY (role_id) REFERENCES app_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_anonymous_persona ADD CONSTRAINT FK_5ABA7A3FA93803 FOREIGN KEY (anonymous_id) REFERENCES app_anonymous (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_anonymous_persona_trans ADD CONSTRAINT FK_3B378E082C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_anonymous_persona (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_bu_trans ADD CONSTRAINT FK_AE7B40C2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_bu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_individual_role ADD CONSTRAINT FK_C5713550AE271C0D FOREIGN KEY (individual_id) REFERENCES app_individual (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_individual_role ADD CONSTRAINT FK_C5713550D60322AC FOREIGN KEY (role_id) REFERENCES app_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_individual_persona ADD CONSTRAINT FK_828FC6EAE271C0D FOREIGN KEY (individual_id) REFERENCES app_individual (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_individual_persona_trans ADD CONSTRAINT FK_2EB6F73E2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_individual_persona (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_organization_role ADD CONSTRAINT FK_CF25196832C8A3DE FOREIGN KEY (organization_id) REFERENCES app_organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_organization_role ADD CONSTRAINT FK_CF251968D60322AC FOREIGN KEY (role_id) REFERENCES app_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_organization_persona ADD CONSTRAINT FK_7767B60F32C8A3DE FOREIGN KEY (organization_id) REFERENCES app_organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_organization_persona_trans ADD CONSTRAINT FK_63870C2F2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_organization_persona (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_role_trans ADD CONSTRAINT FK_D1E65DEE2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_role ADD CONSTRAINT FK_E3445799D4D57CD FOREIGN KEY (staff_id) REFERENCES app_staff (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_role ADD CONSTRAINT FK_E3445799D60322AC FOREIGN KEY (role_id) REFERENCES app_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_bu ADD CONSTRAINT FK_8C89CE59D4D57CD FOREIGN KEY (staff_id) REFERENCES app_staff (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_bu ADD CONSTRAINT FK_8C89CE59E0319FBC FOREIGN KEY (bu_id) REFERENCES app_bu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_persona ADD CONSTRAINT FK_972E9C81D4D57CD FOREIGN KEY (staff_id) REFERENCES app_staff (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_persona_trans ADD CONSTRAINT FK_83B289352C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_staff_persona (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_system_role ADD CONSTRAINT FK_1F401F20D0952FA5 FOREIGN KEY (system_id) REFERENCES app_system (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_system_role ADD CONSTRAINT FK_1F401F20D60322AC FOREIGN KEY (role_id) REFERENCES app_role (id) NOT DEFERRABLE INITIALLY IMMEDIATE');

        // Custom schema
        $this->addSql('CREATE TABLE ds_session (id VARCHAR(128) NOT NULL PRIMARY KEY, data BYTEA NOT NULL, time INTEGER NOT NULL, lifetime INTEGER NOT NULL)');

        // Data
        $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/migrations/1_0_0.yml');
        $data = Yaml::parse($yml);

        $this->addSql('
            INSERT INTO 
                ds_parameter (id, key, value, enabled)
            VALUES 
                (1, \'ds_system.user.username\', \'"'.$data['system']['username'].'"\', true),
                (2, \'ds_system.user.password\', \'"'.$data['system']['password'].'"\', true),
                (3, \'ds_tenant.tenant.default\', \'"'.$data['tenant']['uuid'].'"\', true);
        ');

        $this->addSql('
            INSERT INTO 
                ds_tenant (id, uuid, data, created_at, updated_at)
            VALUES 
                (1, \''.$data['tenant']['uuid'].'\', \'{}\', now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_config (id, uuid, owner, owner_uuid, key, value, enabled, version, tenant, created_at, updated_at)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.username\', \'"'.$data['user']['system']['username'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.password\', \'"'.$data['user']['system']['password'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (3, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.uuid\', \'"'.$data['user']['system']['uuid'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (4, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.roles\', \'[]\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (5, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity.roles\', \'[]\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (6, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity.type\', \'"System"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (7, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity.uuid\', \'"'.$data['identity']['system']['uuid'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (8, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.tenant\', \'"'.$data['tenant']['uuid'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_access (id, uuid, owner, owner_uuid, assignee, assignee_uuid, version, tenant, created_at, updated_at)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'System\', \''.$data['identity']['system']['uuid'].'\', \'System\', \''.$data['identity']['system']['uuid'].'\', 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', \''.$data['identity']['admin']['uuid'].'\', 1, \''.$data['tenant']['uuid'].'\', now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_access_permission (id, access_id, scope, entity, entity_uuid, key, attributes, tenant)
            VALUES 
                (1, 1, \'generic\', NULL, NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\', \''.$data['tenant']['uuid'].'\'),
                (2, 1, \'generic\', NULL, NULL, \'property\', \'["BROWSE","READ","EDIT"]\', \''.$data['tenant']['uuid'].'\'),
                (3, 1, \'generic\', NULL, NULL, \'generic\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\', \''.$data['tenant']['uuid'].'\'),
                (4, 2, \'generic\', NULL, NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\', \''.$data['tenant']['uuid'].'\'),
                (5, 2, \'generic\', NULL, NULL, \'property\', \'["BROWSE","READ","EDIT"]\', \''.$data['tenant']['uuid'].'\'),
                (6, 2, \'generic\', NULL, NULL, \'generic\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\', \''.$data['tenant']['uuid'].'\');
        ');

        $this->addSql('
            INSERT INTO 
                app_bu (id, uuid, owner, owner_uuid, version, tenant, created_at, updated_at, deleted_at)
            VALUES 
                (1, \''.$data['business_unit']['administration']['uuid'].'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', 1, \''.$data['tenant']['uuid'].'\', now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                app_bu_trans (id, translatable_id, title, locale)
            VALUES 
                (1, 1, \'Administration\', \'en\');
        ');

        $this->addSql('
            INSERT INTO 
                app_system (id, uuid, owner, owner_uuid, version, tenant, created_at, updated_at, deleted_at)
            VALUES 
                (1, \''.$data['identity']['system']['uuid'].'\', \'System\', \''.$data['identity']['system']['uuid'].'\', 1, \''.$data['tenant']['uuid'].'\', now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                app_staff (id, uuid, owner, owner_uuid, version, tenant, created_at, updated_at, deleted_at)
            VALUES 
                (1, \''.$data['identity']['admin']['uuid'].'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', 1, \''.$data['tenant']['uuid'].'\', now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                app_staff_persona (id, staff_id, uuid, owner, owner_uuid, data, version, tenant, created_at, updated_at, deleted_at)
            VALUES 
                (1, 1, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'{}\', 1, \''.$data['tenant']['uuid'].'\', now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                app_staff_persona_trans (id, translatable_id, title, locale)
            VALUES 
                (1, 1, \'Default\', \'en\');
        ');
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        // Entity schema
        $this->addSql('ALTER TABLE ds_access_permission DROP CONSTRAINT FK_D46DD4D04FEA67CF');
        $this->addSql('ALTER TABLE app_anonymous_role DROP CONSTRAINT FK_E2D1EAF6FA93803');
        $this->addSql('ALTER TABLE app_anonymous_persona DROP CONSTRAINT FK_5ABA7A3FA93803');
        $this->addSql('ALTER TABLE app_anonymous_persona_trans DROP CONSTRAINT FK_3B378E082C2AC5D3');
        $this->addSql('ALTER TABLE app_bu_trans DROP CONSTRAINT FK_AE7B40C2C2AC5D3');
        $this->addSql('ALTER TABLE app_staff_bu DROP CONSTRAINT FK_8C89CE59E0319FBC');
        $this->addSql('ALTER TABLE app_individual_role DROP CONSTRAINT FK_C5713550AE271C0D');
        $this->addSql('ALTER TABLE app_individual_persona DROP CONSTRAINT FK_828FC6EAE271C0D');
        $this->addSql('ALTER TABLE app_individual_persona_trans DROP CONSTRAINT FK_2EB6F73E2C2AC5D3');
        $this->addSql('ALTER TABLE app_organization_role DROP CONSTRAINT FK_CF25196832C8A3DE');
        $this->addSql('ALTER TABLE app_organization_persona DROP CONSTRAINT FK_7767B60F32C8A3DE');
        $this->addSql('ALTER TABLE app_organization_persona_trans DROP CONSTRAINT FK_63870C2F2C2AC5D3');
        $this->addSql('ALTER TABLE app_anonymous_role DROP CONSTRAINT FK_E2D1EAF6D60322AC');
        $this->addSql('ALTER TABLE app_individual_role DROP CONSTRAINT FK_C5713550D60322AC');
        $this->addSql('ALTER TABLE app_organization_role DROP CONSTRAINT FK_CF251968D60322AC');
        $this->addSql('ALTER TABLE app_role_trans DROP CONSTRAINT FK_D1E65DEE2C2AC5D3');
        $this->addSql('ALTER TABLE app_staff_role DROP CONSTRAINT FK_E3445799D60322AC');
        $this->addSql('ALTER TABLE app_system_role DROP CONSTRAINT FK_1F401F20D60322AC');
        $this->addSql('ALTER TABLE app_staff_role DROP CONSTRAINT FK_E3445799D4D57CD');
        $this->addSql('ALTER TABLE app_staff_bu DROP CONSTRAINT FK_8C89CE59D4D57CD');
        $this->addSql('ALTER TABLE app_staff_persona DROP CONSTRAINT FK_972E9C81D4D57CD');
        $this->addSql('ALTER TABLE app_staff_persona_trans DROP CONSTRAINT FK_83B289352C2AC5D3');
        $this->addSql('ALTER TABLE app_system_role DROP CONSTRAINT FK_1F401F20D0952FA5');
        $this->addSql('DROP SEQUENCE ds_config_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_parameter_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_access_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_access_permission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_tenant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_anonymous_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_anonymous_persona_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_anonymous_persona_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_bu_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_bu_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_individual_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_individual_persona_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_individual_persona_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_organization_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_organization_persona_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_organization_persona_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_role_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_role_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_staff_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_staff_persona_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_staff_persona_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_system_id_seq CASCADE');
        $this->addSql('DROP TABLE ds_config');
        $this->addSql('DROP TABLE ds_parameter');
        $this->addSql('DROP TABLE ds_access');
        $this->addSql('DROP TABLE ds_access_permission');
        $this->addSql('DROP TABLE ds_tenant');
        $this->addSql('DROP TABLE app_anonymous');
        $this->addSql('DROP TABLE app_anonymous_role');
        $this->addSql('DROP TABLE app_anonymous_persona');
        $this->addSql('DROP TABLE app_anonymous_persona_trans');
        $this->addSql('DROP TABLE app_bu');
        $this->addSql('DROP TABLE app_bu_trans');
        $this->addSql('DROP TABLE app_individual');
        $this->addSql('DROP TABLE app_individual_role');
        $this->addSql('DROP TABLE app_individual_persona');
        $this->addSql('DROP TABLE app_individual_persona_trans');
        $this->addSql('DROP TABLE app_organization');
        $this->addSql('DROP TABLE app_organization_role');
        $this->addSql('DROP TABLE app_organization_persona');
        $this->addSql('DROP TABLE app_organization_persona_trans');
        $this->addSql('DROP TABLE app_role');
        $this->addSql('DROP TABLE app_role_trans');
        $this->addSql('DROP TABLE app_staff');
        $this->addSql('DROP TABLE app_staff_role');
        $this->addSql('DROP TABLE app_staff_bu');
        $this->addSql('DROP TABLE app_staff_persona');
        $this->addSql('DROP TABLE app_staff_persona_trans');
        $this->addSql('DROP TABLE app_system');
        $this->addSql('DROP TABLE app_system_role');

        // Custom schema
        $this->addSql('DROP TABLE ds_session');
    }
}
