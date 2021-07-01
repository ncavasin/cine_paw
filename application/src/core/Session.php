<?php

namespace Paw\core;

class Session {
    public function start() {
        session_start();
    }

    public function get() {
        return $this->isActive ? $_SESSION : null;
    }

    public function destroy() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            $_SESSION = [];
            setcookie(session_name(), '', time() - 10000);
            session_destroy();
        }
    }

    public function getData($key) {
        return $_SESSION[$key];
    }

    public function setData($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function isActive() {
        return session_status() == PHP_SESSION_ACTIVE;
    }
}