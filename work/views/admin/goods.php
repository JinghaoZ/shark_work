<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="NmhRb1YtZ0NxBg4mEWQRLlsnJgwcSwYxAz49ImNmVjQGCj0nPHk3Kw==">
    <title></title>
    <link href="/work/web/assets/284102e2/css/bootstrap.css" rel="stylesheet">
    <link href="/work/web/css/site.css" rel="stylesheet">
    <link href="/work/web/assets/15569a89/toolbar.css" rel="stylesheet"></head>
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

            <div class="col-sm-9">
                <a href="/work/web/index.php?r=admin/index" class="btn btn-default btn-doc">Order List</a>
                <a href="/work/web/index.php?r=admin/user" class="btn btn-default btn-doc" >User List</a>
                <a href="/work/web/index.php?r=admin/goods" class="btn btn-default btn-doc">Goods List</a>
            </div>
            <div class="clo-sm-3">
                                <a href="<?php if(Yii::$app->session->get('admin')){echo '/work/web/index.php?r=admin/logout';}else{echo '/work/web/index.php?r=admin/login';}?>" class="btn btn-default btn-doc"><?php if(Yii::$app->session->get('admin')){echo Yii::$app->session->get('admin').'(logout)';}else{echo 'Login';}?></a>
            </div>
        </div>
    </div>
    </header>
    <div class="container">

        <div class="row">
            <div class="col-sm-3">
                <form action="<?=\yii\helpers\Url::toRoute(['admin/search-goods'])?>" method="post">
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
		<div id="refresh">
			<button style="float:right;" onclick="javascript:func();">Refresh</button>
		</div>
        <style>
            img{
                max-width: 84px;;
            }
        </style>
        <table class="table table-bordered">
            <tr>
                <td>Goods id</td>
                <td>Goods Name</td>
                <td>Goods Type</td>
                <td>Seller: </td>
                <td>Location</td>
                <td>Time</td>
                <td>Operation</td>
            </tr>
            <?php foreach($data as $v):?>
            <tr>
                <td><?=$v['id']?></td>
                <td><?=$v['goods_name']?></td>
                <td><?=($v['goods_type'] == 'art')?"Furniture":$v['goods_type']?></td>
                <td><?=$v['username']?></td>
                <td><?=$v['goods_desc']?></td>
                <td><?=date('Y-m-d H:i:s',$v['add_time'])?></td>
                <td><a href="" class="btn btn-success">Delete</a></td>
            </tr>
            <?php endforeach;?>
        </table>
        <?php use yii\widgets\LinkPager;?>
        <?= LinkPager::widget(['pagination' => $pages]); ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company 2016</p>

        <p class="pull-right">Powered by <a href="http://www.yiiframework.com/" rel="external">Yii Framework</a></p>
    </div>
</footer>

<div id="yii-debug-toolbar" data-url="/work/web/index.php?r=debug%2Fdefault%2Ftoolbar&amp;tag=572701811a9cc" style="display:none" class="yii-debug-toolbar-bottom"></div><script src="/work/web/assets/422d4ec3/jquery.js"></script>
<script src="/work/web/assets/483ccaaf/yii.js"></script>
<script src="/work/web/assets/284102e2/js/bootstrap.js"></script>
<script src="/work/web/assets/15569a89/toolbar.js"></script></body>
<script type="text/javascript">
	function func()
	{
		if(confirm("Delete Over Time Things??"))
		{
			this.location = "/work/views/admin/deleteGoods.php?action=ok";
		}
		else
		{
			this.location = "#";
		}

	}
</script>

</html>

