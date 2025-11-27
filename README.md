# 🚀 Colección de Ejercicios PHP - Arquitectura MVC Nativa

Bienvenido a este repositorio. Aquí encontrarás una colección de **11 aplicaciones web** desarrolladas completamente en **PHP nativo**, implementando el patrón de arquitectura de software **MVC (Modelo-Vista-Controlador)** desde cero, sin el uso de frameworks.

> **Nota:** Para facilitar la portabilidad y el despliegue rápido, este proyecto **no utiliza bases de datos SQL**. La persistencia de datos se maneja mediante archivos **JSON** locales.

## 🛠️ Tecnologías Utilizadas

*   **Lenguaje:** PHP 8+
*   **Arquitectura:** MVC (Model-View-Controller) Manual
*   **Base de Datos:** Archivos JSON (NoSQL flat-file)
*   **Frontend:** HTML5, CSS3, JavaScript (Vanilla)
*   **Servidor:** Compatible con Apache (XAMPP/WAMP/Laragon)

---

## 📂 Estructura del Proyecto

Cada ejercicio sigue rigurosamente la misma estructura de carpetas para mantener el orden y la escalabilidad:

```text
Nombre_Del_Ejercicio/
├── config/           # Configuraciones globales (si aplica)
├── controllers/      # Lógica que conecta el usuario con el sistema
├── models/           # Lógica de datos y lectura/escritura de JSON
├── views/            # Interfaz gráfica (HTML/CSS)
├── data/             # Almacenamiento de datos (archivos .json)
├── index.php         # Router principal (Punto de entrada)
└── style.css         # Estilos específicos del ejercicio
```
# 📋 Lista de Proyectos

### **1. 📝 Lista de Tareas (To-Do List)**
Gestor clásico de tareas.  
Permite crear tareas, marcarlas como completadas (tachado visual) y eliminarlas.  
Los datos persisten en **tasks.json**.

---

### **2. 💸 Calculadora de Propinas**
Herramienta para calcular el total a pagar según el porcentaje de propina.  
Guarda un historial de los últimos cálculos realizados.

---

### **3. 🔐 Generador de Contraseñas**
Genera contraseñas fuertes aleatorias con opciones personalizables:  
- Longitud  
- Mayúsculas  
- Números  
- Símbolos  

Incluye botón para copiar al portapapeles.

---

### **4. 💰 Gestor de Gastos**
Aplicación de finanzas personales.  
Permite registrar gastos por categoría y ver un resumen total.  
Incluye clases CSS dinámicas según tipo de gasto.

---

### **5. 📅 Sistema de Reservas**
Agenda citas validando disponibilidad.  
El modelo evita crear dos reservas en la misma fecha y hora.

---

### **6. 📝 Gestor de Notas (Estilo Google Keep)**
Muro de notas con buscador en tiempo real.  
Permite filtrar por título, contenido y color.

---

### **7. 🗓️ Calendario de Eventos**
Calendario visual interactivo.  
Permite agregar eventos por fecha y navegar entre meses.

---

### **8. 🍳 Plataforma de Recetas**
Libro de recetas digital.  
Guarda ingredientes, pasos y categoría.  
Permite filtrar por:  
- Desayuno  
- Almuerzo  
- Cena  
- Postre  

Incluye buscador.

---

### **9. 🧠 Juego de Memoria**
Juego interactivo donde PHP genera el tablero y JavaScript maneja la lógica.  
Guarda **ranking (Top 5)** de mejores puntajes.

---

### **10. 📊 Plataforma de Encuestas**
Sistema de votación con preguntas y opciones múltiples.  
Al votar, muestra gráficas de barras porcentuales en tiempo real.

---

### **11. ⏱️ Cronómetro Online**
Cronómetro de alta precisión con JavaScript.  
Permite registrar vueltas (laps) y guardar historial en el servidor.

---

# 🚀 Instalación y Uso

### 1️⃣ Clonar el repositorio
Ubícate en la carpeta del servidor local (`www` en WAMP / `htdocs` en XAMPP):

```bash
git clone https://github.com/KXwyn/MVC-exercises.git