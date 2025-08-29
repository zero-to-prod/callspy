<?php

namespace Zerotoprod\Callspy;

class Callspy
{
    private static $instance;
    public $calls = [];

    public static function record(string $key, array $arguments): void
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        $self = self::$instance;

        $self->calls[] = [$key, $arguments];
    }

    /**
     * @param  string|array  $key
     *
     * @return array
     */
    public static function get($key): array
    {
        if (!isset(self::$instance)) {
            return [];
        }

        return self::$instance->calls[is_array($key)
            ? $key[0].'::'.$key[1]
            : $key] ?? [];
    }

    public static function reset(): void
    {
        if (!isset(self::$instance)) {
            return;
        }

        $self = self::$instance;

        $self->calls = [];
    }
}