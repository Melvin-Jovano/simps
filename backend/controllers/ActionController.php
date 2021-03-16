<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginPetugas;
use backend\models\Shortcut;
use common\models\Petugas;
use common\models\LoginForm;
use common\models\User;
use frontend\models\Student;
use yii\web\Response;

/**
 * Site controller
 */
class ActionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['get-siswa'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['get-siswa'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'get-siswa' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionGetSiswa()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $data = Student::find()->select('nisn, nama')->where(['id_kelas' => $req->post("class"), 'id_skill' => $req->post("skill")])->all();
            if($data) {
                return $response = [
                    'siswa' => $data
                ];
            } else {
                return $response = [
                    'siswa' => false
                ];

            }
            
        }
    }

    public function actionGetShortcut()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $data = Shortcut::find()->select('url')->where(['name' => $req->post("name"), 'level' => $req->post("level")])->one();
            if($data) {
                return $this->redirect(url::toRoute([$data['url']]));
            } else {
                return $response = [
                    'data' => false
                ];

            }
            
        }
    }
}
