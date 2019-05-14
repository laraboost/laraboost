<?php

namespace Laraboost;

use Illuminate\Console\DetectsApplicationNamespace;

class Compiler
{
    use DetectsApplicationNamespace;

    public $stub;
    public $input_data;
    public $output_contents;
    public $withoutKeys = true;

    public function __construct($stub_path, $data)
    {
        $this->input_data = $data;
        $this->stub = __DIR__ . '/../stubs/' . $stub_path;
        $this->output_contents = file_get_contents($this->stub);
    }

    public function compile()
    {
        $this->input_data['namespace'] = rtrim(self::getAppNamespace(), '\\');

        foreach ($this->input_data as $key => $value) {
            if (!$this->withoutKeys) {
                $value = $value . '$' . $key . '$';
            }
            $this->output_contents = preg_replace("/\\$$key\\$/i", $value, $this->output_contents);
        }
        return $this->output_contents;
    }

    public static function stub($stub_path, $data)
    {
        $compiler = new Compiler($stub_path, $data);
        return $compiler->compile();
    }
}