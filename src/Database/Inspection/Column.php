<?php

declare(strict_types=1);

namespace Directus\Database\Inspection;

use Directus\Contracts\Database\Inspection\Column as ColumnContract;
use Doctrine\DBAL\Schema\Column as DoctrineColumn;

class Column implements ColumnContract
{
    /**
     * @var DoctrineColumn
     */
    protected $column;

    /**
     * @var bool
     */
    protected $primary;

    /**
     * @var bool
     */
    protected $unique;

    /**
     * Column constructor.
     */
    public function __construct(DoctrineColumn $column, bool $primary, bool $unique)
    {
        $this->column = $column;
        $this->primary = $primary;
        $this->unique = $unique;
    }

    public function name(): string
    {
        return $this->column->getName();
    }

    public function comment(?string $new = null): string
    {
        if ($new !== null) {
            $this->column->setComment($new);
        }

        return $this->column->getComment() ?? '';
    }

    public function type(): string
    {
        return $this->column->getType()->getName();
    }

    public function scale(): int
    {
        return $this->column->getScale();
    }

    public function length(): ?int
    {
        return $this->column->getLength();
    }

    public function primary(): bool
    {
        return $this->primary;
    }

    public function unique(): bool
    {
        return $this->unique;
    }

    public function unsigned(): bool
    {
        return $this->column->getUnsigned();
    }

    public function nullable(): bool
    {
        return !$this->column->getNotnull();
    }

    public function fixed(): bool
    {
        return $this->column->getFixed();
    }

    public function precision(): int
    {
        return $this->column->getPrecision();
    }

    public function increments(): bool
    {
        return $this->column->getAutoincrement();
    }

    public function default()
    {
        return $this->column->getDefault();
    }
}
