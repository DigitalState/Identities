<?php

namespace App\Entity;

use App\Entity\Attribute\Accessor as EntityAccessor;
use Doctrine\Common\Collections\ArrayCollection;
use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Model\Type\Deletable;
use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Identitiable;
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
 * Class Individual
 *
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={
 *              "groups"={"individual_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"individual_input"}
 *          },
 *          "filters"={
 *              "app.individual.search",
 *              "app.individual.date",
 *              "app.individual.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\IndividualRepository")
 * @ORM\Table(name="app_individual")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Individual implements Identifiable, Uuidentifiable, Ownable, Identitiable, Deletable, Versionable, Tenantable
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
    use Accessor\Deleted;
    use Accessor\Version;
    use TenantAccessor\Tenant;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"individual_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"individual_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    private $uuid;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"individual_output"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"individual_output"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"individual_output"})
     */
    protected $deletedAt;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"individual_output", "individual_input"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    private $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"individual_output", "individual_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    private $ownerUuid;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"individual_output"})
     * @ORM\OneToMany(targetEntity="IndividualPersona", mappedBy="individual", cascade={"persist", "remove"})
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    private $personas;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"individual_output"})
     * @ORM\OneToMany(targetEntity="IndividualRole", mappedBy="individual", cascade={"persist", "remove"})
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    private $roles;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"individual_output", "individual_input"})
     * @ORM\Column(name="version", type="integer")
     * @ORM\Version
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    private $version;

    /**
     * @var string
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"individual_output"})
     * @ORM\Column(name="tenant", type="guid")
     * @Assert\Uuid
     */
    private $tenant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personas = new ArrayCollection;
        $this->roles = new ArrayCollection;
    }
}
