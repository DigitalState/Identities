<?php

namespace App\Entity;

use App\Entity\Attribute\Accessor;
use Doctrine\Common\Collections\ArrayCollection;

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
 *              "groups"={"business_unit_role_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"business_unit_role_input"}
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
class SystemRole extends BusinessUnitRole
{
    use Accessor\System;
    use Accessor\BusinessUnits;

    /**
     * @var \App\Entity\System
     * @ApiProperty
     * @Serializer\Groups({"business_unit_role_output", "business_unit_role_input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\System", inversedBy="roles")
     * @ORM\JoinColumn(name="system_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    private $system;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ApiProperty
     * @Serializer\Groups({"business_unit_role_output", "business_unit_role_input"})
     * @ORM\ManyToMany(targetEntity="App\Entity\BusinessUnit", cascade={"remove", "persist"})
     * @ORM\JoinTable(
     *     name="app_system_role_bu",
     *     joinColumns={
     *         @ORM\JoinColumn(name="system_role_id", referencedColumnName="id")
     *     }
     * )
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     */
    private $businessUnits;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->businessUnits = new ArrayCollection;
    }
}
