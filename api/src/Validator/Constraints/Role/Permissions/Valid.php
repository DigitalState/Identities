<?php

namespace App\Validator\Constraints\Role\Permissions;

use Symfony\Component\Validator\Constraint;

/**
 * Class Valid
 *
 * @Annotation
 */
final class Valid extends Constraint
{
    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
