<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    // Сценарий регистрации
    const SCENARIO_SIGNUP = 'signup';

    // Повторный пароль нужно объявить, т.к. этого поля нет в БД
    public $password_repeat;
    public $agree;

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            // Логин и пароль - обязательные поля
            [['username', 'surname', 'telephone', 'password', 'email','birthday','t_shirt','city','study'], 'required'],
            // Длина пароля не менее 6 символов
            ['password', 'string', 'length' => [6, 30]],
            // Длина повторного пароля не менее 6 символов
            ['password_repeat', 'string', 'length' => [6, 30]],
            // Пароль должен совпадать с повторным паролем для сценария регистрации
            ['password', 'compare', 'compareAttribute'=>'password_repeat'],
            // Почта проверяется на соответствие типу
            ['email', 'email'],
            // Почта должна быть в пределах от 6 до 50 символов
            ['email', 'string', 'length' => [6, 50]],
            // Почта должна быть уникальной
            ['email', 'unique'],
            // Почта должна быть написана в нижнем регистре
            ['email', 'filter', 'filter'=>'mb_strtolower'],

            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            [['birthday'],'default','value' => date('Y-m-d')],
			['telephone', 'match', 'pattern' => '/^\+380\d{3}\d{2}\d{2}\d{2}$/
', 'message' => 'Введіть будь ласка номер вашого телефона в такому форматі: +380*********' ],
            /*['telephone', 'match', 'pattern' => '
^((\+?38)[ \-] ?)?((\(\d{3}\))|(\d{3}))?([ \-])?(\d{3}[\- ]?\d{2}[\- ]?\d{2})$
', 'message' => 'Введіть будь ласка номер вашого телефона в такому форматі: +38 0** *** ** **' ],*/
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' =>'Ім\'я',
            'email'=>'Email',
            'surname'=>'Прізвище',
            'telephone'=>'Телефон',
            'password'=>'Пароль',
            'password_repeat'=>'Повторний пароль',
            'birthday'=>'Дата народження',
            't_shirt'=>'Розмір футболки',
            'city'=>'Місце проживання',
            'study'=>'Навчальний заклад',
            'sex'=>'Стать',
            'agree'=>'Згода'

        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($this->isNewRecord)
            {
                // Время регистрации
                $this->time_registration = date("Y-m-d");
                // Хешировать пароль
                $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            }

            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    public function generateAuthKey()
    {
        $this->auth_key= \Yii::$app->security->generateRandomString();
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['idUser' => 'id']);
    }
}
