<?php


namespace app\controllers;

use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\Article;
use app\models\Category;
use app\models\Comment;
use app\models\NewComment;

class PostController extends Controller
{
    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');

        $category = Category::find()->where(['id'=>$id])->one();
        ////////////////////////////доробити
        $pages = new Pagination(
            [
                'pageSize' => 10
            ]);
        $news = Article::find()->
        where(['idCategory'=>$id,'access'=>1])->
        select(['title','id'])->
        orderBy(['date'=>SORT_DESC])->
        all();

        return $this->render('view',
            [
                'category'=>$category,
                'news'=>$news,
                'pages'=>$pages
            ]);
    }

    public function actionArticle($id)
    {
        $status = Article::find()->where(['id'=>$id])->one();
        if($status->access) {
            $id = Yii::$app->request->get('id');

            $article = Article::find()->where(['id' => $id])->one();
            $comments = Comment::find()->where(['idArticle' => $id,'public'=>1])->all();
            $authors = $this->getAuthors($comments);

            $model = new NewComment();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if(!$_POST['NewComment']['content']){$this->refresh();}
                else{
                    $model1 = new Comment;
                    $model1->idUser = $_POST['NewComment']['idUser'];
                    $model1->idArticle = $_POST['NewComment']['idArticle'];
                    $model1->content = htmlspecialchars($_POST['NewComment']['content']);
                    $model1->date = $_POST['NewComment']['date'];
                    $model1->public = 0;
                    //var_dump($article->idCategory);exit();

                    $model1->insert();
                    Yii::$app->session->setFlash('ok','Ваш коментар знаходиться в стані одобрення');
                    return $this->refresh();
                }
            }
			$category = Category::find()->all();
			$list = $this->createList($category);
            return $this->render('article',
                [
                    'article' => $article,
                    'model' => $model,
                    'comments' => $comments,
                    'authors' => $authors,
					'list'=>$list,
					'category'=>$category

                ]);
        }
        else{
            header('Location: /');
            exit();
        }
    }

    public function getAuthors($comments)
    {
        $list=[];
        $i=0;
        foreach ($comments as $comment){
            $list[$i] = User::find()->
            where(['id'=>$comment->idUser])->
            all();
            $i++;
        }
        return $list;
    }

	public function createList($category){
        $list=[];
        $i=0;
        foreach ($category as $cat){
            $list[$i] = Article::find()->
            select(['title','id'])->
            where(['idCategory'=>$cat->id,'access'=>1])->
            orderBy(['date'=>SORT_DESC])->
            all();
            $i++;
        }
        return $list;
    }
	
}