<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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

 


     public function actionPayment()
    {
        $this->layout = 'main';

        $request = Yii::$app->request->bodyParams;

        if (isset($request['subscribe'])) {

            $params = [
                'ORDER_ID' => '',
                'CUST_ID' => '',
                'TXN_AMOUNT' => '',
                'EMAIL' => '',
                'MOBILE_NO' => ''
            ];

            \common\components\Paytm::configPaytm($params, 'test');
        }

        return $this->render('payment', [
        ]);
    }

    public function actionPaymentSuccess()
    {
        
        if ($response['order_status'] === 'Success') {

           if(isset($_POST['GATEWAYNAME']) && ($_POST['GATEWAYNAME']=='WALLET')){
            $TXN_AMOUNT = $_POST['TXNAMOUNT'];
            $TXN_ID = $_POST['TXN_ID'];
           }
     Yii::$app->session->setFlash('success', '<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.');
            return $this->redirect(['payment']);
        }
       
        else {
            Yii::$app->session->setFlash('error', "<br>Security Error. Illegal access detected");
            return $this->redirect(['payment']);
        }
    }

    
}
