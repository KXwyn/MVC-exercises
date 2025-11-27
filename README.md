# 🚀 Colección de Ejercicios - Laravel 11 MVC

Bienvenido a este repositorio. Aquí encontrarás una colección de **11 aplicaciones web** desarrolladas en **Laravel**, implementando el patrón de arquitectura **MVC (Modelo-Vista-Controlador)** de forma profesional.

> **Nota:** Este proyecto ha sido migrado de PHP Nativo a **Laravel Framework**. Utiliza **SQLite** como base de datos para facilitar la portabilidad y **Blade** para las vistas.

## 🛠️ Tecnologías Utilizadas

*   **Framework:** Laravel 10/11
*   **Lenguaje:** PHP 8.2+
*   **Base de Datos:** SQLite (Sin configuraciones complejas)
*   **Frontend:** Bootstrap 5, Blade Templates, JavaScript
*   **Validaciones:** Laravel Request Validation
*   **ORM:** Eloquent

---

## 📂 Estructura del Proyecto

El proyecto unifica 11 ejercicios en una sola instalación de Laravel:

*   `routes/web.php`: Rutas definidas para cada ejercicio.
*   `app/Http/Controllers/`: Lógica de negocio separada por controlador.
*   `app/Models/`: Modelos Eloquent con Casting y Relaciones.
*   `resources/views/`: Vistas organizadas por carpetas (`tasks`, `tips`, `memory`, etc.).

---

## 📋 Lista de Proyectos Incluidos

1.  **📝 Lista de Tareas:** CRUD completo con persistencia en BD.
2.  **💸 Calculadora de Propinas:** Lógica matemática y guardado de historial.
3.  **🔐 Generador de Contraseñas:** Algoritmo aleatorio y almacenamiento seguro.
4.  **💰 Gestor de Gastos:** Cálculo de totales usando colecciones de Laravel (`sum`).
5.  **📅 Sistema de Reservas:** Validación de disponibilidad (impide citas duplicadas).
6.  **📝 Gestor de Notas:** Buscador en tiempo real usando `LIKE` en SQL.
7.  **🗓️ Calendario de Eventos:** Manejo de fechas avanzado con la librería **Carbon**.
8.  **🍳 Plataforma de Recetas:** Sistema de filtros dinámicos (Categoría y Búsqueda).
9.  **🧠 Juego de Memoria:** Lógica mixta (Backend baraja cartas, Frontend juega).
10. **📊 Plataforma de Encuestas:** Uso de **Relaciones Eloquent** (1 a muchos) y gráficos.
11. **⏱️ Cronómetro Online:** Integración JS/PHP guardando arrays JSON en base de datos.

---

## 🚀 Instalación y Uso

Si descargas este repositorio, sigue estos pasos para hacerlo funcionar:

1.  **Clonar el repositorio:**
    ```bash
    git clone https://github.com/KXwyn/MVC-exercises.git
    ```

2.  **Instalar dependencias:**
    ```bash
    composer install
    ```

3.  **Configurar entorno:**
    Copia el archivo de ejemplo y genera la llave de la aplicación.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configurar Base de Datos:**
    Abre el archivo `.env` y asegúrate de usar SQLite:
    ```env
    DB_CONNECTION=sqlite
    # Comenta las líneas de DB_HOST, DB_DATABASE, etc.
    ```
    Luego crea el archivo vacío en la carpeta database:
    *Windows:* `type nul > database/database.sqlite`
    *Mac/Linux:* `touch database/database.sqlite`

5.  **Migrar Tablas:**
    Crea las tablas en la base de datos.
    ```bash
    php artisan migrate
    ```

6.  **Ejecutar:**
    ```bash
    php artisan serve
    ```
    Entra a: `http://127.0.0.1:8000`

---

## 👤 Autor

Desarrollado por Miguel Cortés
Ejercicio académico para demostrar dominio de Laravel, Eloquent ORM y Arquitectura MVC.
