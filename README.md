Squidmagic is a tool designed to analyze a web-based network traffic to detect central command and control (C&C) servers and Malicious site, using Squid proxy server and Spamhaus.

### Install dependencies

```
squidmagic# pip install -r requirements.txt

```

### usage

```
squidmagic # python squidmagic.py /var/log/squid3/access.log

                 _     _                       _      
                (_)   | |                     (_)     
 ___  __ _ _   _ _  __| |_ __ ___   __ _  __ _ _  ___ 
/ __|/ _` | | | | |/ _` | '_ ` _ \ / _` |/ _` | |/ __|
\__ \ (_| | |_| | | (_| | | | | | | (_| | (_| | | (__ 
|___/\__, |\__,_|_|\__,_|_| |_| |_|\__,_|\__, |_|\___|
        | |                               __/ |       
        |_|                              |___/        
     Analyzing...

Analyzing by SBL Advisory...
	Spam server detected, ip is 65.182.101.221
Analyzing by SBL_CSS Advisory...
	safe server detected, host or ip is 65.182.101.221
Analyzing by PBL Advisory...
	safe server detected, host or ip is 65.182.101.221

```
