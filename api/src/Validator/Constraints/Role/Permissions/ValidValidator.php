<?php

namespace App\Validator\Constraints\Role\Permissions;

use Ds\Component\Api\Collection\ServiceCollection;
use Ds\Component\Acl\Model\Permission;
use JsonSchema\Validator;
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
 *             "scope": {
 *                 "type": "owned_by",
 *                 "entity": "BusinessUnit",
 *                 "entityUuid": "aff1370c-9cb7-432d-a608-57021637f278"
 *             },
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
        $validator = new Validator;
        $property = '
            {
                "type": "array",
                "items": {
                    "type": "array",
                    "additionalProperties": false,
                    "required": ["scope", "permissions"],
                    "properties": {
                        "scope": {
                            "type": "array",
                            "additionalProperties": false,
                            "properties": {
                                "operator": {
                                    "type": "string",
                                    "enum": ["and", "or"]
                                },
                                "conditions": {
                                    "type": "array"
                                },
                                "type": {
                                    "type": "string",
                                    "enum": ["generic", "object", "identity", "owner", "session", "property"]
                                },
                                "entity": {
                                    "type": "string"
                                },
                                "entityUuid": {
                                    "type": ["string", "null"]
                                },
                                "property": {
                                    "type": "string"
                                },
                                "comparison": {
                                    "type": "string",
                                    "enum": ["eq", "neq"]
                                },
                                "value": {}
                            }
                        },
                        "permissions": {
                            "type": "array",
                            "items": {
                                "type": "array",
                                "additionalProperties": false,
                                "required": ["key", "attributes"],
                                "properties": {
                                    "key": {
                                        "type": "string"
                                    },
                                    "attributes": {
                                        "type": "array",
                                        "items": {
                                            "type": "string",
                                            "enum": ["BROWSE", "READ", "EDIT", "ADD", "DELETE", "EXECUTE"]
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        ';
        $schema = json_decode('
            {
                "type": "array",
                "additionalProperties": false,
                "properties": {
                    "assets": ' . $property . ',
                    "authentication": ' . $property . ',
                    "cases": ' . $property . ',
                    "cms": ' . $property . ',
                    "forms": ' . $property . ',
                    "identities": ' . $property . ',
                    "microservice": ' . $property . ',
                    "records": ' . $property . ',
                    "services": ' . $property . ',
                    "tasks": ' . $property . ',
                    "tenants": ' . $property . '
                }
            }
        ');
        $permissions = $role->getPermissions();
        $validator->validate($permissions, $schema);

        if (!$validator->isValid()) {
            foreach ($validator->getErrors() as $error) {
                $this->context
                    ->buildViolation($error['message'])
                    ->atPath('permissions.' . $error['property'])
                    ->addViolation();
            }
        }
    }
}
