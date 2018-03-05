<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class BoardsController extends ControllerBase
{

    const DEFAULT_PAGE = 1;
    const ITEMS_PER_PAGE = 10;    
    const DEFAULT_SORT_FIELD = 'name';
    const DEFAULT_SORT_DIRECTION = 'DESC';

    public function initialize()
    {
        $this->tag->setTitle('Manage your Boards');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->persistent->parameters = null;
        $itemsPerPage = self::ITEMS_PER_PAGE;
        $currentPage = self::DEFAULT_PAGE;
        $keyword = null;
        $sortField = null;
        $sortDirection = null;

        $boards = array();
        $currentSelected = 0;
        if ($this->request->isPost()) {
            $currentPage = trim($this->request->getPost("currentPage")) != '' ? $this->request->getPost("currentPage") : $currentPage; 
            $itemsPerPage = trim($this->request->getPost("itemsPerPage")) != '' ? $this->request->getPost("itemsPerPage") : $itemsPerPage;
            $keyword = $this->request->getPost("keyword");
            $sortField = trim($this->request->getPost("sortField")) != '' ? $this->request->getPost("sortField") : $sortField;
            $sortDirection = trim($this->request->getPost("sortDirection")) != '' ? $this->request->getPost("sortDirection") : $sortDirection;               
             
            if (strlen($currentPage) > 0) {                
                if ($this->session->get('page') != $currentPage) {
                    $this->session->set('page', $currentPage);
                }                        
            } else {                
                $currentPage = self::DEFAULT_PAGE;
                $this->session->set('page', $currentPage);
            } 

            if (strlen($itemsPerPage) > 0) {                
                if ($this->session->get('itemsPerPage') != $itemsPerPage) {
                    $this->session->set('itemsPerPage', $itemsPerPage);
                }                        
            } else {                
                $itemsPerPage = self::ITEMS_PER_PAGE;
                $this->session->set('itemsPerPage', $itemsPerPage);
            } 

            if (strlen($keyword) > 0) {                
                if ($this->session->get('keyword') != $keyword) {
                    $this->session->set('keyword', $keyword);
                }                        
            } else {                
                $this->session->set('keyword', null);
            }   

            if (strlen($sortField) > 0) {
                if ($this->session->get('sortField') != $sortField) {
                    $this->session->set('sortField', $sortField);
                }
            } else {
                $sortField = self::DEFAULT_SORT_FIELD;
                $this->session->set('sortField', $sortField);
            }    

            if (strlen($sortDirection) > 0) {
                if ($this->session->get('sortDirection') != $sortDirection) {
                    $this->session->set('sortDirection', $sortDirection);
                }  
            } else {
                $sortDirection = self::DEFAULT_SORT_DIRECTION;
                $this->session->set('sortDirection', $sortDirection);
            }    

        } else {
            if (strlen($itemsPerPage) > 0) {
                $this->session->set('itemsPerPage', $itemsPerPage);
            } else {
                if ($this->session->get('itemsPerPage') != null) {
                    $itemsPerPage = $this->session->get('itemsPerPage');
                } else {
                    $itemsPerPage = self::ITEMS_PER_PAGE;
                    $this->session->set('itemsPerPage', $itemsPerPage);
                }
            }

            if (strlen($keyword) > 0) {
                $this->session->set('keyword', $keyword);                
            } else {
                if ($this->session->get('keyword') != null) {
                    $keyword = $this->session->get('keyword');
                }
            }

            if (strlen($sortField) > 0) {
                $this->session->set('sortField', $sortField);
            } else {
                if ($this->session->get('sortField') != null) {
                    $sortField = $this->session->get('sortField');
                } else {
                    $sortField = self::DEFAULT_SORT_FIELD;
                    $this->session->set('sortField', $sortField);
                }
            }

            if (strlen($sortDirection) > 0) {
                $this->session->set('sortDirection', $sortDirection);
            } else {
                if ($this->session->get('sortDirection') != null) {
                    $sortDirection = $this->session->get('sortDirection');
                } else {
                    $sortDirection = self::DEFAULT_SORT_DIRECTION;
                    $this->session->set('sortDirection', $sortDirection);
                }
            }
        }
        
        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["conditions"] = "name LIKE '%" . $keyword . "%' OR description LIKE '%" . $keyword . "%'";
        $parameters["order"] = $sortField . ' ' . $sortDirection;        

        try {
            // The data set to paginate
            $boards = Board::find($parameters);
            
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
        
        $totalItems = count($boards);

        // Create a Model paginator, show number of rows by page starting from $currentPage
        $paginator = null;
        $itemsPerPage = $itemsPerPage > -1 ? $itemsPerPage : $totalItems;
        $paginator = new Paginator([
            'data' => $boards,
            'limit'=> $itemsPerPage,
            'page' => $currentPage
        ]);

        // Get the paginated results
        $page = $paginator->getPaginate();
        
        $start = ($page->current - 1) * $itemsPerPage + 1;
        $end = $totalItems;

        if ($itemsPerPage < $page->items) {
            $end = $itemsPerPage * $page->current;
            if ($end > $totalItems) {
                $end = $totalItems;
            }
        }

        $this->view->itemsPerPage = $itemsPerPage;
        $this->view->keyword = $keyword;
        $this->view->sortField = $sortField;
        $this->view->sortDirection = $sortDirection;
        $this->view->page = $page;
        $this->view->start = $start;
        $this->view->end = $end;
        $this->view->totalItems = $totalItems;
        $this->view->currentPage = $currentPage;
    }
    
    /**
     * Shows the form to create a new board.
     */
    public function newAction()
    {
        $this->view->form = new BoardForm(null, array('edit' => true));
    }

    /**
     * Creates a new board.
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "boards",
                    "action"     => "index",
                ]
            );
        }

        $form = new BoardForm();
        $board = new Board();
        $messages = [];

        $data = $this->request->getPost();
        if (!$form->isValid($data, $board)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
                $messages[count($messages)] = $message;
            }

            $this->view->messages = $messages;
            return $this->dispatcher->forward(
                [
                    "controller" => "boards",
                    "action"     => "new",
                ]
            );
        }

        if ($board->save() == false) {
            foreach ($board->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "boards",
                    "action"     => "new",
                ]
            );
        }

        $this->persistent->parameters = null;    
        $this->session->remove('keyword');                       

        $form->clear();        

        $this->flashSession->success("Board <b>" . $board->name . "</b>  was created successfully.");

        $is_saveNew = $this->request->getPost('saveNew');
        if ($is_saveNew == 'true') {
            return $this->response->redirect('boards/new');
        } else {
            return $this->response->redirect('boards');
        } 
    }

    /**
     * Edits a board based on its id.
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $board = Board::findFirstById($id);
            if (!$board) {
                $this->flashSession->error("Board was not found.");
                return $this->response->redirect('boards');
            }

            $this->view->board = $board;
            $this->view->form = new BoardForm($board, array('edit' => true));
        }
    }

    /**
     * Updates a board record on display.
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "boards",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");

        $board = Board::findFirstById($id);
        if (!$board) {
            $this->flashSession->error("Board does not exists.");
            return $this->response->redirect('boards');
        }

        $form = new BoardForm($board);
        $this->view->form = $form;

        $data = $this->request->getPost();

        if (!$form->isValid($data, $board)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "boards",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        if ($board->save() == false) {
            foreach ($board->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "boards",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        $form->clear();

        $this->flashSession->success("Board <b>" . $board->name . "</b>  was updated successfully.");

        return $this->response->redirect('boards');
    }

    /**
     * Deletes a board.
     * 
     * @param int $id
     */
    public function deleteAction($id)
    {
        $messages = [];
        $board = Board::findFirstById($id);
        if (!$board) {
            $this->flashSession->error("Board was not found.");
            return $this->response->redirect('boards');
        }

        if (!$board->delete()) {
            foreach ($board->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "boards",
                    "action"     => "search",
                ]
            );
        }

        $this->flashSession->success("Board <b>" . $board->name . "</b> was deleted successfully.");

        return $this->response->redirect('boards');
    }

    /**
     * Retrieves the board profile.
     * 
     * @param int $id
     */
    public function profileAction($id)
    {
        $board = Board::findFirstById($id);
        if (!$board) {
            $this->flashSession->error("Board was not found.");
            return $this->response->redirect('boards');
        }

        $workflows = Workflow::findByboardId($id);  
        $form = new WorkflowForm(new Workflow(), array('edit' => true));

        $this->view->board = $board;
        $this->view->workflows = $workflows;
        $this->view->form = $form;
        $this->view->setTemplateAfter('board');
    }

    public function settingsAction($id)
    {
        $board = Board::findFirstById($id);
        if (!$board) {
            $this->flashSession->error("Board was not found.");
            return $this->response->redirect('boards');
        }

        $workflows = Workflow::findByboardId($id);  
        $workflowForm = new WorkflowForm(new Workflow(), array('edit' => true));
        $this->view->workflowForm = $workflowForm;
        $this->view->workflows = $workflows;
        

        $tags = Tag::findByboardId($id);  
        $tagForm = new TagForm(new Tag(), array('edit' => true));
        $this->view->tagForm = $tagForm;
        $this->view->tags = $tags;

        $this->view->board = $board;               

        $this->view->setTemplateAfter('board');
    }

    public function boardAction($id)
    {
        $board = Board::findFirstById($id);
        if (!$board) {
            $this->flashSession->error("Board was not found.");
            return $this->response->redirect('boards');
        }

        $workflows = Workflow::findByboardId($id);  
        $form = new WorkflowForm(new Workflow(), array('edit' => true));

        $this->view->board = $board;
        $this->view->workflows = $workflows;
        $this->view->form = $form;
        $this->view->setTemplateAfter('board');
    }
}

