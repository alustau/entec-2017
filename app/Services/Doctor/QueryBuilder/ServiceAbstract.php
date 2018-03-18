<?php
namespace App\Services\Doctor\QueryBuilder;

use Illuminate\Database\Query\Builder as QueryBuilder;


/**
 * Class ServiceAbstract
 * @package App\Services\Doctor\QueryBuilder
 */
abstract class ServiceAbstract
{
    /**
     * @var QueryBuilder
     */
    protected $query;

    /**
     * @var string
     */
    protected $table = 'doctor';

    /**
     * ServiceAbstract constructor.
     * @param QueryBuilder $query
     */
    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }
}
