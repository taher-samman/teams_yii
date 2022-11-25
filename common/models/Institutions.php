<?php

namespace common\models;

use common\behaviors\FillTranslationFieldsBehavior;
use common\behaviors\GenerateAttributesBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

class Institutions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institutions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ],
            [
                'class' => GenerateAttributesBehavior::class,
                'attributes' => ['status_label']
            ],
            [
                'class' => FillTranslationFieldsBehavior::class,
                'fields' => ['attribute_code' => 'name'],
                'translationClass' => InstitutionsTranslations::class
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Colleges]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColleges()
    {
        return $this->hasMany(Colleges::class, ['institution_id' => 'id']);
    }

    /**
     * Gets query for [[InstitutionsTranslations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstitutionsTranslations()
    {
        return $this->hasMany(InstitutionsTranslations::class, ['entity_id' => 'id']);
    }
}
