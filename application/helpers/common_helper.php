<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('print_rr'))
{
	function print_rr($__array, $exit = NULL)
	{
        echo '<div style="border: 1px solid #000; padding: 10px;">';
        echo '<pre>';
        // $log = debug_backtrace();
        $log = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS ,1)[0];  
        unset($log['function']);
        print_r($log);
        if(is_array($__array)){
            print_r($__array);
        }
        if(is_string($__array)){
            print($__array);
        }
        if(false == is_null($exit))
        {   echo '<br/>';
            if(is_array($exit)){
                print_r($exit);
            }else if($exit != ''){
                echo $exit;
            }
            echo '</pre></div>';
            exit;
        }
        echo '</pre></div>';
	}

    function get_password_hash($pwd,$encrypt = true){
        if($encrypt){
            $hash = PASSWORD_BCRYPT;
        }else{
            $hash = PASSWORD_DEFAULT;
        }
        return password_hash($pwd,$hash);
    }
}


/**
Example:
for encrypt
encryptor("encode", "ANUJSHARMA");
for decrypt
encryptor("decode", "TEg3SDVJVC9uZ2VvZUJTU1M4ZUhzUT09");
**/
function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $key = hash('sha256', SECURITY_SALT);
    $iv = substr(hash('sha256', SECURITY_IV), 0, 16);
    switch($action){
    	case 'encode':
    	{
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = rtrim(base64_encode($output),"=");
	    }
	    break;
	    case 'decode':
	    {
    	    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }
	    break;
	}
    return $output;
}

function exitWithJson($status, $msg, $__array = []){
    if(!empty($__array)){
        $data['data'] = $__array;
    }
    $data['status'] = $status;
    $data['msg'] = $msg;
    echo json_encode($data, JSON_FORCE_OBJECT|JSON_HEX_QUOT|JSON_PRETTY_PRINT);
    exit;
}

function generateToken() {
    return bin2hex(openssl_random_pseudo_bytes(64));
}