<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 08.02.2018
 * Time: 13:52
 */

namespace app\models;


use yii\db\ActiveRecord;

class Info extends ActiveRecord
{

    public static function tableName()
    {
        return 'info';
    }
}