<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Attribute\Accessor;
use Ds\Component\Security\Model\Type\Secured;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation As Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class IndividualPersona
 *
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={
 *              "groups"={"persona_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"persona_input"}
 *          },
 *          "filters"={
 *              "app.individual_persona.search",
 *              "app.individual_persona.search_translation",
 *              "app.individual_persona.date",
 *              "app.individual_persona.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IndividualPersonaRepository")
 * @ORM\Table(name="app_individual_persona")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class IndividualPersona extends Persona implements Secured
{
    // This behavior must be included at the same level as the child class.
    use Behavior\Translatable\Translatable;

    use Accessor\Individual;

    /**
     * @var \AppBundle\Entity\Individual
     * @ApiProperty
     * @Serializer\Groups({"persona_output", "persona_input"})
     * @ORM\ManyToOne(targetEntity="Individual", inversedBy="personas")
     * @ORM\JoinColumn(name="individual_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $individual;
}