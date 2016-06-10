<?php

namespace frontend\controllers;

use Yii;
use app\models\Posts;
use app\models\Category;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            
            'verbs' => [
                'class' => VerbFilter::className(),
               
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionAll()
    {
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Posts::find(),
        // ]);
        
        // Query -> Posts & Usuarios & Perfiles
        $pClass = new Posts;
        $posts = $pClass->getAllLeft();
        
        $cClass = new Category;
        
        $categories = $cClass->getAllLeft();
        
        return $this->render('all', [
            //'dataProvider' => $dataProvider,
            'posts' => $posts,
            'categories' => $categories
        ]);
    }
    
    public function actionAjaxuinfo()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $searchname= explode(":", $data['uid']);
            $searchname= $searchname[0];
            
            $query = new \yii\db\Query();
            $query
            ->select(['username' ,'profile.name AS pname'])
            ->from('user')
            ->leftJoin('profile', '`profile`.`user_id` = `id`');
            
            $cmd = $query->createCommand();
            $user = $cmd->queryAll();
            
            $userData = $user[0];
            
            $search = '<strong>Nombre:</strong> '.$userData['pname'];
            $search .= '<br/> <strong>Username:</strong> '.$userData['username'];
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'userdata' => $search,
                'code' => 100,
            ];
        }
    }
    

    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
