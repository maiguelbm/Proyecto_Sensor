#include <WiFi.h>
#include <WebServer.h>
#include <DHT.h>

// 🔹 Configuración del WiFi
const char* ssid = "Ceformat_Estudiantes";        // Cambia por el nombre de tu red
const char* password = "Formacion2025";  // Cambia por la contraseña

// 🔹 Configuración del sensor DHT
#define DHTPIN 4       // Pin donde conectaste el DHT
#define DHTTYPE DHT11  // Cambia a DHT22 si usas ese modelo

DHT dht(DHTPIN, DHTTYPE);
WebServer server(80);  // Servidor web en el puerto 80

void handleSensorRead() {
    Serial.println("📡 Solicitando datos del sensor...");

    float temperatura = dht.readTemperature();
    float humedad = dht.readHumidity();

    if (isnan(temperatura) || isnan(humedad)) {
        Serial.println("⚠️ Error: No se pudo leer el sensor DHT");
        server.send(500, "text/plain", "Error al leer el sensor DHT. Revisa la conexión.");
        return;
    }

    Serial.println("✅ Datos obtenidos correctamente:");
    Serial.print("🌡️ Temperatura: "); Serial.print(temperatura); Serial.println("°C");
    Serial.print("💧 Humedad: "); Serial.print(humedad); Serial.println("%");

    String response = "{";
    response += "\"temperatura\": " + String(temperatura) + ",";
    response += "\"humedad\": " + String(humedad);
    response += "}";

    server.send(200, "application/json", response);
}

void setup() {
    Serial.begin(115200);
    dht.begin();

    Serial.println("\n🔧 Iniciando ESP32...");

    // 🚀 Conectar al WiFi
    WiFi.begin(ssid, password);
    Serial.print("🔄 Conectando a WiFi...");
    while (WiFi.status() != WL_CONNECTED) {
        delay(1000);
        Serial.print(".");
    }
    
    Serial.println("\n✅ ¡Conectado!");
    Serial.print("📡 Dirección IP: ");
    Serial.println(WiFi.localIP()); // Muestra la IP asignada al ESP32

    // 🌍 Iniciar servidor web
    server.on("/read", handleSensorRead);
    server.begin();
    Serial.println("🖥️ Servidor web iniciado.");
}

void loop() {
    server.handleClient();
}

