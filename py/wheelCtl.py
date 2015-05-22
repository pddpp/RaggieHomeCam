from time import localtime, strftime
import sys
cmdNum = sys.argv[1]-10
sys.path.insert(0,'/usr/lib/python2.7/bridge')
from bridgeclient import BridgeClient as bridgeclient
client = bridgeclient()
f = open("log.txt",'a')
client.put('wheelCmd',str(cmdNum))
f.write(strftime("%Y-%m-%d %H:%M:%S", localtime())+": wheel  command trigered %s\n" % cmdNum)