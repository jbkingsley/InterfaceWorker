<?php
/**
 * ServerInternalError 服务器运行异常错误
 *
 * @package     InterfaceWorker\Exception
 * @author      kings
 */
namespace InterfaceWorker\Exceptions;

use InterfaceWorker\Exceptions;

class ServerInternalException extends Exceptions {

    public function __construct($message, $code = 0) {
        parent::__construct(
            "Internal Server Error: {$message}", 500 + $code
        );
    }
}
