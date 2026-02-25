# 📦 Sistema de Inventario de Equipos

Sistema de inventario desarrollado con **Laravel + Livewire** para la gestión de equipos tecnológicos, usuarios y estados. Permite registrar, buscar, ordenar y administrar equipos de manera eficiente mediante una interfaz moderna y reactiva.

---

## 🚀 Características principales

* 📋 CRUD de equipos
* 🔍 Buscador en tiempo real
* ↕️ Ordenamiento por columnas
* 📑 Paginación
* 🏷️ Gestión de estados (Disponible, Asignado, En reparación, etc.)
* 👥 Relación equipos – usuarios
* ⚡ Interfaz reactiva con Livewire
* 🎨 UI moderna usando Flux

---

## 🛠️ Tecnologías utilizadas

* **PHP 8.2+**
* **Laravel 12**
* **Livewire 4**
* **MySQL**
* **Tailwind CSS**
* **Flux UI**

---

## ⚙️ Instalación

1. Clona el repositorio:

```bash
git clone https://github.com/ycapataz/Inventario.git
```

2. Ingresa al proyecto:

```bash
cd inventario
```

3. Instala dependencias:

```bash
composer install
npm install && npm run build
```

4. Copia el archivo de entorno:

```bash
cp .env.example .env
```

5. Configura la base de datos en `.env`

6. Genera la clave:

```bash
php artisan key:generate
```

7. Ejecuta migraciones:

```bash
php artisan migrate --seed
```

8. Levanta el servidor:

```bash
php artisan serve
```

---

## 🧪 Funcionalidades destacadas

### 🔍 Buscador de equipos

Permite buscar por:

* Serial
* Marca
* Modelo
* Estado

Implementado mediante **Scope personalizado** en el modelo `Equipos`.

### ↕️ Ordenamiento

Ordena dinámicamente por:

* ID
* Marca
* Modelo
* Serial
* Fecha de creación

### 💾 Mutators automáticos

RAM y Almacenamiento se guardan automáticamente en GB:

```php
protected function ram(): Attribute
{
    return Attribute::make(
        set: fn ($value) => $value . ' GB'
    );
}
```

---

## 📸 Capturas

<img width="1867" height="953" alt="image" src="https://github.com/user-attachments/assets/e995cbf9-4f98-4b75-9893-375bbe1474c4" />

---

## 👨‍💻 Autor

**Daniel**
Proyecto desarrollado como sistema de inventario para control interno de equipos.

---

## 📄 Licencia

Este proyecto es de uso interno / educativo. Puedes adaptarlo según tus necesidades.

---

⭐ Si este proyecto te fue útil, no olvides darle una estrella en GitHub.
