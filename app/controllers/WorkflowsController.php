<?php

class WorkflowsController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Manage your Workflows');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->view->setTemplateAfter('content');        
    }

    public function createAction()
    {
        $form = new WorkflowForm();
        $workflow = new Workflow();        

        $data = $this->request->getPost();
        if (!$form->isValid($data, $workflow)) {
            foreach ($form->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            return $this->response->redirect('boards/profile/' . $data['board_id']);
        }

        if ($workflow->save() == false) {
            foreach ($workflow->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            return $this->response->redirect('boards/profile/' . $data['board_id']);
        }
         
        $this->flashSession->success("Workflow was created successfully.");       

        return $this->response->redirect('boards/profile/' . $data['board_id']);
    }    

    public function ajaxCreateAction()
    {
        $data = $this->request->getPost();        

        $workflow = new Workflow();
        $form = new WorkflowForm($workflow);
        if (!$form->isValid($data, $workflow)) {
            foreach ($form->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            exit;
        }

        if ($workflow->save() == false) {
            foreach ($workflow->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            exit;
        }
                
        $this::updateSequence();

        return "Workflow " . $data['name'] . " was created successfully.";  
    }    

    /**
     * API call for retrieving a particular record by id.
     * @param int $id
     */
    public function getAction($id)
    {
        $workflow = Workflow::findById($id);
        if (!$workflow) {
            $this->flash->error("Workflow was not found.");
            return $this->dispatcher->forward(
                [
                    "controller" => "boards",
                    "action"     => "profile",
                    "params"     => [$data['board_id']]
                ]
            );
        }

        $this->response->setJsonContent($workflow);
        $this->response->send();
        exit;
    }

    public function ajaxSaveAction()
    {
        $data = $this->request->getPost();
        $workflow = Workflow::findFirstById($data['id']); 
        $successMsg = "Workflow " . $workflow->name . " was updated successfully.";  

        $form = new WorkflowForm($workflow);
        if (!$form->isValid($data, $workflow)) {
            foreach ($form->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            exit;
        }

        if ($workflow->save() == false) {
            foreach ($workflow->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            exit;
        }
         
        $this::updateSequence();        

        return $successMsg;
    }

    public function saveAction()
    {
        $data = $this->request->getPost();
        $workflow = Workflow::findFirstById($data['id']); 

        $form = new WorkflowForm($workflow);
        if (!$form->isValid($data, $workflow)) {
            foreach ($form->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            return false;
        }

        if ($workflow->save() == false) {
            foreach ($workflow->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            return false;
        }
         
        $this->flashSession->success("Workflow " . $workflow->name . " was updated successfully.");    

        return $this->response->redirect('boards/profile/' . $data['board_id']);
    }

    /**     
     * API call that deletes a record by id.
     * @param int $id
     */
    public function deleteAction($id)
    {
        $workflow = Workflow::findFirstById($id);
        if (!$workflow) {
            $this->flashSession->error("Workflow was not found.");
            return $this->response->redirect('boards');
        }

        if (!$workflow->delete()) {
            foreach ($workflow->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "boards",
                    "action"     => "profile",
                    "params"     => [$workflow->board_id]
                ]
            );
        }
        
        $this->flashSession->success("Workflow <b>" . $workflow->name . "</b> was deleted successfully.");

        return $this->response->redirect("boards/profile/" . $workflow->board_id);
    }

    public function ajaxDeleteAction($id)
    {
        $workflow = Workflow::findFirstById($id); 
        if (!$workflow) {
            $this->flashSession->error("Workflow was not found.");
            return $this->response->redirect('boards');
        }

        $successMsg = "Workflow " . $workflow->name . " was deleted successfully.";  

        if (!$workflow->delete()) {
            foreach ($workflow->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            exit;
        }

        $this::updateSequence();
                
        return $successMsg;
    }

    public function updateSequence($boardId)
    {
        $workflows = WorkFlow::find([
            'condition' => 'board_id = ?1',
            'bind'      => [
                1 => $boardId
            ],
            'order'     => 'date_created ASC'            
        ]);
        $sequence = 1;
        foreach ($workflows as $workflow) {
            $workflow->sequence = $sequence;
            $workflow->save();
            $sequence++;
        }
    }

    /**
     * Ajax call to switch workflow sequences using move by drag and drop.
     */
    public function switchSequenceAction()
    {
        $this->view->disable();

        $currentWorkflow = Workflow::findFirstById($this->request->getQuery('current'));        
        $targetWorkflow = Workflow::findFirstById($this->request->getQuery('target'));

        $currentSequence = $currentWorkflow->sequence;
        $targetSequence = $targetWorkflow->sequence;

        $currentWorkflow->sequence = $targetSequence;
        $targetWorkflow->sequence = $currentSequence;
       
        if (!$currentWorkflow->save()) {
            $this->view->enable();
            foreach ($workflow->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "boards",
                    "action"     => "profile",
                    "params"     => [$currentWorkflow->board_id]
                ]
            );
        }

        if (!$targetWorkflow->save()) {
            $this->view->enable();
            foreach ($workflow->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "boards",
                    "action"     => "profile",
                    "params"     => [$targetWorkflow->board_id]
                ]
            );
        }
    }

    /**
     * API call that retrieves workflow records for a board.
     * @param int $boardId
     */
    public function listByBoardAction($boardId)
    {
        $this->view->disable();

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters['conditions'] = "board_id = " . $boardId;
        $parameters['order'] = "sequence ASC";
        
        $workflows = Workflow::find($parameters);
        
        $this->response->setJsonContent($workflows);
        $this->response->send();        
    }
    
}

