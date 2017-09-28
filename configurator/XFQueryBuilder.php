<?php
/**
 * Created by PhpStorm.
 * User: serega
 * Date: 07.07.17
 * Time: 12:09
 */

namespace sergey_h\xfilter\configurator;


use sergey_h\xfilter\behaviors\input\XFInpInstance;
use sergey_h\xfilter\behaviors\XFilterBehavior;
use yii\db\ActiveQuery;


/**
 * Class XFQueryBuilder
 * @package app\modules\fl\xfilter\configurator
 */
class XFQueryBuilder
{

    /**
     * @param $query
     * @param $data
     *
     * @return mixed
     * @internal param XFInpInstance[] $input
     */
    public static function build(ActiveQuery $query, $data)
    {
        /** @var XFInpInstance $item */
        foreach ($data as $item) {
            $methodName = 'build' . str_replace(' ', '', ucwords(str_replace('_', ' ', $item->getOperator())));
            $filter = self::$methodName($item);
            $query->andFilterWhere($filter);
        }

        return $query;
    }


    /**
     * @param $query
     * @param $config
     *
     * @return ActiveQuery
     */
    public static function joinTables($query, $config)
    {
        $joined = [];
        /** @var XFilterBehavior $item */
        foreach ($config as $item) {
            if (in_array($item->getRelationName(), $joined) || $item->getRelationName() == false) continue;
            /** @var ActiveQuery $query */
            $query->joinWith($item->getRelationName(), false);
            $joined[] = $item->getRelationName();
        }
        return $query;
    }

    /**
     * @var array
     */
    public static $comparators = [
        'equal'            => '=',
        'not_equal'        => '<>',
        'greater_than'     => '>',
        'less_than'        => '<',
        'greater_or_equal' => '>=',
        'less_or_equal'    => '<=',
        'in'               => 'in',
        'not_in'           => 'not in',
        'between'          => 'between',
        'not_between'      => 'not between',
        'like'             => 'like',
        'not_like'         => 'not like',
        'null'             => '= null',
        'not_null'         => '<> null',
    ];

    /**
     * @var array
     */
    public static $rules = [
        'equal'            => '/^(.){1,20}$/',
        'not_equal'        => '/^(.){1,20}$/',
        'greater_than'     => '/^\d+$/',
        'less_than'        => '/^\d+$/',
        'greater_or_equal' => '/^\d+$/',
        'less_or_equal'    => '/^\d+$/',
        'between'          => '/^\d*(\.|,)*\d+,\s\d+(\.|,)*\d+$/',
        'not_between'      => '/^\d*(\.|,)*\d+,\s\d+(\.|,)*\d+$/',
        'in'               => '/(((.*),\s)+)|(^\d+(,*\s*)*$)/',
        'not_in'           => '/(((.*),\s)+)|(^\d+(,*\s*)*$)/',
        'like'             => '/(.*)/',
        'not_like'         => '/(.*)/',
        'null'             => '/^(.){1,20}$/',
        'not_null'         => '/^(.){1,20}$/',
    ];


    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildEqual(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();
        return ['=',$config->getAlias(),$input->getValue()];
    }


    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildNotEqual(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();
        return ['=',$config->getAlias(),$input->getValue()];
    }


    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildBetween(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();
        $arr = [
            'between',
            $config->getAlias(),
        ];
        $values = explode(', ', $input->getValue());
        foreach ($values as $item) {
            $arr[] = $item;
        }
        return $arr;
    }


    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildNotBetween(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();
        $arr = [
            'not between',
            $config->getAlias(),
        ];
        $values = explode(', ', $input->getValue());
        foreach ($values as $item) {
            $arr[] = $item;
        }
        return $arr;
    }


    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildLessOrEqual(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();
        return ['<=',$config->getAlias(),$input->getValue()];
    }

    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildGreaterOrEqual(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();
        return ['>=',$config->getAlias(),$input->getValue()];
    }

    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildNotLike(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();
        $val = '%'.$input->getValue().'%';
        return ['not like',$config->getAlias(),$val];
    }

    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildLike(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();
        $val = '%'.$input->getValue().'%';
        return ['like',$config->getAlias(),$val];
    }


    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildGreaterThan(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();
        return ['>',$config->getAlias(),$input->getValue()];
    }


    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildLessThan(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();
        return ['<',$config->getAlias(),$input->getValue()];
    }


    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildIn(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();

        $values = explode(', ', $input->getValue());

        return ['in', $config->getAlias(), $values] ;
    }

    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildNotIn(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();

        $values = explode(', ', $input->getValue());

        return ['not in', $config->getAlias(), $values] ;
    }


    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildNotNull(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();
        return ['<>',$config->getAlias(),null];
    }


    /**
     * @param XFInpInstance $input
     *
     * @return array
     */
    public static function buildNull(XFInpInstance $input)
    {
        /** @var XFilterBehavior $config */
        $config = $input->getConfig();
        return ['<>',$config->getAlias(),null];
    }


}