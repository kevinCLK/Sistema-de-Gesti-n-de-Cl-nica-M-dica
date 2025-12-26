# Sistema de Gestión de Clínica Médica

Sistema web desarrollado en Laravel para la gestión integral de una clínica médica. Permite administrar pacientes, doctores, consultorios, horarios y reservas de citas médicas.

## 📋 Características

- **Gestión de Pacientes**: Registro, edición y consulta de información de pacientes con historial médico completo
- **Gestión de Doctores**: Administración de doctores con especialidades y licencias médicas
- **Gestión de Consultorios**: Control de consultorios con ubicación, capacidad y especialidad
- **Gestión de Horarios**: Configuración de horarios de atención por consultorio y doctor
- **Sistema de Reservas**: Reserva de citas médicas con calendario de eventos
- **Gestión de Usuarios**: Sistema de usuarios con roles y permisos (Spatie Laravel Permission)
- **Generación de Reportes**: Exportación de reportes en formato PDF para pacientes, doctores, consultorios y horarios
- **Autenticación**: Sistema de login y registro de usuarios con middleware de autenticación

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 10.x
- **PHP**: 8.1+
- **Base de Datos**: MySQL/MariaDB
- **Frontend**: Blade Templates, Vite, Axios
- **Librerías**:
  - [Spatie Laravel Permission](https://github.com/spatie/laravel-permission) - Gestión de roles y permisos
  - [DomPDF](https://github.com/barryvdh/laravel-dompdf) - Generación de PDFs
  - [FPDF](https://github.com/Setasign/FPDF) - Generación de PDFs
  - [Guzzle HTTP](https://github.com/guzzle/guzzle) - Cliente HTTP

## 📦 Requisitos Previos

- PHP >= 8.1
- Composer
- Node.js y NPM
- MySQL o MariaDB
- Extensiones PHP requeridas:
  - OpenSSL
  - PDO
  - Mbstring
  - Tokenizer
  - XML
  - Ctype
  - JSON
  - BCMath

## 🚀 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/clinica.git
cd clinica
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de Node.js

```bash
npm install
```

### 4. Configurar el archivo de entorno

Copia el archivo `.env.example` a `.env`:

```bash
cp .env.example .env
```

Edita el archivo `.env` con tus configuraciones:

```env
APP_NAME="Sistema de Clínica"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinica_db
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 5. Generar la clave de aplicación

```bash
php artisan key:generate
```

### 6. Ejecutar las migraciones

```bash
php artisan migrate
```

### 7. Ejecutar los seeders (opcional)

```bash
php artisan db:seed
```

### 8. Compilar los assets

Para desarrollo:

```bash
npm run dev
```

Para producción:

```bash
npm run build
```

### 9. Iniciar el servidor de desarrollo

```bash
php artisan serve
```

El sistema estará disponible en `http://localhost:8000`

## 📁 Estructura del Proyecto

```
CLINICA/
├── app/
│   ├── Console/          # Comandos de consola
│   ├── Exceptions/       # Manejo de excepciones
│   ├── Http/
│   │   ├── Controllers/  # Controladores de la aplicación
│   │   └── Middleware/   # Middleware personalizado
│   ├── Models/           # Modelos Eloquent
│   └── Providers/        # Service Providers
├── config/               # Archivos de configuración
├── database/
│   ├── factories/        # Factories para testing
│   ├── migrations/       # Migraciones de base de datos
│   └── seeders/          # Seeders de base de datos
├── public/               # Punto de entrada público
├── resources/
│   ├── css/             # Estilos CSS
│   ├── js/              # JavaScript
│   └── views/           # Vistas Blade
├── routes/              # Rutas de la aplicación
├── storage/             # Archivos de almacenamiento
└── tests/               # Pruebas automatizadas
```

## 🔐 Roles y Permisos

El sistema utiliza Spatie Laravel Permission para gestionar roles y permisos. Los permisos principales incluyen:

- `pacientes.lista` - Ver lista de pacientes
- `paciente.ver` - Ver detalles de paciente
- `paciente.registrar` - Registrar nuevo paciente
- `paciente.editar` - Editar paciente
- `doctores.lista` - Ver lista de doctores
- `doctor.registrar` - Registrar nuevo doctor
- `consultorios.lista` - Ver lista de consultorios
- `consultorio.registrar` - Registrar nuevo consultorio
- `horarios.lista` - Ver lista de horarios
- `horario.registrar` - Registrar nuevo horario
- `registrocita` - Registrar nueva cita
- `usuarios.index` - Gestionar usuarios

## 📊 Modelos Principales

### Paciente
- Información personal (nombre, apellidos, CI, fecha de nacimiento)
- Información médica (grupo sanguíneo, alergias)
- Información de contacto (celular, correo, dirección)
- Contacto de emergencia

### Doctor
- Información personal (nombres, apellidos, teléfono)
- Licencia médica
- Especialidad
- Relación con usuario del sistema

### Consultorio
- Nombre y ubicación
- Capacidad
- Teléfono
- Especialidad
- Estado (activo/inactivo)

### Horario
- Relación con doctor y consultorio
- Días y horas de atención

### Evento (Cita)
- Título de la cita
- Fecha y hora de inicio y fin
- Relación con usuario, doctor y consultorio
- Color para visualización en calendario

## 🧪 Testing

Ejecutar las pruebas con PHPUnit:

```bash
php artisan test
```

O directamente con PHPUnit:

```bash
./vendor/bin/phpunit
```

## 📝 Generación de Reportes

El sistema permite generar reportes en PDF para:

- Lista de pacientes
- Lista de doctores
- Lista de consultorios
- Lista de horarios

Los reportes se generan desde las respectivas vistas de lista de cada módulo.

## 🔧 Comandos Artisan Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimizar la aplicación
php artisan optimize

# Crear un nuevo controlador
php artisan make:controller NombreController

# Crear una nueva migración
php artisan make:migration nombre_migracion

# Crear un nuevo modelo
php artisan make:model NombreModelo
```

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 👥 Contribuciones

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📧 Contacto

Para preguntas o soporte, por favor abre un issue en el repositorio.

## 🙏 Agradecimientos

- [Laravel](https://laravel.com) - Framework PHP
- [Spatie](https://spatie.be) - Paquete de permisos
- Todos los contribuidores de las librerías utilizadas

---

**Desarrollado con ❤️ usando Laravel**
