#include <WiFi.h>
#include <ArduinoJson.h>

const char * host = "10.150.150.63";
const int Port = 80;

const char* ssid = "bssm_free";
const char* password = "bssm_free";

WiFiClient client;

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
  
  String url = "/bssm2_3/control.php?did=device1";
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
    String line = client.readStringUntil('\n'); // readLine();
    if (line.indexOf("{\"pin\"") != -1) {
      Serial.println(line);
      // Stream& input;
      
      StaticJsonDocument<48> doc;
      DeserializationError error = deserializeJson(doc, line);
      
      if (error) {
        Serial.print(F("deserializeJson() failed: "));
        Serial.println(error.f_str());
        return;
        }
        
        int pin = doc["pin"]; // 16
        int cmd = doc["cmd"]; // 0

        if (pin == -1) {
          Serial.print("할 작업이 없음");
        } else {
          Serial.print("핀번호 = ");
          Serial.print(pin);
          Serial.print(", 제어명령= ");
          Serial.print(cmd);
          digitalWrite(pin, cmd); 
        }
    }
  }
  //4.둘사이의 연결이 끊어진다!
  Serial.println("연결이 해제되었습니다!");
  delay(5000);
}
