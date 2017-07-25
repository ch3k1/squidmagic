# squidmagic

squidmagic is a tool designed to analyze a web-based network traffic to detect central command and control (C&C) servers and Malicious site, using Squid proxy server and Spamhaus.

### Install 

Clone this repo

```
squidmagic# pip install -r requirements.txt
squidmagic/lib# composer install

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
use \SquidApp\Squid;

require dirname(__DIR__) . '/lib/vendor/autoload.php';

$squidmagic = new FileSystem();

// output banner
echo Squid::bannerAction();

// Scans a directory for files
$squidmagic->scandirs(__DIR__.'/bin');

// Checks if file exists in certain location 
$squidmagic->fileExists(__DIR__.'/bin/server.php');

// run server
$squidmagic->openInBackground(__DIR__.'/bin/');

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
