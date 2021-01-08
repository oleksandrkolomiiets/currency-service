<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Builder;

class CurrencyRepository
{
    /**
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll(array $filters = [], int $perPage = 15)
    {
        $query = Currency::query()
            ->whereIn('id', Currency::query()
                ->orderBy('date', 'desc')
                ->orderBy('created_at', 'desc')
                ->get()
                ->unique('code')
                ->pluck('id'))
            ->orderBy('code', 'asc');

        $query = $this->applyFilters($query, $filters);

        return $query->paginate($perPage);
    }

    /**
     * @param string $currency
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get(string $currency, array $filters = [], int $perPage = 15)
    {
        $query = Currency::query()
            ->where('code', $currency)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');

        $query = $this->applyFilters($query, $filters);

        return $query->paginate($perPage);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function insert(array $data): bool
    {
        return Currency::query()->insert($data);
    }

    /**
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    private function applyFilters(Builder $query, array $filters): Builder
    {
        if (isset($filters['date_from'])) {
            $query->where('date', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $query->where('date', '<=', $filters['date_to']);
        }

        return $query;
    }
}
