<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

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
        // Tables
        $this->addSql('CREATE TABLE ds_session (id VARCHAR(128) NOT NULL PRIMARY KEY, `data` BLOB NOT NULL, `time` INTEGER UNSIGNED NOT NULL, lifetime MEDIUMINT NOT NULL) COLLATE utf8_bin, engine = innodb');
        $this->addSql('CREATE TABLE ds_config (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, `value` LONGTEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_758C45F4D17F50A6 (uuid), UNIQUE INDEX UNIQ_758C45F44E645A7E (`key`), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_access (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_A76F41DCD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_access_permission (id INT AUTO_INCREMENT NOT NULL, access_id INT DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, entity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, attributes LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', INDEX IDX_D46DD4D04FEA67CF (access_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_anonymous (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_6A5EB29BD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_anonymous_persona (id INT AUTO_INCREMENT NOT NULL, anonymous_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_5ABA7A3D17F50A6 (uuid), INDEX IDX_5ABA7A3FA93803 (anonymous_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_anonymous_persona_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_3B378E082C2AC5D3 (translatable_id), UNIQUE INDEX app_anonymous_persona_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_bu (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_F0C3D814D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_bu_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_AE7B40C2C2AC5D3 (translatable_id), UNIQUE INDEX app_bu_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_individual (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D188576BD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_individual_persona (id INT AUTO_INCREMENT NOT NULL, individual_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_828FC6ED17F50A6 (uuid), INDEX IDX_828FC6EAE271C0D (individual_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_individual_persona_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_2EB6F73E2C2AC5D3 (translatable_id), UNIQUE INDEX app_individual_persona_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_organization (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_36079FDD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_organization_persona (id INT AUTO_INCREMENT NOT NULL, organization_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_7767B60FD17F50A6 (uuid), INDEX IDX_7767B60F32C8A3DE (organization_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_organization_persona_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_63870C2F2C2AC5D3 (translatable_id), UNIQUE INDEX app_organization_persona_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_staff (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_94BD7E5FD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_staff_bu (staff_id INT NOT NULL, bu_id INT NOT NULL, INDEX IDX_8C89CE59D4D57CD (staff_id), INDEX IDX_8C89CE59E0319FBC (bu_id), PRIMARY KEY(staff_id, bu_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_staff_persona (id INT AUTO_INCREMENT NOT NULL, staff_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_972E9C81D17F50A6 (uuid), INDEX IDX_972E9C81D4D57CD (staff_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_staff_persona_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_83B289352C2AC5D3 (translatable_id), UNIQUE INDEX app_staff_persona_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_system (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_2C4E7C0BD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        // Foreign keys
        $this->addSql('ALTER TABLE ds_access_permission ADD CONSTRAINT FK_D46DD4D04FEA67CF FOREIGN KEY (access_id) REFERENCES ds_access (id)');
        $this->addSql('ALTER TABLE app_anonymous_persona ADD CONSTRAINT FK_5ABA7A3FA93803 FOREIGN KEY (anonymous_id) REFERENCES app_anonymous (id)');
        $this->addSql('ALTER TABLE app_anonymous_persona_trans ADD CONSTRAINT FK_3B378E082C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_anonymous_persona (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_bu_trans ADD CONSTRAINT FK_AE7B40C2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_bu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_individual_persona ADD CONSTRAINT FK_828FC6EAE271C0D FOREIGN KEY (individual_id) REFERENCES app_individual (id)');
        $this->addSql('ALTER TABLE app_individual_persona_trans ADD CONSTRAINT FK_2EB6F73E2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_individual_persona (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_organization_persona ADD CONSTRAINT FK_7767B60F32C8A3DE FOREIGN KEY (organization_id) REFERENCES app_organization (id)');
        $this->addSql('ALTER TABLE app_organization_persona_trans ADD CONSTRAINT FK_63870C2F2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_organization_persona (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_staff_bu ADD CONSTRAINT FK_8C89CE59D4D57CD FOREIGN KEY (staff_id) REFERENCES app_staff (id)');
        $this->addSql('ALTER TABLE app_staff_bu ADD CONSTRAINT FK_8C89CE59E0319FBC FOREIGN KEY (bu_id) REFERENCES app_bu (id)');
        $this->addSql('ALTER TABLE app_staff_persona ADD CONSTRAINT FK_972E9C81D4D57CD FOREIGN KEY (staff_id) REFERENCES app_staff (id)');
        $this->addSql('ALTER TABLE app_staff_persona_trans ADD CONSTRAINT FK_83B289352C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_staff_persona (id) ON DELETE CASCADE');

        // Data
        $this->addSql('
            INSERT INTO 
                `app_bu` (`id`, `uuid`, `owner`, `owner_uuid`, `version`, `created_at`, `updated_at`, `deleted_at`)
            VALUES 
                (1, \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', 1, now(), now(), NULL),
                (2, \'447a62c0-7043-41f7-8540-d57aa15070de\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', 1, now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                `app_bu_trans` (`id`, `translatable_id`, `title`, `created_at`, `updated_at`, `deleted_at`, `locale`)
            VALUES 
                (1, 1, \'Administration\', now(), now(), NULL, \'en\'),
                (2, 1, \'Administration\', now(), now(), NULL, \'fr\'),
                (3, 2, \'Portal\', now(), now(), NULL, \'en\'),
                (4, 2, \'Portail\', now(), now(), NULL, \'fr\');
        ');

        $this->addSql('
            INSERT INTO 
                `app_system` (`id`, `uuid`, `owner`, `owner_uuid`, `version`, `created_at`, `updated_at`, `deleted_at`)
            VALUES 
                (1, \'df5fd904-aa47-452f-9c4a-d6b52fe5ace4\', \'System\', \'df5fd904-aa47-452f-9c4a-d6b52fe5ace4\', 1, now(), now(), NULL),
                (2, \'7b59586d-6924-47f3-bc1b-0dc207f5e80c\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', 1, now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                `app_anonymous` (`id`, `uuid`, `owner`, `owner_uuid`, `version`, `created_at`, `updated_at`, `deleted_at`)
            VALUES 
                (1, \'a21e1b48-a4d6-4227-8fa0-9b43f29ca990\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', 1, now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                `ds_config` (`id`, `uuid`, `owner`, `owner_uuid`, `key`, `value`, `enabled`, `version`, `created_at`, `updated_at`)
            VALUES 
                (1, \'6cfe982d-6201-437f-a510-8d018738f6e4\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.username\', \'system@ds\', 1, 1, now(), now()),
                (2, \'022a5d20-8296-431f-bfae-a8b3b9171983\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.uuid\', \'b496655f-8fe6-4340-9a77-1bc3eeabab53\', 1, 1, now(), now()),
                (3, \'50dedeec-a9c7-4f53-b9f8-0a5ece814386\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.roles\', \'ROLE_SYSTEM\', 1, 1, now(), now()),
                (4, \'57591774-a6d0-4bd0-a8c6-df15ac5464a5\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.identity\', \'System\', 1, 1, now(), now()),
                (5, \'57bd1518-de1e-42dc-969a-ecf0ebe5c31d\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.user.identity_uuid\', \'df5fd904-aa47-452f-9c4a-d6b52fe5ace4\', 1, 1, now(), now()),
                (6, \'7e311479-4beb-4b08-a239-8af425661df1\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.authentication.host\', \'http://api.authentication.ds\', 1, 1, now(), now()),
                (7, \'c9b4c5e3-591b-4432-955f-faf190c1f876\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.identities.host\', \'http://api.identities.ds\', 1, 1, now(), now()),
                (8, \'1053bd87-e875-4e5f-b8fe-3168d1d2d643\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.cases.host\', \'http://api.cases.ds\', 1, 1, now(), now()),
                (9, \'deb2b282-2692-441c-8425-3391088bfe8e\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.services.host\', \'http://api.services.ds\', 1, 1, now(), now()),
                (10, \'5e796c47-9598-4822-9c97-7c3d912a68e1\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.records.host\', \'http://api.records.ds\', 1, 1, now(), now()),
                (11, \'4717c3a7-d271-4553-bd81-1e36a57cc4f4\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.assets.host\', \'http://api.assets.ds\', 1, 1, now(), now()),
                (12, \'a166498c-41b6-47a9-b70b-57afcc790c38\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.cms.host\', \'http://api.cms.ds\', 1, 1, now(), now()),
                (13, \'30ad15dc-868f-48d3-a364-5bd99fb88d70\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.camunda.host\', \'http://api.camunda.ds/engine-rest\', 1, 1, now(), now()),
                (14, \'f18ca8a6-f678-43a7-bf78-6b618ac50a14\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'ds_api.api.formio.host\', \'http://api.formio.ds\', 1, 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                `ds_access` (`id`, `uuid`, `owner`, `owner_uuid`, `identity`, `identity_uuid`, `version`, `created_at`, `updated_at`)
            VALUES 
                (1, \'488ebf9b-6999-4ca6-9537-1d203222fc09\', \'System\', \'df5fd904-aa47-452f-9c4a-d6b52fe5ace4\', \'System\', \'df5fd904-aa47-452f-9c4a-d6b52fe5ace4\', 1, now(), now()),
                (2, \'d012266b-2b14-4401-9265-4efdefd91acc\', \'BusinessUnit\', \'df5fd904-aa47-452f-9c4a-d6b52fe5ace4\', \'System\', \'7b59586d-6924-47f3-bc1b-0dc207f5e80c\', 1, now(), now()),
                (3, \'a34d968b-9d27-41f5-9313-ad2641125208\', \'BusinessUnit\', \'11bec012-a73f-45c1-8d2e-53502fa58c23\', \'Individual\', NULL, 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                `ds_access_permission` (`id`, `access_id`, `entity`, `entity_uuid`, `key`, `attributes`)
            VALUES 
                (1, 1, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (2, 1, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (3, 1, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\'),
                (4, 2, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (5, 2, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (6, 2, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\'),
                (7, 3, \'BusinessUnit\', \'447a62c0-7043-41f7-8540-d57aa15070de\', \'individual\', \'["BROWSE","READ"]\'),
                (8, 3, \'BusinessUnit\', \'447a62c0-7043-41f7-8540-d57aa15070de\', \'individual_uuid\', \'["BROWSE","READ"]\'),
                (9, 3, \'BusinessUnit\', \'447a62c0-7043-41f7-8540-d57aa15070de\', \'individual_persona\', \'["BROWSE","READ"]\'),
                (10, 3, \'BusinessUnit\', \'447a62c0-7043-41f7-8540-d57aa15070de\', \'individual_persona_uuid\', \'["BROWSE","READ"]\'),
                (11, 3, \'BusinessUnit\', \'447a62c0-7043-41f7-8540-d57aa15070de\', \'individual_persona_title\', \'["BROWSE","READ"]\'),
                (12, 3, \'BusinessUnit\', \'447a62c0-7043-41f7-8540-d57aa15070de\', \'individual_persona_data\', \'["BROWSE","READ"]\'),
                (13, 3, \'BusinessUnit\', \'447a62c0-7043-41f7-8540-d57aa15070de\', \'individual_persona_version\', \'["BROWSE","READ"]\'),
                (14, 3, \'BusinessUnit\', \'447a62c0-7043-41f7-8540-d57aa15070de\', \'individual_persona\', \'["EDIT"]\'),
                (15, 3, \'BusinessUnit\', \'447a62c0-7043-41f7-8540-d57aa15070de\', \'individual_persona_title\', \'["EDIT"]\'),
                (16, 3, \'BusinessUnit\', \'447a62c0-7043-41f7-8540-d57aa15070de\', \'individual_persona_data\', \'["EDIT"]\'),
                (17, 3, \'BusinessUnit\', \'447a62c0-7043-41f7-8540-d57aa15070de\', \'individual_persona_version\', \'["EDIT"]\');
        ');
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        // Foreign keys
        $this->addSql('ALTER TABLE ds_access_permission DROP FOREIGN KEY FK_D46DD4D04FEA67CF');
        $this->addSql('ALTER TABLE app_anonymous_persona DROP FOREIGN KEY FK_5ABA7A3FA93803');
        $this->addSql('ALTER TABLE app_anonymous_persona_trans DROP FOREIGN KEY FK_3B378E082C2AC5D3');
        $this->addSql('ALTER TABLE app_bu_trans DROP FOREIGN KEY FK_AE7B40C2C2AC5D3');
        $this->addSql('ALTER TABLE app_staff_bu DROP FOREIGN KEY FK_8C89CE59E0319FBC');
        $this->addSql('ALTER TABLE app_individual_persona DROP FOREIGN KEY FK_828FC6EAE271C0D');
        $this->addSql('ALTER TABLE app_individual_persona_trans DROP FOREIGN KEY FK_2EB6F73E2C2AC5D3');
        $this->addSql('ALTER TABLE app_organization_persona DROP FOREIGN KEY FK_7767B60F32C8A3DE');
        $this->addSql('ALTER TABLE app_organization_persona_trans DROP FOREIGN KEY FK_63870C2F2C2AC5D3');
        $this->addSql('ALTER TABLE app_staff_bu DROP FOREIGN KEY FK_8C89CE59D4D57CD');
        $this->addSql('ALTER TABLE app_staff_persona DROP FOREIGN KEY FK_972E9C81D4D57CD');
        $this->addSql('ALTER TABLE app_staff_persona_trans DROP FOREIGN KEY FK_83B289352C2AC5D3');

        // Tables
        $this->addSql('DROP TABLE ds_config');
        $this->addSql('DROP TABLE ds_access');
        $this->addSql('DROP TABLE ds_access_permission');
        $this->addSql('DROP TABLE app_anonymous');
        $this->addSql('DROP TABLE app_anonymous_persona');
        $this->addSql('DROP TABLE app_anonymous_persona_trans');
        $this->addSql('DROP TABLE app_bu');
        $this->addSql('DROP TABLE app_bu_trans');
        $this->addSql('DROP TABLE app_individual');
        $this->addSql('DROP TABLE app_individual_persona');
        $this->addSql('DROP TABLE app_individual_persona_trans');
        $this->addSql('DROP TABLE app_organization');
        $this->addSql('DROP TABLE app_organization_persona');
        $this->addSql('DROP TABLE app_organization_persona_trans');
        $this->addSql('DROP TABLE app_staff');
        $this->addSql('DROP TABLE app_staff_bu');
        $this->addSql('DROP TABLE app_staff_persona');
        $this->addSql('DROP TABLE app_staff_persona_trans');
        $this->addSql('DROP TABLE app_system');
        $this->addSql('DROP TABLE ds_session');
    }
}
