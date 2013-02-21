<?php
/*
  $Id: password_funcs.php,v 1.10 2003/02/11 01:31:02 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

//checking null value
function tep_not_null($value) {
    if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      if ( (is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) {
        return true;
      } else {
        return false;
      }
    }
  }
////
// This funstion validates a plain text password with an
// encrpyted password
  function validate_password($plain, $encrypted) {
// split apart the hash / salt
      $stack = explode(':', $encrypted);

      if (sizeof($stack) != 2) return false;

      if (sha1($stack[1] . $plain) == $stack[0]) {
		  echo "stack 1:".sha1($stack[1] . $plain) . "<br />" . "stack 0 :" . $stack[0];
        return true;
      }
    }





////
// Return a random value
  function tep_rand($min = null, $max = null) {
    static $seeded;

    if (!$seeded) {
      mt_srand((double)microtime()*1000000);
      $seeded = true;
    }

    if (isset($min) && isset($max)) {
      if ($min >= $max) {
        return $min;
      } else {
        return mt_rand($min, $max);
      }
    } else {
      return mt_rand();
    }
  }

////
// This function makes a new password from a plaintext password. 
  function encrypt_password($plain) {
    $password = '';

    for ($i=0; $i<10; $i++) {
      $password .= tep_rand();
    }

    $salt = substr(sha1($password), 0, 2);

    $password = sha1($salt . $plain) . ':' . $salt;

    return $password;
  }
  
  $encript = "123";
  $encript = encrypt_password($encript);
  echo $encript. "<br />";
  echo "<br />" .validate_password("123",$encript);
?>
