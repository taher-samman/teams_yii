<?php

namespace common\behaviors;

use common\models\Types;
use yii\base\InvalidCallException;
use yii\base\UnknownPropertyException;
use yii\db\BaseActiveRecord;


class GenerateAttributesBehavior extends \yii\behaviors\AttributeBehavior
{
    public $attributes;

    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_AFTER_FIND => [$this->attributes],
            ];
        }
    }

    public function __get($name)
    {
        foreach ($this->attributes as $attribute) {
            if ($name === $attribute) {
                if ($name === 'status_label') {
                    return Types::findStatus($this->owner->status);
                }
            }
        }
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } elseif (method_exists($this, 'set' . $name)) {
            throw new InvalidCallException('Getting write-only property: ' . get_class($this) . '::' . $name);
        }

        throw new UnknownPropertyException('Getting unknown property: ' . get_class($this) . '::' . $name);
    }
    public function canGetProperty($name, $checkVars = true)
    {
        foreach ($this->attributes as $attribute) {
            if ($name === $attribute) {
                return true;
            }
        }
    }
}
