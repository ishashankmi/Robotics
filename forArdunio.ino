#include<RF24.h>
#include<SPI.h>

#define m1 6
#define m2 7

#define m3 4
#define m4 5

int forward(){
  digitalWrite(m1,HIGH);
  digitalWrite(m2,LOW);

  digitalWrite(m3,HIGH);
  digitalWrite(m4,LOW);
  return 0;
};

int backward(){
  digitalWrite(m1,LOW);
  digitalWrite(m2,HIGH);

  digitalWrite(m3,LOW);
  digitalWrite(m4,HIGH);
  return 0;
}

int right(){
  digitalWrite(m3,HIGH);
  digitalWrite(m4,LOW);

  digitalWrite(m1,LOW);
  digitalWrite(m2,LOW);
  return 0;
}


int left(){
  digitalWrite(m3,LOW);
  digitalWrite(m4,LOW);

  digitalWrite(m1,HIGH);
  digitalWrite(m2,LOW);
  return 0;
}

RF24 radio(8,9);

void setup() {
  radio.begin();
  radio.setPALevel(RF24_PA_MAX);
  radio.setChannel(0x76);
  radio.setDataRate(RF24_250KBPS);
  radio.openReadingPipe(1, 0xE0E0F0F0E1LL);
  radio.enableDynamicPayloads();
  radio.powerUp();

  pinMode(m1,OUTPUT);
  pinMode(m2,OUTPUT);
  pinMode(m3,OUTPUT);
  pinMode(m4,OUTPUT);
  Serial.begin(9600);
  pinMode(A0,OUTPUT);
}

int releasex(){
  digitalWrite(m1,LOW);
  digitalWrite(m2,LOW);

  digitalWrite(m3,LOW);
  digitalWrite(m4,LOW);
  return 0;
}

int light(int val){
  digitalWrite(A0,val);
}

void loop() {
  char res[32] = {0};
  radio.startListening();
  if (radio.available()) {
    delay(30);
    radio.read(&res, sizeof(res));
    Serial.println(res);
    if(res[2]=='1'){
      light(1);
    }else{
      light(0);
    };
    if(res[0]=='1'){
      forward();
    }else if(res[0]=='2'){
      backward();
    }else if(res[0]=='3'){
      left();
    }else if(res[0]=='4'){
      right();
    }else{
      releasex();
    };
  }else{
    releasex();
  }
}
