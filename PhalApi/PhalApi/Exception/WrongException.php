<?php

/**
 * Created by .
 * User: denn
 * Date: 2017/2/15
 * Time: 18:50
 */
class PhalApi_Exception_WrongException extends PhalApi_Exception
{

    public function __construct($message, $code = 0) {
        parent::__construct(
            $message, 40001+$code
        );
    }
}