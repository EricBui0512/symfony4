<?php

namespace App\Repository;

use App\Entity\Context;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Context|null find($id, $lockMode = null, $lockVersion = null)
 * @method Context|null findOneBy(array $criteria, array $orderBy = null)
 * @method Context[]    findAll()
 * @method Context[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContextRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Context::class);
    }


    /**
     * @param $data
     * @return int|null
     */
    public function createObject($data) {
        $entityManager = $this->getDoctrine()->getManager();
        $context = new Context();
        $context->setContextLevelId($data['context_level_id']);
        $context->setIntance($data['instance']);
        $entityManager->persist($context);

        $entityManager->flush();
        return $context->getId();
    }

    /**
     * @param $id
     * @return Context return  context object
     */
    public function getObjectById($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $context = $entityManager->getRepository('App:Context')->find($id);
        return $context;
    }


    /**
     * @return Context[] return array of context object
     */
    public function getAllObjects() {
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository('App:Context')->findAll();
        return $users;
    }


    /**
     * @param $id
     * @return bool
     */
    public function removeObject($id){
        $entityManager = $this->getDoctrine()->getManager();
        $context = $entityManager->getRepository('App:Context')->find($id);
        $entityManager->remove($context);
        $entityManager->flush();
        return true;
    }

    /**
     * @param $contextLevelId
     * @param $instance
     * @return Context return  context object
     */
    public function getObjectByContextIdAndInstance($contextLevelId, $instance) {
        $entityManager = $this->getDoctrine()->getManager();

        $context = $entityManager->getRepository('App:Context')->findOneBy(
            ['$context_levelId' => $contextLevelId],
            ['instance' => $instance]
        );
        return $context;
    }




    // /**
    //  * @return Context[] Returns an array of Context objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Context
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
