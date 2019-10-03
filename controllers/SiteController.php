<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PollingUnit;
use yii\helpers\Url;
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
                'only' => ['logout'],
                'rules' => [
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
     * @return string
     */
    public function actionIndex()
    {
        $rows = (new \yii\db\Query())
        ->select(['lga.uniqueid','lga_name','polling_unit.uniquewardid'])
        ->join('LEFT JOIN', 'polling_unit', 'polling_unit.lga_id = lga.lga_id')
        ->from('lga')
        // ->distinct()
        ->all();
        return $this->render('index',compact('rows'));
    }

    public function display_new_polling_unit()
    {
        $rows = (new \yii\db\Query())
        ->from('lga')
        ->where(['polling_unit_name' => ''])


        // ->distinct()
        ->all();
        return $this->render('index',compact('rows'));
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * store result for all new
     * polling unit
     *
     * @return Response|string
     */
    public function actionPolling()
    {
        $model = new PollingUnit();
        if ($model->load(Yii::$app->request->post() )) {
            //Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        
           $category =  (new \yii\db\Query())->from('lga')
            ->join('LEFT JOIN', 'polling_unit', 'polling_unit.lga_id = lga.lga_id')
            ->select(['lga.lga_id','lga.state_id','lga.lga_name','polling_unit.polling_unit_id'])
            ->where(['polling_unit.polling_unit_id'=> null])
            ->all();

        return $this->render('pollingunit', [
            'model' => $model,
            'category' =>  $category
        ]);
    }

    public function actionView($id)
    {
        $rows = (new \yii\db\Query())->from('polling_unit')->findOne($id);
        // if ($rows === null) {
        //     throw new NotFoundHttpException;
        // }

        // return json_encode($rows);
        return $this->render('show', [
            'rows' => $rows,
            // 'category' => Category::find()->all(),
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays result for any individual polling unit
     *
     * @return string
     */
    public function polling_unit($id)
    {
        $subQuery = (new Query())->from('polling_unit')
        ->where(['polling_unit_id' => $id])
        ->all();

        return $subQuery;
        
        return $this->render('inec');
    }


}
