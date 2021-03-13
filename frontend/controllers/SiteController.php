<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Student;
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect('site/login');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        $req = Yii::$app->request;
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('dashboard');
        }

        if ($model->load(Yii::$app->request->post())) {
            $siswa = Student::find()->where(["nisn" => $req->post('LoginForm')['nisn']])->one();
            if ($siswa) {
                if (Yii::$app->getSecurity()->validatePassword($req->post('LoginForm')['password'], $siswa['password'])) {
                $model->login(User::findByNISN($req->post('LoginForm')['nisn']));
                return $this->render('dashboard');

            } else {
                Yii::$app->session->setFlash('danger', 'NISN Atau Kata Sandi Salah');
                $model->password = '';
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'NISN Atau Kata Sandi Salah');
            $model->password = '';
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            
            $student = new Student;
            $student->nisn = Yii::$app->request->post('SignupForm')['nisn'];
            $student->nama = Yii::$app->request->post('SignupForm')['nama'];
            $student->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('SignupForm')['password']);
            $student->created_at = date('Y-m-d H:i:s');
            $student->save();

            Yii::$app->session->setFlash('success', 'Akun Telah Dibuat, Silahkan Login');
            return $this->goHome();
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    public function actionProfile()
    {
        $data = Student::find()->where(["nisn" => Yii::$app->user->identity->nisn])->one();
        return $this->render('profile', [
            'data' => $data
        ]);
    }
}
