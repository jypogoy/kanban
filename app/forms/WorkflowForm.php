<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class WorkflowForm extends Form
{

    /**
     * This method returns the default value for field 'csrf'
     */
    public function getCsrf()
    {
        return $this->security->getToken();
    }

    /**
     * Form initializer
     * 
     * @param Entity $entity
     * @param array $options
     */
    public function initialize($entity = null, $options = array())
    {
        if (!isset($options['edit'])) {
            $id = new Text("id");
            $id->setLabel("Id");            
            $this->add($id);
            $boardId = new Text("board_id");
            $this->add($boardId->setLabel("board Id"));
        } else {
            $this->add(new Hidden("id"));
            $this->add(new Hidden ("board_id"));
        }
        
        // Add a text element to capture the 'name'
        $name = new Text('name');
        $name->setLabel('Name');
        $name->setFilters(['striptags', 'string']);
        $name->setAttribute('required', 'true');
        $name->setAttribute('requiredMsg', 'Please specify a workflow name.');
        $name->addValidators([
            new PresenceOf([
                'message' => 'Name is required'
            ])
        ]);
        $this->add($name);

        $description = new TextArea('description');
        $description->setLabel('Description');
        $description->setFilters(['striptags', 'string']);        
        $this->add($description);      

        // Add a text element to put a hidden CSRF
        $this->add(
            new Hidden(
                'csrf'
            )
        );
    }
}
