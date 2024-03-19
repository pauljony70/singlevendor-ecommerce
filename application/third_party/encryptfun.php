<?php
class encryptfun
{
    private $iv  = '1234567890123456'; #Same as in JAVA
  //  private $key = '6543210987654321'; #Same as in JAVA  ///AES only supports key sizes of 16, 24 or 32 bytes.

    public function __construct() {
       // echo "constr";
    }
    
    function encryptNewValueEverytime($key, $payload) {
      $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
      $encrypted = openssl_encrypt($payload, 'aes-256-cbc', $key, 0, $iv);
      return base64_encode($encrypted . '::' . $iv);
    }
    
    function decryptforNewValueEverytime($key, $garble) {
        list($encrypted_data, $iv) = explode('::', base64_decode($garble), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
    }
    
    function encrypt($key, $string ) {
        
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $key );
		$iv  = '1234567890123456';

        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
       
        return $output;
    }
    function decrypt($key, $string ){
        
         $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $key );
		$iv  = '1234567890123456';

        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
      
        return $output; 
    }
    
    
}
?>