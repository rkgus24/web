#include <WiFi.h>
#include "DHT.h"
#define DHTPIN 16
#define DHTTYPE DHT11   // DHT 11
DHT dht(DHTPIN, DHTTYPE); //생성자

const char * host = "10.129.55.189";
const int Port = 1880;

const char* ssid = "bssm_free";
const char* password = "bssm_free";

WiFiClient client;

void setup() {
  Serial.begin(115200); //결과를 PC에서보겠다!
  dht.begin();
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
  int num = 100;

  float temp = dht.readTemperature();
  float humi = dht.readHumidity();

  String url = "/test?id=6&data="+String(temp) + "&humi=" + String(humi);
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
  delay(5000);
}