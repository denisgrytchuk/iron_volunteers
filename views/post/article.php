<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $article->title;

?>


<link href="/web/css/index.css" rel="stylesheet">

<div >

    <div class="col-md-8 center-col">
        <div>
            <h2><?= $article->title?></h2>
            <hr>
            <div class="article-img">
                <img  src='<?= $article->photo?>'></img>
            </div>
            <div>
                <?= $article->content?>
            </div>
            <hr>
            <span><?=$article->date?></span>
        </div>
        <hr>
        <div>
            <div>
                <?php if(!Yii::$app->user->isGuest){?>
                    <?php  if(Yii::$app->session->hasFlash('ok')):?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php  echo Yii::$app->session->getFlash('ok');?>
                        </div>
                    <?php endif; ?>
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'idUser')->hiddenInput(['value'=>Yii::$app->user->id]) ?>
                    <?= $form->field($model, 'idArticle')->hiddenInput(['value'=>$article->id]) ?>
                    <?= $form->field($model, 'content')?>
                    <?= $form->field($model,'date')->hiddenInput(['value' => date("Y-m-d H:i:s")]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Відправити', ['class' => 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                <?php }?>
            </div>
            <hr>
            <div>
                <?php  $i=0;
                foreach ($comments as $comment){ ?>
                    <?php if($comment->public){ ?>
                        <div class="comment">

                            <h4>
                                <?=$authors[$i][0]->username.' '.$authors[$i][0]->surname?>
                            </h4>

                                <p>
                                    <?=$comment->content?>
                                </p>

                        </div>
                    <?php } ?>
                    <?php
                    $i++;
                } ?>
            </div>
        </div>
    </div>
	<div class="col-md-4 center-col news-category">
		<div class="accordion">
			<?php for($i=0;$i<count($category);$i++){?>
				<button class="col-md-12 accordion"><?=$category[$i]->name?></button>
				<!--button class="accordion"><a href='/web/post/<?=$category[$i]->id?>'><?=$category[$i]->name?></a></button-->
				<div class="col-md-12 panel"><p>
						<?php foreach ($list[$i] as $lis){?>
							<div><a href='/post/article/<?=$lis->id?>'><?=$lis->title?></a></div><br>
						<?php }?>
					</p>
				</div>
			<?php   } ?>
		</div>
	</div>

</div>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        }
    }
</script>