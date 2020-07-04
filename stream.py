import os
import sys
import subprocess
#delays used on link
#delay = [10, 50, 100]
#bandwidth combinations
#ban = [5,10,15]
#packetloss combinations
#ploss = [0.0]
#number of hosts (Nodes) to run
host = [2]
p  ='arbiter'
col = 3
count = 1
for curr in range(count):
    for h in host:
        clear = 'sudo mn -c'
        run_top_script = 'sudo python topo.py '+ str(h)+ ' ' + str(p)+ ' ' + str(col)       
        subprocess.run(clear.split(' '))
        print(run_top_script)
        subprocess.run(run_top_script.split(' '))
