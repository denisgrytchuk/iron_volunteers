<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 26.01.2018
 * Time: 18:39
 */

namespace app\models;

use yii\db\ActiveRecord;


class Participation extends ActiveRecord
{
    public static function tableName()
    {
        return 'participation';
    }

}