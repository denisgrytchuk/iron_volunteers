<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class Admin extends ActiveRecord
{

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            // Логин и пароль - обязательные поля
            ['password', 'required'],
            // Длина пароля не менее 6 символов
            ['password', 'string', 'length' => [6, 30]],
        ];
    }

}
