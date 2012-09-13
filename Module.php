<?php
namespace ZFLadenka;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module implements AutoloaderProviderInterface
{
	public function onBootstrap($e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach('dispatch.error', function($e) {
            if ($e->getParam('exception') instanceof \Exception) {
                require_once __DIR__ . DIRECTORY_SEPARATOR . 'Nette' . DIRECTORY_SEPARATOR . 'Debugger.php';
                \Debugger::enable();
                \Debugger::toStringException($e->getParam('exception'));
            }
        }, 1000);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                ),
            ),
        );
    }
}