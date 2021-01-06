<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 22.01.2018
 * Time: 19:21
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public $photo;

    public function uploadFile(UploadedFile $file=null)
    {
        if($file){
            $file->saveAs(Yii::getAlias('@web').'uploads/'.$file->name);
            return $file->name;
        }
        else{
            return '';
        }

    }

    public function deleteFile($name=null)
    {
        if($name && $name!='uploads/') {
            unlink($name);
        }
    }
}