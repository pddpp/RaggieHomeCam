from time import localtime, strftime
import sys
sys.path.insert(0,'/usr/lib/python2.7/bridge')
from bridgeclient import BridgeClient as bridgeclient
client = bridgeclient()
#Get current vertical position of camera
curPosH = client.get('posH')
#Write to log.html
f = open("log.txt",'a')
f.write(strftime("%Y-%m-%d %H:%M:%S", localtime())+": Camera turn right, current posH(0-180) is %s. \n " % curPosH )

#Write next vertical position of camera to arduino
nxtPosH = min(int(curPosH)+3,120)
client.put('posH',str(nxtPosH).zfill(3))
if nxtPosH == 180: 
    f.write(strftime("%Y-%m-%d %H:%M:%S", localtime())+": Camera can't turn right more, posH is 180. \n")

f.write(strftime("%Y-%m-%d %H:%M:%S", localtime())+": Camera turn right, current posH(0-180) is %s. \n " % nxtPosH )