<?php

namespace Ds\Bundle\StaffBundle\Entity;

use Ds\Bundle\PersonaBundle\Entity\PersonaTranslation;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class StaffPersonaTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="ds_staff_persona_trans")
 */
class StaffPersonaTranslation extends PersonaTranslation
{
    // This behavior must be included at the same level as the child class.
    use Behavior\Translatable\Translation;
}
