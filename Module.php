<?php
namespace ZFLadenka;

use Zend\Module\Consumer\AutoloaderProvider,
    Zend\EventManager\StaticEventManager;

class Module implements AutoloaderProvider
{
	public function init()
    {
    	$events = StaticEventManager::getInstance();
        $events->attach('Zend\Mvc\Application', 'dispatch.error', function($e) {	
        	require_once __DIR__ . DIRECTORY_SEPARATOR . 'Nette' . DIRECTORY_SEPARATOR . 'Debugger.php';
        	\Debugger::enable();
        	\Debugger::toStringException($e->getParam('exception'));
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