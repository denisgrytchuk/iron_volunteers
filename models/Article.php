<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 06.11.2017
 * Time: 19:29
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * ContactForm is the model behind the contact form.
 */
class Article extends ActiveRecord
{
    public $change_photo;

    public static function tableName()
    {
        return 'article';
    }

    public function rules()
    {
        return [
            [['title','idCategory','date'], 'required'],
            [['title','content'],'string'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'],'default','value' => date('Y-m-d')],

        ];
    }

    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'idCategory']);
    }

    public function getCategory()
    {
        $parent = $this->parent;

        return $parent ? $parent->name : '';
    }
}
