<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="b3RBV3pCOUdYMAQIOSR6F10hNmQDMw0tOwICOCwoCXECMAxkJTt0Lg==">
    <title></title>
    <script type="text/javascript" src="/jQuery/jquery-3.1.1.min.js"></script>
    <link href="/work/web/assets/16d7266f/css/bootstrap.css" rel="stylesheet">
    <link href="/work/web/css/site.css" rel="stylesheet">
    <link href="/work/web/assets/e7704573/toolbar.css" rel="stylesheet"></head>
<body>

<style>
    img{
        max-width: 600px;
    }
</style>

<div class="wrap">
    <header class="main-header"  style="background-image: url(http://image.golaravel.com/5/c9/44e1c4e50d55159c65da6a41bc07e.jpg)"">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <h1><span class="hide">Laravel - </span>Sharing Around</h1>
                <h2 class="hide">PHP THAT DOESN'T HURT. CODE HAPPY &amp; ENJOY THE FRESH AIR.</h2>

                <img src="http://image.golaravel.com/e/b0/4e4bd788405aab87f03d26edc4ab4.png" alt="Laravel" class="hide">
            </div>

            <div class="col-sm-8">
                <a href="/work/web/index.php?r=index/index" class="btn btn-default btn-doc">Home</a>
                <a href="/work/web/index.php?r=cate/book" class="btn btn-default btn-doc" >Books</a>
                <a href="/work/web/index.php?r=cate/clothes" class="btn btn-default btn-doc">Clothes</a>
                <a href="/work/web/index.php?r=cate/bike" class="btn btn-default btn-doc">Bicycle</a>
                <a href="/work/web/index.php?r=cate/art" class="btn btn-default btn-doc">Furniture</a>
            </div>
            <div class="clo-sm-4">
                <a href="/work/web/index.php?r=cate/art" class="btn btn-default btn-doc">Center</a>
                <a href="<?php if(Yii::$app->session->get('username')){echo '/work/web/index.php?r=user/logout';}else{echo '/work/web/index.php?r=user/login';}?>" class="btn btn-default btn-doc"><?php if(Yii::$app->session->get('username')){echo Yii::$app->session->get('username').'(logout)';}else{echo 'Login';}?></a>
                <a href="/work/web/index.php?r=user/register" class="btn btn-default btn-doc">Register</a>
            </div>
        </div>
    </div>
    </header>
    <div class="container">

        <div class="row">
            <div class="col-sm-3">
                <form action="<?=\yii\helpers\Url::toRoute(['goods/search'])?>" method="post">
                    <div class="input-group">
                        <input type="text" name="goods_name" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <!--<button class="btn btn-default" type="button">Search!</button>-->
                        <input type="submit" class="btn btn-default" value="search!">
                    </span>
                    </div>
                </form>
            </div>

            <br><br><br><br>
        </div>
        <?php $form=\yii\widgets\ActiveForm::begin();?>
        <input type="hidden" name="Order[goods_id1]" value="<?=$goods_id?>">
        <table class="table">

            <tr>
                <td>User Name：</td>
                <td><?=$content['username']?></td>
            </tr>
            <tr>
                <td>Phone：</td>
                <td><?=$content['tel']?></td>
            </tr>
            <tr>
                <td>Change by：</td>
                <td>
                    <select name="Order[goods_id2]" id="">
                        <?php foreach($goods as $good):?>
                            <option value="<?=$good['id']?>"><?=$good['goods_name']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
        </table>
        <a href="<?=\yii\helpers\Url::toRoute(['goods/add','goods_id'=>$goods_id])?>" class="btn btn-default">Add new </a><br><br>

        <?=\yii\helpers\Html::submitButton('New Order',['class'=>'btn btn-success'])?>
        <?php $form->end();?><br><br>

        <div class="row">


        </div>

    </div>
</div>



<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company 2016</p>

        <p class="pull-right">Powered by <a href="http://www.yiiframework.com/" rel="external">Yii Framework</a></p>
    </div>
</footer>

<div id="yii-debug-toolbar" data-url="/work/web/index.php?r=debug%2Fdefault%2Ftoolbar&amp;tag=572571233888b" style="display:none" class="yii-debug-toolbar-bottom"></div><script src="/work/web/assets/7cbb6a4e/jquery.js"></script>
<script src="/work/web/assets/3c8e67fb/yii.js"></script>
<script src="/work/web/assets/16d7266f/js/bootstrap.js"></script>
<script src="/work/web/assets/e7704573/toolbar.js"></script></body>
</html>
