<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected function initialize()
    {
        $this->tag->prependTitle('Kanban | ');
        $this->view->setTemplateAfter('main');
    }

    public function beforeExecuteRoute($dispatcher)
    {
        // Re-route to the login page when session expires.
        if ($this->session->isStarted() && !$this->session->has('auth')) {
            $module = $this->router->getModuleName();
            if ($dispatcher->getControllerName() != 'session') {
                $dispatcher->forward(array('controller' => 'session', 'action' => 'index'));
                return false;
            }            
        }   
    }

}
