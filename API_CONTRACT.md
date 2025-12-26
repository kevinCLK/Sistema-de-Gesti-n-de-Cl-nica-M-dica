# Contrato de API RESTful - Sistema de Gestión de Clínica

Este documento define la especificación de la API RESTful para el sistema de gestión de la clínica. El frontend de Angular se desarrollará basándose en este contrato.

## Principios Generales

- **URL Base:** Toda las rutas de la API estarán prefijadas con `/api`. Ejemplo: `http://localhost:8000/api`.
- **Formato de Datos:** Todas las respuestas y las peticiones con cuerpo (POST, PUT) utilizarán el formato `application/json`.
- **Autenticación:** (Pendiente de implementación en el backend) La API estará protegida. Las peticiones requerirán un token de autenticación (Bearer Token) en la cabecera `Authorization`, gestionado por Laravel Sanctum.
- **Respuestas de Error:** Los errores se indicarán con los códigos de estado HTTP apropiados (4xx, 5xx) y una respuesta JSON con un mensaje de error.
  ```json
  {
    "message": "Descripción del error."
  }
  ```

---

## Recurso: Pacientes (`/pacientes`)

Endpoints para la gestión de la información de los pacientes.

### Estructura del Objeto Paciente

```json
{
  "id": 1,
  "nombre": "Juan",
  "apellidos": "Pérez Gómez",
  "ci": "1234567 LP",
  "fecha_nacimiento": "1990-05-15",
  "grupo_sanguineo": "O+",
  "alergias": "Ninguna",
  "celular": "77712345",
  "correo": "juan.perez@example.com",
  "direccion": "Av. Principal #123",
  "contacto_emergencia_nombre": "Ana Gómez",
  "contacto_emergencia_celular": "77754321",
  "created_at": "2023-10-27T10:00:00.000000Z",
  "updated_at": "2023-10-27T10:00:00.000000Z"
}
```

### Endpoints

#### 1. Obtener lista de pacientes

- **Método:** `GET`
- **Ruta:** `/api/pacientes`
- **Respuesta Exitosa (200 OK):** Un array de objetos Paciente.
  ```json
  [
    {
      "id": 1,
      "nombre": "Juan",
      "apellidos": "Pérez Gómez",
      "ci": "1234567 LP"
    },
    {
      "id": 2,
      "nombre": "Maria",
      "apellidos": "Lopez Soto",
      "ci": "7654321 CB"
    }
  ]
  ```
  *(Nota: La lista puede devolver una versión simplificada de los objetos para mayor eficiencia).*

#### 2. Obtener un paciente específico

- **Método:** `GET`
- **Ruta:** `/api/pacientes/{id}`
- **Parámetros:** `id` (entero, requerido) - El ID del paciente.
- **Respuesta Exitosa (200 OK):** Un objeto Paciente completo.

#### 3. Registrar un nuevo paciente

- **Método:** `POST`
- **Ruta:** `/api/pacientes`
- **Cuerpo de la Petición (Request Body):** Un objeto con los datos del nuevo paciente (sin el `id`, `created_at`, `updated_at`).
- **Respuesta Exitosa (201 Created):** El objeto Paciente completo recién creado, incluyendo su nuevo `id`.

#### 4. Actualizar un paciente existente

- **Método:** `PUT` o `PATCH`
- **Ruta:** `/api/pacientes/{id}`
- **Parámetros:** `id` (entero, requerido) - El ID del paciente a actualizar.
- **Cuerpo de la Petición (Request Body):** Un objeto con los campos a actualizar.
- **Respuesta Exitosa (200 OK):** El objeto Paciente completo con los datos actualizados.

#### 5. Eliminar un paciente

- **Método:** `DELETE`
- **Ruta:** `/api/pacientes/{id}`
- **Parámetros:** `id` (entero, requerido) - El ID del paciente a eliminar.
- **Respuesta Exitosa (204 No Content):** Sin cuerpo en la respuesta.

---
*(Se añadirán las definiciones para Doctores, Consultorios, Citas, etc., a medida que se implementen en el frontend).*
