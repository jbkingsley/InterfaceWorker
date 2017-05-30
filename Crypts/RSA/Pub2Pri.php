<?php
/**
 * RSA_Pub2Pri 原始RSA加密
 * 
 * RSA - 公钥加密，私钥解密
 *
 * @package     InterfaceWorker\Crypts\RSA
 * @author      kings
 */
namespace InterfaceWorker\Crypts\RSA;

use InterfaceWorker\Crypt;

class Pub2Pri implements Crypt {

    public function encrypt($data, $pubkey) {
        $rs = '';

        if (@openssl_public_encrypt($data, $rs, $pubkey) === FALSE) {
            return NULL;
        }

        return $rs;
    }
    
    public function decrypt($data, $prikey) {
        $rs = '';

        if (@openssl_private_decrypt($data, $rs, $prikey) === FALSE) {
            return NULL;
        }

        return $rs;
    }
}
