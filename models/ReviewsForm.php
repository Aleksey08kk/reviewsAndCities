<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ReviewsForm extends Model
{
    public $reviews;
    /**
     * @var mixed
     */


    public function rules(): array
    {
        return [
            [['reviews'], 'required'],
            [['reviews'], 'string', 'length' => [3,250]]
        ];
    }

    public function saveReviews($id): bool
    {
        $reviews = new Reviews();
        $reviews->id_author = Yii::$app->user->id;
        $reviews->title = $this->reviews;
        $reviews->text = $this->reviews;
        $reviews->id_city = $id;
        $reviews->date_create = date('Y-m-d');
        return $reviews->save();
    }
}