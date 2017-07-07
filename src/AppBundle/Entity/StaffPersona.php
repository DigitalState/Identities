<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Ds\Component\Model\Annotation\Translate;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation As Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class StaffPersona
 *
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={
 *              "groups"={"persona_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"persona_input"}
 *          },
 *          "filters"={"app.staff_persona.search", "app.staff_persona.search_translation", "app.staff_persona.date", "app.staff_persona.order"}
 *      }
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StaffPersonaRepository")
 * @ORM\Table(name="app_staff_persona")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class StaffPersona extends Persona
{
    // This behavior must be included at the same level as the child class.
    use Behavior\Translatable\Translatable;

    use Accessor\Staff;

    /**
     * @var \AppBundle\Entity\Staff
     * @ApiProperty
     * @Serializer\Groups({"persona_output", "persona_input"})
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Staff", inversedBy="personas")
     * @ORM\JoinColumn(name="staff_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $staff;
}