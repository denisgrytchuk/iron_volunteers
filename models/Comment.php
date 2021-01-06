<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 08.11.2017
 * Time: 16:01
 */

namespace app\models;


use Yii;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class Comment extends ActiveRecord
{

    public static function tableName()
    {
        return 'comment';
    }

    public function attributeLabels()
    {
        return [
            'id' => '',
            'idUser' => '',
            'idArticle' => '',
            'content' => '',
            'date' => ''
        ];
    }

    public function getParent()
    {
        return $this->hasOne(User::className(), ['id' => 'idUser']);
    }

    public function getCommentator()
    {
        $parent = $this->parent;

        return $parent ? $parent->username.'  '.$parent->surname: '';
    }

    public function getTitle()
    {
        return $this->hasOne(Article::className(), ['id' => 'idArticle']);
    }

    public function getArticle()
    {
        $title = $this->title;

        return $title ? $title->title: '';
    }
}
