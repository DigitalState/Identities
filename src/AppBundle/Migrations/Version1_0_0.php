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
        $this->addSql('CREATE TABLE ds_config (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, `value` LONGTEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_758C45F4D17F50A6 (uuid), UNIQUE INDEX UNIQ_758C45F44E645A7E (`key`), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_permission (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', user_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_7A6F7670D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_permission_entry (id INT AUTO_INCREMENT NOT NULL, permission_id INT DEFAULT NULL, business_unit_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, attributes LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', INDEX IDX_E68A6391FED90CCA (permission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_admin (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_5EDD80BBD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_anonymous (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_6A5EB29BD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_anonymous_persona (id INT AUTO_INCREMENT NOT NULL, anonymous_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_5ABA7A3D17F50A6 (uuid), INDEX IDX_5ABA7A3FA93803 (anonymous_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_anonymous_persona_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_3B378E082C2AC5D3 (translatable_id), UNIQUE INDEX app_anonymous_persona_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_bu (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_F0C3D814D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_bu_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_AE7B40C2C2AC5D3 (translatable_id), UNIQUE INDEX app_bu_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_individual (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D188576BD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_individual_persona (id INT AUTO_INCREMENT NOT NULL, individual_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_828FC6ED17F50A6 (uuid), INDEX IDX_828FC6EAE271C0D (individual_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_individual_persona_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_2EB6F73E2C2AC5D3 (translatable_id), UNIQUE INDEX app_individual_persona_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_staff (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_94BD7E5FD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_staff_persona (id INT AUTO_INCREMENT NOT NULL, staff_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_972E9C81D17F50A6 (uuid), INDEX IDX_972E9C81D4D57CD (staff_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_staff_persona_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_83B289352C2AC5D3 (translatable_id), UNIQUE INDEX app_staff_persona_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_system (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_2C4E7C0BD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        // Foreign keys
        $this->addSql('ALTER TABLE ds_permission_entry ADD CONSTRAINT FK_E68A6391FED90CCA FOREIGN KEY (permission_id) REFERENCES ds_permission (id)');
        $this->addSql('ALTER TABLE app_anonymous_persona ADD CONSTRAINT FK_5ABA7A3FA93803 FOREIGN KEY (anonymous_id) REFERENCES app_anonymous (id)');
        $this->addSql('ALTER TABLE app_anonymous_persona_trans ADD CONSTRAINT FK_3B378E082C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_anonymous_persona (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_bu_trans ADD CONSTRAINT FK_AE7B40C2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_bu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_individual_persona ADD CONSTRAINT FK_828FC6EAE271C0D FOREIGN KEY (individual_id) REFERENCES app_individual (id)');
        $this->addSql('ALTER TABLE app_individual_persona_trans ADD CONSTRAINT FK_2EB6F73E2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_individual_persona (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_staff_persona ADD CONSTRAINT FK_972E9C81D4D57CD FOREIGN KEY (staff_id) REFERENCES app_staff (id)');
        $this->addSql('ALTER TABLE app_staff_persona_trans ADD CONSTRAINT FK_83B289352C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_staff_persona (id) ON DELETE CASCADE');

        // Data
        // 1 - Administration
        // 2 - Public
        $this->addSql('
            INSERT INTO 
                `app_bu` (`id`, `uuid`, `owner`, `owner_uuid`, `version`, `created_at`, `updated_at`, `deleted_at`)
            VALUES 
                (1, \'ed1fe135-b791-4b8d-a033-acab9daa9853\', \'Admin\', \'59717ce0-5a37-46d8-ad80-66d5b22d2ccf\', 1, now(), now(), NULL),
                (2, \'194671e9-12aa-41df-8feb-1ba45e4a71e6\', \'BusinessUnit\', \'ed1fe135-b791-4b8d-a033-acab9daa9853\', 1, now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                `app_admin` (`id`, `uuid`, `owner`, `owner_uuid`, `version`, `created_at`, `updated_at`, `deleted_at`)
            VALUES 
                (1, \'59717ce0-5a37-46d8-ad80-66d5b22d2ccf\', \'Admin\', \'59717ce0-5a37-46d8-ad80-66d5b22d2ccf\', 1, now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                `app_system` (`id`, `uuid`, `owner`, `owner_uuid`, `version`, `created_at`, `updated_at`, `deleted_at`)
            VALUES 
                (1, \'bd654051-6a03-488a-a771-bb3bfc646a9f\', \'System\', \'bd654051-6a03-488a-a771-bb3bfc646a9f\', 1, now(), now(), NULL);
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
        $this->addSql('ALTER TABLE ds_permission_entry DROP FOREIGN KEY FK_E68A6391FED90CCA');
        $this->addSql('ALTER TABLE app_anonymous_persona DROP FOREIGN KEY FK_5ABA7A3FA93803');
        $this->addSql('ALTER TABLE app_anonymous_persona_trans DROP FOREIGN KEY FK_3B378E082C2AC5D3');
        $this->addSql('ALTER TABLE app_bu_trans DROP FOREIGN KEY FK_AE7B40C2C2AC5D3');
        $this->addSql('ALTER TABLE app_individual_persona DROP FOREIGN KEY FK_828FC6EAE271C0D');
        $this->addSql('ALTER TABLE app_individual_persona_trans DROP FOREIGN KEY FK_2EB6F73E2C2AC5D3');
        $this->addSql('ALTER TABLE app_staff_persona DROP FOREIGN KEY FK_972E9C81D4D57CD');
        $this->addSql('ALTER TABLE app_staff_persona_trans DROP FOREIGN KEY FK_83B289352C2AC5D3');

        // Tables
        $this->addSql('DROP TABLE ds_config');
        $this->addSql('DROP TABLE ds_permission');
        $this->addSql('DROP TABLE ds_permission_entry');
        $this->addSql('DROP TABLE app_admin');
        $this->addSql('DROP TABLE app_anonymous');
        $this->addSql('DROP TABLE app_anonymous_persona');
        $this->addSql('DROP TABLE app_anonymous_persona_trans');
        $this->addSql('DROP TABLE app_bu');
        $this->addSql('DROP TABLE app_bu_trans');
        $this->addSql('DROP TABLE app_individual');
        $this->addSql('DROP TABLE app_individual_persona');
        $this->addSql('DROP TABLE app_individual_persona_trans');
        $this->addSql('DROP TABLE app_staff');
        $this->addSql('DROP TABLE app_staff_persona');
        $this->addSql('DROP TABLE app_staff_persona_trans');
        $this->addSql('DROP TABLE app_system');
    }
}
