<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class BoardForm extends Form
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
            $element = new Text("id");
            $this->add($element->setLabel("Id"));
        } else {
            $this->add(new Hidden("id"));
        }
        
        // Add a text element to capture the 'name'
        $name = new Text('name');
        $name->setLabel('Board Name');
        $name->setFilters(['striptags', 'string']);
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
