<?php

namespace app\rbac\rules;

use sn\rbac\Rule;
use app\models\Event;

class OwnerRule extends Rule{

    public $name = 'isOwner';

    public function execute($user, $item, $params){
        /**
         * @var Event $event
         */
        if(isset($params['event']) && ($params['event'] instanceof Event)) {
            $event = $params['event'];

            return $event->user->id == $user;
        }

        return false;
    }

}