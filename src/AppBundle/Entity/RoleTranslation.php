<?php

namespace AppBundle\Entity;

use Ds\Component\Model\Attribute\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class RoleTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="app_role_trans")
 */
class RoleTranslation
{
    use Behavior\Translatable\Translation;

    use Accessor\Title;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;
}
