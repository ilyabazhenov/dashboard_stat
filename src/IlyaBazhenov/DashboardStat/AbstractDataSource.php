<?php namespace IlyaBazhenov\DashboardStat;

use Carbon\Carbon;

abstract class AbstractDataSource
{
    /**
     * @var DataContainer
     */
    protected $dataContainer;

    /**
     * @param Carbon $periodStart
     * @param Carbon $periodEnd
     *
     * @throws Exception
     */
    public function __construct (Carbon $periodStart, Carbon $periodEnd)
    {
        $container = $this->makeDataContainer($periodStart, $periodEnd);

        if ( ! $container instanceof DataContainer)
        {
            throw new Exception('Method ' . static::class . '::makeDataContainer() should be return DataContainer instance, ' . gettype($container) . ' type given');
        }

        $this->dataContainer = $container;
    }

    /**
     * @return DataContainer
     *
     * @throws Exception
     */
    public function getDataContainer ()
    {
        return $this->dataContainer;
    }

    /**
     * @param Carbon $periodStart
     * @param Carbon $periodEnd
     *
     * @return DataContainer
     */
    abstract protected function makeDataContainer (Carbon $periodStart, Carbon $periodEnd);
}