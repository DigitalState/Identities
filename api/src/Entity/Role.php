<?php

namespace App\Entity;

use App\Entity\Attribute\Accessor as EntityAccessor;
use Ds\Component\Locale\Model\Type\Localizable;
use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Sluggable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Versionable;
use Ds\Component\Tenant\Model\Attribute\Accessor as TenantAccessor;
use Ds\Component\Tenant\Model\Type\Tenantable;
use Ds\Component\Translation\Model\Attribute\Accessor as TranslationAccessor;
use Ds\Component\Translation\Model\Type\Translatable;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Validator\Constraints\Role as RoleAssert;
use Doctrine\ORM\Mapping as ORM;
use Ds\Component\Locale\Model\Annotation\Locale;
use Ds\Component\Translation\Model\Annotation\Translate;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation As Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Role
 *
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={
 *              "groups"={"role_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"role_input"}
 *          },
 *          "filters"={
 *              "app.role.search",
 *              "app.role.search_translation",
 *              "app.role.date",
 *              "app.role.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 * @ORM\Table(
 *     name="app_role",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(columns={"slug", "tenant"})
 *     }
 * )
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 * @ORMAssert\UniqueEntity(fields={"slug", "tenant"})
 * @RoleAssert\Permissions\Valid
 */
class Role implements Identifiable, Uuidentifiable, Sluggable, Ownable, Translatable, Localizable, Versionable, Tenantable
{
    use Behavior\Translatable\Translatable;
    use Behavior\Timestampable\Timestampable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use TranslationAccessor\Title;
    use Accessor\Slug;
    use EntityAccessor\Permissions;
    use Accessor\Deleted;
    use Accessor\Version;
    use TenantAccessor\Tenant;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"role_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"role_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    private $uuid;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"role_output"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"role_output"})
     */
    protected $updatedAt;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"role_output", "role_input"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    private $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"role_output", "role_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    private $ownerUuid;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"role_output", "role_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Assert\All({
     *     @Assert\NotBlank,
     *     @Assert\Length(min=1)
     * })
     * @Locale
     * @Translate
     */
    private $title;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"role_output", "role_input"})
     * @ORM\Column(name="slug", type="string")
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    private $slug;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"role_output", "role_input"})
     * @ORM\Column(name="permissions", type="json_array")
     * @Assert\Type("array")
     */
    private $permissions;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"role_output", "role_input"})
     * @ORM\Column(name="version", type="integer")
     * @ORM\Version
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    private $version;

    /**
     * @var string
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"role_output"})
     * @ORM\Column(name="tenant", type="guid")
     * @Assert\Uuid
     */
    private $tenant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->title = [];
        $this->permissions = [];
        $this->version = 1;
    }
}
