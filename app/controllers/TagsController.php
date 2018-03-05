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
    
    public function createAction()
    {
        $data = $this->request->getPost();        

        $tag = new Tag();
        $form = new TagForm($tag);
        if (!$form->isValid($data, $tag)) {
            foreach ($form->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            exit;
        }

        if ($tag->save() == false) {
            foreach ($tag->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            exit;
        }
                
        return "Tag " . $data['name'] . " was created successfully.";  
    }  

    public function getAction($id)
    {
        $tag = Tag::findById($id);
        if (!$tag) {
            $this->flash->error("Tag was not found.");
            return $this->dispatcher->forward(
                [
                    "controller" => "boards",
                    "action"     => "profile",
                    "params"     => [$data['board_id']]
                ]
            );
        }

        $this->response->setJsonContent($tag);
        $this->response->send();
        exit;
    }

    public function saveAction()
    {
        $data = $this->request->getPost();
        $tag = Tag::findFirstById($data['id']); 
        $successMsg = "Tag " . $tag->name . " was updated successfully.";  

        $form = new TagForm($tag);
        if (!$form->isValid($data, $tag)) {
            foreach ($form->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            exit;
        }

        if ($tag->save() == false) {
            foreach ($tag->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            exit;
        }
         
        return $successMsg;
    }

    public function deleteAction($id)
    {
        $tag = Tag::findFirstById($id); 
        if (!$tag) {
            $this->flashSession->error("Tag was not found.");
            return $this->response->redirect('boards');
        }

        $successMsg = "Tag " . $tag->name . " was deleted successfully.";  

        if (!$tag->delete()) {
            foreach ($tag->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            exit;
        }

        return $successMsg;
    }
}

