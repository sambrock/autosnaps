<?php

namespace App\Services;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class CollectionPaginator
{
  public static function paginate(Collection $results, $pageSize)
  {
    $page = Paginator::resolveCurrentPage('page');

    $total = $results->count();

    return self::paginator($results->forPage($page, $pageSize), $total, $pageSize, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => 'page',]);
  }

  protected static function paginator($items, $total, $perPage, $currentPage, $options)
  {
    return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
      'items',
      'total',
      'perPage',
      'currentPage',
      'options'
    ));
  }
}
