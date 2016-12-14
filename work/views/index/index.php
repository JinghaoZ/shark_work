<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="b3RBV3pCOUdYMAQIOSR6F10hNmQDMw0tOwICOCwoCXECMAxkJTt0Lg==">
    <title></title>
    <link href="/work/web/assets/16d7266f/css/bootstrap.css" rel="stylesheet">
    <link href="/work/web/css/site.css" rel="stylesheet">
    <link href="/work/web/assets/e7704573/toolbar.css" rel="stylesheet"></head>

<style>
    img{
        max-width: 87px;
    }
</style>
<body>
<header class="main-header"  style="background-image: url(http://image.golaravel.com/5/c9/44e1c4e50d55159c65da6a41bc07e.jpg)"">
<div class="container">
    <div class="row">
        <div class="col-sm-12">

            <h1><span class="hide">Laravel - </span>Sharing Around</h1>
            <h2 class="hide">PHP THAT DOESN'T HURT. CODE HAPPY &amp; ENJOY THE FRESH AIR.</h2>

            <img src="http://image.golaravel.com/e/b0/4e4bd788405aab87f03d26edc4ab4.png" alt="Laravel" class="hide">
        </div>

        <div class="col-sm-9">
            <a href="/work/web/index.php?r=index/index" class="btn btn-default btn-doc">Home</a>
            <a href="/work/web/index.php?r=cate/book" class="btn btn-default btn-doc" >Books</a>
            <a href="/work/web/index.php?r=cate/clothes" class="btn btn-default btn-doc">Clothes</a>
            <a href="/work/web/index.php?r=cate/bike" class="btn btn-default btn-doc">Bicycle</a>
            <a href="/work/web/index.php?r=cate/art" class="btn btn-default btn-doc">Furniture</a>
        </div>
        <div class="clo-sm-3">
            <a href="/work/web/index.php?r=user/show" class="btn btn-default btn-doc">Center</a>
            <a href="<?php if(Yii::$app->session->get('username')){echo '/work/web/index.php?r=user/logout';}else{echo '/work/web/index.php?r=user/login';}?>" class="btn btn-default btn-doc"><?php if(Yii::$app->session->get('username')){echo Yii::$app->session->get('username').'(logout)';}else{echo 'Login';}?></a>
            <a href="/work/web/index.php?r=user/register" class="btn btn-default btn-doc">Register</a>
        </div>
    </div>
</div>
</header>

    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
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




        <div class="row">
            <div class="col-sm-2"><h4 style="margin-left: 30px;">Clothes <span class="label label-default">New</span></h4>
            </div>
            <div class="col-sm-offset-8 col-sm-2">
                <?php if($clo_num > 7) {
                    echo '<div style="padding-left: 30px;"><h4><a href="'.\yii\helpers\Url::toRoute(['cate/book']).'"> >>> </a></h4></div>';
                }?>
            </div>
        </div>
        <div class="row">
            <?php foreach($goods_clothes as $good_clo):?>
            <div class="col-xs-6 col-md-3">
                <a href="<?=\yii\helpers\Url::toRoute(['index/detail','id'=>$good_clo['id']])?>" class="thumbnail">
                    <p><?=$good_clo['goods_name']?></p>
                    <p>Seller: <?=$good_clo['username']?></p>
                    <p>Upload Time<?=date('Y-m-d H:m:s',$good_clo['add_time'])?></p>
                    <p><img src="/work/web/uploads/<?=$good_clo['logo']?>" alt=""></p>
                </a>
            </div>
            <?php endforeach;?>
        </div>





        <div class="row">
            <div class="col-sm-2"><h4 style="margin-left: 30px;">Bicycle<span class="label label-default">New</span></h4>
            </div>
            <div class="col-sm-offset-8 col-sm-2">
                <?php if($bike_num > 7) {
                    echo '<div style="padding-left: 30px;"><h4><a href="'.\yii\helpers\Url::toRoute(['cate/book']).'"> >>> </a></h4></div>';
                }?>
            </div>
        </div>
        <div class="row">
            <?php foreach($goods_bike as $good_bk):?>
                <div class="col-xs-6 col-md-3">
                    <a href="<?=\yii\helpers\Url::toRoute(['index/detail','id'=>$good_bk['id']])?>" class="thumbnail">
                        <p><?=$good_bk['goods_name']?></p>
                        <p>Seller: <?=$good_bk['username']?></p>
                        <p>Upload Time<?=date('Y-m-d H:m:s',$good_bk['add_time'])?></p>
                        <p><img src="/work/web/uploads/<?=$good_bk['logo']?>" alt=""></p>
                    </a>
                </div>
            <?php endforeach;?>
        </div>




        <div class="row">
            <div class="col-sm-2"><h4 style="margin-left: 30px">Books<span class="label label-default">New</span></h4>
            </div>
            <div class="col-sm-offset-8 col-sm-2">
                <?php if($book_num > 7) {
                    echo '<div style="padding-left: 30px;"><h4><a href="'.\yii\helpers\Url::toRoute(['cate/book']).'"> >>> </a></h4></div>';
                }?>
            </div>
        </div>
        <div class="row">
            <?php foreach($goods_book as $good_bok):?>
                <div class="col-md-3">
                    <a href="<?=\yii\helpers\Url::toRoute(['index/detail','id'=>$good_bok['id']])?>" class="thumbnail">
                        <p><?=$good_bok['goods_name']?></p>
                        <p>Seller: <?=$good_bok['username']?></p>
                        <p>Upload Time<?=date('Y-m-d H:m:s',$good_bok['add_time'])?></p>
                        <p><img src="/work/web/uploads/<?=$good_bok['logo']?>" alt=""></p>
                    </a>
                </div>
            <?php endforeach;?>
        </div>



        <div class="row">
            <div class="col-sm-2">
                <h4 style="margin-left: 30px;">Furniture     <span class="label label-default">New</span></h4>
            </div>
            <div class="col-sm-offset-8 col-sm-2">
                <?php if($art_num > 7) {
                    echo '<div style="padding-left: 30px;"><h4><a href="'.\yii\helpers\Url::toRoute(['cate/book']).'"> >>> </a></h4></div>';
                }?>
            </div>
        </div>
        <div class="row">
            <?php foreach($goods_art as $good):?>
                <div class="col-md-3">
                    <a href="<?=\yii\helpers\Url::toRoute(['index/detail','id'=>$good['id']])?>" class="thumbnail">
                        <p><?=$good['goods_name']?></p>
                        <p>Seller: <?=$good['username']?></p>
                        <p>Upload Time<?=date('Y-m-d H:m:s',$good['add_time'])?></p>
                        <p><img src="/work/web/uploads/<?=$good['logo']?>" alt=""></p>
                    </a>
                </div>
            <?php endforeach;?>
            <?php if($art_num > 7) {
                echo '<div style="padding-top: 300px;"><a href="'.\yii\helpers\Url::toRoute(['cate/art']).'"> >>> </a></div>';
            }?>
        </div>
    </div>
</div>





<div id="yii-debug-toolbar" data-url="/work/web/index.php?r=debug%2Fdefault%2Ftoolbar&amp;tag=572571233888b" style="display:none" class="yii-debug-toolbar-bottom"></div><script src="/work/web/assets/7cbb6a4e/jquery.js"></script>
<script src="/work/web/assets/3c8e67fb/yii.js"></script>
<script src="/work/web/assets/16d7266f/js/bootstrap.js"></script>
<script src="/work/web/assets/e7704573/toolbar.js"></script></body>
</html>