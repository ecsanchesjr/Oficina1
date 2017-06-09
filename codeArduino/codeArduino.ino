#include <SPI.h>
#include <MFRC522.h>
#include <LiquidCrystal.h>
#include <Ethernet.h>
#include <avr/wdt.h>


byte server[] = {192,168,1,102};
String location = " /Oficina1/web/controller/ArduinoController.php?";


byte mac[] = { 0xDE, 0xAF, 0xCE, 0xEF, 0xFE, 0xED };
EthernetClient client;

char inString[32]; // string for incoming serial data
int stringPos = 0; // string index counter
boolean startRead = false; // is reading?
String aux;
String content = "";
String hex1 = ""; // String for tag
String hex2 = ""; // String for Inventory tag

int control=0;

#define SS_PIN 8
#define RST_PIN 9

MFRC522 mfrc522(SS_PIN, RST_PIN);
LiquidCrystal lcd(6, 7, 5, 4, 3, 2);

void setup(){
  wdt_disable();
  //Serial.begin(1000000);
  SPI.begin();
  Serial.println("Inicio");
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
    msgInicial();
}


void msgInicial(){
  lcd.clear();
  lcd.print(" Aproxime o seu");
  lcd.setCursor(0,1);
  lcd.print("cartao do leitor");
}

void msgSecundaria(){
  lcd.clear();
  lcd.print("Aproxime a tag d");
  lcd.setCursor(0,1);
  lcd.print("o item no leitor");
  wdt_enable(WDTO_4S);
}

void loop(){ // NOT FINISHED
  if(!mfrc522.PICC_IsNewCardPresent()){
    return;
  }
  if(!mfrc522.PICC_ReadCardSerial()){
    return;
  }
  byte letra;
  for (byte i = 0; i < mfrc522.uid.size; i++) {
    content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Leitura Efetuada");
  lcd.setCursor(0,1);
  lcd.print("Processando...");
  wdt_disable();
  //Serial.println(control);
  if(control==1){
    hex2.concat(content);
    control++;
    content = "";
  }else{
    hex1.concat(content);
    content = "";
    control++;
    msgSecundaria();
  }
  delay(2000);
  if(control==2){
    continue_exec();
  }
}

String connAndRead(){
  stringPos = 0;
  memset( &inString, 0, 32 );
  for(int a=0;a<4000;a++){
    if (client.available()) {
        char c = client.read();
        if (c == '<' ) {
      startRead = true;
      }else if(startRead){
      if(c != '>'){
        inString[stringPos] = c;
        stringPos ++;
      }else{
        startRead = false;
        return inString;
      }
      }
    }
  }
}

void continue_exec() {
  client.print("GET ");
  client.print(location);
  client.print("keyP=");
  client.print(hex1);
  client.print("&");
  client.print("keyI=");
  client.print(hex2);
  client.print("&ardCode=1");
  client.println(" HTTP/1.0");
  client.println();

  aux = connAndRead();
  Serial.println("PHP RETURN");
  //Serial.println(aux);
  //Serial.println("Keys");
  //Serial.println(hex1);
  //Serial.println(hex2);

  if(aux.substring(0,19).equals("Devolucao concluida")){
	  msgDevol();
  }else if(aux.substring(0,20).equals("Emprestimo concluido")){
	  msgEmpres();
  }else if(aux.substring(0,24).equals("PROBLEMA EM UMA DAS TAGS")){
    msgProblema();
  }else if(aux.substring(0,20).equals("Tente novamente")){
    msgProblema();
  }

  delay(5000);
  soft_reset();
}

void msgProblema(){
  lcd.clear();
  lcd.print("Erro de Leitura");
  lcd.setCursor(0,1);
  lcd.print("Aguarde e Repita");
}

void msgEmpres(){
	lcd.clear();
	lcd.print("Emprestimo bem");
	lcd.setCursor(0,1);
	lcd.print("Sucedido");
}

void msgDevol(){
  lcd.clear();
  lcd.print("Devolucao bem");
  lcd.setCursor(0,1);
  lcd.print("Sucedida");
}

void soft_reset() {
  asm volatile("jmp 0");
}
