<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'App\Controller\CapabilityGroupController' shared autowired service.

include_once $this->targetDirs[3].'/src/Controller/CapabilityGroupController.php';

return $this->services['App\Controller\CapabilityGroupController'] = new \App\Controller\CapabilityGroupController(($this->services['App\Repository\AuthorizationRepository'] ?? $this->load('getAuthorizationRepositoryService.php')));
