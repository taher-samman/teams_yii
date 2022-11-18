<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "specializations".
 *
 * @property int $id
 * @property string $name
 * @property int $college_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Colleges $college
 * @property Grades[] $grades
 */
class Specializations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specializations';
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
            [['name', 'college_id', 'created_at', 'updated_at'], 'required'],
            [['college_id'], 'integer'],
            [['status'], 'default', 'value' => Types::STATUS_ENABLED],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['college_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colleges::class, 'targetAttribute' => ['college_id' => 'id']],
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
            'college_id' => 'College ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[College]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCollege()
    {
        return $this->hasOne(Colleges::class, ['id' => 'college_id']);
    }

    /**
     * Gets query for [[Grades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrades()
    {
        return $this->hasMany(Grades::class, ['specialization_id' => 'id']);
    }
}
