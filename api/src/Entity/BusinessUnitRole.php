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
 * Class BusinessUnitRole
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
 *              "app.business_unit_role.search",
 *              "app.business_unit_role.date",
 *              "app.business_unit_role.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\BusinessUnitRoleRepository")
 * @ORM\Table(name="app_bu_role")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class BusinessUnitRole extends AssignedRole
{
    use Accessor\BusinessUnit;

    /**
     * @var \App\Entity\BusinessUnit
     * @ApiProperty
     * @Serializer\Groups({"assigned_role_output", "assigned_role_input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\BusinessUnit", inversedBy="roles")
     * @ORM\JoinColumn(name="business_unit_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    private $businessUnit;
}
