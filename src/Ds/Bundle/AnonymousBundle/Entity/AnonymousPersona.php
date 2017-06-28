<?php

namespace Ds\Bundle\AnonymousBundle\Entity;

use Ds\Bundle\PersonaBundle\Entity\Persona;
use Ds\Bundle\AnonymousBundle\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Ds\Component\Model\Annotation\Translate;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;

/**
 * Class AnonymousPersona
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds.anonymous_persona.search", "ds.anonymous_persona.date", "ds.anonymous_persona.order", "ds.anonymous_persona.search_translation"},
 *          "normalization_context"={
 *              "groups"={"persona_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"persona_input"}
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\AnonymousBundle\Repository\AnonymousPersonaRepository")
 * @ORM\Table(name="ds_anonymous_persona")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class AnonymousPersona extends Persona
{
    // This behavior must be included at the same level as the child class.
    use Behavior\Translatable\Translatable;

    use Accessor\Anonymous;

    /**
     * @var \Ds\Bundle\AnonymousBundle\Entity\Anonymous
     * @ApiProperty
     * @Serializer\Groups({"persona_output", "persona_input"})
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\AnonymousBundle\Entity\Anonymous", inversedBy="personas")
     * @ORM\JoinColumn(name="anonymous_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $anonymous;
}