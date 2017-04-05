<?php

namespace Ds\Bundle\IndividualBundle\Entity;

use Ds\Component\Entity\Entity\Uuidentifiable;
use Ds\Component\Entity\Entity\Accessor;
use Doctrine\Common\Collections\ArrayCollection;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation As Serializer;
use Gedmo\Mapping\Annotation as Behavior;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Individual
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds_individual.individual.filter"},
 *          "normalization_context"={"groups"={"individual_output"}},
 *          "denormalization_context"={"groups"={"individual_input"}}
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\IndividualBundle\Repository\IndividualRepository")
 * @ORM\Table(name="ds_individual")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Individual implements Uuidentifiable
{
    /**
     * @var integer
     *
     * @ApiProperty(identifier=false)
     * @Serializer\Groups({"individual_output_admin"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id; use Accessor\Id;

    /**
     * @var string
     *
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"individual_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid; use Accessor\Uuid;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"individual_output_admin"})
     * @Behavior\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt; use Accessor\CreatedAt;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"individual_output_admin"})
     * @Behavior\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt; use Accessor\UpdatedAt;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @Serializer\Groups({"individual_output"})
     * @ORM\OneToMany(targetEntity="Ds\Bundle\IndividualBundle\Entity\Persona", mappedBy="individual", cascade={"persist", "remove"})
     */
    protected $personas; # region accessors

    /**
     * Add persona
     *
     * @param \Ds\Bundle\IndividualBundle\Entity\Persona $persona
     * @return \Ds\Bundle\IndividualBundle\Entity\Individual
     */
    public function addPersona(Persona $persona)
    {
        $persona->setIndividual($this);
        $this->personas[] = $persona;

        return $this;
    }

    /**
     * Remove persona
     *
     * @param \Ds\Bundle\IndividualBundle\Entity\Persona $persona
     */
    public function removePersona(Persona $persona)
    {
        $this->personas->removeElement($persona);
    }

    /**
     * Get personas
     *
     * @return array
     */
    public function getPersonas()
    {
        return $this->personas->toArray();
    }

    # endregion

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personas = new ArrayCollection;
    }
}
