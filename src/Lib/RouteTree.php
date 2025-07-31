<?php

namespace App\Lib;

class RouteTree
{
    private function __construct(private array $children, private array $methods) {}

    private static function empty()
    {
        return new self([], []);
    }

    public static function build(array $routes)
    {
        $tree = self::empty();

        foreach($routes as $route => $action) {
            $split = explode('/', trim($route, '/'));

            $tree->children($split, create: true)->methods($action);
        }

        return $tree;
    }

    private function child(string $key, bool $create): ?self
    {
        if(!array_key_exists($key, $this->children)) {
            if($create) {
                $this->children[$key] = self::empty();
            } else {
                return null;
            }
        }

        return $this->children[$key];
    }

    private function children(array $keys, bool $create): ?self
    {
        if(count($keys) === 0) {
            return $this;
        }

        if(count($keys) === 1 && $keys[0] === '') {
            return $this;
        }

        return $this
            ->child(array_shift($keys), $create)
            ?->children($keys, $create);
    }

    private function methods(array $methods)
    {
        $this->methods = $methods;
    }

    private function toArray()
    {
        return [
            'methods' => $this->methods,
            'children' => c(...$this->children)->map(fn($child) => $child->toArray())->toArray(),
        ];
    }

    public function dd()
    {
        dd($this->toArray());
    }

    public function find(string $route)
    {
        $split = explode('/', trim($route, '/'));

        return $this->children($split, create: false);
    }

    public function method(string $method)
    {
        return $this->methods[$method] ?? null;
    }
}