<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\web\UploadedFile;

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
    public function attributeLabels(): array
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
        return Yii::$app->formatter->asDate($this->date_create);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    public function actionSetImg(int $id)
    {
        $model = new ImageUpLoad;

        if (Yii::$app->request->isPost) {
            $city = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');

            if ($city->saveImage($model->uploadFile($file, $city->img))) {
                return $this->redirect(['view', 'id' => $city->id]);
            }
        }
        return $this->render('img', ['model' => $model]);
    }




    public function saveImg($filename): bool
    {
        $this->img = $filename;
        return $this->save(false);
    }

    public function getImg(): string
    {
        return ($this->img) ? '/uploads/' . $this->img : '/no-image.png';
    }



}
