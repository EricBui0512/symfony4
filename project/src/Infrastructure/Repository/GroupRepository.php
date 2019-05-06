<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Context\Context;
use App\Domain\Entity\Group\ChatGroup;
use App\Domain\Entity\Group\GroupUsersRepoInterface;
use App\Application\Utils\ConstantTerms;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\Entity\Group\GroupRepoInterface;

/**
 * Class GroupRepository
 * @package App\Infrastructure\GroupRepository
 */
class GroupRepository implements GroupRepoInterface
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
        $this->objectRepository = $this->entityManager->getRepository(ChatGroup::class);
    }


    /**
     * @param $data
     * @return int|null
     */
    public function createObject(ChatGroup $group): void
    {

        $this->entityManager->persist($group);
        $this->entityManager->flush();



//        // create context instance
//        $contextData = array();
//        $contextlevelInstance = new ContextLevelsRepository();
//        $context = new Context();
//        $contextData['context_level_id'] = $contextlevelInstance->getContextByName(ConstantTerms::GROUP_CONTEXT)->getId();
//        $contextData['instance'] = $group->getId();
//        $contextRepoInstance = new ContextRepository();

        //return ($contextRepoInstance->createObject($data) != null) ? $group->getId() : null;
    }




    /**
     * @param Group $group
     */
    public function removeObject(ChatGroup $group): void
    {

        $this->entityManager->remove($group);
        $this->entityManager->flush();
    }

    public function findAll(): array
    {

    }

    /**
     * @param $id
     * @return bool
     */
    public function isExistGroup($id) {
        return ($this->objectRepository->find($id) != null)? true : false;

    }



    /**
     * @param $id
     */
    public function getObjectById(int $id): ?ChatGroup
    {
        return $this->objectRepository->find($id);
    }

}
