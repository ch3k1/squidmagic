#!/bin/bash

SQUID_REPO='https://github.com/ch3k1/squidmagic'

declare -a packages
declare -a python_packages 
python_packages=(sh configparser termcolor dnspython pyzmq)
packages["ubuntu"]="python-pip git libzmq-dev"

Color_Off='\033[0m'       # Text Reset
LOG=$(mktemp)
# Regular Colors
Red='\033[0;31m'          # Red
log_icon="\e[31m✓\e[0m"
log_icon_ok="\e[32m✓\e[0m"
log_icon_nok="\e[31m✗\e[0m"

if [[ $EUID -ne 0 ]]; then
    echo -e "$Red \n You must be a root user.. $Color_Off"
  exit 1
else

[[ ! -e /etc/debian_version ]] && {
    echo  -e "$Red \n This script currently works only ubuntu 16.04 distro $Color_Off"
    exit 1
}

  run_and_log() {
    $1 &> ${LOG} && {
        _log_icon=$log_icon_ok
    } || {
        _log_icon=$log_icon_nok
        exit_=1
    }
    echo -e "${_log_icon} ${2}"
    [[ $exit_ ]] && { echo -e "\t -> ${_log_icon} $3";  exit; }
  }

  install_packages(){
    # Update and Install packages
    sudo apt-get update -y && sudo apt-get upgrade -y
    sudo apt-get install -y ${packages[@]}
    return 0
  }

  clone_repo(){
    git clone ${SQUID_REPO}
    return 0
  }
  
  # install python packages
  install_python_packages(){
    pip install ${python_packages[@]}
    return 0
  }
  
  run_and_log install_packages "Installing system packages"
  run_and_log clone_repo "Cloning repo" "Could not clone repo"
  run_and_log install_python_packages "Installing python packages"


fi