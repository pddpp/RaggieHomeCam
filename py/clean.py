from time import localtime, strftime
#Write to log.html
f = open("log.txt",'a')
f.write(strftime("%Y-%m-%d %H:%M:%S", localtime())+": Starts the automation clean room process.\n")
