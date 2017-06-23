<?php

namespace Migrations;

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
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ds_permission (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', user_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_7A6F7670D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_permission_entry (id INT AUTO_INCREMENT NOT NULL, permission_id INT DEFAULT NULL, business_unit_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, attributes LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', INDEX IDX_E68A6391FED90CCA (permission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_bu (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_C35ECCF9D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_bu_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_BED414D52C2AC5D3 (translatable_id), UNIQUE INDEX ds_bu_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_staff (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_95970533D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_staff_persona (id INT AUTO_INCREMENT NOT NULL, staff_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_6552A244D17F50A6 (uuid), INDEX IDX_6552A244D4D57CD (staff_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_staff_persona_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_4B2FB84F2C2AC5D3 (translatable_id), UNIQUE INDEX ds_staff_persona_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_individual (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1DB518CDD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_individual_persona (id INT AUTO_INCREMENT NOT NULL, individual_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_4248065CD17F50A6 (uuid), INDEX IDX_4248065CAE271C0D (individual_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_individual_persona_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_23ABE6712C2AC5D3 (translatable_id), UNIQUE INDEX ds_individual_persona_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_anonymous (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_5B66812FD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_anonymous_persona (id INT AUTO_INCREMENT NOT NULL, anonymous_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_BAF4D4C7D17F50A6 (uuid), INDEX IDX_BAF4D4C7FA93803 (anonymous_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_anonymous_persona_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_4B4CFF822C2AC5D3 (translatable_id), UNIQUE INDEX ds_anonymous_persona_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ds_permission_entry ADD CONSTRAINT FK_E68A6391FED90CCA FOREIGN KEY (permission_id) REFERENCES ds_permission (id)');
        $this->addSql('ALTER TABLE ds_bu_translation ADD CONSTRAINT FK_BED414D52C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES ds_bu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ds_staff_persona ADD CONSTRAINT FK_6552A244D4D57CD FOREIGN KEY (staff_id) REFERENCES ds_staff (id)');
        $this->addSql('ALTER TABLE ds_staff_persona_trans ADD CONSTRAINT FK_4B2FB84F2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES ds_staff_persona (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ds_individual_persona ADD CONSTRAINT FK_4248065CAE271C0D FOREIGN KEY (individual_id) REFERENCES ds_individual (id)');
        $this->addSql('ALTER TABLE ds_individual_persona_trans ADD CONSTRAINT FK_23ABE6712C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES ds_individual_persona (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ds_anonymous_persona ADD CONSTRAINT FK_BAF4D4C7FA93803 FOREIGN KEY (anonymous_id) REFERENCES ds_anonymous (id)');
        $this->addSql('ALTER TABLE ds_anonymous_persona_trans ADD CONSTRAINT FK_4B4CFF822C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES ds_anonymous_persona (id) ON DELETE CASCADE');
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ds_permission_entry DROP FOREIGN KEY FK_E68A6391FED90CCA');
        $this->addSql('ALTER TABLE ds_bu_translation DROP FOREIGN KEY FK_BED414D52C2AC5D3');
        $this->addSql('ALTER TABLE ds_staff_persona DROP FOREIGN KEY FK_6552A244D4D57CD');
        $this->addSql('ALTER TABLE ds_staff_persona_trans DROP FOREIGN KEY FK_4B2FB84F2C2AC5D3');
        $this->addSql('ALTER TABLE ds_individual_persona DROP FOREIGN KEY FK_4248065CAE271C0D');
        $this->addSql('ALTER TABLE ds_individual_persona_trans DROP FOREIGN KEY FK_23ABE6712C2AC5D3');
        $this->addSql('ALTER TABLE ds_anonymous_persona DROP FOREIGN KEY FK_BAF4D4C7FA93803');
        $this->addSql('ALTER TABLE ds_anonymous_persona_trans DROP FOREIGN KEY FK_4B4CFF822C2AC5D3');
        $this->addSql('DROP TABLE ds_permission');
        $this->addSql('DROP TABLE ds_permission_entry');
        $this->addSql('DROP TABLE ds_bu');
        $this->addSql('DROP TABLE ds_bu_translation');
        $this->addSql('DROP TABLE ds_staff');
        $this->addSql('DROP TABLE ds_staff_persona');
        $this->addSql('DROP TABLE ds_staff_persona_trans');
        $this->addSql('DROP TABLE ds_individual');
        $this->addSql('DROP TABLE ds_individual_persona');
        $this->addSql('DROP TABLE ds_individual_persona_trans');
        $this->addSql('DROP TABLE ds_anonymous');
        $this->addSql('DROP TABLE ds_anonymous_persona');
        $this->addSql('DROP TABLE ds_anonymous_persona_trans');
    }
}
