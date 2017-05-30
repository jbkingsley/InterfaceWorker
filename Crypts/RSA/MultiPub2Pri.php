<?php
/**
 * RSA_MultiPub2Pri 超长RSA加密
 * 
 * RSA - 公钥加密，私钥解密 - 超长字符串的应对方案
 *
 * @package     InterfaceWorker\Crypts\RSA
 * @author      kings
 */
namespace InterfaceWorker\Crypts\RSA;

use InterfaceWorker\Crypts\RSA;

class MultiPub2Pri extends MultiBase {

    protected $pub2pri;

    public function __construct() {
        $this->pub2pri = new Pub2Pri();

        parent::__construct();
    }

    protected function doEncrypt($toCryptPie, $pubkey) {
        return $this->pub2pri->encrypt($toCryptPie, $pubkey);
    }

    protected function doDecrypt($encryptPie, $prikey) {
        return $this->pub2pri->decrypt($encryptPie, $prikey);
    }
}
