# Actividad de Evaluación 3 (AE3) - Desarrollo Web (Semana 8)

**Institución:** Universidad de Ciencias y Humanidades (UCH)  
**Curso:** Desarrollo Web  
**Evaluación:** Práctica Evaluada - Formularios responsivos y lógica de interacción con JavaScript  
**Fecha:** 29/09/2026  

---

## 🔗 Enlaces del Proyecto

| Recurso | Enlace |
| :--- | :--- |
| **Repositorio GitHub** | `https://github.com/lzsdjuan2119/pc1` |
| **Página Principal (Menú)** | [Ver Índice Publicado](https://lzsdjuan2119.github.io/pc1/) |


## 📁 Estructura del Repositorio

```text
AE3/
├── index.html                 # Página principal con menú interactivo hacia todos los casos
├── README.md                  # Documentación principal con enlaces y descripción
├── informe/
│   ├── INFORME_AE3.md         # Informe académico completo con código y tablas de pruebas
│   └── Informe_Semana_8.docx  # Documento de entrega para el docente
│
├── caso1/                     # Caso 1 (Versión inicial estructurada con carpetas js y css)
│   ├── cita.html
│   ├── confirmacion-cita.html
│   ├── css/styles.css
│   ├── js/cita.js
│   ├── js/confirmacion.js
│   └── favicon.png
│
├── caso1B/                    # Caso 2 (Cotizador de Panadería )
│   ├── pedido.html
│   ├── resumen-pedido.html
│   └── script.js
│
├── caso2b/                    # Caso 1 (Citas Médicas)
│   ├── cita.html
│   ├── confirmacion-cita.html
│   └── script.js
│
└── caso2c/                    # Caso 2 (Cotizador Panadería )
    ├── pedido.html
    ├── resumen-pedido.html
    └── script.js
```

---

## 📌 Descripción de los Casos Desarrollados

### Caso 1: Solicitud de Citas para Consultorio ("Salud Centro")
* **Objetivo:** Registrar solicitudes para las especialidades de Consulta General, Odontología y Nutrición.
* **Reglas validadas:**
  - Nombre completo: entre 3 y 60 caracteres.
  - Correo electrónico con formato válido (`@` y dominio).
  - Especialidad obligatoria.
  - Fecha igual o posterior al día actual (no permite fechas pasadas).
  - Horario de atención seleccionado de un arreglo: `09:00`, `10:00`, `11:00`, `15:00`, `16:00`. El horario de las **11:00 está marcado como no disponible** e impide el envío.
* **Transferencia de datos:** Se almacena el objeto de la solicitud en `sessionStorage` y se visualiza en `confirmacion-cita.html`. Se controla el acceso directo sin datos.

### Caso 2: Cotizador de Pedidos de Panadería ("Trigal uch")
* **Objetivo:** Cotizar pedidos de productos artesanales con selección de retiro o reparto a domicilio.
* **Catálogo:**
  - Pan de masa madre: S/ 18.00
  - Caja de alfajores: S/ 24.00
  - Torta pequeña: S/ 45.00
* **Reglas y cálculos:**
  - Cantidades enteras entre 1 y 10 por producto; obligatorio al menos 1 producto.
  - **Reparto:** Añade S/ 8.00; **Retiro en tienda:** S/ 0.00.
  - **Descuento:** Si el subtotal llega a S/ 100.00 o más, se aplica el **10% de descuento** antes de sumar el reparto.
  - **Caso de verificación (Consigna 10):**
    - 2 tortas pequeñas (S/ 90.00) + 1 caja de alfajores (S/ 24.00) + Reparto (S/ 8.00):
    - Subtotal: **S/ 114.00**
    - Descuento 10%: **S/ 11.40**
    - Reparto: **S/ 8.00**
    - Total final: **S/ 110.60**
* **Transferencia de datos:** Objeto guardado en `sessionStorage` y transferido a `resumen-pedido.html`.

--
