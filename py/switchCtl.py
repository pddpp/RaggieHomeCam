from time import localtime, strftime
import sys
cmdNum = int(sys.argv[1])-20
print cmdNum
swNum = "sw"+str((cmdNum+1)/2)+"On"
swStatus = 'N' if cmdNum%2==0 else 'Y'
print swNum+"   "+swStatus
sys.path.insert(0,'/usr/lib/python2.7/bridge')
from bridgeclient import BridgeClient as bridgeclient
client = bridgeclient()
f = open("log.txt",'a')
client.put(swNum,swStatus)
f.write(strftime("%Y-%m-%d %H:%M:%S", localtime())+": switch %s is changed to %s\n" % (swNum, swStatus) )
#f.write("%s\n" % cmdNum)
print strftime("%Y-%m-%d %H:%M:%S", localtime())+": switch %s is changed to %s\n" % (swNum, swStatus)