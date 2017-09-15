<?php
function es_admin($user, $pass){
  if ($user == 'admin' && $pass == 'admin') {
    return true;
  } else {
    return false;
  }
}
 ?>
