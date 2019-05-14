<?php

namespace Laraboost;

use Laraboost\Compiler;
use Illuminate\Support\Str;

class Model
{
    public $name;
    public $columns;
    public $table_name;
    public $relationships;

    public function __construct($filename)
    {
        $file_path = base_path('.laraboost/models/' . $filename . '.json');
        $config = json_decode(file_get_contents($file_path));

        $this->name = $config->name;
        $this->table_name = $config->table_name;
        $this->columns = $config->columns;
        $this->relationships = $config->relationships;
        // load config from file based on filename
    }

    public static function get($filename)
    {
        return new Model($filename);
    }

    public static function create($name)
    {
        file_put_contents(
            base_path('.laraboost/models/' . $name . '.json'),
            Compiler::stub('configs/model.json', [
                'name' => $name,
                'plural_name' => Str::lower(Str::plural($name))
            ])
        );

        return self::get($name);
    }

    public function __toString()
    {
        return json_encode([
            "name" => $this->name,
            "table_name" => $this->table_name,
            "columns" => $this->columns,
            "relationships" => $this->relationships,
        ]);
    }
}