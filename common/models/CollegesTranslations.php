<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "colleges_translations".
 *
 * @property int $id
 * @property string $attribute_code
 * @property int $entity_id
 * @property string $language
 * @property string $value
 *
 * @property Colleges $entity
 */
class CollegesTranslations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colleges_translations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attribute_code', 'entity_id', 'language', 'value'], 'required'],
            [['entity_id'], 'integer'],
            [['attribute_code', 'language', 'value'], 'string', 'max' => 255],
            [['attribute_code', 'entity_id', 'language'], 'unique', 'targetAttribute' => ['attribute_code', 'entity_id', 'language']],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colleges::class, 'targetAttribute' => ['entity_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute_code' => 'Attribute Code',
            'entity_id' => 'Entity ID',
            'language' => 'Language',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[Entity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Colleges::class, ['id' => 'entity_id']);
    }
}
