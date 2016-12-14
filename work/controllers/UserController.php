<?php

namespace app\controllers;

use app\models\task\Goods;
use app\models\task\Order;
use app\models\task\User;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;



class UserController extends Controller
{
    public $enableCsrfValidation = false;

    public function actions() {
        return [
            'captcha' =>  [
                'class' => 'yii\captcha\CaptchaAction',
                'height' => 50,
                'width' => 80,
                'minLength' => 4,
                'maxLength' => 4
            ],
        ];
    }

    public function actionLogin()
    {
        $model = new User();
        if(\Yii::$app->request->isPost){
            $model->setScenario('login');
            $model->attributes = \Yii::$app->request->post('User');

            if($model->login())
            {
                return $this->redirect(Url::toRoute(['index/index']));
            }
        }

        return $this->renderPartial('login',['model'=>$model]);
    }


    public function actionRegister()
    {
        

        $model = new User();

        if(\Yii::$app->request->isPost){
            $model->setScenario('register');
            $model->attributes = \Yii::$app->request->post('User');

            $tempname = $model->username;
            $res = $this->searchUser($tempname);
            if($res){
                $newArray = mysqli_fetch_array($res, MYSQLI_ASSOC);
                print_r(count($newArray));
                if($newArray){
                    echo "<script>alert('Username has been used!')</script>";
                }
                else{
                    if($model->register()){
                        return $this->redirect(Url::toRoute(['user/login']));
                    }
                    else{
                        echo "<script>alert('Sorry, something is Error')</script>";
                    }
                }  
            }

        return $this->renderPartial('register',['model'=>$model]);
    }


    public function actionShow()
    {
        if(!\Yii::$app->session->get('username')) {
            return $this->redirect(['user/login']);
        }

        $model = new User();
        $session = \Yii::$app->session;
        $username = $session->get('username');
        $model = $model->findOne(['username'=>$username]);

        $data = Order::find()->asArray()->all();

        $goods_data = Goods::find()->where(['username'=>$username])->orderBy('add_time desc')->asArray()->all();


        $num = 0;
        $order_ids = [];
        foreach($data as $v){
            foreach($goods_data as $v2) {
                if($v['goods_id1'] == $v2['id']) {
                    $num = $num+1;
                    $order_ids[] = $v['id'];
                }
            }
        }
        $m_goods = new Goods();
        $goods = $m_goods->find()->where(['username'=>$username])->orderBy('add_time desc')->asArray()->all();

        $goods1 = [];
        foreach($goods as $v) {
            $sql = 'select id from task_order where goods_id1 = "'.$v['id'].'" or goods_id2 = "'.$v['id'].'" ';
            $order_id = Order::findBySql($sql)->asArray()->one()['id'];

            $v['order_id'] = $order_id;
            $goods1[] = $v;
        }

        return $this->renderPartial('show',['model'=>$model,'goods'=>$goods1,'num'=>$num,'order_ids'=>$order_ids]);
    }


    public function actionUpdate()
    {

        $session = \Yii::$app->session;
        $username = $session->get('username');
        $model = User::find()->where(['username'=>$username])->one();
        $model->setScenario('update');

        if (\Yii::$app->request->isPost) {
            $model->attributes = \Yii::$app->request->post('User');
            $model->logo = UploadedFile::getInstance($model, 'logo');

            if ($model->logo && $model->validate()) {
                $image =  UploadedFile::getInstance($model,'logo');
                $ext = $image->getExtension();
                $imageName = time().rand(100,999).'.'.$ext;
                $image->saveAs('uploads/'.$imageName);//设置图片的存储位置
                $model->logo = $imageName;

                $model->username = $username;

                if($model->save()) {
                    return $this->redirect(Url::toRoute(['show']));
                }
            }
        }

        $model = $model->findOne(['username'=>$username]);

        return $this->renderPartial('update',['model'=>$model]);
    }


    public function actionLogout(){
        unset(\Yii::$app->session['username']);
        \Yii::$app->session->destroy();
        return $this->redirect(Url::toRoute(['user/login']));
    }
    private function getCoon(){
            $ini_array = parse_ini_file("config.ini");
            $mysqli = mysqli_connect($ini_array["location"],$ini_array["name"],$ini_array["pwd"],"task",3306);
            //Read the local database info from the local file.
            if(mysqli_connect_errno()){
                printf("Connect Failed: %s/n",mysqli_connect_error());
                exit();
            }
            $mysqli->query("SET NAMES 'UTF8'");
            return $mysqli;
        }
    private function searchUser($uname){
        $mysqli = $this->getCoon();
        $sql = "select * from task_user where username = '".$uname."'";
        $avaRes = $mysqli->query($sql);
        return $avaRes;
    }

}