<?php

namespace Patterns\Iterator;

class StepIterator implements \Iterator
{
    private array $keys;
    private array $values;
    private int $pos = 0;
    private readonly int $total;

    public function __construct(
        array $data,
        private int $step
    ) {
        $this->keys = array_keys($data);
        $this->values = array_values($data);
        $this->total = \count($data);
    }

    public function current(): mixed
    {
        return $this->values[$this->pos];
    }

    public function next(): void
    {
        $this->pos += $this->step;
    }

    public function key(): mixed
    {
        return $this->keys[$this->pos];
    }

    public function valid(): bool
    {
        return $this->pos < $this->total;
    }

    public function rewind(): void
    {
        $this->pos = 0;
    }

    public function asGenerator(): \Generator
    {
        foreach ($this as $key => $value) {
            yield $key => $value;
        }
    }
}
