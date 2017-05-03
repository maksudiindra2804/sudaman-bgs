<?php
/**
 * Encrypter.php
 *
 * PHP version 5.2+
 *
 * @author    Paul Lowndes <paul@gtcode.com>
 * @author    GTCode
 * @link      http://www.GTCode.com/
 * @package   Encrypt
 * @version   0.1
 * @category  ext
 */

/**
 * Encrypter is a simple class using Yii to encrypt using mcrypt.
 *
 * It is based on this article, first answer:
 * http://stackoverflow.com/questions/2448256/php-mcrypt-encrypting-decrypting-file/2448441#2448441
 *
 * The extension requires mcrypt for PHP.
 *
 * It is strongly recommended that you do *not* use this for credit cards, and
 * certainly not for passwords (which you should be hashing using the phpass
 * extension).  Valid use case scenarios would include encrypting transaction
 * or subscription tokens for recurring payments.  The tokens could be provided
 * by, for example, Authorize.net's CIM method, which is a service that stores
 * credit card data for you, avoiding the need to store the actual CC data
 * locally, and you would simply use a token for completing recurring payments.
 *
 * Choosing modes:
 * http://stackoverflow.com/questions/1220751/how-to-choose-an-aes-encryption-mode-cbc-ecb-ctr-ocb-cfb
 * http://en.wikipedia.org/wiki/Block_cipher_modes_of_operation
 *
 */
class Encrypter extends CApplicationComponent
{
    public $cypher = 'rijndael-256';
    public $mode = 'cfb';
    public $key = null;
    
    public $functionsCheck = array(
        'mcrypt_module_open',
        'mcrypt_enc_get_iv_size',
        'mcrypt_create_iv',
        'mcrypt_generic_init',
        'mcrypt_generic',
        'mcrypt_generic_deinit',
    );
    
    public function init() {
        if (!$this->cypher || !$this->mode || !$this->key) {
            throw new CException('Encryption library called without proper config');
        }
        foreach ($this->functionsCheck as $function) {
            if (!function_exists($function)) {
                throw new CException('Encryption library called without function ' . $function);
            }
        }
        return parent::init();
    }
    
    public function encrypt($plaintext) {
        $td = mcrypt_module_open($this->cypher, '', $this->mode, '');
        $this->verifyModuleOpen($td);
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        if ($iv === false) {
            throw new CException('Problem opening via mcrypt_create_iv');
        }        
        $init = mcrypt_generic_init($td, $this->key, $iv);
        $this->verifyGenericInit($init);
        $crypttext = mcrypt_generic($td, $plaintext);
        mcrypt_generic_deinit($td);
        return $iv . $crypttext;
    }
    
    public function decrypt($crypttext) {
        $plaintext = '';
        $td = mcrypt_module_open($this->cypher, '', $this->mode, '');
        $this->verifyModuleOpen($td);
        $ivsize = mcrypt_enc_get_iv_size($td);
        $iv = substr($crypttext, 0, $ivsize);
        $crypttext = substr($crypttext, $ivsize);
        if ($iv) {
            mcrypt_generic_init($td, $this->key, $iv);
            $this->verifyGenericInit($init);
            $plaintext = mdecrypt_generic($td, $crypttext);
        }
        return $plaintext;
    }
    
    private function verifyModuleOpen($td) {
        if ($td === false) {
            throw new CException('Problem opening via mcrypt_module_open, using cypher ' . $this->cypher . ' and mode ' . $this->mode);
        }        
    }
    
    private function verifyGenericInit($init) {
        if ($init === false) {
            throw new CException('Incorrect parameters passed to mcrypt_generic_init');
        } else if ($init < 0) {
            switch ($init) {
                case -3:
                    throw new CException('Incorrect key length passed to mcrypt_generic_init');
                    break;
                case -4:
                    throw new CException('Memory allocation problems using mcrypt_generic_init');
                    break;
                default:
                    throw new CException('Unknown error using mcrypt_generic_init');
                    break;
            }
        }        
    }
}