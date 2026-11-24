<?php

/**
 * Permisos definidos por rol (sin tabla permissions).
 * El mismo permiso puede aparecer en varios roles.
 */
return [
    'administrador' => [
        'products.view',
        'products.create',
        'products.delete',
    ],

    'editor' => [
        'products.view',
    ],
];
