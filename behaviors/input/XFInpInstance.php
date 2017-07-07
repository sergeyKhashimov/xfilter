<?php

namespace sergey_h\xfilter\behaviors\input;

/**
 * Created by PhpStorm.
 * User: serega
 * Date: 07.07.17
 * Time: 12:12
 */
class XFInpInstance
{

    /**
     * @var
     */
    protected $name;
    /**
     * @var
     */
    protected $operator;
    /**
     * @var
     */
    protected $value;

    /**
     * @var
     */
    protected $config;

    /**
     * @var
     */
    protected $queryLine;

    /**
     * XFInpInstance constructor.
     *
     * @param $params
     */
    public function __construct($params)
    {
        $this->name = $params['name'];
        $this->operator = $params['operator'];
        $this->value = $params['value'];
    }

    /**
     *
     */
    public function getBuildQueryLine()
    {

    }

    /**
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param mixed $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getQueryLine()
    {
        return $this->queryLine;
    }

    /**
     * @param mixed $queryLine
     */
    public function setQueryLine($queryLine)
    {
        $this->queryLine = $queryLine;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

}