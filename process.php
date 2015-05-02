<?php
$actNum=$_POST['actNum'];
switch ($actNum) {
    case 1:
        exec('python py/clean.py');
        break;
    case 2:
        exec('python py/camUp.py');
        break;
    case 3:
        exec('sudo python /var/www/control/py/derecha.py');
        break;
    case 4:
        exec('sudo python /var/www/control/py/retrocede.py');
        break;
    case 5:
        exec('sudo python /var/www/control/py/para.py');
        break;
    default:
        exec('sudo python /var/www/control/py/para.py');
        break;
}
?>