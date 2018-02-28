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
        $organizationPersonas = $this->parse($this->getResource());

        foreach ($organizationPersonas as $organizationPersona) {
            $entity = new OrganizationPersona;
            $entity
                ->setOrganization($manager->getRepository(Organization::class)->findOneBy(['uuid' => $organizationPersona['organization']]))
                ->setUuid($organizationPersona['uuid'])
                ->setOwner($organizationPersona['owner'])
                ->setOwnerUuid($organizationPersona['owner_uuid'])
                ->setTitle($organizationPersona['title'])
                ->setData($organizationPersona['data']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
