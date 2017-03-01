# squidmagic

squidmagic is a tool designed to analyze a web-based network traffic to detect central command and control (C&C) servers and Malicious site, using Squid proxy server and Spamhaus.

### Install Squid and configure Proxy server and Zeromq

```
apt-get -y install squid3 libzmq3-dev
apt-get install php-pear php-dev
pecl install zmq-beta
```

### simple squid3 configuration to Allow all machines to all sites

```
http_access allow all 
```

### Instalation

	git clone https://github.com/ch3k1/squidmagic
	cd squidmagic
	pip install -r requirements.txt

### Install React/ZMQ (in lib folder)

```
composer install
```

## usage

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

### Run server

```php

<?php
namespace SquidApp\Core;

require dirname(__DIR__) . '/lib/vendor/autoload.php';

$banner = new \SquidApp\Squid();
$squidmagic = new FileSystem();

// output banner
echo $banner->bannerAction();

// Scans a directory for files
$squidmagic->scandirs('squidmagic/Collector path');

// Checks if file exists in certain location 
$squidmagic->fileExists('Collector Path/server.php');

// run server
$squidmagic->openInBackground('Collector Path/lib/bin/');

```

```
squidmagic/lib # php squidmagic.php 

                                                            
                              | |                          
         ___  __ _ _   _ _  __| |_ __ ___   __ _  __ _ _  ___ 
        / __|/ _` | | | | |/ _` | '_ ` _ \ / _` |/ _` | |/ __|
        \__ \ (_| | |_| | | (_| | | | | | | (_| | (_| | | (__ 
        |___/\__, |\__,_|_|\__,_|_| |_| |_|\__,_|\__, |_|\___|
                | |                               __/ |       
                |_|                              |___/ 
                    squidmagic collector started   
        
```

