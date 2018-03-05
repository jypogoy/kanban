<?php

class TagsController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Manage your Tags');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->view->setTemplateAfter('content');        
    }

    public function listByBoardAction($boardId)
    {
        $this->view->disable();

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters['conditions'] = "board_id = " . $boardId;
        $parameters['order'] = "name ASC";
        
        $tags = Tag::find($parameters);
        
        $this->response->setJsonContent($tags);
        $this->response->send();        
    }
}

