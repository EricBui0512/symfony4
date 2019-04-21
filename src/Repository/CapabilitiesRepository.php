<?php

namespace App\Repository;

use App\Entity\Capabilities;
use App\Repository\CustomizedServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Capabilities|null find($id, $lockMode = null, $lockVersion = null)
 * @method Capabilities|null findOneBy(array $criteria, array $orderBy = null)
 * @method Capabilities[]    findAll()
 * @method Capabilities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CapabilitiesRepository extends CustomizedServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Capabilities::class);
    }



    /**
     * @param $capabilityName
     * @return Capabilities Return Capabilities objects
     */
    public function getCapabilityByName($capabilityName) {

        $capability = $this->entityRepo->findOneBy(
            ['name' => $capabilityName]
        );
        return $capability;
    }

}
