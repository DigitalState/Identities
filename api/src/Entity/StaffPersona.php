<?php

namespace App\Entity;

use App\Entity\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
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
 *          "filters"={
 *              "app.staff_persona.search",
 *              "app.staff_persona.search_translation",
 *              "app.staff_persona.date",
 *              "app.staff_persona.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\StaffPersonaRepository")
 * @ORM\Table(name="app_staff_persona")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class StaffPersona extends Persona
{
    // This behavior must be included at the same level as the child class.
    use Behavior\Translatable\Translatable;

    use Accessor\Staff;

    /**
     * @var \App\Entity\Staff
     * @ApiProperty
     * @Serializer\Groups({"persona_output", "persona_input"})
     * @ORM\ManyToOne(targetEntity="Staff", inversedBy="personas")
     * @ORM\JoinColumn(name="staff_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    private $staff;
}