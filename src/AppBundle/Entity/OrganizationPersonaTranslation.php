<?php

namespace AppBundle\Entity;

use Knp\DoctrineBehaviors\Model as Behavior;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OrganizationPersonaTranslation
 *
 * @ORM\Entity
 * @ORM\Table(name="app_organization_persona_trans")
 */
class OrganizationPersonaTranslation extends PersonaTranslation
{
    // This behavior must be included at the same level as the child class.
    use Behavior\Translatable\Translation;
}
