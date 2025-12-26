# Guía de Contribución

¡Gracias por tu interés en contribuir al Sistema de Gestión de Clínica Médica! Este documento proporciona pautas para contribuir al proyecto.

## Cómo Contribuir

### Reportar Bugs

Si encuentras un bug, por favor:

1. Verifica que el bug no haya sido reportado ya en los [Issues](https://github.com/tu-usuario/clinica/issues)
2. Si no existe, crea un nuevo issue con:
   - Un título descriptivo
   - Descripción clara del problema
   - Pasos para reproducir el bug
   - Comportamiento esperado vs comportamiento actual
   - Versión de PHP, Laravel y otras dependencias relevantes
   - Capturas de pantalla si aplica

### Sugerir Mejoras

Las sugerencias de nuevas características son bienvenidas:

1. Verifica que la sugerencia no haya sido propuesta antes
2. Crea un issue con:
   - Descripción clara de la funcionalidad propuesta
   - Justificación de por qué sería útil
   - Ejemplos de uso si aplica

### Pull Requests

1. **Fork el repositorio**
   ```bash
   git clone https://github.com/tu-usuario/clinica.git
   cd clinica
   ```

2. **Crea una rama para tu feature**
   ```bash
   git checkout -b feature/nombre-de-tu-feature
   ```

3. **Realiza tus cambios**
   - Sigue las convenciones de código del proyecto
   - Añade comentarios cuando sea necesario
   - Actualiza la documentación si es relevante

4. **Ejecuta las pruebas**
   ```bash
   php artisan test
   ```

5. **Commit tus cambios**
   ```bash
   git add .
   git commit -m "Descripción clara de los cambios"
   ```

6. **Push a tu fork**
   ```bash
   git push origin feature/nombre-de-tu-feature
   ```

7. **Abre un Pull Request**
   - Describe claramente los cambios realizados
   - Menciona cualquier issue relacionado
   - Incluye capturas de pantalla si hay cambios en la UI

## Estándares de Código

### PHP

- Sigue [PSR-12](https://www.php-fig.org/psr/psr-12/) para el estilo de código
- Usa nombres descriptivos para variables, funciones y clases
- Comenta código complejo
- Mantén las funciones pequeñas y enfocadas

### Laravel

- Sigue las convenciones de Laravel
- Usa Eloquent para consultas de base de datos cuando sea posible
- Implementa validación en los controladores
- Usa Form Requests para validaciones complejas

### Base de Datos

- Crea migraciones para todos los cambios de esquema
- Usa nombres descriptivos para tablas y columnas
- Añade índices cuando sea necesario para rendimiento

### Git

- Usa mensajes de commit descriptivos
- Haz commits pequeños y frecuentes
- Usa el formato: `tipo: descripción breve`

Ejemplos:
- `feat: añadir funcionalidad de exportar reportes`
- `fix: corregir error en validación de pacientes`
- `docs: actualizar README con instrucciones de instalación`
- `refactor: mejorar estructura de controladores`

## Estructura de Commits

```
tipo(alcance): descripción breve

Descripción más detallada si es necesario

- Lista de cambios
- Si aplica
```

Tipos:
- `feat`: Nueva funcionalidad
- `fix`: Corrección de bug
- `docs`: Cambios en documentación
- `style`: Cambios de formato (no afectan código)
- `refactor`: Refactorización de código
- `test`: Añadir o modificar tests
- `chore`: Tareas de mantenimiento

## Preguntas

Si tienes preguntas sobre cómo contribuir, puedes:
- Abrir un issue con la etiqueta `question`
- Contactar a los mantenedores del proyecto

## Código de Conducta

Al participar en este proyecto, te comprometes a mantener un ambiente respetuoso y acogedor para todos los contribuidores.

---

¡Gracias por contribuir! 🎉

