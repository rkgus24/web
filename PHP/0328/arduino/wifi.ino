#include <WiFi.h> //ESP32

const char* ssid = "bssm_free";
const char* password = "bssm_free";

const char* host = "10.129.58.85"; //서버의 주소
const int Port = 80;

WiFiClient client;

void setup() {
  Serial.begin(115200);
  //1.ESP32를 인터넷 공유기와 접속시킨다!
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password); //블록킹, 언블록킹
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  // 인터넷공유기와 접속에 성공함!
  
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP()); //ESP32의 IP주소

  //HTTP프로토콜
  //1.클라이언트가 서버에 접속한다
  if (!client.connect(host, Port)) {
    Serial.println("connection failed");
    return;
  }
  //2.클라이언트가 서버에 request를 전송한다
  int num = 100;
  String url = "/hello.php?num=" + String(num);
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");
  //3.서버가 클라이언트로 전송한 response를 수신한다
  unsigned long t = millis(); //생존시간
  while(true){
    if(client.available()) break;
    if(millis() - t > 10000) break;
  }
  //서버가 응답을 보냈다
  while(client.available()){
    Serial.write(client.read());
  }
  //4.연결을 해제한다!(옵션)
  delay(5000);
}

void loop() {
  // put your main code here, to run repeatedly:

}
