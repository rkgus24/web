//1회 서버에 request
//1.클라이언트가 서버에 접속한다
f (!client .connect (host, Port)) {
Serial.println ("conhection failed");
return;
}
Serial.println ("서버와 연결되었습니다 ! ") ;
//2.클라이언트가 서버에 request를 전송한다
float humi =  dht.readHumidity();
float temp = dht.readTemperature ();

Btring url = "/bssm2 _ 3/upload.php?did=device1&temp="+string (temp) + "&humi=" + String (humi) ;
client.print (String ("GET ") + url + " HTTP/l.1\r\n" +
   "Host: "+ host +"r\n" +
   "Connection: close\r\n\r\n");
//3 .서버가 클라이언트에게 response를 전송한다
unsigned long t = millis (); //생존시간
while(1)(
if (client.available ()) break;
if(millis() - t >10000) break;