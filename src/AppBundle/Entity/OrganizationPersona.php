<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation As Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class OrganizationPersona
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
 *              "app.organization_persona.search",
 *              "app.organization_persona.search_translation",
 *              "app.organization_persona.date",
 *              "app.organization_persona.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganizationPersonaRepository")
 * @ORM\Table(name="app_organization_persona")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class OrganizationPersona extends Persona
{
    // This behavior must be included at the same level as the child class.
    use Behavior\Translatable\Translatable;

    use Accessor\Organization;

    /**
     * @var \AppBundle\Entity\Organization
     * @ApiProperty
     * @Serializer\Groups({"persona_output", "persona_input"})
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="personas")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $organization;
}