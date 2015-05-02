from time import localtime, strftime
import sys
sys.path.insert(0,'/usr/lib/python2.7/bridge')
from bridgeclient import BridgeClient as bridgeclient
client = bridgeclient()
#Get current vertical position of camera
curPosV = client.get('posV')
#Write to log.html
f = open("log.txt",'a')
f.write(strftime("%Y-%m-%d %H:%M:%S", localtime())+": Camera down, current posV(0-180) is %s. \n " % curPosV )

#Write next vertical position of camera to arduino
nxtPosV = min(int(curPosV)+3,180)
value.put('posV',str(nxtPosV))
if nxtPosV == 180: 
    f.write(strftime("%Y-%m-%d %H:%M:%S", localtime())+": Camera can't go down more, posV is 0. \n")

f.write(strftime("%Y-%m-%d %H:%M:%S", localtime())+": Camera down, current posV(0-180) is %s. \n " % nxtPosV )