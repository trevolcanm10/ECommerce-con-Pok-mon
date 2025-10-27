# 🧩 Filtro Dinámico de Pokémon

Proyecto MVC con PHP, MySQL y JavaScript que permite filtrar Pokémon en tiempo real según sus tipos, ataque y defensa. Los resultados se actualizan dinámicamente sin recargar la página.

---

## ✨ Funcionalidades

- Filtrado en tiempo real por tipo, ataque y defensa
- Arquitectura MVC con separación clara de responsabilidades
- Consultas SQL dinámicas según filtros activos
- Comunicación asíncrona con AJAX/Fetch API
- Interfaz con tarjetas visuales de Pokémon

---

## 🛠️ Tecnologías

**Frontend:** HTML5, CSS3, JavaScript (Fetch API)  
**Backend:** PHP 7.4+  
**Base de Datos:** MySQL 5.7+

---

## 📁 Estructura del Proyecto

```
📦 PERSONAL_PokemonFiltro/
├── controller/
│   └── pokemon.php          # Controlador (API endpoints)
├── models/
│   └── Pokemon.php          # Modelo (queries SQL)
├── views/
│   ├── index.php            # Vista principal
│   ├── js/
│   │   └── main.js          # Lógica frontend
│   └── css/
│       └── styles.css       # Estilos
├── database/
│   └── pokemon_db.sql       # Script de BD
└── README.md
```

---

## 🗄️ Base de Datos

**Tabla:** `tm_pokemon`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id_pokemon | INT (PK) | Identificador único |
| nombre | VARCHAR(100) | Nombre del Pokémon |
| tipo | VARCHAR(50) | Tipo elemental |
| ataque | INT | Puntos de ataque |
| defensa | INT | Puntos de defensa |
| imagen | VARCHAR(255) | URL de la imagen |

## 📝 Licencia

MIT License

---


Desarrollado por [Tu Nombre]  
GitHub: https://github.com/tuusuario
