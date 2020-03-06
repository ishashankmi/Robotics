# Controlling Robotic Car Via Intranet

Controller program are written in Python3 and Web using pure js with ajax,css & html, server side codes are written in PhP and db is phpMyadmin with mysqli.

## Requirements

```bash
2 NRF24l01 Modules;
RaspberryPi with python3 installed;
Aruino nano with l298n Driver Module;
4x4 Car Chassis;
2x1 18650 Battery
```


## Installation

SSH into pi and just copy-paste code into it. 
Copy paste "forArduino.ino" into arduino IDE.

Install apache2 web server with php in your computer.

```bash
sudo apt update
sudo apt install python3
sudo apt install php libapache2-mod-php
sudo systemctl restart apache2
```

## Usage
Open rpi folder

```python
python3 send.py #modify the web address from 192.168.43.8 to your localhost

```

##### Open arduino IDE and copy paste "forArudino.ino" file in it then compile and upload.

## Example 

```
https://drive.google.com/open?id=1Z5ZGEc6IYDYOa3Wl9MB96c9WQjAYQ1Vv

```
