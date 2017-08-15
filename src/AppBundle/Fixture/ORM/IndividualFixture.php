<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\BusinessUnit;
use AppBundle\Entity\Individual;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ORM\ResourceFixture;
use LogicException;

/**
 * Class IndividualFixture
 */
abstract class IndividualFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $individuals = $this->parse($this->getResource());

        foreach ($individuals as $individual) {
            $entity = new Individual;
            $entity
                ->setUuid($individual['uuid'])
                ->setOwner($individual['owner'])
                ->setOwnerUuid($individual['owner_uuid']);

            foreach ($individual['business_units'] as $businessUnit) {
                $businessUnit = $manager->getRepository(BusinessUnit::class)->findOneBy(['uuid' => $businessUnit]);

                if (!$businessUnit) {
                    throw new LogicException('Business unit does not exist.');
                }

                $entity->addBusinessUnit($businessUnit);
            }

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
