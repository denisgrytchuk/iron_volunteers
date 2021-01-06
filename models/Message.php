<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 01.11.2017
 * Time: 16:26
 */

namespace app\models;

use yii\db\ActiveRecord;


class Message extends ActiveRecord
{
    public static function tableName()
    {
        return 'contact_form';
    }

}