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
     * @var string
     */
    public $serviceUndefined = 'Permissions object contains undefined service {{ service }}.';

    /**
     * @var string
     */
    public $permissionsNotArray = '{{ service }} permissions should be an array.';

    /**
     * @var string
     */
    public $permissionNotObject = '{{ service }} permission should be an object.';

    /**
     * @var string
     */
    public $permissionAttributeMissing = '{{ service }} permission object is missing attribute {{ attribute }}.';

    /**
     * @var string
     */
    public $subpermissionsNotArray = '{{ service }} subpermissions should be an array.';

    /**
     * @var string
     */
    public $subpermissionNotObject = '{{ service }} subpermission should be an object.';

    /**
     * @var string
     */
    public $subpermissionAttributeMissing = '{{ service }} subpermission object is missing attribute {{ attribute }}.';

    /**
     * @var string
     */
    public $subpermissionUndefined = '{{ service }} subpermission object contains undefined attribute {{ attribute }}.';


    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
