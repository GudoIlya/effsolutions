<?php 

namespace app\modules\api\controllers;

use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use app\models\Promocodes;
use yii\web\Response;
use Yii;

class PromocodeController extends ActiveController {
	public $modelClass = 'app\models\Promocodes';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
            'languages' => [
                'ru'
            ]
        ];

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Access-Control-Request-Method' => ['POST', 'GET'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 3600,                 // Cache (seconds)
            ],
        ];

        return $behaviors;
    }

    //public function actionGetDiscountInfo($token) {
    public function actionGetDiscountInfo() {
    	//if (!$token) {
          //  Yii::$app->response->statusCode(401);
        //}

        $promocode_name = Yii::$app->request->get('promocode_name');
        if ($promocode_name) {
            $promocode = Promocodes::find()
                ->select([ 'promocodes.begin_date', 
                           'promocodes.end_date',
                           'promocodes.compensation',
                           'c.id as city_id',
                           'c.city_name as zone',
                           'promocodes.status'])
                ->joinWith('city as c')     
                ->where([
                    'promocodes.promocode' => $promocode_name
                ])
                ->one();
                //https://habrahabr.ru/post/318242/ must read
            return $promocode;
        }

        return [
            'error' => 'Необходимо ввести название промокода'
        ];

    }
}

?>