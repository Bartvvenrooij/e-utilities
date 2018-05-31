<?php
declare(strict_types=1);

namespace LarsNieuwenhuizen\EUtilities\Esearch;

use LarsNieuwenhuizen\EUtilities\AbstractBase;

class ESearch extends AbstractBase
{

    /**
     * @var string
     */
    protected $urlPath = 'esearch.fcgi';

    /**
     * @var string
     */
    protected $database = 'pubmed';

    /**
     * @var string
     */
    protected $returnMode = 'json';

    /**
     * @param Query $query
     * @return string
     */
    public function execute(Query $query)
    {
        $requestUri = $this->getBaseUrl() .
            '?db=' . $this->getDatabase() .
            '&term=' . $query->getQueryString() .
            '&retmode=' . $this->getReturnMode();
        $result = $this->getHttpClient()->get($requestUri)
            ->getBody()
            ->getContents();

        return $result;
    }

    /**
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->database;
    }

    /**
     * @param string $database
     * @return ESearch
     */
    public function setDatabase(string $database): ESearch
    {
        $this->database = $database;

        return $this;
    }

    /**
     * @return string
     */
    public function getReturnMode(): string
    {
        return $this->returnMode;
    }

    /**
     * @param string $returnMode
     * @return ESearch
     */
    public function setReturnMode(string $returnMode): ESearch
    {
        $this->returnMode = $returnMode;

        return $this;
    }
}
