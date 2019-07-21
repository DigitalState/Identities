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
 * Class OrganizationRole
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
class OrganizationRole extends BusinessUnitRole
{
    use Accessor\Organization;
    use Accessor\BusinessUnits;

    /**
     * @var \App\Entity\Organization
     * @ApiProperty
     * @Serializer\Groups({"business_unit_role_output", "business_unit_role_input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization", inversedBy="roles")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    private $organization;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ApiProperty
     * @Serializer\Groups({"business_unit_role_output", "business_unit_role_input"})
     * @ORM\ManyToMany(targetEntity="App\Entity\BusinessUnit", cascade={"remove", "persist"})
     * @ORM\JoinTable(
     *     name="app_organization_role_bu",
     *     joinColumns={
     *         @ORM\JoinColumn(name="organization_role_id", referencedColumnName="id")
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
