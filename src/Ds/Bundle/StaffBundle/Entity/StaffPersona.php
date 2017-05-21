<?php

namespace Ds\Bundle\StaffBundle\Entity;

use Ds\Bundle\PersonaBundle\Entity\Persona;
use Ds\Bundle\StaffBundle\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Ds\Component\Model\Annotation\Translate;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;

/**
 * Class StaffPersona
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds_persona.filter.persona"},
 *          "normalization_context"={"groups"={"persona_output"}},
 *          "denormalization_context"={"groups"={"persona_input"}}
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\StaffBundle\Repository\StaffPersonaRepository")
 * @ORM\Table(name="ds_staff_persona")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class StaffPersona extends Persona
{
    // This behavior must be included at the same level as the child class.
    use Behavior\Translatable\Translatable;

    use Accessor\Staff;

    /**
     * @var \Ds\Bundle\StaffBundle\Entity\Staff
     * @ApiProperty
     * @Serializer\Groups({"persona_output", "persona_input"})
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\StaffBundle\Entity\Staff", inversedBy="personas")
     * @ORM\JoinColumn(name="staff_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $staff;
}