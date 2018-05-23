<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Organization;
use AppBundle\Entity\OrganizationPersona;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

/**
 * Class OrganizationPersonaFixture
 */
abstract class OrganizationPersonaFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $organizationPersona = new OrganizationPersona;
            $organizationPersona
                ->setOrganization($manager->getRepository(Organization::class)->findOneBy(['uuid' => $object->organization]))
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);
            $manager->persist($organizationPersona);
            $manager->flush();
        }
    }
}
