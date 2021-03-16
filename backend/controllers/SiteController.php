<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginPetugas;
use backend\models\Spp;
use common\models\Petugas;
use common\models\LoginForm;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'dashboard', 'index'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'dashboard', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
    public function actionIndex()
    {
        return $this->redirect(['site/dashboard']);
    }

    public function actionDashboard()
    {
        return $this->render('index');
    }

    public function actionStudent()
    {
        return $this->redirect(['student/index']);
    }

    public function actionBilling()
    {
        $spp = new Spp;
        return $this->render('billing', [
            'model' => $spp
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'blank';
        $model = new LoginPetugas();
        $form = new LoginForm();

        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/dashboard']);
        }

        if (Yii::$app->request->post()) {
            $petugas = LoginPetugas::find()->where(['username' => Yii::$app->request->post('LoginPetugas')['username']])->one();

            if($petugas) {
                if(Yii::$app->getSecurity()->validatePassword(Yii::$app->request->post('LoginPetugas')['password'], $petugas['password'])) {
                    
                    (new LoginForm)->login(Petugas::findById($petugas['id']));

                    return $this->redirect('dashboard');

                } else {
                    Yii::$app->session->setFlash('danger', 'Username Atau Kata Sandi Salah');
                    return $this->render('login', [
                        'model' => $model,
                    ]);
                }
            } else {
                Yii::$app->session->setFlash('danger', 'Username Atau Kata Sandi Salah');
                return $this->render('login', [
                    'model' => $model,
                ]);
            }

        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
