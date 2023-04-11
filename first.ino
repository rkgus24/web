#include "MYDHT.h"

MYDHT mydht (16,0) ;
void setup() {
// put your setup code here, to run once:
Serial.begin (115200);
mydht.begin();
}

void loop(){
// put your main code here, to run repeatedly;
float temp = mydht .readTemperature ();
float humi = mydht.readHumidity ();
Serial.print (F ("Humidity: "));
Serial.print (humi) ;
Serial.print (F ("% Temperature:"));
Serial.print (temp);
Serial.println(F("'C "));
delay (2000);
  }