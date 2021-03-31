<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginPetugas;
use backend\models\Spp;
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
                'only' => ['get-siswa', 'get-diagram'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['get-siswa', 'get-diagram'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'get-siswa' => ['post'],
                    // 'get-diagram' => ['post'],
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

    public function actionGetDiagram()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $dates = [];
            $data = [];
            
            $last = date("t");

            for($i=1; $i<date("d")+1; $i++) {
                array_push($dates, $i);
            }

            foreach ($dates as $key) {
                $num = $key + 1;
                $tomm = date("Y-m-" . $num);
                $today = date("Y-m-" . $key);
                $total = Yii::$app->db->createCommand("SELECT sum(nominal) as total FROM spp WHERE created_at between '$today' AND '$tomm'")->queryScalar();
                
                if ($num == $last + 1) {
                    if (date("m") == 12) {
                        $nextYear = date('Y', strtotime('+1 year'));
                        $myDate = date('m',strtotime('first day of +1 month'));
                        $nextDate = date($nextYear . "-" . $myDate . "-1");
                        $total = Yii::$app->db->createCommand("SELECT sum(nominal) as total FROM spp WHERE created_at between '2021-03-30' AND '$nextDate'")->queryScalar();
                        array_push($data, $total != "" ? $total : 0);
                    } else {
                        $myDate = date('m',strtotime('first day of +1 month'));
                        $nextDate = date("Y-" . $myDate . "-1");
                        $total = Yii::$app->db->createCommand("SELECT sum(nominal) as total FROM spp WHERE created_at between '2021-03-30' AND '$nextDate'")->queryScalar();
                        array_push($data, $total != "" ? $total : 0);
                    }
                    
                } else {
                    array_push($data, $total != "" ? $total : 0);
                }
            }

            if (max($data) == 0) {
                return $response = [
                    'total' => false,
                    'dates' => $dates,
                    'maximum' => max($data),
                    'month' => date("M"),
                ];
            } else {
                return $response = [
                    'total' => $data,
                    'dates' => $dates,
                    'maximum' => max($data),
                    'month' => date("M"),
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

    public function actionGetAllHistory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $data = (new \yii\db\Query())
            ->select("spp.created_at, spp.nominal, student.nama, skill.skill, class.class")
            ->from('spp')
            ->leftJoin('student', 'student.nisn = spp.nisn')
            ->leftJoin('skill', 'skill.id = student.id_skill')
            ->leftJoin('class', 'class.id = student.id_kelas')
            ->all();

            if($data) {
                return $response = [
                    'data' => $data,
                ];
            } else {
                return $response = [
                    'data' => false
                ];
            }
        }
    }

    public function actionGetSiswaHistory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {
            $data = (new \yii\db\Query())
            ->select("spp.created_at, spp.nominal, student.nama, skill.skill, class.class, skill.alias")
            ->from('spp')
            ->leftJoin('student', 'student.nisn = spp.nisn')
            ->leftJoin('skill', 'skill.id = student.id_skill')
            ->leftJoin('class', 'class.id = student.id_kelas')
            ->where(['spp.nisn' => $req->post("nisn")])
            ->all();

            if($data) {
                return $response = [
                    'data' => $data,
                ];
            } else {
                return $response = [
                    'data' => false
                ];
            }
        }
    }

    public function actionGetRangeHistory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $req = Yii::$app->request;

        if ($req->isAjax) {

            $data = (new \yii\db\Query())
            ->select("spp.created_at, spp.nominal, student.nama, skill.skill, class.class")
            ->from('spp')
            ->leftJoin('student', 'student.nisn = spp.nisn')
            ->leftJoin('skill', 'skill.id = student.id_skill')
            ->leftJoin('class', 'class.id = student.id_kelas')
            ->andWhere(['between', 'spp.created_at', $req->post('date1'), $req->post('date2')])
            ->all();
            
            return $response = [
                'data' => $data,
                'date1' => $req->post('date1'),
                'date2' => $req->post('date2'),
            ];
        }
    }

}
