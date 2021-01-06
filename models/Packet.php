<?php


namespace app\models;

use yii\db\ActiveRecord;


class Packet extends ActiveRecord
{
    public $change_photo;

    public static function tableName()
    {
        return 'packet';
    }



}