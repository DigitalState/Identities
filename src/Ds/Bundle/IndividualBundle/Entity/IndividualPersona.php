<?php

namespace Ds\Bundle\IndividualBundle\Entity;

use Ds\Bundle\PersonaBundle\Entity\Persona;
use Ds\Bundle\IndividualBundle\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Ds\Component\Model\Annotation\Translate;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;

/**
 * Class IndividualPersona
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds.individual_persona.search", "ds.individual_persona.search_translation", "ds.individual_persona.date", "ds.individual_persona.order"},
 *          "normalization_context"={
 *              "groups"={"persona_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"persona_input"}
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\IndividualBundle\Repository\IndividualPersonaRepository")
 * @ORM\Table(name="ds_individual_persona")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class IndividualPersona extends Persona
{
    // This behavior must be included at the same level as the child class.
    use Behavior\Translatable\Translatable;

    use Accessor\Individual;

    /**
     * @var \Ds\Bundle\IndividualBundle\Entity\Individual
     * @ApiProperty
     * @Serializer\Groups({"persona_output", "persona_input"})
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\IndividualBundle\Entity\Individual", inversedBy="personas")
     * @ORM\JoinColumn(name="individual_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $individual;
}