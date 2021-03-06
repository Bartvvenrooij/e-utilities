<?php
declare(strict_types=1);

namespace LarsNieuwenhuizen\EUtilities\Interfaces;

interface EUtility
{

    /**
     * @param Query $query
     * @return string
     */
    public function execute(Query $query): string;
}
