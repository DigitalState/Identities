<?php

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version0_18_1
 */
final class Version0_18_1 extends AbstractMigration
{
    /**
     * Up migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE app_bu ADD data JSON NOT NULL DEFAULT \'[]\'::json');
        $this->addSql('COMMENT ON COLUMN app_bu.data IS \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE app_role ADD data JSON NOT NULL DEFAULT \'[]\'::json');
        $this->addSql('COMMENT ON COLUMN app_role.data IS \'(DC2Type:json_array)\'');
    }

    /**
     * Down migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE app_role DROP data');
        $this->addSql('ALTER TABLE app_bu DROP data');
    }
}
