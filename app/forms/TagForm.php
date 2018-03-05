<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;

class TagForm extends Form
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
            $this->add($boardId->setLabel("Board Id"));
        } else {
            $this->add(new Hidden("id"));
            $this->add(new Hidden("board_id"));
        }
        
        // Add a text element to capture the 'name'
        $name = new Text('name');
        $name->setLabel('Name');
        $name->setFilters(['striptags', 'string']);
        $name->setAttribute('required', 'true');
        $name->setAttribute('requiredMsg', 'Please specify a tag name.');
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

        $color = new Select(            
            'Color',
            [
                ''          => '- Choose a color -',
                'Red'       => 'Red',
                'Orange'    => 'Orange',
                'Yellow'    => 'Yellow',
                'Olive'     => 'Olive',
                'Green'     => 'Green',
                'Teal'      => 'Teal',
                'Blue'      => 'Blue',
                'Violet'    => 'Violet',
                'Purple'    => 'Purple',
                'Pink'      => 'Pink',
                'Brown'     => 'Brown',
                'Grey'      => 'Grey',
                'Black'     => 'Black' 
            ]          
        );
        $color->setAttribute('class', 'ui dropdown');
        $this->add($color);

        // Add a text element to put a hidden CSRF
        $this->add(
            new Hidden(
                'csrf'
            )
        );
    }
}
