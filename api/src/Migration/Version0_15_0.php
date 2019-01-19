<?php

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Migrations\Version;
use Ds\Component\Acl\Migration\Version0_15_0 as Acl;
use Ds\Component\Config\Migration\Version0_15_0 as Config;
use Ds\Component\Container\Attribute;
use Ds\Component\Database\Util\Objects;
use Ds\Component\Database\Util\Parameters;
use Ds\Component\Metadata\Migration\Version0_15_0 as Metadata;
use Ds\Component\Parameter\Migration\Version0_15_0 as Parameter;
use Ds\Component\Tenant\Migration\Version0_15_0 as Tenant;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class Version0_15_0
 */
final class Version0_15_0 extends AbstractMigration implements ContainerAwareInterface
{
    use Attribute\Container;

    /**
     * @cont string
     */
    const DIRECTORY = '/srv/api/config/migrations';

    /**
     * @var \Ds\Component\Acl\Migration\Version0_15_0
     */
    private $acl;

    /**
     * @var \Ds\Component\Config\Migration\Version0_15_0
     */
    private $config;

    /**
     * @var \Ds\Component\Metadata\Migration\Version0_15_0
     */
    private $metadata;

    /**
     * @var \Ds\Component\Parameter\Migration\Version0_15_0
     */
    private $parameter;

    /**
     * @var \Ds\Component\Tenant\Migration\Version0_15_0
     */
    private $tenant;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Migrations\Version  $version
     */
    public function __construct(Version $version)
    {
        parent::__construct($version);
        $this->acl = new Acl($version);
        $this->config = new Config($version);
        $this->metadata = new Metadata($version);
        $this->parameter = new Parameter($version);
        $this->tenant = new Tenant($version);
    }

    /**
     * Up migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        $parameters = Parameters::parseFile(static::DIRECTORY.'/parameters.yaml');
        $this->acl->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/acl.yaml', $parameters));
        $this->config->setContainer($this->container)->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/config.yaml', $parameters));
        $this->metadata->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/metadata.yaml', $parameters));
        $this->parameter->setContainer($this->container)->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/system/parameter.yaml', $parameters));
        $this->tenant->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/system/tenant.yaml', $parameters));

        $businessUnits = Objects::parseFile(static::DIRECTORY.'/0_15_0/business_unit.yaml', $parameters);
        $staffs = Objects::parseFile(static::DIRECTORY.'/0_15_0/staff.yaml', $parameters);
        $systems = Objects::parseFile(static::DIRECTORY.'/0_15_0/system.yaml', $parameters);

        $sequences['app_anonymous_id_seq'] = 1;
        $sequences['app_anonymous_persona_id_seq'] = 1;
        $sequences['app_anonymous_persona_trans_id_seq'] = 1;
        $sequences['app_bu_id_seq'] = 1 + count($businessUnits);
        $sequences['app_bu_trans_id_seq'] = 1;
        $sequences['app_individual_id_seq'] = 1;
        $sequences['app_individual_persona_id_seq'] = 1;
        $sequences['app_individual_persona_trans_id_seq'] = 1;
        $sequences['app_organization_id_seq'] = 1;
        $sequences['app_organization_persona_id_seq'] = 1;
        $sequences['app_organization_persona_trans_id_seq'] = 1;
        $sequences['app_role_id_seq'] = 1;
        $sequences['app_role_trans_id_seq'] = 1;
        $sequences['app_staff_id_seq'] = 1 + count($staffs);
        $sequences['app_staff_persona_id_seq'] = 1;
        $sequences['app_staff_persona_trans_id_seq'] = 1;
        $sequences['app_system_id_seq'] = 1 + count($businessUnits);

        foreach ($businessUnits as $businessUnit) {
            $sequences['app_bu_trans_id_seq'] += count((array) $businessUnit->title);
        }

        foreach ($staffs as $staff) {
            $sequences['app_staff_persona_id_seq'] += count((array) $staff->personas);

            foreach ($staff->personas as $persona) {
                $sequences['app_staff_persona_trans_id_seq'] += count((array) $persona->title);
            }
        }

        switch ($this->platform->getName()) {
            case 'postgresql':
                $this->addSql('CREATE SEQUENCE app_anonymous_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_anonymous_id_seq']);
                $this->addSql('CREATE SEQUENCE app_anonymous_persona_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_anonymous_persona_id_seq']);
                $this->addSql('CREATE SEQUENCE app_anonymous_persona_trans_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_anonymous_persona_trans_id_seq']);
                $this->addSql('CREATE SEQUENCE app_bu_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_bu_id_seq']);
                $this->addSql('CREATE SEQUENCE app_bu_trans_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_bu_trans_id_seq']);
                $this->addSql('CREATE SEQUENCE app_individual_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_individual_id_seq']);
                $this->addSql('CREATE SEQUENCE app_individual_persona_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_individual_persona_id_seq']);
                $this->addSql('CREATE SEQUENCE app_individual_persona_trans_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_individual_persona_trans_id_seq']);
                $this->addSql('CREATE SEQUENCE app_organization_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_organization_id_seq']);
                $this->addSql('CREATE SEQUENCE app_organization_persona_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_organization_persona_id_seq']);
                $this->addSql('CREATE SEQUENCE app_organization_persona_trans_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_organization_persona_trans_id_seq']);
                $this->addSql('CREATE SEQUENCE app_role_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_role_id_seq']);
                $this->addSql('CREATE SEQUENCE app_role_trans_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_role_trans_id_seq']);
                $this->addSql('CREATE SEQUENCE app_staff_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_staff_id_seq']);
                $this->addSql('CREATE SEQUENCE app_staff_persona_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_staff_persona_id_seq']);
                $this->addSql('CREATE SEQUENCE app_staff_persona_trans_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_staff_persona_trans_id_seq']);
                $this->addSql('CREATE SEQUENCE app_system_id_seq INCREMENT BY 1 MINVALUE 1 START '.$sequences['app_system_id_seq']);
                $this->addSql('CREATE TABLE app_anonymous (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_6A5EB29BD17F50A6 ON app_anonymous (uuid)');
                $this->addSql('CREATE TABLE app_anonymous_role (anonymous_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(anonymous_id, role_id))');
                $this->addSql('CREATE INDEX IDX_E2D1EAF6FA93803 ON app_anonymous_role (anonymous_id)');
                $this->addSql('CREATE INDEX IDX_E2D1EAF6D60322AC ON app_anonymous_role (role_id)');
                $this->addSql('CREATE TABLE app_anonymous_persona (id INT NOT NULL, anonymous_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_5ABA7A3D17F50A6 ON app_anonymous_persona (uuid)');
                $this->addSql('CREATE INDEX IDX_5ABA7A3FA93803 ON app_anonymous_persona (anonymous_id)');
                $this->addSql('COMMENT ON COLUMN app_anonymous_persona.data IS \'(DC2Type:json_array)\'');
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
                $this->addSql('COMMENT ON COLUMN app_individual_persona.data IS \'(DC2Type:json_array)\'');
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
                $this->addSql('COMMENT ON COLUMN app_organization_persona.data IS \'(DC2Type:json_array)\'');
                $this->addSql('CREATE TABLE app_organization_persona_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE INDEX IDX_63870C2F2C2AC5D3 ON app_organization_persona_trans (translatable_id)');
                $this->addSql('CREATE UNIQUE INDEX app_organization_persona_trans_unique_translation ON app_organization_persona_trans (translatable_id, locale)');
                $this->addSql('CREATE TABLE app_role (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, permissions JSON NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_5247AFCAD17F50A6 ON app_role (uuid)');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_5247AFCA989D9B624E59C462 ON app_role (slug, tenant)');
                $this->addSql('COMMENT ON COLUMN app_role.permissions IS \'(DC2Type:json_array)\'');
                $this->addSql('CREATE TABLE app_role_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
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
                $this->addSql('COMMENT ON COLUMN app_staff_persona.data IS \'(DC2Type:json_array)\'');
                $this->addSql('CREATE TABLE app_staff_persona_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE INDEX IDX_83B289352C2AC5D3 ON app_staff_persona_trans (translatable_id)');
                $this->addSql('CREATE UNIQUE INDEX app_staff_persona_trans_unique_translation ON app_staff_persona_trans (translatable_id, locale)');
                $this->addSql('CREATE TABLE app_system (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_2C4E7C0BD17F50A6 ON app_system (uuid)');
                $this->addSql('CREATE TABLE app_system_role (system_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(system_id, role_id))');
                $this->addSql('CREATE INDEX IDX_1F401F20D0952FA5 ON app_system_role (system_id)');
                $this->addSql('CREATE INDEX IDX_1F401F20D60322AC ON app_system_role (role_id)');
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

                $i = 0;
                $j = 0;

                foreach ($businessUnits as $businessUnit) {
                    if (null === $businessUnit->uuid) {
                        $businessUnit->uuid = Uuid::uuid4()->toString();
                    }

                    $this->addSql(sprintf(
                        'INSERT INTO app_bu (id, uuid, owner, owner_uuid, version, tenant, created_at, updated_at, deleted_at) VALUES (%d, %s, %s, %s, %d, %s, %s, %s, %s);',
                        ++$i,
                        $this->connection->quote($businessUnit->uuid),
                        $this->connection->quote($businessUnit->owner),
                        $this->connection->quote($businessUnit->owner_uuid),
                        $businessUnit->version,
                        $this->connection->quote($businessUnit->tenant),
                        'now()',
                        'now()',
                        'NULL'
                    ));

                    foreach ($businessUnit->title as $locale => $title) {
                        $this->addSql(sprintf('INSERT INTO app_bu_trans (id, translatable_id, title, locale) VALUES (%d, %d, %s, %s);',
                            ++$j,
                            $i,
                            $this->connection->quote($title),
                            $this->connection->quote($locale)
                        ));
                    }
                }

                $i = 0;
                $j = 0;
                $k = 0;

                foreach ($staffs as $staff) {
                    if (null === $staff->uuid) {
                        $staff->uuid = Uuid::uuid4()->toString();
                    }

                    $this->addSql(sprintf(
                        'INSERT INTO app_staff (id, uuid, owner, owner_uuid, version, tenant, created_at, updated_at, deleted_at) VALUES (%d, %s, %s, %s, %d, %s, %s, %s, %s);',
                        ++$i,
                        $this->connection->quote($staff->uuid),
                        $this->connection->quote($staff->owner),
                        $this->connection->quote($staff->owner_uuid),
                        $staff->version,
                        $this->connection->quote($staff->tenant),
                        'now()',
                        'now()',
                        'NULL'
                    ));

                    foreach ($staff->personas as $persona) {
                        if (null === $persona->uuid) {
                            $persona->uuid = Uuid::uuid4()->toString();
                        }

                        $this->addSql(sprintf(
                            'INSERT INTO app_staff_persona (id, staff_id, uuid, owner, owner_uuid, data, version, tenant, created_at, updated_at, deleted_at) VALUES (%d, %d, %s, %s, %s, %s, %d, %s, %s, %s, %s);',
                            ++$j,
                            $i,
                            $this->connection->quote($persona->uuid),
                            $this->connection->quote($staff->owner),
                            $this->connection->quote($staff->owner_uuid),
                            $this->connection->quote(json_encode($persona->data)),
                            $persona->version,
                            $this->connection->quote($staff->tenant),
                            'now()',
                            'now()',
                            'NULL'
                        ));

                        foreach ($persona->title as $locale => $title) {
                            $this->addSql(sprintf('INSERT INTO app_staff_persona_trans (id, translatable_id, title, locale) VALUES (%d, %d, %s, %s);',
                                ++$k,
                                $j,
                                $this->connection->quote($title),
                                $this->connection->quote($locale)
                            ));
                        }
                    }
                }

                $i = 0;

                foreach ($systems as $system) {
                    if (null === $system->uuid) {
                        $system->uuid = Uuid::uuid4()->toString();
                    }

                    $this->addSql(sprintf(
                        'INSERT INTO app_system (id, uuid, owner, owner_uuid, version, tenant, created_at, updated_at, deleted_at) VALUES (%d, %s, %s, %s, %d, %s, %s, %s, %s);',
                        ++$i,
                        $this->connection->quote($system->uuid),
                        $this->connection->quote($system->owner),
                        $this->connection->quote($system->owner_uuid),
                        $system->version,
                        $this->connection->quote($system->tenant),
                        'now()',
                        'now()',
                        'NULL'
                    ));
                }

                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$this->platform->getName().'".');
                break;
        }
    }

    /**
     * Down migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->acl->down($schema);
        $this->config->setContainer($this->container)->down($schema);
        $this->metadata->down($schema);
        $this->parameter->setContainer($this->container)->down($schema);
        $this->tenant->down($schema);

        switch ($this->platform->getName()) {
            case 'postgresql':
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
                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$this->platform->getName().'".');
                break;
        }
    }
}
