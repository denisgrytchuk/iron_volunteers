<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 12.02.2018
 * Time: 10:42
 */

namespace app\models;

use yii\db\ActiveRecord;


class EtapUser extends ActiveRecord
{

    public static function tableName()
    {
        return 'etap_user';
    }
}