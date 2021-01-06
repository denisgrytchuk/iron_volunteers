<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 01.11.2017
 * Time: 16:23
 */

namespace app\models;

use yii\db\ActiveRecord;


class Post extends ActiveRecord
{
    public static function tableName()
    {
        return 'post';
    }

    public function attributeLabels()
    {
        return [
            'title'=>'Заголовок',
            'short'=>'Короткий опис',
            'text'=>'Текст',
            'category'=>'Категорія',
            'img'=>'Світлина',
            'date'=>'Дата створення',
            'is_publish'=>'Опублікувати',
            'in_facebook'=>'Опублікувати у Facebook'
        ];
    }

    public function rules()
    {
        return [

        ];
    }
}