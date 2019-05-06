<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Context\ContextRepoInteface;
use App\Domain\Entity\Context\Context;
use App\Repository\CustomizedServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
*/
class ContextRepository implements ContextRepoInteface
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
        $this->objectRepository = $this->entityManager->getRepository(Context::class);
    }



    /**
     * @param Context $context
     */
    public function createObject(Context $context): void
    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $context = new Context();
//        $context->setContextLevelId($data['context_level_id']);
//        $context->setIntance($data['instance']);
//        $entityManager->persist($context);
//
//        $entityManager->flush();
//
//
//        return $context->getId();

        $this->entityManager->persist($context);
        $this->entityManager->flush();

    }

    /**
     * @param $id
     * @return Context
     */
    public function getObjectById(int $id): Context
    {
        return $this->objectRepository->find($id);
    }


    /**
     * @param $id
     */
    public function removeObject(Context $context): void
    {
        $this->entityManager->remove($context);
        $this->entityManager->flush();

    }

    /**
     * @param $contextLevelId
     * @param $instance
     * @return Context return  context object
     */
    public function getObjectByContextIdAndInstance($contextLevelId, $instance): Context
    {

        $context = $this->entityRepo->findOneBy(
            ['$context_levelId' => $contextLevelId],
            ['instance' => $instance]
        );
        return $context;
    }





}
