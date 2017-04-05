<?php

namespace Ds\Bundle\IndividualBundle\Entity;

use Ds\Component\Entity\Entity\Uuidentifiable;
use Ds\Component\Entity\Entity\Accessor;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation As Serializer;
use Gedmo\Mapping\Annotation as Behavior;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Persona
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds_individual.persona.filter"},
 *          "normalization_context"={"groups"={"persona_output"}},
 *          "denormalization_context"={"groups"={"persona_input"}}
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\IndividualBundle\Repository\PersonaRepository")
 * @ORM\Table(name="ds_individual_persona")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Persona implements Uuidentifiable
{
    /**
     * @var integer
     *
     * @ApiProperty(identifier=false)
     * @Serializer\Groups({"persona_output_admin"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id; use Accessor\Id;

    /**
     * @var string
     *
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"persona_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid; use Accessor\Uuid;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"persona_output_admin"})
     * @Behavior\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt; use Accessor\CreatedAt;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"persona_output_admin"})
     * @Behavior\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt; use Accessor\UpdatedAt;

    /**
     * @var \Ds\Bundle\IndividualBundle\Entity\Individual
     *
     * @Serializer\Groups({"persona_output"})
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\IndividualBundle\Entity\Individual", inversedBy="personas")
     * @ORM\JoinColumn(name="individual_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $individual; # region accessors

    /**
     * Set individual
     *
     * @param \Ds\Bundle\IndividualBundle\Entity\Individual $individual
     * @return \Ds\Bundle\IndividualBundle\Entity\Persona
     */
    public function setIndividual(Individual $individual = null)
    {
        $this->individual = $individual;

        return $this;
    }

    /**
     * Get individual
     *
     * @return \Ds\Bundle\IndividualBundle\Entity\Individual
     */
    public function getIndividual()
    {
        return $this->individual;
    }

    # endregion

    /**
     * @var array
     *
     * @Serializer\Groups({"persona_output"})
     * @ORM\Column(name="data", type="json_array")
     */
    protected $data; use Accessor\Data;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
    }
}
