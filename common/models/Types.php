<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class Types extends Model
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    static $types = [
        [
            'id' => 1,
            'name' => 'University',
            'has_specializations' => true
        ],
        [
            'id' => 2,
            'name' => 'School',
            'has_specializations' => false
        ],
    ];
    static function findStatus($id)
    {
        switch ($id) {
            case 1:
                return 'Enabled';
                break;

            case 0:
                return 'Disabled';
                break;
        }
    }
    static function findType($id)
    {
        foreach (self::$types as $type) {
            if ($type['id'] === $id) {
                return $type;
            }
        }
        return null;
    }
    static function getTypes()
    {
        $types = [];
        foreach (self::$types as $type) {
            $types[$type['id']] = $type['name'];
        }
        return $types;
    }
}
