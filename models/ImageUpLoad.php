<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpLoad extends Model{

    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png'] //правило чтоб загружались только выбраные форматы. Чтоб не грузить txt и др.
        ];
    }


    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;

        if($this->validate())
        {
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage();
        }
        return $this->saveImage();
    }

    public function getFolder()
    {
        return Yii::getAlias('@web') . 'uploads/';
    }

    public function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    public function deleteCurrentImage($currentImage){
        if($this->fileExists($currentImage))
        {
            @unlink(Yii::getAlias('@web') . 'uploads/' . $currentImage);
        }
    }

    public function fileExists($currentImage)
    {
            return file_exists($this->getFolder() . $currentImage);
    }

    public function saveImage()
    {
        $filename = $this->generateFilename();
        $this->image->saveAs($this->getFolder() . $filename);
        return $filename;
    }
}

