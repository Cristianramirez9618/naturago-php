\# 🌿 NATURAGO



\*\*Plataforma web de turismo sostenible\*\*



NATURAGO es un proyecto web orientado a descubrir destinos turísticos y facilitar la exploración de lugares de interés. Integra una interfaz web, gestión de usuarios y un asistente turístico desarrollado con Python y FastAPI.



\## ✨ Funcionalidades



\- Interfaz web desarrollada con HTML, CSS, JavaScript y PHP.

\- Registro e inicio de sesión de usuarios.

\- Persistencia de datos mediante MySQL.

\- Asistente turístico basado en una API con FastAPI.

\- Entorno de desarrollo local con XAMPP.



\## 🛠️ Tecnologías utilizadas



\- \*\*Frontend:\*\* HTML5, CSS3 y JavaScript.

\- \*\*Backend web:\*\* PHP.

\- \*\*Base de datos:\*\* MySQL.

\- \*\*API del asistente:\*\* Python y FastAPI.

\- \*\*Servidor local:\*\* XAMPP.

\- \*\*Control de versiones:\*\* Git y GitHub.



\## 📁 Estructura del proyecto



```text

naturago-php/

├── api/                 # Endpoints PHP

├── api\\\_python/          # API del asistente turístico

├── config/              # Configuración privada

├── asistente.js         # Interacción con el asistente

├── estilos.css          # Estilos de la interfaz

├── index.php            # Página principal

├── naturago\\\_db.sql      # Estructura y datos de prueba

├── script.js            # Funcionalidades JavaScript

├── .gitignore           # Archivos excluidos de Git

└── README.md            # Documentación del proyecto

```



\## 🚀 Instalación y ejecución local



\### Requisitos



\- Windows.

\- XAMPP con Apache y MySQL.

\- PHP compatible con el proyecto.

\- Python compatible con las dependencias de la API.

\- Git.



\### 1. Descargar el proyecto



Clona el repositorio o descarga el código desde GitHub:



```bash

git clone https://github.com/Cristianramirez9618/naturago-php.git

```



Si ya tienes el proyecto en tu computadora, no necesitas clonarlo otra vez.



\### 2. Configurar XAMPP



Coloca el proyecto en:



```text

C:\\\\xampp\\\\htdocs\\\\naturago-php

```



Inicia Apache y MySQL desde el panel de control de XAMPP.



\### 3. Crear la base de datos



1\. Abre `http://localhost/phpmyadmin/`.

2\. Crea la base de datos `naturago\\\_db`, si ese es el nombre configurado en tu proyecto.

3\. Importa el archivo `naturago\\\_db.sql`.

4\. Configura la conexión a MySQL en el archivo privado correspondiente.



No publiques contraseñas reales ni claves privadas en el repositorio.



\### 4. Abrir la aplicación web



Visita:



```text

http://localhost/naturago-php/

```



\### 5. Ejecutar la API del asistente



Entra en la carpeta de Python:



```bash

cd C:\\\\xampp\\\\htdocs\\\\naturago-php\\\\api\\\_python

```



Crea y activa un entorno virtual:



```bash

python -m venv .venv

.venv\\\\Scripts\\\\activate

```



Instala las dependencias:



```bash

pip install -r requirements.txt

```



Revisa `main.py` para confirmar el nombre de la aplicación FastAPI y el puerto configurado. Si la instancia se llama `app`, puedes iniciarla habitualmente con:



```bash

uvicorn main:app --reload

```



La dirección y el puerto de la API deben coincidir con los configurados en el JavaScript del asistente.



\## 🧪 Datos de prueba



Los datos de demostración deben ser ficticios y utilizarse únicamente para desarrollo y pruebas.



No utilices contraseñas reales ni información personal en los registros de prueba.



\## 🔐 Seguridad



\- Mantener las credenciales fuera del control de versiones.

\- Excluir archivos privados mediante `.gitignore`.

\- Utilizar consultas preparadas para interactuar con MySQL.

\- Almacenar contraseñas mediante funciones seguras de hash.

\- Configurar HTTPS y las credenciales adecuadas al desplegar la aplicación.



\## 📌 Estado del proyecto



\*\*En desarrollo.\*\*



Las funcionalidades, la configuración del asistente y el despliegue pueden requerir ajustes según el entorno de ejecución.



\## 🔗 Repositorio



\[https://github.com/Cristianramirez9618/naturago-php](https://github.com/Cristianramirez9618/naturago-php)

