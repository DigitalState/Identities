<?php

namespace Ds\Bundle\BusinessUnitBundle\Entity;

use Ds\Component\Model\Accessor;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BusinessUnitTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="ds_bu_translation")
 */
class BusinessUnitTranslation
{
    use Behavior\Translatable\Translation;
    use Behavior\Timestampable\Timestampable;
    use Behavior\SoftDeletable\SoftDeletable;

    use Accessor\Title;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;
}
