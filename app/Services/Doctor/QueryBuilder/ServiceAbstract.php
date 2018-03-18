<?php
namespace App\Services\Doctor\QueryBuilder;

use Illuminate\Database\Query\Builder as QueryBuilder;


abstract class ServiceAbstract
{
    protected $query;

    protected $table = 'doctor';

    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }
}