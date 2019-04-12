<?php

namespace PHPCriteria\XF\Admin\Controller;

use XF\Mvc\ParameterBag;
use XF\Util\Php;

class Trophy extends XFCP_Trophy
{
    public function actionSave(ParameterBag $params)
    {
        $userCriteria = $this->filter([
            'user_criteria' => 'array'
        ]);
        $userCriteria = $userCriteria['user_criteria'];

        if(array_key_exists('php_callback', $userCriteria))
        {
            $class = $userCriteria['php_callback']['data']['callback_class'];
            $method = $userCriteria['php_callback']['data']['callback_method'];

            if (!Php::validateCallbackPhrased($class, $method, $error))
            {
                return $this->error($error);
            }
        }

        return parent::actionSave($params);
    }
}