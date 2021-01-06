<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 11.02.2018
 * Time: 20:06
 */

namespace app\models;

use yii\db\ActiveRecord;


class PacketEvent extends ActiveRecord
{
    public static function tableName()
    {
        return 'packet_event';
    }

}