<?php
namespace app\controllers;

use app\models\task\Goods;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\task\User;

class GoodsController extends Controller {

    public $enableCsrfValidation = false;

    public function actionAdd(){

        $goods_id = \Yii::$app->request->get('goods_id');
        $username = \Yii::$app->session->get('username');
        $m_goods = new Goods();

        if(\Yii::$app->request->isPost){
            $m_goods->attributes = \Yii::$app->request->post('Goods');

            $m_goods->logo = UploadedFile::getInstance($m_goods, 'logo');
            if(!$m_goods->logo) {
                return $this->redirect(Url::toRoute(['goods/add']));
            }
            $image =  UploadedFile::getInstance($m_goods,'logo');
            $ext = $image->getExtension();
            $imageName = time().rand(100,999).'.'.$ext;
            $image->saveAs('uploads/'.$imageName);
            $m_goods->logo = $imageName;


            if($m_goods->validate()) {
                $m_goods->username = \Yii::$app->session->get('username');
                $m_goods->add_time = time();
                if($m_goods->save()) {
                    if($goods_id) {
                        return $this->redirect(Url::toRoute(['order/add','goods_id'=>$goods_id]));
                    } else {
                        return $this->redirect(Url::toRoute(['user/show']));
                    }
                }
            }
        }

        return $this->renderPartial('add',['m_goods'=>$m_goods,'username'=>$username]);
    }


    public function actionDelete()
    {
        $id = \Yii::$app->request->get('id');

        $m_goods = new Goods();

        $m_goods = $m_goods->find()->where(['id'=>$id])->one();

        if($m_goods->delete()) {
            return $this->redirect(Url::toRoute(['user/show']));
        }
    }


    public function actionSearch() {

        $goods_name = \Yii::$app->request->post('goods_name');
        if(!\Yii::$app->session->get('username')) {
            return $this->redirect(['user/login']);
        }
        $model = new User();
        $session = \Yii::$app->session;
        $username = $session->get('username');
        $model = User::find()->where(['username'=>$username])->one();;
        $model->setScenario('update');

        $user_loc = $model->nickname;
        if($goods_name != '') {
            $sql = 'select * from task_goods where (goods_name like "%'.$goods_name.'%" or username like "%'.$goods_name.'%") and (username != "'.$username.'")';

            $data = Goods::findBySql($sql)->asArray()->all();
            $rst = array();
            foreach ($data as $d) {
                $leven_dis = $this->compare($user_loc, $d['goods_desc']);
                $d['l_dis'] = $leven_dis;
                if($d['status'] != 1){
                    array_push($rst,$d);
                }
            }
            $flag=array();
            foreach($rst as $r){
                $flag[]=$r['l_dis'];
            }
            array_multisort($flag, SORT_ASC, $rst);
            return $this->renderPartial('search',['data'=>$rst]);
        }

        return $this->redirect(Url::toRoute(['index/index']));
    }
    function compare($buy,$sell)
    {
        $dis = levenshtein($buy,$sell);
        return $dis;
    }
}