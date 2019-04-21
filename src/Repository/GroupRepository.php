<?php

namespace App\Repository;

use App\Entity\Group;
use App\Repository\Interfaces\GroupRepoInterface;
use App\Utils\ConstantTerms;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Group|null find($id, $lockMode = null, $lockVersion = null)
 * @method Group|null findOneBy(array $criteria, array $orderBy = null)
 * @method Group[]    findAll()
 * @method Group[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupRepository extends CustomizedServiceEntityRepository implements GroupRepoInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Group::class);
    }

    public function __call($method, $args) {
        return call_user_func_array ( [
            $this->entityRepo,
            $method
        ], $args );
    }


    /**
     * @param $data
     * @return int|null
     */
    public function createObject($data) {
        $entityManager = $this->getDoctrine()->getManager();
        $group = new Group();
        $group->setName($data["name"]);
        $entityManager->persist($group);

        $entityManager->flush();

        // create context instance
        $contextData = array();
        $contextlevelInstance = new ContextLevelsRepository();
        $contextData['context_level_id'] = $contextlevelInstance->getContextByName(ConstantTerms::GROUP_CONTEXT)->getId();
        $contextData['instance'] = $group->getId();
        $contextRepoInstance = new ContextRepository();

        return ($contextRepoInstance->createObject($data) != null) ? $group->getId() : null;
    }

    /**
     * @param $id
     * @return Group return Group object
     */
    public function getObjectById($id)
    {
        return $this->entityRepo->find($id);
    }



    /**
     * @param $id
     * @return bool
     */
    public function removeObject($id) {

        $group = $this->entityRepo->find($id);
        if ($group != null) {
            $contextlevelInstance = new ContextLevelsRepository();
            $contextLevelId = $contextlevelInstance->getContextByName(ConstantTerms::GROUP_CONTEXT)->getId();
            $contextRepo = new ContextRepository();
            $contextInstance = $contextRepo->getObjectByContextIdAndInstance($contextLevelId, $group->id);
            if($contextRepo->removeObject($contextInstance->getId())){
                return true;
            }
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isExistGroup($id) {
        return ($this->entityRepo->find($id) != null)? true : false;
    }


    public function isEmptyGroup($id)
    {
        $group = $this->entityRepo->find($id);
        return (($group != null) && ($group->getUsersGroups() != null)) ? false : true;
    }

}
