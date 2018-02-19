<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Attribute\Accessor as EntityAccessor;
use Doctrine\Common\Collections\ArrayCollection;
use Ds\Component\Locale\Model\Type\Localizable;
use Ds\Component\Model\Attribute\Accessor;
use Ds\Component\Model\Type\Deletable;
use Ds\Component\Model\Type\Identifiable;
use Ds\Component\Model\Type\Ownable;
use Ds\Component\Model\Type\Uuidentifiable;
use Ds\Component\Model\Type\Versionable;
use Ds\Component\Security\Model\Type\Secured;
use Ds\Component\Translation\Model\Attribute\Accessor as TranslationAccessor;
use Ds\Component\Translation\Model\Type\Translatable;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Ds\Component\Locale\Model\Annotation\Locale;
use Ds\Component\Translation\Model\Annotation\Translate;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation As Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class BusinessUnit
 *
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={
 *              "groups"={"business_unit_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"business_unit_input"}
 *          },
 *          "filters"={
 *              "app.business_unit.search",
 *              "app.business_unit.search_translation",
 *              "app.business_unit.date",
 *              "app.business_unit.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusinessUnitRepository")
 * @ORM\Table(name="app_bu")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class BusinessUnit implements Identifiable, Uuidentifiable, Ownable, Translatable, Localizable, Deletable, Versionable, Secured
{
    use Behavior\Translatable\Translatable;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use TranslationAccessor\Title;
    use EntityAccessor\Staffs;
    use EntityAccessor\Individuals;
    use Accessor\Deleted;
    use Accessor\Version;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"business_unit_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"business_unit_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"business_unit_output"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"business_unit_output"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"business_unit_output"})
     */
    protected $deletedAt;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"business_unit_output", "business_unit_input"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    protected $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"business_unit_output", "business_unit_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid;

    /**
     * @var array
     * @ApiProperty
     * @Serializer\Groups({"business_unit_output", "business_unit_input"})
     * @Assert\Type("array")
     * @Assert\NotBlank
     * @Assert\All({
     *     @Assert\NotBlank,
     *     @Assert\Length(min=1)
     * })
     * @Locale
     * @Translate
     */
    protected $title;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ApiProperty
     * @ORM\ManyToMany(targetEntity="Staff", mappedBy="businessUnits")
     */
    protected $staffs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ApiProperty(writable=false)
     * @ORM\ManyToMany(targetEntity="Individual", mappedBy="businessUnits")
     */
    protected $individuals;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"business_unit_output", "business_unit_input"})
     * @ORM\Column(name="version", type="integer")
     * @ORM\Version
     * @Assert\NotBlank
     * @Assert\Type("integer")
     */
    protected $version;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->title = [];
        $this->staffs = new ArrayCollection;
        $this->individuals = new ArrayCollection;
    }
}
