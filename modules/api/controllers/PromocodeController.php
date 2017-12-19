<?php 

namespace app\modules\api\controllers;

use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use app\models\PromocodesSearch;
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

    public function actionGetDiscountInfo($token) {
    	

        $promocode_name = Yii::$app->request->get('promocode_name');
        if ($promocode_name) {
            $promocode = PromocodesSearch::getPromocodeInfo($promocode_name);
            return $promocode;
        }

        return [
            'error' => 'Необходимо ввести название промокода'
        ];

    }

    /**
    * Активирует для клиента промокод в определенной зоне
    * @var $token - csrf token
    * @return $compensation - вознаграждение клиента
    */
    public function actionActivateDiscount($token) {

        if (!$token) {
            Yii::$app->response->statusCode(401);
        }

        $errors = (null !== Yii::$app->request->get('promocode_name') AND Yii::$app->request->get('promocode_name')!='') ? '': 'Не указан промокод';
        $errors .= (null !== Yii::$app->request->get('city_id') AND Yii::$app->request->get('city_id') !='') ? '' : 'Не указана тарифная зона';

        if(strlen($errors) > 0){
            return [
                'error' => $errors
            ];
        }
        
        $compensation = PromocodesSearch::activateDiscount();

        return $compensation;
    }
}

?>