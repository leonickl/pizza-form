<?php

namespace App\Lib;

class View
{
    private const string PATH = __DIR__.'/../../views';

    private function __construct(protected string $view, protected array $params) {}

    public static function make(string $view, array $params = []): self
    {
        return new self($view, $params);
    }

    public function render(): string
    {
        $path = self::PATH.'/'.$this->view.'.php';

        if (! file_exists($path)) {
            throw new \App\Exceptions\ViewNotFoundException($path);
        }

        extract($this->params);

        ob_start();
        include $path;

        return ob_get_clean();
    }

    public function layout(string $view, array $additionalParams = [])
    {
        $this->params = [...$this->params, ...$additionalParams];

        return self::make($view, [
            'slot' => $this->render(),
            ...$additionalParams,
        ]);
    }
}
