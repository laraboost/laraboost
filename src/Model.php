<?php

namespace Laraboost;

use Laraboost;
use Illuminate\Support\Str;

class Model
{
    public $name;
    public $columns;
    public $table_name;
    public $plural_name;
    public $relationships;

    public function __construct($filename)
    {
        $file_path = base_path('.laraboost/models/' . $filename . '.json');
        $config = json_decode(file_get_contents($file_path));

        $this->name = $config->name ?? '';
        $this->table_name = $config->table_name ?? '';
        $this->columns = $config->columns ?? [];
        $this->relationships = $config->relationships ?? [];
    }

    public static function get($filename)
    {
        return new Model($filename);
    }

    public static function create($name)
    {
        file_put_contents(base_path('.laraboost/models/' . $name . '.json'), []);

        $model = self::get($name);
        $model->name = $name;
        $model->table_name = Str::lower(Str::plural($name));
        $model->plural_name = Str::lower(Str::plural($name));
        $model->columns = [
            [
                'name' => 'id',
                'type' => 'increments'
            ]
        ];
        $model->save();
    }

    public function addColumn($values)
    {
        array_push($this->columns, $values);
    }

    public function addColumns(Array $array)
    {
        array_merge($this->columns, $array);
    }

    public function save()
    {
        file_put_contents(
            base_path('.laraboost/models/' . $this->name . '.json'),
            $this
        );
        Laraboost::indexModels();
    }

    public function __toString()
    {
        return json_encode([
            'name' => $this->name,
            'table_name' => $this->table_name,
            'plural_name' => $this->plural_name,
            'columns' => $this->columns,
            'relationships' => $this->relationships,
        ]);
    }
}
