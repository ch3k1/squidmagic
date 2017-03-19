# squidmagic

squidmagic is a tool designed to analyze a web-based network traffic to detect central command and control (C&C) servers and Malicious site, using Squid proxy server and Spamhaus.

### Install Ubuntu 16.04

Clone this repo & execute the script

```
squidmagic# ./install.sh

✓ Installing system packages
✓ Cloning repositories
✓ Installing python packages
✓ Installing php packages

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


### External Links

* [Twitter](https://twitter.com/avardanidze1)
