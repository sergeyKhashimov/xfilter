<?php

namespace sergey_h\xfilter\configurator;
use yii\db\ActiveRecord;

/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 7/6/17
 * Time: 10:31 PM
 */
abstract class XFilterDomain extends ActiveRecord
{
    protected  $query;
    protected  $fields;


    /** sets array of fields need to filter
     *
     * @return mixed
     */
    abstract function configure();

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

}