<?php

namespace Ds\Bundle\AnonymousBundle\Entity;

use Ds\Bundle\PersonaBundle\Entity\PersonaTranslation;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AnonymousPersonaTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="ds_anonymous_persona_trans")
 */
class AnonymousPersonaTranslation extends PersonaTranslation
{
    // This behavior must be included at the same level as the child class.
    use Behavior\Translatable\Translation;
}
