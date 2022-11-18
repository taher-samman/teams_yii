<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "courses".
 *
 * @property int $id
 * @property string $name
 * @property int $semester_id
 * @property string|null $code
 * @property float $price
 * @property string|null $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Chapters[] $chapters
 * @property Semesters $semester
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
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
            [['name', 'semester_id', 'price', 'created_at', 'updated_at'], 'required'],
            [['semester_id'], 'integer'],
            [['price'], 'number'],
            [['status'], 'default', 'value' => Types::STATUS_ENABLED],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'code', 'description'], 'string', 'max' => 255],
            [['semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semesters::class, 'targetAttribute' => ['semester_id' => 'id']],
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
            'semester_id' => 'Semester ID',
            'code' => 'Code',
            'price' => 'Price',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Chapters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChapters()
    {
        return $this->hasMany(Chapters::class, ['course_id' => 'id']);
    }

    /**
     * Gets query for [[Semester]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemester()
    {
        return $this->hasOne(Semesters::class, ['id' => 'semester_id']);
    }
}
