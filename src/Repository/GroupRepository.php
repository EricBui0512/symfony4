<?php

namespace App\Repository;

use App\Entity\Group;
use App\Repository\Interfaces\GroupRepoInterface;
use App\Utils\ConstantTerms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Group|null find($id, $lockMode = null, $lockVersion = null)
 * @method Group|null findOneBy(array $criteria, array $orderBy = null)
 * @method Group[]    findAll()
 * @method Group[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupRepository extends ServiceEntityRepository implements GroupRepoInterface
{
    private $group;
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Group::class);
    }

    public function __call($method, $args) {
        return call_user_func_array ( [
            $this->group,
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

        if ($contextRepoInstance->createObject($data)){
            return $group->getId();
        }
        return null;
    }

    /**
     * @param $id
     * @return Group return Group object
     */
    public function getObjectById($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $group = $entityManager->getRepository('App:Group')->find($id);
        return $group;
    }

    /**
     * @return Group[] return an array of Group objects
     */
    public function getAllObjects() {
        $entityManager = $this->getDoctrine()->getManager();
        $groups = $entityManager->getRepository('App:Group')->findAll();
        return $groups;
    }

    /**
     * @param $id
     * @return bool
     */
    public function removeObject($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $group = $entityManager->getRepository('App:Group')->find($id);
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
        $entityManager = $this->getDoctrine()->getManager();
        $group = $entityManager->getRepository('App:Group')->find($id);
        if (!$group) {
            return false;
        } else{
            return true;
        }
    }


    public function isEmptyGroup($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $group = $entityManager->getRepository('App:Group')->find($id);
        if ($group != null) {
            if($group->getUsersGroups() != null) {
                return false;
            }
        }
        return true;
    }


    // /**
    //  * @return Group[] Returns an array of Group objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Group
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
