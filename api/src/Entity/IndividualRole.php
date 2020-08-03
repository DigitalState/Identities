<?php

namespace App\Entity;

use App\Entity\Attribute\Accessor;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation As Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class IndividualRole
 *
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={
 *              "groups"={"assigned_role_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"assigned_role_input"}
 *          },
 *          "filters"={
 *              "app.individual_role.search",
 *              "app.individual_role.date",
 *              "app.individual_role.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\IndividualRoleRepository")
 * @ORM\Table(name="app_individual_role")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class IndividualRole extends AssignedRole
{
    use Accessor\Individual;

    /**
     * @var \App\Entity\Individual
     * @ApiProperty
     * @Serializer\Groups({"assigned_role_output", "assigned_role_input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Individual", inversedBy="roles")
     * @ORM\JoinColumn(name="individual_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    private $individual;
}
