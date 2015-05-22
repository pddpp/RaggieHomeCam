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
        exec('python py/camDown.py');
        break;
    case 4:
        exec('python py/camLeft.py');
        break;
    case 5:
        exec('python py/camRight.py');
        break;
    case 6:
        exec('python py/camRst.py');
        break;
    case 7:
        exec('python py/laserOn.py');
        break;
    case 8:
        exec('python py/laserOff.py');
        break;
}
if ($actNum>10 and $actNum<20){
    exec("python py/wheelCtl.py 12");
}
?>