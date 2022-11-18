<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "grades".
 *
 * @property int $id
 * @property string $name
 * @property int $specialization_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Semesters[] $semesters
 * @property Specializations $specialization
 */
class Grades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grades';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'specialization_id', 'created_at', 'updated_at'], 'required'],
            [['specialization_id'], 'integer'],
            [['status'], 'default', 'value' => Types::STATUS_ENABLED],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specializations::class, 'targetAttribute' => ['specialization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'specialization_id' => 'Specialization ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Semesters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemesters()
    {
        return $this->hasMany(Semesters::class, ['grade_id' => 'id']);
    }

    /**
     * Gets query for [[Specialization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization()
    {
        return $this->hasOne(Specializations::class, ['id' => 'specialization_id']);
    }
}
