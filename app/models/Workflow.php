<?php

class Workflow extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=2, nullable=true)
     */
    public $order;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=250, nullable=true)
     */
    public $description;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    public $board_id;

      /**
     *
     * @var integer
     * @Column(type="integer", length=2, nullable=true)
     */
    public $sequence;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $date_created;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("kanban");
        $this->setSource("workflow");
        $this->belongsTo('board_id', '\Board', 'id', ['alias' => 'Board']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'workflow';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Workflow[]|Workflow|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Workflow|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
