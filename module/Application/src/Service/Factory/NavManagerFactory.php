<?php
namespace Application\Service\Factory;

use Interop\Container\ContainerInterface;
use Application\Service\NavManager;
use User\Service\RbacManager;
use User\Service\EveSSOManager;

/**
 * This is the factory class for NavManager service. The purpose of the factory
 * is to instantiate the service and pass it dependencies (inject dependencies).
 */
class NavManagerFactory
{
    /**
     * This method creates the NavManager service and returns its instance. 
     */
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $authService = $container->get(\Laminas\Authentication\AuthenticationService::class);
        
        $viewHelperManager = $container->get('ViewHelperManager');
        $urlHelper = $viewHelperManager->get('url');
        
        $rbacManager = $container->get(RbacManager::class);
        
        $sso_manager = $container->get(EveSSOManager::class);
        
        return new NavManager($authService, $urlHelper, $rbacManager, $sso_manager);
    }
}
