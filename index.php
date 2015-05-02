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
                  <img src="http://<?php echo $_SERVER['SERVER_NAME'];?>:8080/?action=stream" class="img-rounded" style="max-width:100%;max-height:100%" alt="Stream Image Here" />
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
                          <button id="viewRoom" name="viewRoom" class="btn btn-large btn-primary" cellpadding="10">View Room</button>
                          <button id="turnOnMusic" name="turnOnMusic" class="btn btn-large btn-success" cellpadding="10">Turn on Music</button>
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
                                <td><img id="forward" name="forward" src="forward.png" class="btn btn-large" id="forward"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><img id="left" name="left" src="left.png" class="btn btn-large"></td>
                                <td><img id="stop" name="stop" src="stop.png" class="btn btn-large"></td>
                                <td><img id="right" name="right" src="right.png" class="btn btn-large"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td align="center"><button id="clean" name="clean" id="cleanRoom" name="cleanRoom" class="btn btn-large btn-inverse">Clean</button></td>
                                <td></td>
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
    window.actionNum=1;
$("#camUp").click(function(){
    $('#selectedCommand').show().text("Camera up 3 degree");
    window.actionNum=2;
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

