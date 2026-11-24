# Ejemplo JWT + Roles (Laravel API)

API con **JWT** y permisos definidos **por rol en código** (sin tabla `permissions`).

En BD: `roles` + `users.role_id` (un usuario = un solo rol).

## Permisos por rol

Archivo `config/roles.php`:

```php
return [
    'admin' => [
        'products.view',
        'products.create',
        'products.delete',
    ],
    'editor' => [
        'products.view', // mismo permiso que admin
    ],
];
```

## Usuarios demo

| Email | Password | Rol |
|-------|----------|-----|
| admin@example.com | password | admin |
| editor@example.com | password | editor |

## Endpoints

```bash
php artisan migrate --seed
php artisan serve
```

| Método | Ruta | Permiso | Quién |
|--------|------|---------|-------|
| POST | `/api/auth/login` | — | público |
| GET | `/api/auth/me` | JWT | autenticado |
| GET | `/api/products` | `products.view` | admin y editor |
| POST | `/api/products` | `products.create` | solo admin |

Header: `Authorization: Bearer {token}`
