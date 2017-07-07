<?php

namespace sergey_h\xfilter\behaviors;

/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 7/6/17
 * Time: 10:50 PM
 */
abstract class XFilterBehavior
{
    /**
     *
     */
    const FLOAT = 'float';
    /**
     *
     */
    const FLAG = 'flag';
    /**
     *
     */
    const STRING = 'string';

    /**
     * @var
     */
    protected $fieldName;
    /**
     * @var
     */
    protected $relationName;
    /**
     * @var
     */
    protected $alias;
    /**
     * @var
     */
    protected $label;

    /**
     * XFilterBehavior constructor.
     *
     * @param string $fieldName
     * @param bool|string $relationName
     * @param string $alias
     * @param string $label
     */
    public function __construct($fieldName, $relationName = false, $alias, $label)
    {

        $this->fieldName = $fieldName;
        $this->relationName = $relationName;
        $this->alias = $alias;
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    abstract function getType();

}