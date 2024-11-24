<?php

namespace Rhodiz\Config\Helpers;

// Clase para el manejo de sesiones con valores expirables
class SessionHelper
{
    /**
     * Inicializa la sesión (debe llamarse antes de usar cualquier método de sesión).
     */
    public static function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Guarda un valor en la sesión con un tiempo de expiración.
     *
     * @param string $key Nombre de la clave de sesión.
     * @param mixed $value Valor a almacenar.
     * @param int $ttl Tiempo de vida en segundos.
     */
    public static function setValue($key, $value, $ttl=3600) {
        self::startSession();
        $_SESSION[$key] = [
            'value' => $value,
            'expires_at' => time() + $ttl
        ];
    }

    /**
     * Recupera un valor de la sesión si no ha expirado.
     *
     * @param string $key Nombre de la clave de sesión.
     * @return mixed|null Retorna el valor si está disponible y no ha expirado, o null si no existe o ha expirado.
     */
    public static function getValue($key) {
        self::startSession();
        if (isset($_SESSION[$key])) {
            $data = $_SESSION[$key];
            return $data['value'];

            // Verificar si ha expirado
            /*if ($data['expires_at'] > time()) {
                return $data['value'];
            } else {
                // Eliminar el valor de la sesión si ha expirado
                unset($_SESSION[$key]);
            }*/
        }
        return null;
    }

    /**
     * Elimina una clave específica de la sesión.
     *
     * @param string $key Nombre de la clave de sesión.
     */
    public static function removeValue($key) {
        self::startSession();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}
