<?php

namespace common\models;

use common\behaviors\FillTranslationFieldsBehavior;
use common\behaviors\GenerateAttributesBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "colleges".
 *
 * @property int $id
 * @property int $institution_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Institutions $institution
 * @property Specializations[] $specializations
 */
class Colleges extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colleges';
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
                'translationClass' => CollegesTranslations::class
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['institution_id'], 'required'],
            // [['institution_id'], 'integer'],
            [['status'], 'default', 'value' => Types::STATUS_ENABLED],
            [['created_at', 'updated_at'], 'safe'],
            [['institution_id'], 'exist', 'skipOnError' => true, 'targetClass' => Institutions::class, 'targetAttribute' => ['institution_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'institution_id' => 'Institution ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Institution]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstitution()
    {
        return $this->hasOne(Institutions::class, ['id' => 'institution_id']);
    }

    /**
     * Gets query for [[Specializations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecializations()
    {
        return $this->hasMany(Specializations::class, ['college_id' => 'id']);
    }
}
