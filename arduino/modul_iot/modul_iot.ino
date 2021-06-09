#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

WifiClient wifiClient;

const char* ssid = "bayu";
const char* password = "";
 
void setup () {
 
  Serial.begin(115200);
 
  WiFi.begin(ssid, password);
 
  while (WiFi.status() != WL_CONNECTED) {
 
    delay(1000);
    Serial.print("Connecting..");
 
  }
 
}

void loop() {

  if (WiFi.status() == WL_CONNECTED) { //Check WiFi connection status

    HTTPClient http;  //Declare an object of class HTTPClient
    String url = "http://jsonplaceholder.typicode.com/users/1";
    http.begin(wifiClient, url);  //Specify request destination
    int httpCode = http.GET();                                  //Send the request

    if (httpCode > 0) { //Check the returning code

      String payload = http.getString();   //Get the request response payload
      Serial.println(payload);             //Print the response payload

    }

    http.end();   //Close connection

  }

  delay(30000);    //Send a request every 30 seconds
}

// API CAPSS
// API KEY DISESUAIKAN DENGAN API DI HALAMAN MEMBER/SUPER MEMBER
// field=1 sama dengan membaca data di field1
// String url = http://127.0.0.1:8000/api/capps/iot?api_key=jRLXn2O3tQadlAelO2ofSb9HZ7qHKuxVhHo9g2FzG8hHcQqA4aCoYodq9rKI&field=1