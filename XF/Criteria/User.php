<?php

namespace PHPCriteria\XF\Criteria;

use XF\Util\Php;

class User extends XFCP_User
{
    public function _matchPhpCallback(array $data, \XF\Entity\User $user)
    {
        $class = $data['callback_class'];
        $method = $data['callback_method'];

        if (!Php::validateCallback($class, $method))
        {
            $this->app->error()->logError(\XF::phrase('phpcriteria_can_not_find_callback', [
                'class' => $class,
                'method' => $method
            ]));

            return false;
        }

        return (bool)call_user_func_array([$class, $method], [$this->app, $user]);
    }
}