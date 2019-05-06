<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 5/5/19
 * Time: 10:15 PM
 */

namespace App\Domain\Entity\Context;


interface ContextLevelsRepoInterface
{
    /**
     * @param $contextLevelName
     * @return ContextLevels
     */
    public function getContextByName($contextLevelName): ContextLevels;

}