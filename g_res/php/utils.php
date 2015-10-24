<?php

function startsWith($haystack, $needle) {
  // search backwards starting from haystack length characters from the end
  return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

function endsWith($haystack, $needle) {
  // search forward starting from end minus needle length characters
  return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}
function putFormDir($dir, $name) {
 echo "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\"><input type=\"hidden\" name=\"dir\" value=\"" . $dir . "\"><button class=\"button\" type=\"submit\">" . $name . "</button></form>";
}
                
?>
