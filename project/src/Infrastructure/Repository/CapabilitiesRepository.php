<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Capabilities\CapabilitiesRepoInterface;
use App\Infrastructure\Repository;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\Entity\Capabilities\Capabilities;

/**
 *Class CapabilitiesRepository
 */
class CapabilitiesRepository implements CapabilitiesRepoInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    /**
     * ArticleRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Capabilities::class);
    }



    /**
     * @param $capabilityName
     * @return Capabilities Return Capabilities objects
     */
    public function getCapabilityByName($capabilityName): Capabilities
    {

        $capability = $this->objectRepository->findOneBy(
            ['name' => $capabilityName]
        );
        return $capability;
    }

}
