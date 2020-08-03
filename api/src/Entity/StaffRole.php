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
 * Class AnonymousRole
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
 *              "app.staff_role.search",
 *              "app.staff_role.date",
 *              "app.staff_role.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\StaffRoleRepository")
 * @ORM\Table(name="app_staff_role")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class StaffRole extends AssignedRole
{
    use Accessor\Staff;

    /**
     * @var \App\Entity\Staff
     * @ApiProperty
     * @Serializer\Groups({"assigned_role_output", "assigned_role_input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Staff", inversedBy="roles")
     * @ORM\JoinColumn(name="staff_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    private $staff;
}
