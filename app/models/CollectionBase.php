<?php

namespace Backend\Models;

use MongoInt32;
use Phalcon\Mvc\Collection;

class CollectionBase extends Collection
{

    /**
     * @param $id
     * @return $this
     */
    public static function findByIntID($id)
    {
        return self::findFirst([
            [
                "_id" => intval($id)
            ]
        ]);
    }

    public static function get32Int($int)
    {
        return new MongoInt32($int);
    }

    public static function allEntry()
    {
        return self::find();
    }

//    public abstract static function initSave($model);

    public static function initCSV($model) {
        return self::initSave($model);
    }

    public static function deleteAll() {
        $ok = true;
        foreach (self::find() as $self) {
            if (($ok = $self->delete()) == false) {
                break;
            }
        }
        return $ok;
    }

    public static function getKeywords($queryString)
    {
        $keywords = [];
        // Separate the keywords
        $nocomma = explode(',', $queryString);
        $nospace = [];
        foreach ($nocomma as $fragment) {
            array_push($nospace, explode(' ', $fragment));
        }
        foreach ($nospace as $speckle) {
            foreach ($speckle as $molecule) {
                if (strlen($molecule) > 1) array_push($keywords, preg_quote($molecule, '/'));
            }
        }
        // Construct regex string
        $regex = '';
        $i = 0;
        foreach ($keywords as $keyword) {
            if ($i != 0) $regex .= '|';
            $regex .= $keyword;
            $i++;
        }
        return $keywords;
    }

    public static function getRegex($keywords)
    {
        $regex = '';
        $i = 0;
        foreach ($keywords as $keyword) {
            if ($i != 0) $regex .= '|';
            $regex .= $keyword;
            $i++;
        }
        return $regex;
    }

    public static function getMongoRegex($fieldNames, $regex)
    {
        $mongoRegex = [
            '$or' => []
        ];
        foreach ($fieldNames as $fieldName) {
            $mongoRegex['$or'][$fieldName] = [
                '$regex' => $regex,
                '$options' => 'i'
            ];
        }
        return $mongoRegex;
    }

    public function initialize()
    {
        $this->useImplicitObjectIds(false);
    }

    public function setIntID($id)
    {
        $this->setId(new MongoInt32($id));
    }

    public function setIntFK($fkName, $value)
    {
        $this->$fkName = new MongoInt32($value);
    }

}
