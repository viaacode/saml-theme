<?php
$env = "%%ENV%%";
switch ($env) {
  case "integration":
    $prefix= "-int";
  break;
  case "development":
    $prefix= "-tst";
  break;
  case "staging":
    $prefix= "-qas";
  break;
  case "production":
    $prefix= "";
  break;
}
$this->data['meemoo_environment'] = $prefix;

echo "<!--". ($env) .": ".$prefix." -->";
?>
