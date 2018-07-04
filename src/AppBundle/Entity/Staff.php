<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Attribute\Accessor as EntityAccessor;
use Doctrine\Common\Collections\ArrayCollection;
use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Model\Type\Deletable;
use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Identitiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Versionable;
use Ds\Component\Security\Model\Type\Secured;
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
 * Class Staff
 *
 * @ApiResource(
 *     shortName="staffs",
 *     attributes={
 *         "normalization_context"={
 *             "groups"={"staff_output"}
 *         },
 *         "denormalization_context"={
 *             "groups"={"staff_input"}
 *         },
 *         "filters"={
 *             "app.staff.search",
 *             "app.staff.date",
 *             "app.staff.order"
 *         }
 *     }
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StaffRepository")
 * @ORM\Table(name="app_staff")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Staff implements Identifiable, Uuidentifiable, Ownable, Identitiable, Deletable, Versionable, Tenantable, Secured
{
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use EntityAccessor\Identity\Identity;
    use EntityAccessor\Identity\IdentityUuid;
    use EntityAccessor\Personas;
    use EntityAccessor\Roles;
    use EntityAccessor\BusinessUnits;
    use Accessor\Deleted;
    use Accessor\Version;
    use TenantAccessor\Tenant;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"staff_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"staff_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"staff_output"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"staff_output"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"staff_output"})
     */
    protected $deletedAt;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"staff_output", "staff_input"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    protected $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"staff_output", "staff_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"staff_output"})
     * @ORM\OneToMany(targetEntity="StaffPersona", mappedBy="staff", cascade={"persist", "remove"})
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    protected $personas;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ApiProperty
     * @Serializer\Groups({"staff_output", "staff_input"})
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(
     *     name="app_staff_role",
     *     joinColumns={
     *         @ORM\JoinColumn(name="staff_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *     }
     * )
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    protected $roles;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ApiProperty
     * @Serializer\Groups({"staff_output", "staff_input"})
     * @ORM\ManyToMany(targetEntity="BusinessUnit", inversedBy="staffs")
     * @ORM\JoinTable(
     *     name="app_staff_bu",
     *     joinColumns={
     *         @ORM\JoinColumn(name="staff_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(name="bu_id", referencedColumnName="id")
     *     }
     * )
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    protected $businessUnits;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"staff_output", "staff_input"})
     * @ORM\Column(name="version", type="integer")
     * @ORM\Version
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    protected $version;

    /**
     * @var string
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"staff_output"})
     * @ORM\Column(name="tenant", type="guid")
     * @Assert\Uuid
     */
    protected $tenant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personas = new ArrayCollection;
        $this->roles = new ArrayCollection;
        $this->businessUnits = new ArrayCollection;
    }
}
