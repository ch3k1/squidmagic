#!/usr/bin/python

import sys,os,argparse,re
import signal,time

import dns.resolver
import zmq
from sh import tail

from termcolor import colored
from config.config import spamhaus
from modules import retcodes
from core import color

colors = color.colors()

# ZeroMQ Context
context = zmq.Context()

# This is our new stuff
zmq_socket = context.socket(zmq.PUSH)
zmq_socket.connect("tcp://127.0.0.1:5555")

if len(sys.argv) <= 1:
    print("Please give some options, type -h for more information")
    sys.exit()

signal.signal(signal.SIGINT, signal.SIG_DFL);
 
class squidmagic(object):
    def __init__(self, apiattr, species):
        self.apiattr = apiattr
        self.species = species

    def getapiattr(self):
        return self.apiattr
    def getSpecies(self):
        return self.species
        
class Banner(squidmagic):
    def __init__(self, apiattr):
        squidmagic.__init__(self, apiattr, """
                 _     _                       _      
                (_)   | |                     (_)     
 ___  __ _ _   _ _  __| |_ __ ___   __ _  __ _ _  ___ 
/ __|/ _` | | | | |/ _` | '_ ` _ \ / _` |/ _` | |/ __|
\__ \ (_| | |_| | | (_| | | | | | | (_| | (_| | | (__ 
|___/\__, |\__,_|_|\__,_|_| |_| |_|\__,_|\__, |_|\___|
        | |                               __/ |       
        |_|                              |___/        
     """)

banner = Banner("Banner")
parser = argparse.ArgumentParser(description='squidmagic is a tool designed to analyze a web-based network traffic')
parser.add_argument('logfile_path', help='Select a Squid server log file path')
args = parser.parse_args()

if os.path.isfile(args.logfile_path):
    sys.stdout.write(colors['BOLD']['code'] + banner.getSpecies() + colors['END']['code'] + colors['BOLD']['code'] + "Analyzing...\n" + colors['END']['code'])
    print
else:
    sys.stdout.write(colors['BOLD']['code'] + "Squid server log file not found.\n" + colors['END']['code'])
    sys.exit(0)

class sbladvisory:

    @staticmethod
    def default_response(self):
        self.sp_response = {'status': '0',
                            'response_code': '0',
                            'url': 'null'}

    def check_status(self, ip):
        self.default_response(self)
        sp_resolver = dns.resolver.Resolver()

        try:
            _r_name = dns.reversename.from_address(ip)

            _r_name = str(_r_name).replace("in-addr.arpa.", "zen.spamhaus.org.")
            answers = sp_resolver.query(_r_name)
         
            for rdata in answers:
                _url = spamhaus()+ip
                self.sp_response = {'status': '1',
                                    'response_code':
                                    retcodes.sblcodes()[rdata.address],
                                    'assessment':
                                    retcodes.sblzencodes()[rdata.address],
                                    'url': _url}
        except Exception, e:
            pass

        return self.sp_response

class sblcssadvisory:

    @staticmethod
    def default_response(self):
        self.sp_response = {'status': '0',
                            'response_code': '0',
                            'url': 'null'}

    def check_status(self, ip):
        self.default_response(self)
        sp_resolver = dns.resolver.Resolver()

        try:

            _r_name = dns.reversename.from_address(ip)

            _r_name = str(_r_name).replace("in-addr.arpa.", "zen.spamhaus.org.")
            answers = sp_resolver.query(_r_name)
         
            for rdata in answers:
                _url = spamhaus()+ip
                self.sp_response = {'status': '1',
                                    'response_code':
                                    retcodes.sblcsscodes()[rdata.address],
                                    'assessment':
                                    retcodes.sblcsszencodes[rdata.address],
                                    'url': _url}
        except Exception, e:
            pass

        return self.sp_response

class pbladvisory:

    @staticmethod
    def default_response(self):
        self.sp_response = {'status': '0',
                            'response_code': '0',
                            'url': 'null'}

    def check_status(self, ip):
        self.default_response(self)
        sp_resolver = dns.resolver.Resolver()

        try:

            _r_name = dns.reversename.from_address(ip)

            _r_name = str(_r_name).replace("in-addr.arpa.", "zen.spamhaus.org.")
            answers = sp_resolver.query(_r_name)
         
            for rdata in answers:
                _url = spamhaus()+ip
                self.sp_response = {'status': '1',
                                    'response_code':
                                    retcodes.rblcodes()[rdata.address],
                                    'assessment':
                                    retcodes.zenrblcodes()[rdata.address],
                                    'url': _url}
        except Exception, e:
            pass

        return self.sp_response

class xbladvisory:

    @staticmethod
    def default_response(self):
        self.sp_response = {'status': '0',
                            'response_code': '0',
                            'url': 'null'}

    def check_status(self, ip):
        self.default_response(self)
        sp_resolver = dns.resolver.Resolver()

        try:

            _r_name = dns.reversename.from_address(ip)

            _r_name = str(_r_name).replace("in-addr.arpa.", "zen.spamhaus.org.")
            answers = sp_resolver.query(_r_name)
         
            for rdata in answers:
                _url = spamhaus()+ip
                self.sp_response = {'status': '1',
                                    'response_code':
                                    retcodes.xblcodes()[rdata.address],
                                    'assessment':
                                    retcodes.zenxblcodes()[rdata.address],
                                    'url': _url}
        except Exception, e:
            pass

        return self.sp_response

for i, line in enumerate(tail("-f", args.logfile_path, _iter=True)):
    
    try:
        duration, byte, address, code_status, num_bytes, method, urls, rfc931, HIER_DIRECT, _ = line.split()[:10]

        def sbl_spamhaus():
            time.sleep(2)
            sys.stdout.write(colored(colors['BOLD']['code'] + "Analyzing by SBL Advisory...\n" + colors['END']['code'], 'blue'))
            ips = re.findall(r'[0-9]+(?:\.[0-9]+){3}', HIER_DIRECT)
            if not ips:
                print '\t', colored("The IP address or hostname where the request was forwarded not found", 'red')
                return
            for ip in ips:
                domain_ip = ip.split(":")[0]

            sh = sbladvisory()
            response = sh.check_status(domain_ip)
            if response['status'] == '0':
                print '\t', colored("safe server detected, host or ip is "  + domain_ip, 'green')
                msg = { 'squidmagic': 'squidmagic','host' : domain_ip, 'status' : 'safe' }
                zmq_socket.send_json(msg)
            else:
                print '\t', colored("Spam server detected, ip is "  + domain_ip, 'red')
                msg = { 'squidmagic': 'squidmagic', 'host' : domain_ip, 'status' : 'unsafe' }
                zmq_socket.send_json(msg)

        def css_spamhaus():
            time.sleep(2)
            sys.stdout.write(colored(colors['BOLD']['code'] + "Analyzing by SBL_CSS Advisory...\n" + colors['END']['code'], 'blue'))
            ips = re.findall(r'[0-9]+(?:\.[0-9]+){3}', HIER_DIRECT)
            if not ips:
                print '\t', colored("The IP address or hostname where the request was forwarded not found", 'red')
                return
            for ip in ips:
                domain_ip = ip.split(":")[0]

            sh = sblcssadvisory()
            response = sh.check_status(domain_ip)
            if response['status'] == '0':
                print '\t', colored("safe server detected, host or ip is "  + domain_ip, 'green')
                msg = { 'squidmagic': 'squidmagic', 'host' : domain_ip, 'status' : 'safe' }
                zmq_socket.send_json(msg)
            else:
                print '\t', colored("Spam server detected, ip is "  + domain_ip, 'red')
                msg = { 'squidmagic': 'squidmagic', 'host' : domain_ip, 'status' : 'unsafe' }
                zmq_socket.send_json(msg)

        def pbl_spamhaus():
            time.sleep(2)
            sys.stdout.write(colored(colors['BOLD']['code'] + "Analyzing by PBL Advisory...\n" + colors['END']['code'], 'blue'))
            ips = re.findall(r'[0-9]+(?:\.[0-9]+){3}', HIER_DIRECT)
            if not ips:
                print '\t', colored("The IP address or hostname where the request was forwarded not found", 'red')
                return
            for ip in ips:
                domain_ip = ip.split(":")[0]

            sh = pbladvisory()
            response = sh.check_status(domain_ip)

            if response['status'] == '0':
                print '\t', colored("safe server detected, host or ip is "  + domain_ip, 'green')
                msg = { 'squidmagic': 'squidmagic', 'host' : domain_ip, 'status' : 'safe' }
                zmq_socket.send_json(msg)
            else:
                print '\t', colored("Spam server detected, ip is "  + domain_ip, 'red')
                msg = { 'squidmagic': 'squidmagic', 'host' : domain_ip, 'status' : 'unsafe' }
                zmq_socket.send_json(msg)
        
        def xbl_spamhaus():
            time.sleep(2)
            sys.stdout.write(colored(colors['BOLD']['code'] + "Analyzing by XBL Advisory...\n" + colors['END']['code'], 'blue'))
            ips = re.findall(r'[0-9]+(?:\.[0-9]+){3}', HIER_DIRECT)
            if not ips:
                print '\t', colored("The IP address or hostname where the request was forwarded not found", 'red')
                return
            for ip in ips:
                domain_ip = ip.split(":")[0]

            sh = xbladvisory()
            response = sh.check_status(domain_ip)
            
            if response['status'] == '0':
                print '\t', colored("safe server detected, host or ip is "  + domain_ip, 'green')
                msg = { 'squidmagic': 'squidmagic', 'host' : domain_ip, 'status' : 'safe' }
                zmq_socket.send_json(msg)
            else:
                print '\t', colored("Malicious web server detected, ip is "  + domain_ip, 'red')
                msg = { 'squidmagic': 'squidmagic', 'host' : domain_ip, 'status' : 'unsafe' }
                zmq_socket.send_json(msg)

        def main():
           sbl_spamhaus()
           css_spamhaus()
           pbl_spamhaus()
           xbl_spamhaus()

        if __name__ == '__main__':
            main()

    except ValueError:
        continue

    if rfc931 == '-': continue

    try:
        if code_status.split('/')[1] == '407': continue
    except IndexError:
        continue
    
    try:
        sum_bytes[rfc931] = sum_bytes[rfc931] + int(num_bytes)
    except KeyError:
        sum_bytes[rfc931] = int(num_bytes)
