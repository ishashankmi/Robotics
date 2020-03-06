import RPi.GPIO as GPIO
from lib_nrf24 import NRF24
import urllib.request;
from time import sleep;
import spidev

GPIO.setmode(GPIO.BCM)

pipes = [[0xE0, 0xE0, 0xF0, 0xF0, 0xE1], [0xA1,0xA1,0xA1,0xF0,0xF0]]

radio = NRF24(GPIO, spidev.SpiDev())
radio.begin(0, 17)

radio.setPayloadSize(32)
radio.setChannel(0x76)
radio.setDataRate(NRF24.BR_250KBPS)
radio.setPALevel(NRF24.PA_MAX)

radio.setAutoAck(True)
radio.enableDynamicPayloads()
radio.enableAckPayload()
radio.openWritingPipe(pipes[0]);

radio.printDetails()


lights=0;

while True:
	res=urllib.request.urlopen("http://192.168.43.49:80/testing/main.php");
	val=res.read().decode();
	sleep(5/1000);
	if str(val)[0]!="0":
		xyz=list(val);
		while len(xyz)<32:
			xyz.append(0);
		radio.write(xyz);
		sleep(10/1000);
