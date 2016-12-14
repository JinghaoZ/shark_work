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
<body>

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
                <a href="/work/web/index.php?r=user/show" class="btn btn-default btn-doc">Center</a>
                <a href="<?php if(Yii::$app->session->get('username')){echo '/work/web/index.php?r=user/logout';}else{echo '/work/web/index.php?r=user/login';}?>" class="btn btn-default btn-doc"><?php if(Yii::$app->session->get('username')){echo Yii::$app->session->get('username').'(logout)';}else{echo 'Login';}?></a>
                <a href="/work/web/index.php?r=user/register" class="btn btn-default btn-doc">Register</a>
                <a href="<?=\yii\helpers\Url::toRoute(['order/show-order','order_ids'=>$order_ids])?>" class="btn btn-default btn-doc"><span class="glyphicon glyphicon-tasks" aria-hidden="true">　<strong><?=$num?></strong>　</span></a>
            </div>
        </div>
    </div>
    </header>
    <div class="container">
        <style>
            img{
                max-height: 87px;
                max-width: 87px;
            }
        </style>
        <div>
            <table class="table table-hover">
                <tr>
                    <td>User Logo</td>
                    <td><img src="/work/web/uploads/<?=$model->logo?>" alt=""></td>
                </tr>
                <tr>
                    <td>User Name</td>
                    <td><?=$model->username?></td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td><?=$model->nickname?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><?=$model->tel?></td>
                </tr>
                <tr>
                    <td><a href="<?=\yii\helpers\Url::toRoute('user/update')?>" class="btn btn-primary btn-md" role="button">Modify</a></td>
                    <td></td>
                </tr>
            </table>
            <table class="table table-striped">
                <tr>
                    <td>#</td>
                    <td>Goods Name</td>
                    <td>Location</td>
                    <td>Goods Type</td>
                    <td>goods Image</td>
                    <td>Upload Time</td>
                    <td>State</td>
                    <td>Operation</td>
                </tr>
                <?php foreach($goods as $good):?>
                <tr>
                    <td><?=$good['id']?></td>
                    <td><?=$good['goods_name']?></td>
                    <td><?=$good['goods_desc']?></td>
                    <td><?=($good['goods_type'] == "art")?"Furniture":$good['goods_type']?></td>
                    <td><img src="/work/web/uploads/<?=$good['logo']?>" alt=""></td>
                    <td><?=date('Y-m-d H:i:s',$good['add_time'])?></td>
                    <td><?php if($good['status']){echo "<a href='".\yii\helpers\Url::toRoute(['order/show','order_id'=>$good['order_id']])."'>New Order List</a>";}else {
                            echo 'No Order';
                        }?></td>
                    <td><a href="<?=\yii\helpers\Url::toRoute(['goods/delete','id'=>$good['id']])?>">Delete</a></td>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td>
                        <a href="<?=\yii\helpers\Url::toRoute('goods/add')?>" class="btn btn-default btn-md" role="button">Upload New</a>
                    </td>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
            </table>
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