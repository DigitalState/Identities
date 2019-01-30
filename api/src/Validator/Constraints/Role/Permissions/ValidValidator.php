<?php

namespace App\Validator\Constraints\Role\Permissions;

use Ds\Component\Api\Collection\ServiceCollection;
use Ds\Component\Acl\Model\Permission;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class ValidValidator
 *
 * @example
 * <code>
 * {
 *     "identities": [
 *         {
 *             "scope": "owned_by",
 *             "entity": "BusinessUnit",
 *             "entityUuid": "aff1370c-9cb7-432d-a608-57021637f278",
 *             "permissions": [
 *                 {
 *                     "key": "individual",
 *                     "attributes": ["BROWSE", "READ"]
 *                 },
 *                 {
 *                     "key": "individual_uuid",
 *                     "attributes": ["BROWSE", "READ"]
 *                 }
 *             ]
 *         }
 *     ]
 * }
 * </code>
 */
final class ValidValidator extends ConstraintValidator
{
    /**
     * @var \Ds\Component\Api\Collection\ServiceCollection
     */
    protected $serviceCollection;

    /**
     * Constructor
     *
     * @param \Ds\Component\Api\Collection\ServiceCollection $serviceCollection
     */
    public function __construct(ServiceCollection $serviceCollection)
    {
        $this->serviceCollection = $serviceCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($role, Constraint $constraint)
    {
        foreach ($role->getPermissions() as $service => $permissions) {
            if (!$this->serviceCollection->containsKey($service.'.access')) {
                $this->context
                    ->buildViolation($constraint->serviceUndefined)
                    ->setParameter('{{ service }}', '"' . $service . '"')
                    ->atPath('permissions.' . $service)
                    ->addViolation();

                continue;
            }

            if (!is_array($permissions)) {
                $this->context
                    ->buildViolation($constraint->permissionsNotArray)
                    ->setParameter('{{ service }}', '"'.$service.'"')
                    ->atPath('permissions.'.$service)
                    ->addViolation();

                continue;
            }

            foreach ($permissions as $index => $permission) {
                if (!is_array($permission)) {
                    $this->context
                        ->buildViolation($constraint->permissionNotObject)
                        ->setParameter('{{ service }}', '"'.$service.'"')
                        ->atPath('permissions.'.$service.'['.$index.']')
                        ->addViolation();

                    continue;
                }

                foreach (['scope', 'entity', 'entityUuid', 'permissions'] as $attribute) {
                    if (!array_key_exists($attribute, $permission)) {
                        $this->context
                            ->buildViolation($constraint->permissionAttributeMissing)
                            ->setParameter('{{ service }}', '"'.$service.'"')
                            ->setParameter('{{ attribute }}', '"'.$attribute.'"')
                            ->atPath('permissions.'.$service.'['.$index.'].'.$attribute)
                            ->addViolation();
                    }

                    if ('permissions' === $attribute) {
                        if (!is_array($permission['permissions'])) {
                            $this->context
                                ->buildViolation($constraint->subpermissionsNotArray)
                                ->setParameter('{{ service }}', '"'.$service.'"')
                                ->atPath('permissions.'.$service.'['.$index.'].permissions')
                                ->addViolation();

                            continue;
                        }

                        foreach ($permission['permissions'] as $subindex => $subpermission) {
                            if (!is_array($subpermission)) {
                                $this->context
                                    ->buildViolation($constraint->subpermissionNotObject)
                                    ->setParameter('{{ service }}', '"'.$service.'"')
                                    ->atPath('permissions.'.$service.'['.$index.'].permissions['.$subindex.']')
                                    ->addViolation();

                                continue;
                            }

                            foreach (['key', 'attributes'] as $subattribute) {
                                if (!array_key_exists($subattribute, $subpermission)) {
                                    $this->context
                                        ->buildViolation($constraint->subpermissionAttributeMissing)
                                        ->setParameter('{{ service }}', '"'.$service.'"')
                                        ->setParameter('{{ attribute }}', '"'.$subattribute.'"')
                                        ->atPath('permissions.'.$service.'['.$index.'].'.$attribute.'['.$subindex.'].'.$subattribute)
                                        ->addViolation();

                                    continue;
                                }

                                if ('attributes' === $subattribute) {
                                    foreach ($subpermission['attributes'] as $item) {
                                        if (!in_array($item, [Permission::BROWSE, Permission::READ, Permission::EDIT, Permission::ADD, Permission::DELETE, Permission::EXECUTE])) {
                                            $this->context
                                                ->buildViolation($constraint->subpermissionUndefined)
                                                ->setParameter('{{ service }}', '"'.$service.'"')
                                                ->setParameter('{{ attribute }}', '"'.$item.'"')
                                                ->atPath('permissions.'.$service.'['.$index.'].'.$attribute.'['.$subindex.'].attributes')
                                                ->addViolation();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
