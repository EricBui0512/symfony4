<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 5/5/19
 * Time: 5:26 PM
 */

namespace App\Domain\Entity\Context;

use App\Domain\Entity\Context\Context;


interface ContextRepoInteface
{
    /**
     * @param $id
     * @return Context
     */
    public function getObjectById(int $id): Context;

    /**
     * @param \App\Domain\Entity\Context\Context $context
     */
    public function createObject(Context $context): void;


    /**
     * @param $id
     */
    public function removeObject(Context $context):void;


}