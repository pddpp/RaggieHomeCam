#include <RCSwitch.h>

#include <Servo.h>
#include <Bridge.h>
#include <stdio.h>
#include <IRremote.h>

//Define RCswitch
RCSwitch mySwitch = RCSwitch();
//Define three servos
Servo servoBase;
Servo servoArm;
Servo servoLaser;
//Define variables to hold value read from bridge
char posVc[4];
char posHc[4];
char laserOnc[2];
char wheelCmd[2];
char sw1Onc[2];
char sw2Onc[2];
char sw3Onc[2];
char sw4Onc[2];
//PIN for servo, IR transmit pin is 13, RCswitch pin is 10
const int servoBasePIN = 9;
const int servoArmPIN= 6;
const int servoLaserPIN = 5;
const int servoDelay = 500;

//preset ir signal for wheel commands, got from IRrecord.ino
unsigned int cleanCmd[15]={2850,1100,900,3000,850,3050,850,3050,2750,1100,850,3100,800,3100,800};
unsigned int forwardCmd[15]={2800,1150,850,3050,800,3100,800,3050,850,3050,850,3050,2750,1150,800};
unsigned int leftCmd[15]={2800,1150,850,3050,800,3100,800,3050,800,3100,800,3050,800,3100,2750};
unsigned int rightCmd[15]={2850,1100,850,3050,850,3050,850,3000,900,3000,850,3050,2800,1150,2800};
unsigned int stopCmd[15]={2800,1150,800,3100,850,3050,800,3050,2750,1150,2800,1100,850,3050,2750};
unsigned int dockCmd[15]={2850,1150,850,3050,850,3050,850,3050,800,3100,2750,1100,850,3050,2750};
unsigned int spotCmd[15]={2800,1150,800,3100,850,3050,850,3050,850,3050,2800,1100,850,3050,850};
//prset rc switch signal for switch1-4 on/off 
unsigned long sw1OnCmd= 1332531;
unsigned long sw1OffCmd= 1332540;
unsigned long sw2OnCmd= 1332675;
unsigned long sw2OffCmd = 1332684;
unsigned long sw3OnCmd= 1332995;
unsigned long sw3OffCmd= 1333004;
unsigned long sw4OnCmd= 1340675;
unsigned long sw4OffCmd = 1340684;
//original bridge values
int posVInt = 140;
int posHInt = 90;
int posVIntOrg = 140;
int posHIntOrg = 90;
int wheelCmdOrg = 0;
int wheelCmdInt = 0;
char laserOnOrg;
int loopCount = 0;
char sw1OnOrg;
char sw2OnOrg;
char sw3OnOrg;
char sw4OnOrg;

IRsend irsend;

void setup() {
  
  // put your setup code here, to run once:
  servoBase.attach(servoBasePIN);
  servoArm.attach(servoArmPIN);
  //servoLaser.attach(servoLaserPIN);
  
  servoBase.write(posHInt);
  servoArm.write(posVInt);
  //servoLaser.write(servoLaser.read());
  delay(servoDelay);
  //detach servoBase and servoArm to give them a rest
  servoBase.detach();
  servoArm.detach();
  
  Bridge.begin();
  //posH is a variable to be read by python script
  Bridge.get("posH",posHc, 4);
  Bridge.put("posH","090");
  
  delay(10);
  //posV is a variable to be read by python script
  Bridge.get("posV",posVc, 4);
  Bridge.put("posV","140");
  
  delay(10);
  //startLaser is a variable read from python script
  Bridge.get("laserOn",laserOnc,2);
  Bridge.put("laserOn","N");
  delay(10);
  //wheelCmd is a variable to be read by python script
  Bridge.get("wheelCmd",wheelCmd, 2);
  Bridge.put("wheelCmd","0");  
  delay(10);
  //startLaser is a variable read from python script
  Bridge.get("sw1On",sw1Onc,2);
  Bridge.put("sw1On","N");
  delay(10);
  //startLaser is a variable read from python script
  Bridge.get("sw2On",sw2Onc,2);
  Bridge.put("sw2On","N");
  delay(10);
  //startLaser is a variable read from python script
  Bridge.get("sw3On",sw3Onc,2);
  Bridge.put("sw3On","N");
  delay(10);
  //startLaser is a variable read from python script
  Bridge.get("sw4On",sw4Onc,2);
  Bridge.put("sw4On","N");
  delay(500);
  
  // Transmitter is connected to Arduino Pin #10  
  mySwitch.enableTransmit(10);
  // Optional set pulse length.
  mySwitch.setPulseLength(188);
  //send turn off commands to ensure all switches are off
  mySwitch.send(sw1OffCmd, 24);
  delay(100);
  mySwitch.send(sw2OffCmd, 24);
  delay(100);
  mySwitch.send(sw3OffCmd, 24);
  delay(100);
  mySwitch.send(sw4OffCmd, 24);
  delay(100);
}

void loop() {
    //Get the latest wheelCmd and send IR signal
    Bridge.get("wheelCmd",wheelCmd, 2);
    wheelCmdInt = atoi(wheelCmd);
    if(wheelCmdInt != 0){ sendIRCmd(wheelCmdInt);}
    
    delay(10);
    
    //Get the latest posH and write to servoBase
    
    Bridge.get("posH",posHc, 4);
    posHIntOrg = posHInt;
    posHInt = atoi(posHc);
    if(posHIntOrg != posHInt){
      servoBase.attach(servoBasePIN);
      servoBase.write(posHInt);
      delay(servoDelay);
      servoBase.detach();
      
    }
    delay(10);
    
    //Get the latest posV and write to servoArm
    Bridge.get("posV",posVc, 4);
    posVIntOrg = posVInt;
    posVInt = atoi(posVc);
    if (posVIntOrg != posVInt){
      servoArm.attach(servoArmPIN);
      servoArm.write(posVInt);
      delay(servoDelay);
      servoArm.detach();
    }
    delay(10);
    
    laserOnOrg = laserOnc[0];
    Bridge.get("laserOn",laserOnc,2);
    if(laserOnOrg != laserOnc[0]){
      if(laserOnc[0] == 'Y'){ //if char then need to be single quote!!!
        servoLaser.attach(servoLaserPIN);
      }else{
        servoLaser.detach();
        
      }
    }
    //check if switch1-4 changed
    sw1OnOrg = sw1Onc[0];
    Bridge.get("sw1On",sw1Onc,2);
    if(sw1OnOrg != sw1Onc[0]){
      if(sw1Onc[0] == 'Y'){ //if char then need to be single quote!!!
        mySwitch.send(sw1OnCmd, 24);
      }else{
        mySwitch.send(sw1OffCmd, 24);
        
      }
    }
    sw2OnOrg = sw2Onc[0];
    Bridge.get("sw2On",sw2Onc,2);
    if(sw2OnOrg != sw2Onc[0]){
      if(sw2Onc[0] == 'Y'){ //if char then need to be single quote!!!
        mySwitch.send(sw2OnCmd, 24);
      }else{
        mySwitch.send(sw2OffCmd, 24);
        
      }
    }
    sw3OnOrg = sw3Onc[0];
    Bridge.get("sw3On",sw3Onc,2);
    if(sw3OnOrg != sw3Onc[0]){
      if(sw3Onc[0] == 'Y'){ //if char then need to be single quote!!!
        mySwitch.send(sw3OnCmd, 24);
      }else{
        mySwitch.send(sw3OffCmd, 24);
        
      }
    }
    sw4OnOrg = sw4Onc[0];
    Bridge.get("sw1On",sw4Onc,2);
    if(sw4OnOrg != sw4Onc[0]){
      if(sw1Onc[0] == 'Y'){ //if char then need to be single quote!!!
        mySwitch.send(sw4OnCmd, 24);
      }else{
        mySwitch.send(sw4OffCmd, 24);
        
      }
    }
    
    if (loopCount == 10){ //change direction of servoLaser about every 6 sec
      if (servoLaser.attached()){
        servoLaser.write(random(0,180));
        
      }
      loopCount = 0;
      
    }
    loopCount+=1;
}

void sendIRCmd(int cmdInt){
    switch(cmdInt){
      case 0:
        break;
      case 1:
        for(int i = 0; i<10; i++){
          irsend.sendRaw(cleanCmd,15,38);
          delay(10);
        }
        break;
      case 2:
        for(int i = 0; i<10; i++){
          irsend.sendRaw(spotCmd,15,38);
          delay(10);
        }
        break;
       case 3:
        for(int i = 0; i<10; i++){
          irsend.sendRaw(dockCmd,15,38);
          delay(10);
        }
        break;
      case 4:
        for(int i = 0; i<100; i++){
          irsend.sendRaw(forwardCmd,15,38);
          delay(10);
        }
        for (int i = 0; i<3;i++){
          irsend.sendRaw(stopCmd,15,38);
          delay(10);
        }
        break;
       case 5:
         for(int i = 0; i<25; i++){
          irsend.sendRaw(leftCmd,15,38);
          delay(10);
          }
         for (int i = 0; i<3;i++){
           irsend.sendRaw(stopCmd,15,38);
           delay(10);
          }
          break;
       case 6:
         for (int i = 0; i<5;i++){
           irsend.sendRaw(stopCmd,15,38);
           delay(10);
          }
         break;
       case 7:
         for(int i = 0; i<25; i++){
            irsend.sendRaw(rightCmd,15,38);
            delay(10);
          }
         for (int i = 0; i<3;i++){
           irsend.sendRaw(stopCmd,15,38);
           delay(10);
          }
          break;      
    }
    Bridge.put("wheelCmd","0");
    delay(10);
}
