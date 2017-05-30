<?php
/**
 * _RSA_Pri2Pub RSA原始加密
 * 
 * RSA - 私钥加密，公钥解密
 *
 * @package     InterfaceWorker\Crypts\RSA
 * @author      kings
 */
namespace InterfaceWorker\Crypts\RSA;

use InterfaceWorker\Crypt;

class Pri2Pub implements Crypt {

    public function encrypt($data, $prikey) {
        $rs = '';

        if (@openssl_private_encrypt($data, $rs, $prikey) === FALSE) {
            return NULL;
        }

        return $rs;
    }

    public function decrypt($data, $pubkey) {
        $rs = '';

        if (@openssl_public_decrypt($data, $rs, $pubkey) === FALSE) {
            return NULL;
        }

        return $rs;
    }
}
