# Documentación: TaskManager como PWA


# Manifest.json - Documentación

## short_name
Nombre corto que se muestra bajo el ícono en móviles.
## name
Nombre completo de la aplicación.
## icons
Lista de íconos en distintos tamaños para diferentes dispositivos.
## start_url
URL de inicio cuando el usuario abre la app instalada.
## display
Modo de visualización: "standalone" elimina la barra de URL.
## background_color
Color de fondo en la splash screen.
## theme_color
Color del tema (barra de estado en Android).
## description
Descripción breve de la app.
## lang
Idioma principal del contenido.



 # offline.html

Este archivo es fundamental para que la aplicación funcione correctamente en modo offline. Se muestra cuando el usuario intenta acceder a la app sin conexión a internet.


### Propósito
- Proporcionar una experiencia de usuario amigable cuando no hay conexión.
- Informar al usuario que la app sigue siendo funcional en modo offline.
- Mantener la coherencia visual con el resto de la aplicación (colores, tipografía).
### Estructura y Contenido
- **Encabezado (`<head>`)**: Define metadatos básicos y estilos internos.
- **Cuerpo (`<body>`)**: Contiene un contenedor centrado con:
  - Un icono visual (`📱`) para indicar el contexto de "dispositivo móvil".
  - Un título principal (`<h1>`) que comunica claramente el estado de la conexión.
  - Dos párrafos (`<p>`) que explican la situación y ofrecen una solución (conectar a internet).
### Estilos
- El fondo usa un degradado que coincide con el de la app principal (`#667eea`).
- El texto es blanco para garantizar contraste y legibilidad.
- Se utiliza `backdrop-filter: blur(10px)` para un efecto moderno de transparencia.
### Integración con el Service Worker
El Service Worker intercepta todas las solicitudes de red. Si falla la conexión, devuelve este archivo como respuesta, garantizando que la app nunca muestre un error 404.
### Mejoras Futuras (Opcionales)
- Usar una imagen SVG en lugar del emoji para mayor accesibilidad.
- Agregar un botón "Recargar" que intente reconectar.
- Implementar una animación sutil para mejorar la experiencia de usuario.


## Estrategia de Íconos

En lugar de reducir el `manifest.json` a un solo ícono, se optó por una estrategia más robusta: generar todos los íconos en los tamaños requeridos por la especificación PWA.

### Tamaños implementados
- `72x72`, `96x96`, `128x128`, `144x144`, `152x152`, `192x192`, `384x384`, `512x512`
### Beneficios
- **Máxima compatibilidad** con Android, iOS, Windows y Chrome OS.
- **Experiencia de usuario profesional** en todos los dispositivos.
- **Cumplimiento total** con la checklist de Google para PWAs.

Esta decisión refuerza el compromiso con estándares de calidad y una experiencia de usuario consistente.


## Gestión de Archivos Duplicados

Durante el desarrollo, se generó un archivo duplicado llamado `manifest copy.json` en la carpeta `Corte2/`. Este archivo no es funcional ni necesario para el funcionamiento de la PWA.
### Acción Tomada
- El archivo `manifest copy.json` fue eliminado para mantener la estructura del proyecto limpia y organizada.
- Solo se conserva el archivo `manifest.json`, que contiene la configuración correcta de la PWA.