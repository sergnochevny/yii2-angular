<?php
/**
 * Date: 14.10.2017
 * Time: 15:59
 */

namespace app\behaviors;

use Yii;
use yii\base\Behavior;
use yii\web\Application;
use yii\web\Response;

class GetApplication extends Behavior{

    public $exclude = [
        'gii/default/index',
        'gii/default/create',
        'gii/default/view',
    ];

    /**
     * @inheritdoc
     */
    public function events(){
        return [
            Application::EVENT_BEFORE_REQUEST => 'beforeRequest',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeRequest($event){
        if(!Yii::$app->getRequest()->getIsAjax()) {
            Yii::$app->response->format = Response::FORMAT_HTML;
            if(YII_ENV_DEV) {
                /**
                 * @var $app Application
                 */
                $app = $event->sender;
                $request = $app->getRequest();
                list($route, $params) = $request->resolve();
                if(in_array($route, $this->exclude)) {
                    return true;
                }
            }
            Yii::$app->catchAll = [Yii::$app->defaultRoute];
        }

        return true;
    }

}