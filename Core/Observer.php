<?php
/**
 * Created by PhpStorm.
 * User: simona
 * Date: 11/10/2018
 * Time: 17:48
 */
namespace Core;

abstract class Observer

{
    public function __construct($subject = null) {
        if (is_object($subject) && $subject instanceof Subject) {
            $subject->attach($this);
        }
    }

    public function update($subject) {
        // looks for an observer method with the state name
        if (method_exists($this, $subject->getState())) {
            call_user_func_array(array($this, $subject->getState()), array($subject));
        }
    }


}