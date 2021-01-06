<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 05.10.2017
 * Time: 22:28
 */

namespace app\models;
use yii\db\ActiveRecord;


class ContactForm extends ActiveRecord
{

    public static function tableName()
    {
        return 'contact_form';
    }

    public function attributeLabels()
    {
        return [
            'name' =>'Ім\'я',
            'email'=>'Email',
            'subject'=>'Тема',
            'text'=>'Текст повідомлення',
            'date'=>''


        ];
    }

    public function rules()
    {
        return [
            ['name','required'],
            ['text','required'],
            ['subject','required'],
            ['email','required'],
            ['email','email'],
            ['date','date','format' => 'php:Y-m-d'],

        ];
    }
}