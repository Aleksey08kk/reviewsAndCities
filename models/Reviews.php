<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int|null $id_city
 * @property string|null $title
 * @property string|null $text
 * @property int|null $rating
 * @property string|null $img
 * @property int|null $id_author
 * @property string|null $date_create
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_city', 'rating', 'id_author'], 'integer'],
            [['date_create'], 'safe'],
            [['title', 'text', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_city' => 'Id City',
            'title' => 'Title',
            'text' => 'Text',
            'rating' => 'Rating',
            'img' => 'Img',
            'id_author' => 'Id Author',
            'date_create' => 'Date Create',
        ];
    }

    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }
    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }
/*
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    */
/*
    public function isAllowed(): int
    {
        return $this->status;
    }

    public function allow(): bool
    {
        $this->status = 1;
        return $this->save(false);
    }
    public function disallow(): bool
    {
        $this->status = 0;
        return $this->save(false);
    }
    */
}
