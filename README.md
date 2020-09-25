# A supervised Machine Learning approach for DASH video QoE prediction in 5G networks



## Installation

Following software are required to reproduce the same results and data

1. goDash Player --- https://github.com/uccmisl/goDASHbed
2. Mininet --- https://github.com/mininet/mininet
3. MYSQL for data storage

There are two python scripts to run the topology. In stream.py you need to define the number of Hosts (nodes), ABS algorithm, and bandwidth column as defined in the file 5G_Cases.csv. The script will call, topo.py where inside that script godash, mininet called to process the requested hosts and their godash log files.

Open terminal and type

```bash
sudo python3 stream.py
```
After hosts complete the streaming, a folder created for each experiment inside the working directory. A PHP script is used to store each godash logfile in the MYSQL database. For per-segment RTT, Number of Packets and Throughput of stream is calculated by python script
arbiter-bba-persegment-RTT.ipynb for ABS (BBA and Arbiter) with head requests and other-persegment-RTT.ipynb python script is used for ABS Conventional, Logistic, Exponential and  Arbiter +.

## License
[MIT](https://choosealicense.com/licenses/mit/)
