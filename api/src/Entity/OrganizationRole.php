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
 * Class OrganizationRole
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
 *              "app.organization_role.search",
 *              "app.organization_role.date",
 *              "app.organization_role.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\OrganizationRoleRepository")
 * @ORM\Table(name="app_organization_role")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class OrganizationRole extends AssignedRole
{
    use Accessor\Organization;

    /**
     * @var \App\Entity\Organization
     * @ApiProperty
     * @Serializer\Groups({"assigned_role_output", "assigned_role_input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization", inversedBy="roles")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    private $organization;
}
