<?php
/**
 * BadRequestError 客户端非法请求
 *
 * 客户端非法请求
 *
 * @package     InterfaceWorker\Exception
 * @author      kings
 */
namespace InterfaceWorker\Exceptions;

use InterfaceWorker\Exceptions;

class BadRequestException extends Exceptions{

    public function __construct($message, $code = 0) {
        parent::__construct(
            "Bad Request: {$message}", 400 + $code
        );
    }
}
