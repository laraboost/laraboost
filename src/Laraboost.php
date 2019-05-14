<?php

namespace Laraboost;

class Laraboost
{

    public function cache()
    {
        $this->cacheModels();
    }

    public function getCache()
    {
        return $this->__toString();
    }

    public function cacheModels()
    {
        $modelPath = base_path('.laraboost/models/');
        $models = collect(glob($modelPath . '*'))->map(function ($filename) use ($modelPath) {
            return str_replace($modelPath, '', str_replace('.json', '', $filename));
        });
        file_put_contents($modelPath . 'index.json', json_encode($models));
    }

    public function getModels()
    {
        return json_decode(file_get_contents(base_path('.laraboost/models/index.json')));
    }

    public function __toString()
    {
        return json_encode([
            'models' => self::getModels(),
        ]);
    }
}
