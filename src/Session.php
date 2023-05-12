<?php

declare(strict_types=1);

namespace App;

final class Session
{

    /**
    Ajouter ces deux méthodes __construct et __clone rend la classe Session en singleton. Cela signifie qu'elle ne peut être instanciée qu'une seule fois et qu'il n'est pas possible de la cloner. C'est utile lorsque vous voulez garantir qu'il n'y a qu'une seule instance de la classe Session à tout moment dans l'application.
    La méthode __construct est déclarée en privé, ce qui empêche toute instance de la classe Session d'être créée en utilisant le mot-clé new.
    La méthode __clone est déclarée en privé, ce qui empêche toute instance de la classe Session d'être clonée en utilisant le mot-clé clone.
     */
    private function __construct() {}
    private function __clone() {}

    /**
    C'est une bonne alternative pour vérifier si une session est déjà en cours d'exécution. La fonction session_status() renvoie un état de session, qui peut être
    PHP_SESSION_DISABLED (les sessions sont désactivées dans la configuration de PHP),
    PHP_SESSION_NONE (une session n'a pas encore été démarrée),
    PHP_SESSION_ACTIVE (une session est déjà en cours d'exécution).
    Donc, si l'état de session renvoyé par session_status() est égal à PHP_SESSION_NONE, cela signifie qu'une session n'a pas encore été démarrée, et vous pouvez appeler session_start() pour démarrer une session.
     */

    public static function start():void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @param $key string
     * @param $value
     * @return void
     */
    public static function set(string $key, string $value) :void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @param $default
     * @return mixed|null
     */
    public static function get(string $key, string $default = null): mixed
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    /**
     * @param (string) $key
     * @return void
     */
    public static function delete(string $key ):void
    {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * @return void
     */
    public static function clear():void
    {
        self::start();
        session_unset();
        session_destroy();
    }
}
