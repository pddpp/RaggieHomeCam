from time import localtime, strftime
import sys
sys.path.insert(0,'/usr/lib/python2.7/bridge')
from bridgeclient import BridgeClient as bridgeclient
client = bridgeclient()

f = open("log.txt",'a')

client.put('laserOn',"Y")

f.write(strftime("%Y-%m-%d %H:%M:%S", localtime())+": Laser toy is on. \n")