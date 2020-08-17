# A supervised Machine Learning approach forDASH video QoE prediction in 5G networks



## Installation

Following software are required to reproduce the same results and data

1. goDash Player
2. Mininet
3. MYSQL for data storage

There are two python scripts to run the topology. In stream.py you need to define the number of Hosts (nodes), ABS algorithm, and bandwidth column as defined in the file 5G_TC_Driving - Sheet2.csv. The script will call, topo.py where inside that script godash, mininet called to process the requested hosts and their godash log files.

Open terminal and type

```bash
sudo python3 stream.py
```
After hosts complete the streaming, a folder created for each experiment inside the working directory for each experiment. A PHP script is used to store each godash logfile in the MYSQL database. Whereas for per-segment RTT of 60 segments of stream calculated by python script
arbiter-bba-persegment-RTT.ipynb for BBA and Arbiter with head requests and other-persegment-RTT.ipynb python script is used to calculate per-segment RTT, Packets, and Throughput for ABS Conventional, Logistic, Exponential, Arbiter +.
