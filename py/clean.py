from time import gmtime, strftime
#Write to log.html
f = open("../log.txt",'a')
f.write(strftime("%Y-%m-%d %H:%M:%S", gmtime())+": Starts the automation clean room process.")
