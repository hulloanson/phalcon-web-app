<?php
namespace Backend\Models;

class Test extends CollectionBase
{
    public $test_name;

    public $fk;

    public $fks;

    public static function testRegexSearch($strToMatch)
    {
        $safeStr = preg_quote($strToMatch, '/');
        return self::find(
            [
                'test_name' => [
                    '$regex' => '/',
                    '$options' => 'i'
                ]
            ]
        );
    }

    public static function initSave($test)
    {
        $testIns = new Test();
        $testIns->fk = self::get32Int($test['fk']);
        $testIns->fks = $test['fks'];
        $testIns->test_name = $test['test_name'];
        return $testIns->save();
    }

    public static function fkCount($id)
    {
        return self::count([
            'fk' => intval($id)
        ]);
    }

    public static function getAllNames()
    {
        return self::find([
            [],
            [
                'test_name' => 1,
                'fk' => 0,
                '_id' => 0
            ]
        ]);
    }
}