<?php
/**
 * MultiPri2Pub 超长RSA加密
 * 
 * RSA - 私钥加密，公钥解密 - 超长字符串的应对方案
 *
 * @package     InterfaceWorker\Crypts\RSA
 * @author      kings
 */

namespace InterfaceWorker\Crypts\RSA;

use InterfaceWorker\Crypts\RSA;

class MultiPri2Pub extends MultiBase {

    protected $pri2pub;

    public function __construct() {
        $this->pri2pub = new Pri2Pub();

        parent::__construct();
    }

    protected function doEncrypt($toCryptPie, $prikey) {
        return $this->pri2pub->encrypt($toCryptPie, $prikey);
    }

    protected function doDecrypt($encryptPie, $prikey) {
        return $this->pri2pub->decrypt($encryptPie, $prikey);
    }
}
