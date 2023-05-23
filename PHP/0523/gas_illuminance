#include <WiFi.h>
#include <ArduinoJson.h>
#include <MQUnifiedsensor.h>

//Definitions
#define placa "Arduino UNO"
#define Voltage_Resolution 3.3
#define pin A0 //Analog input 0 of your arduino
#define type "MQ-6" //MQ6
#define ADC_Bit_Resolution 12 // For arduino UNO/MEGA/NANO
#define RatioMQ6CleanAir 10   //RS / R0 = 10 ppm 
//#define calibration_button 13 //Pin to calibrate your sensor
const char * host = "10.150.150.63";
const int Port = 80;

const char* ssid = "bssm_free";
const char* password = "bssm_free";

WiFiClient client;

MQUnifiedsensor MQ6(placa, Voltage_Resolution, ADC_Bit_Resolution, pin, type);

void setup() {
  Serial.begin(115200); //결과를 PC에서보겠다!
  pinMode(16, OUTPUT);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  /////////////////////////////////////
  MQ6.setRegressionMethod(1); //_PPM =  a*ratio^b
  MQ6.setA(2127.2); MQ6.setB(-2.526); // Configure the equation to to calculate CH4 concentration
  MQ6.init(); 

  Serial.print("Calibrating please wait.");
  float calcR0 = 0;
  for(int i = 1; i<=10; i ++)
  {
    MQ6.update(); // Update data, the arduino will read the voltage from the analog pin
    calcR0 += MQ6.calibrate(RatioMQ6CleanAir);
    Serial.print(".");
  }
  MQ6.setR0(calcR0/10);
  Serial.println("  done!.");
  
  if(isinf(calcR0)) {Serial.println("Warning: Conection issue, R0 is infinite (Open circuit detected) please check your wiring and supply"); while(1);}
  if(calcR0 == 0){Serial.println("Warning: Conection issue found, R0 is zero (Analog pin shorts to ground) please check your wiring and supply"); while(1);}
  
}

void loop() {
  // put your main code here, to run repeatedly:
  //1회 서버에 request
  //1.클라이언트가 서버에 접속한다
  if (!client.connect(host, Port)) {
    Serial.println("connection failed");
    return;
  }
  Serial.println("서버와 연결되었습니다!");
  //2.클라이언트가 서버에 request를 전송한다
  MQ6.update(); // Update data, the arduino will read the voltage from the analog pin
  float data1 = MQ6.readSensor(); // Sensor will read PPM concentration using the model, a and b values set previously or from the setup
  int data2 = analogRead(39);

  String url = "/2-3web/gas.php?gas="+String(data1)+"&cds="+String(data2);
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: "+ host +"\r\n" +
               "Connection: close\r\n\r\n");
  //3.서버가 클라이언트에게 response를 전송한다
  unsigned long t = millis(); //생존시간
  while(1){
    if(client.available()) break;
    if(millis() - t > 10000) break;
  }
  //응답이 왔거나 시간안에 응답이 안왔다!
  Serial.println("응답이 도착했습니다");
  while(client.available()){
    Serial.write(client.read());
  }
  //4.둘사이의 연결이 끊어진다!
  Serial.println("연결이 해제되었습니다!");
  delay(1000);
}
