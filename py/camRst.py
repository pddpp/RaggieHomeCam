from time import localtime, strftime
import sys
sys.path.insert(0,'/usr/lib/python2.7/bridge')
from bridgeclient import BridgeClient as bridgeclient
client = bridgeclient()
#Get current vertical position of camera
curPosH = client.get('posH')
curPosV = client.get('posV')
#Write to log.html
f = open("log.txt",'a')
f.write(strftime("%Y-%m-%d %H:%M:%S", localtime())+": Current posH(0-180) is %s; Current posV(0-180) is %s. \n " % (curPosH,curPosV) )

#Write next vertical position of camera to arduino
nxtPosH = 90
nxtPosV = 140
value.put('posH',str(nxtPosH).zfill(3))
value.put('posV',str(nxtPosV).zfill(3))
f.write(strftime("%Y-%m-%d %H:%M:%S", localtime())+": Current posH(0-180) is %s; Current posV(0-180) is %s. \n " % (curPosH,curPosV) )