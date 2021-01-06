<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 11.02.2018
 * Time: 21:17
 */


namespace app\models;

use yii\db\ActiveRecord;


class Etap extends ActiveRecord
{

    public static function tableName()
    {
        return 'etap';
    }

    public function getParent()
    {
        return $this->hasOne(Event::className(), ['id' => 'idEvent']);
    }

    public function getEvent()
    {
        $parent = $this->parent;

        return $parent ? $parent->title : '';
    }

}