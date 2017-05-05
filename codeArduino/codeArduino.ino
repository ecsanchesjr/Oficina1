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
String hex = ""; // String for tag
//String hex2 = ""; // String for Inventory tag

#define SS_PIN 8
#define RST_PIN 9

MFRC522 mfrc522(SS_PIN, RST_PIN);
LiquidCrystal lcd(6, 7, 5, 4, 3, 2);

void setup(){
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
  	msgInicial();
}

void loop(){ // NOT FINISHED
	if(!mfrc522.PICC_IsNewCardPresent()){
		return;
	}
	if(!mfrc522.PICC_ReadCardSerial()){
		return;
	}
	verifTagPessoa();
}

void msgInicial(){
 	lcd.clear();
 	lcd.print(" Aproxime o seu");
 	lcd.setCursor(0,1);
 	lcd.print("cartao do leitor");
}

void readSucess(){
	lcd.clear();
	lcd.setCursor(0,0);
	lcd.print("Leitura Efetuada");
	lcd.setCursor(0,1);
	lcd.print("Processando...");
}

void verifTagPessoa(){
	readSucess();
 	byte letra;
 	for (byte i = 0; i < mfrc522.uid.size; i++) {
	 	hex.concat(String(mfrc522.uid.uidByte[i], HEX));
 	}
	delay(2000);
	clientConnect();
	aux = readPhpReturn();

	if(aux.substring(0,8).equals("Prossiga")){
		Serial.println("Prossiga");
	}else if(aux.substring(0,28).equals("Tag de Pessoa nao encontrada")){
		Serial.println("Não achou");
	}
}

void clientConnect(){
	client.print("GET ");
	client.print(location);
	client.print("key=");
	client.print(hex);
	client.print("&ardCode=1");
	client.println(" HTTP/1.0");
	client.println();
}

void msgSecundaria(){
 	lcd.clear();
 	lcd.print("Aproxime a tag d");
 	lcd.setCursor(0,1);
 	lcd.print("o item no leitor");
}
void soft_reset() {
 	asm volatile("jmp 0");
}

String readPhpReturn(){
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
