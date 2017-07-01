<?php

namespace AppBundle\Entity;

use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class StaffPersonaTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="app_staff_persona_trans")
 */
class StaffPersonaTranslation extends PersonaTranslation
{
    // This behavior must be included at the same level as the child class.
    use Behavior\Translatable\Translation;
}
