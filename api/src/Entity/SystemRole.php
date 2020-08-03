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
 * Class SystemRole
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
 *              "app.system_role.search",
 *              "app.system_role.date",
 *              "app.system_role.order"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SystemRoleRepository")
 * @ORM\Table(name="app_system_role")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class SystemRole extends AssignedRole
{
    use Accessor\System;

    /**
     * @var \App\Entity\System
     * @ApiProperty
     * @Serializer\Groups({"assigned_role_output", "assigned_role_input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\System", inversedBy="roles")
     * @ORM\JoinColumn(name="system_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    private $system;
}
