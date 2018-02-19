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
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation As Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Anonymous
 *
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={
 *              "groups"={"anonymous_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"anonymous_input"}
 *          },
 *          "filters"={
 *              "app.anonymous.search",
 *              "app.anonymous.date",
 *              "app.anonymous.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AnonymousRepository")
 * @ORM\Table(name="app_anonymous")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Anonymous implements Identifiable, Uuidentifiable, Ownable, Identitiable, Deletable, Versionable, Secured
{
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Id;
    use Accessor\Uuid;
    use Accessor\Owner;
    use Accessor\OwnerUuid;
    use EntityAccessor\Identity\Identity;
    use EntityAccessor\Identity\IdentityUuid;
    use Accessor\Deleted;
    use Accessor\Version;

    /**
     * @var integer
     * @ApiProperty(identifier=false, writable=false)
     * @Serializer\Groups({"anonymous_output"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ApiProperty(identifier=true, writable=false)
     * @Serializer\Groups({"anonymous_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"anonymous_output"})
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"anonymous_output"})
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"anonymous_output"})
     */
    protected $deletedAt;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"anonymous_output", "anonymous_input"})
     * @ORM\Column(name="`owner`", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min=1, max=255)
     */
    protected $owner;

    /**
     * @var string
     * @ApiProperty
     * @Serializer\Groups({"anonymous_output", "anonymous_input"})
     * @ORM\Column(name="owner_uuid", type="guid", nullable=true)
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ApiProperty(writable=false)
     * @Serializer\Groups({"anonymous_output"})
     * @ORM\OneToMany(targetEntity="AnonymousPersona", mappedBy="anonymous", cascade={"persist", "remove"})
     */
    protected $personas;

    /**
     * @var integer
     * @ApiProperty
     * @Serializer\Groups({"anonymous_output", "anonymous_input"})
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
        $this->personas = new ArrayCollection;
    }
}
