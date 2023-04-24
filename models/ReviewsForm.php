<?php

namespace app\models;
use Yii;
use yii\base\Model;
class ReviewsForm extends Model
{
    public $reviews;

    public function rules()
    {
        return [
            [['reviews'], 'required'],
            [['reviews'], 'string', 'length' => [3,250]]
        ];
    }

    public function saveReviews($city_id)
    {
        $reviews = new Comment;
        $reviews->text = $this->comment;
        $reviews->user_id = Yii::$app->user->id;
        $reviews->article_id = $article_id;
        $reviews->status = 0;
        $reviews->date = date('Y-m-d');
        return $reviews->save();
    }
}