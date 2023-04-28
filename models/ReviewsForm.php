<?php

namespace app\models;

use yii\base\Model;

class ReviewsForm extends Model
{
    public $reviews;

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
        $reviews->title = $this->reviews;
        $reviews->text = $this->reviews;
        $reviews->id_city = $id;
        $reviews->date_create = date('Y-m-d');
        $reviews->img = $this->img;
        return $reviews->save();
    }
}