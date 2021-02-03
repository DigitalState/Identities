<?php

namespace App\Entity;

use App\Entity\Attribute\Accessor as EntityAccessor;
use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Versionable;
use Ds\Component\Tenant\Model\Attribute\Accessor as TenantAccessor;
use Ds\Component\Tenant\Model\Type\Tenantable;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation As Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AssignedRole
 */
abstract class AssignedRole implements Identifiable, Uuidentifiable, Ownable, Versionable, Tenantable
{
    use Behavior\Timestampable\Timestampable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use EntityAccessor\Role;
    use Accessor\EntityUuids;
    use Accessor\Version;
    use TenantAccessor\Tenant;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"assigned_role_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"assigned_role_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

    /**
     * @var \DateTime
     * @ApiProperty
     * @Serializer\Groups({"assigned_role_output", "assigned_role_input"})
     * @Assert\DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"assigned_role_output"})
     */
    protected $updatedAt;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"assigned_role_output", "assigned_role_input"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    protected $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"assigned_role_output", "assigned_role_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid;

    /**
     * @var \App\Entity\Role
     * @ApiProperty
     * @Serializer\Groups({"assigned_role_output", "assigned_role_input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Role")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    protected $role;

    /**
     * @var string
     * @Serializer\Groups({"assigned_role_output", "assigned_role_input"})
     * @ORM\Column(name="entity_uuids", type="json_array")
     */
    protected $entityUuids;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"assigned_role_output", "assigned_role_input"})
     * @ORM\Column(name="version", type="integer")
     * @ORM\Version
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    protected $version;

    /**
     * @var string
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"assigned_role_output"})
     * @ORM\Column(name="tenant", type="guid")
     * @Assert\Uuid
     */
    protected $tenant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entityUuids = [];
    }
}
