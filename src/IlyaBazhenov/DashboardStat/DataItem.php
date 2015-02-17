<?php namespace IlyaBazhenov\DashboardStat;

use Carbon\Carbon;

class DataItem
{
    /**
     * @var Carbon
     */
    protected $date;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param Carbon $date
     * @param mixed $value
     */
    function __construct(Carbon $date, $value)
    {
        $this->date = $date;

        $this->value = $value;
    }

    /**
     * @return Carbon
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}