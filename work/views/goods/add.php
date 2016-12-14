<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="b3RBV3pCOUdYMAQIOSR6F10hNmQDMw0tOwICOCwoCXECMAxkJTt0Lg==">
    <title></title>
    <script type="text/javascript" src="/jquery/jquery-3.1.1.min.js"></script>
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
    <div class="container">

        <div class="col-sm-4">
            <?php date_default_timezone_set('Asia/Tokyo'); 
		$form=\yii\widgets\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
            <?=$form->field($m_goods,'goods_name')?>
            <?=$form->field($m_goods,'goods_type')->dropDownList(['art'=>'Furniture','bike'=>'Bicycle','book'=>'Books','clothes'=>'Clothes'])?>
            <?=$form->field($m_goods,'goods_desc')->textarea(['id'=>'google_geo'])?>
            <?=\yii\helpers\Html::Button('Get Location',['class'=>'btn btn-success','OnClick'=>'getLocation()'])?>
            <?=$form->field($m_goods,'logo')->fileInput()?>
            <?=\yii\helpers\Html::submitButton('Add',['class'=>'btn btn-success'])?>
            <?php $form->end()?>
        </div>
    </div>
</div>
<script>
    var loc = "";
    function getLocation(){
        if (navigator.geolocation){
            navigator.geolocation.getCurrentPosition(showPosition,showError);
        }else{
            alert("浏览器不支持地理定位。");
        }
    }
    function showPosition(position){
        $("#latlon").html("纬度:"+position.coords.latitude +'，经度:'+ position.coords.longitude);
        var latlon = position.coords.latitude+','+position.coords.longitude;
        //google
        var url = 'http://maps.google.cn/maps/api/geocode/json?latlng='+latlon+'&language=CN';
        $.ajax({
            type: "GET",
            url: url,
            beforeSend: function(){
                $("#google_geo").html('正在定位...');
            },
            success: function (json) {
                if(json.status=='OK'){
                    var results = json.results;
                    $.each(results,function(index,array){
                        if(index==0){
                            $("#google_geo").html(array['formatted_address']);
                        }
                    });
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $("#google_geo").html(latlon+"地址位置获取失败");
            }
        });
    }
    function showError(error){
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("定位失败,用户拒绝请求地理定位");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("定位失败,位置信息是不可用");
                break;
            case error.TIMEOUT:
                alert("定位失败,请求获取用户位置超时");
                break;
            case error.UNKNOWN_ERROR:
                alert("定位失败,定位系统失效");
                break;
        }
    }
</script>
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


