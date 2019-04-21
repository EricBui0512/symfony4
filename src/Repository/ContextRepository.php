<?php

namespace App\Repository;

use App\Entity\Context;
use App\Repository\CustomizedServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Context|null find($id, $lockMode = null, $lockVersion = null)
 * @method Context|null findOneBy(array $criteria, array $orderBy = null)
 * @method Context[]    findAll()
 * @method Context[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContextRepository extends CustomizedServiceEntityRepository
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
        return $this->entityRepo->find($id);
    }



    /**
     * @param $id
     * @return bool
     */
    public function removeObject($id){
        $entityManager = $this->getDoctrine()->getManager();
        $context = $this->entityRepo->find($id);
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

        $context = $this->entityRepo->findOneBy(
            ['$context_levelId' => $contextLevelId],
            ['instance' => $instance]
        );
        return $context;
    }





}
