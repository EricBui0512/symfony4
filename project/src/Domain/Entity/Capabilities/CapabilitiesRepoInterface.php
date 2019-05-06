<?php
/**
 * Created by PhpStorm.
 * User: tuongbui
 * Date: 5/5/19
 * Time: 6:38 PM
 */

namespace App\Domain\Entity\Capabilities;


interface CapabilitiesRepoInterface
{
    /**
     * @param $capabilityName
     * @return Capabilities
     */
    public function getCapabilityByName($capabilityName): Capabilities;

}