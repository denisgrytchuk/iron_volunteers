<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 26.01.2018
 * Time: 13:24
 */

namespace app\models;


use yii\db\ActiveRecord;

class Event extends ActiveRecord
{

    public $change_photo;

    public static function tableName()
    {
        return 'event';
    }
}