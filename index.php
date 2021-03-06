<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Raggie's Home Camera</title>
        <script src="jquery-1.9.1.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container">
            <header><br>
                <h2>Raggie's Home Camera</h2>
            </header>
            <nav>
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" onClick="location.href='index.php'">Home</button>
                  </div>
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" onClick="location.href='log.html'">Log</button>
                  </div>
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" onClick="location.href='about.html'">About</button>
                  </div>
                </div> 
            </nav>
            <hr>
            <div>
                <p id="selectedCommand" name= "selectedCommand" class="text-danger"></p>
            </div>
            <div class="row">
                <div class="col-md-8">
<!--                  <img src="http://<?php echo $_SERVER['SERVER_NAME'];?>:8080/?action=stream" class="img-rounded" style="max-width:100%;max-height:100%" alt="Stream Image Here" />
 -->
                     <img src="http://raggie.x24hr.com:8080/?action=stream" class="img-rounded" style="max-width:100%;max-height:100%" alt="Stream Image Here" />
                </div>
              <div class="col-md-4"><br>
                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                    <li class="active"><a href="#auto" data-toggle="tab">Auto</a></li>
                    <li><a href="#manual-cam" data-toggle="tab">Control Camera</a></li>
                    <li><a href="#manual-wheel" data-toggle="tab">Control Wheel</a></li>
                </ul>
                <div id="my-tab-content" class="tab-content">
                    <div class="tab-pane active" id="auto">
                        <h1>Automated Houseworks</h1>
                        <div class="btn-group-vertical" role="group" aria-label="...">
                          <button id="cleanRoom" name="cleanRoom" class="btn btn-large btn-danger" cellpadding="10">Clean Room</button>
                          <button id="turnOnLamp" name="turnOnLamp" class="btn btn-large btn-primary" cellpadding="10">Turn on Lamp</button>
                          <button id="turnOffLamp" name="turnOffLamp" class="btn btn-large btn-warning" cellpadding="10"style="display:none;">Turn off Lamp</button>
                          <button id="turnOnLaser" name="turnOnLaser" class="btn btn-large btn-success" cellpadding="10" >Turn on Laser Toy</button> <!-- from http://jsfiddle.net/S4d6j/-->
                          <button id="turnOffLaser" name="turnOffLaser" class="btn btn-large btn-warning" cellpadding="10" style="display:none;">Turn off Laser Toy</button>
                        </div>
                    </div>
                    <div class="tab-pane" id="manual-cam">
                        <h2>Manually Control Camera</h2><br>
                        <table border="0" align="center" cellpadding="20">
                            <tr>
                                <td></td>
                                <td><img id="camUp" name="camUp" src="forward.png" class="btn btn-large"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><img id="camLeft" name="camLeft" src="left.png" class="btn btn-large"></td>
                                <td><img id="camRst" name="camRst" src="stop.png" class="btn btn-large"></td>
                                <td><img id="camRight" name="camRight" src="right.png" class="btn btn-large"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><img id="camDown" name="camDown" src="backward.png" class="btn btn-large"></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane" id="manual-wheel">
                        <h2>Manually Control Wheel</h2><br>
                        <table border="0" align="center" cellpadding="20">
                            <tr>
                                <td></td>
                                <td><img id="forward" name="forward" src="backward.png" class="btn btn-large" id="forward"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><img id="left" name="left" src="left.png" class="btn btn-large"></td>
                                <td><img id="stop" name="stop" src="stop.png" class="btn btn-large"></td>
                                <td><img id="right" name="right" src="right.png" class="btn btn-large"></td>
                            </tr>
                            <tr>
                                <td align="center"><button id="spot" name="spot" class="btn btn-large btn-primary">    Spot    </button></td>
                                <td align="center"><button id="clean" name="clean" class="btn btn-large btn-danger">  Clean  </button></td>g
                                <td align="center"><button id="dock" name="dock" class="btn btn-large btn-success">   Dock   </button></td>
                            </tr>

                        </table>
                    </div>
                </div>
              </div>
            </div>
        <footer>Copyright: Raggie.x24hr.com </footer>
        </div>
<script type="text/javascript">
var actionNum="";
$(function(){
$("#cleanRoom").click(function(){
    $('#selectedCommand').show().text("Clean Room Started..");
    window.actionNum=11;
});
$("#camUp").click(function(){
    $('#selectedCommand').show().text("Camera up 6 degree");
    window.actionNum=2;
});
$("#camDown").click(function(){
    $('#selectedCommand').show().text("Camera down 6 degree");
    window.actionNum=3;
});
$("#camLeft").click(function(){
    $('#selectedCommand').show().text("Camera turn left 15 degree");
    window.actionNum=4;
});
$("#camRight").click(function(){
    $('#selectedCommand').show().text("Camera right 15 degree");
    window.actionNum=5;
});
$("#camRst").click(function(){
    $('#selectedCommand').show().text("Camera position reset to central");
    window.actionNum=6;
});
$("#turnOnLaser").click(function(){
    $('#selectedCommand').show().text("Laser toy is on");
    $('#turnOffLaser').show();
    $(this).hide();
    window.actionNum=7;
});
$("#turnOffLaser").click(function(){
    $('#selectedCommand').show().text("Laser toy is off");
    $('#turnOnLaser').show();
    $(this).hide();
    window.actionNum=8;
});
$("#forward").click(function(){
    $('#selectedCommand').show().text("Robot going forward for 1 meter");
    window.actionNum=14;
});
$("#left").click(function(){
    $('#selectedCommand').show().text("Robot turning left for 90 degree");
    window.actionNum=15;
});
$("#stop").click(function(){
    $('#selectedCommand').show().text("Stopping current program on robot");
    window.actionNum=11;
});
$("#right").click(function(){
    $('#selectedCommand').show().text("Robot turning right for 90 degree");
    window.actionNum=17;
});
$("#clean").click(function(){
    $('#selectedCommand').show().text("Starting clean room program or pause current program");
    window.actionNum=11;
});
$("#spot").click(function(){
    $('#selectedCommand').show().text("Starting dirt spot clean program");
    window.actionNum=12;
});
$("#dock").click(function(){
    $('#selectedCommand').show().text("Robot going back home");
    window.actionNum=13;
});
$("#turnOnLamp").click(function(){
    $('#selectedCommand').show().text("Lamp in the room is on");
    $('#turnOffLamp').show();
    $(this).hide();
    window.actionNum=21;
});
$("#turnOffLamp").click(function(){
    $('#selectedCommand').show().text("Lamp in the room is off");
    $('#turnOnLamp').show();
    $(this).hide();
    window.actionNum=22;
});
$(this).click(function(){
   console.log("actionNum: "+actionNum);
   
    $.ajax({
        data:{'actNum': actionNum},
        url:'process.php',
        type:'POST',
        success: function(response){
            //alert("Salida: "+response );
        }
    });
  });

});
</script>
    </body>
</html>

