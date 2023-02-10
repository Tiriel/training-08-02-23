<?php

namespace Db;

class Query
{
    public function __construct(
        protected readonly Connection $connection,
        protected int $itemsPerPage
    ) {}
}
