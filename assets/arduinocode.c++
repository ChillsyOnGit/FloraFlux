int sensor;
int pin = 8;

void setup()
{
  Serial.begin(9600);
  pinMode (pin,OUTPUT);
}

void loop()
{
  sensor = analogRead (A0);
  Serial.println (sensor);
   if (sensor < 200){
  digitalWrite (pin, HIGH);
    delay (1000);
  digitalWrite (pin, LOW);
    delay(1000);
  }else{
    digitalWrite (pin, LOW);
    delay(1000);
  } 

}