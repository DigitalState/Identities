<?php

namespace Ds\Bundle\IndividualBundle\Entity;

use Ds\Bundle\PersonaBundle\Entity\PersonaTranslation;
use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class IndividualPersonaTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="ds_individual_persona_trans")
 */
class IndividualPersonaTranslation extends PersonaTranslation
{
    // This behavior must be included at the same level as the child class.
    use Behavior\Translatable\Translation;
}
