<?php
namespace App\Services\Doctor\QueryBuilder;


use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Listable;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder as QueryBuilder;

class CreatorService extends ServiceAbstract implements Creatable
{
    protected $lister;

    public function __construct(QueryBuilder $query, Listable $lister)
    {
        parent::__construct($query);

        $this->lister = $lister;
    }

    /**
     * Create a doctor
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        unset($data['_token']);

        $data = array_merge($data, [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $this->query
            ->from($this->table)
            ->insert($data);

        return $this->lister->last();
    }
}