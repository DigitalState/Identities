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
 * Class IndividualRole
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
class IndividualRole extends BusinessUnitRole
{
    use Accessor\Individual;
    use Accessor\BusinessUnits;

    /**
     * @var \App\Entity\Individual
     * @ApiProperty
     * @Serializer\Groups({"business_unit_role_output", "business_unit_role_input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Individual", inversedBy="roles")
     * @ORM\JoinColumn(name="individual_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    private $individual;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ApiProperty
     * @Serializer\Groups({"business_unit_role_output", "business_unit_role_input"})
     * @ORM\ManyToMany(targetEntity="App\Entity\BusinessUnit", cascade={"remove", "persist"})
     * @ORM\JoinTable(
     *     name="app_individual_role_bu",
     *     joinColumns={
     *         @ORM\JoinColumn(name="individual_role_id", referencedColumnName="id")
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
