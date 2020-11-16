<?php
namespace app\modules\api\v1\controllers\user;

use approot\App;
use approot\classes\Request;
use approot\classes\authentication\user\login_middleware\LoginByAPI_KEY;
use app\modules\api\v1\models\user\FriendModel__GET;

/**
 *
 *
 */
class FriendController extends \approot\AppControllerAPI_REST
{

    /**
     *
     *
     */
    protected function afterInit(array $data): void
    {
        if($data['method'] == 'get'){
            LoginByAPI_KEY::init();
            
            if(App::$user::isGuest() === true){
                $this->responseJSON([
                    "error" => "Authentication required", 
                    "status" => 401
                ]); 
            }
        }
    }

    /**
     *
     *
     */
    protected function get(): void
    {
        $model = new FriendModel__GET();
        $model->userid = Request::getParamGET('userid');
        if($model->validation()){
            $this->responseJSON($model->getData());                
        }

        $this->responseJSON($model->getErrorModel());
    }
    
}



