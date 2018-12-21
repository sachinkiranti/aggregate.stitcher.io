<?php

use App\Support\Filterable;
use App\Support\QueryFilter;
use Domain\User\Models\User;
use Faker\Factory;
use Faker\Generator;

function locale()
{
    return config('app.locale');
}

function faker(): Generator
{
    return Factory::create();
}

function current_user(): ?User
{
    return Auth::user();
}

function filter(string $name, Filterable $filterable = null): string
{
    $queryFilter = app(QueryFilter::class);

    return $queryFilter
        ->filter($name, $filterable);
}

function filter_active(string $name, Filterable $filterable = null): bool
{
    $queryFilter = app(QueryFilter::class);

    return $queryFilter->isActive($name, $filterable);
}

function clear_filter(string $name): string
{
    $queryFilter = app(QueryFilter::class);

    return $queryFilter->clear($name);
}
