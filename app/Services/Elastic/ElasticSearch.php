<?php

namespace App\Services\Elastic;

use Elastic\Elasticsearch\ClientBuilder;

class ElasticSearch
{
    public static function getClient(): \Elastic\Elasticsearch\Client
    {
        return ClientBuilder::fromConfig(config('elastic'));
    }
}