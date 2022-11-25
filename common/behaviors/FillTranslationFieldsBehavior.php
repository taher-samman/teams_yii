<?php

namespace common\behaviors;

use Yii;
use yii\db\BaseActiveRecord;
use yii\base\InvalidCallException;
use yii\base\UnknownPropertyException;

class FillTranslationFieldsBehavior extends \yii\behaviors\AttributeBehavior
{
    public $fields;  // 'attribute_code' => 'name'
    public $translationClass;
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_AFTER_INSERT => [$this->fields],
                BaseActiveRecord::EVENT_AFTER_UPDATE => [$this->fields],
                BaseActiveRecord::EVENT_AFTER_FIND => [$this->fields],
            ];
        }
    }

    protected function getValue($event)
    {
        $postData = post(explode('\\models\\', $this->translationClass)[1]);
        switch ($event->name) {
            case BaseActiveRecord::EVENT_AFTER_INSERT:
                foreach ($this->fields as $field => $value) {
                    if (!$this->insert($postData, $field, $value)) {
                        $this->owner->delete();
                        Yii::$app->session->removeAllFlashes();
                        setFlash('error', 'Institution Not Saved!!');
                    }
                }
                break;
            case BaseActiveRecord::EVENT_AFTER_UPDATE:
                foreach ($this->fields as $field => $value) {
                    $this->update($postData, $field, $value);
                }
                break;
        }
    }
    public function insert($postData, $field, $value)
    {
        if (isset($postData[$field][$value])) {
            $institutionTranslation = new $this->translationClass();
            $institutionTranslation->attribute_code = $value;
            $institutionTranslation->entity_id = $this->owner->id;
            $institutionTranslation->language = Yii::$app->language;
            $institutionTranslation->value = $postData[$field][$value];
            if ($institutionTranslation->save()) {
                return true;
            }
        }
        return false;
    }
    public function update($postData, $field, $value)
    {
        if (isset($postData[$field][$value])) {
            $institutionTranslation = $this->translationClass::find()
                ->where(['entity_id' => $this->owner->id, 'language' => Yii::$app->language, 'attribute_code' => $value])->one();
            if (!is_null($institutionTranslation)) {
                $institutionTranslation->value = $postData[$field][$value];
                $institutionTranslation->save();
            } else {
                $this->insert($postData, $field, $value);
            }
        }
    }
    public function __get($name)
    {
        foreach ($this->fields as $field => $value) {
            if ($name === $value) {
                $institutionTranslation = $this->translationClass::find()
                    ->where(['entity_id' => $this->owner->id, 'language' => Yii::$app->language, 'attribute_code' => $value])->one();
                if (!is_null($institutionTranslation)) {
                    return $institutionTranslation->value;
                }
                return '';
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
        foreach ($this->fields as $field => $value) {
            if ($name === $value) {
                return true;
            }
        }
    }
}
