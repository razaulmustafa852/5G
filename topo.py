import sys
from mininet.log import setLogLevel, info
from mininet.node import Controller, RemoteController
from mininet.link import TCLink

from mn_wifi.net import Mininet_wifi
from mn_wifi.cli import CLI
from mn_wifi.net import Mininet_wifi
from multiprocessing import Process
import os
import time
import  random
station = []
import math
def roundup(x):
    return int(math.ceil(x / 100.0)) * 100

def topology():

    h= int(sys.argv[1])

    p = sys.argv[2]
    #c = int(sys.argv[3])

    d = int(sys.argv[3])
    
    #p = float(sys.argv[4])

    "Create a network."
    #net = Mininet_wifi( controller=RemoteController, link=TCLink )

    net = Mininet_wifi( controller=Controller, link=TCLink )
    
    info("*** Creating nodes\n")
    
    for i in range(h):
        m='sta%s' % (i+1)
        j=i+1
        station.insert(i, net.addHost(m, ip='192.168.0.%s/24'%(j)))

    s3= net.addSwitch('s3')
     
    s4= net.addSwitch('s4')
    server = net.addHost('server', ip='192.168.0.150/24' )
    c0 = net.addController('c0')
    #queue_size = (b * d * 1000) / (1500 * 8)
    #queue_size = roundup(queue_size)
    info("*** Adding Link\n")
    for i in range(h):
        net.addLink(s3, station[i])
    #net.addLink(server, s3, 1, 100, link='weird', bw=b, delay= str(d)+'ms', loss= p, max_queue_size=queue_size)
    net.addLink(s3,s4,100,1)
    net.addLink(server, s4, 1 ,100)
    info("*** Starting network\n")
    net.build()
    c0.start()
    s3.start([c0])
    s4.start([c0])
    #info("*** Running CLI\n")
    time.sleep(05)
    subfolder = 'host_' + str(h) + '_'+str(p)+ '_'+str(d) 
    os.system('mkdir -p ' + subfolder)
    #for i in range(h):
        #stt='sta%s' % (i+1)
        #stta=net.get(stt)
        #print stta.cmd('cd /home/raza/goDash/DashApp/src/goDASH/_host_' + str(h) + ' && sudo tcpdump -i '+str(stta)+'-eth0  -w '+str(stta)+'.pcap &')
   

    st=[]
    
    for i in range(h):
        m1='sta%s' % (i+1)
        m2=net.get(m1)
        st.insert(i, m2)


    
    switch=net.get('s3')
    server=net.get('server')
    #server.cmd('server iw dev server-eth1 interface add mon0 type monitor')
    #server.cmd('server ifconfig mon0 up')
    #CLI(net)
    #return st, switch, server, h, b, d, p
    return st, switch, server, h,net,p, d

def cap2(h ,p,d):
    print os.system('sudo tcpdump -i s3-eth100 -U -w /home/raza/goDash/DashApp/src/goDASH/pcap/host_'+str(h) +'_'+str(p)+ '_'+str(d)+'.pcap ') 
    #host_'+str(h) +'_'+str(p)+ '_'+str(d)+'


def test1(num,h,p,d ):
   
   
    print num.cmd('cd /home/raza/goDash/DashApp/src/goDASH/ && ./goDASH --config ../config/configure.json >/home/raza/goDash/DashApp/src/goDASH/host_'+str(h)+'_'+str(p) +'_'+str(d)+'/h_'+str(num)+'.txt && echo done_' + str(num) )
   
def server(sr):

    print sr.cmd('cd /home/raza/goDash/DashApp/src/goDASH/caddy && ./caddy')

def tstop(h):
    #if h == 5:	
     #  tt=100*h
    #elif h == 10:
     #  tt=81*h
    #elif h == 15:
     #  tt=61*h	
    tt=2951
    time.sleep(tt)
    os.system('sudo pkill -9 caddy' )

def tsstop(h):
    #if h == 5:	
     #  tt=99*h
    #elif h == 10:
     #  tt=80*h
    #elif h == 15:
     #  tt=60*h

    tt =2950
    time.sleep(tt)
    os.system('sudo pkill -9 tcpdump' )

def  tc(s,cn):
     os.system('sudo ./bwc.sh')

if __name__ == '__main__':
    setLogLevel( 'info' )

    station, switch, ser , h,net,p,cn  =topology()
    #print(station)
    #print('Here I am printing sta1 ------')
    #val = station[0].cmd('iperf sta1 ser')
    #print(val)
    #print('Here I am printing sta1 ------')



    u=0
    v=0
    x=1
    a=0
    b=0
    c=0
    d=0
    e=0
    kk=0
    g=1
    mm=0
    ddd=0
    
    if g==1:
       
       y = Process(target=server, args=(ser,))  
       y.start()
       b=1

    
    if b==1:
       n = Process(target=cap2, args=(h,p,cn))   
       n.start()       
       d=1 
    

    if d==1:
       nnn = Process(target=tc, args=(ser,cn))   
       nnn.start() 
       #print "Testing bandwidth between h101 and h2"
       #sta1, server = net.get( 'sta1', 'server' )
       #net.iperf( (sta1, server) )      
       ddd=1 
    
    if ddd==1:
       #print 'dashc'
       for k in range(h):
           print station[k]
           q = Process(target=test1, args=(station[k],h,p,cn))  
           q.start()
           q.join
           kk=1

    if kk==1:
       t = Process(target=tstop, args=(h,))   
       t.start()
       mm=1
    
    if mm==1:
       tt = Process(target=tsstop, args=(h,))   
       tt.start()
