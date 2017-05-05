#include <SPI.h>
#include <MFRC522.h>
#include <LiquidCrystal.h>
#include <Ethernet.h>


byte server[] = {192,168,1,100};
String location = " /Oficina1/web/controller/ArduinoController.php?";


byte mac[] = { 0xDE, 0xAF, 0xCE, 0xEF, 0xFE, 0xED };
EthernetClient client;

char inString[32]; // string for incoming serial data
int stringPos = 0; // string index counter
boolean startRead = false; // is reading?
String aux;
#define SS_PIN 8
#define RST_PIN 9
MFRC522 mfrc522(SS_PIN, RST_PIN);
LiquidCrystal lcd(6, 7, 5, 4, 3, 2);
String hex1= "";
String hex2="";
void setup()
{
 Serial.begin(9600);
 SPI.begin();
 mfrc522.PCD_Init();
 lcd.begin(16, 2);
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print("Inicializando...");
 Ethernet.begin(mac);
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print("Conectando...");
  while(!client.connect(server,80)){
   delay(4000);
 }
  mensageminicial();
}

void loop(){ //AINDA ESTÁ A SER FEITA
  
}

void mensageminicial()
{
 lcd.clear();
 lcd.print(" Aproxime o seu");
 lcd.setCursor(0,1);
 lcd.print("cartao do leitor");
}
void soft_reset() {
 asm volatile("jmp 0");
}



