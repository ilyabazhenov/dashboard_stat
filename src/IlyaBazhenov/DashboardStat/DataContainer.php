<?php namespace IlyaBazhenov\DashboardStat;

use Carbon\Carbon;

class DataContainer
{
    /**
     * @var DataItem[]
     */
    protected $data = [];

    /**
     * @return void
     */
    protected function sortingData ()
    {
        usort($this->data, function ($a, $b)
        {
            /** @var DataItem $a */
            /** @var DataItem $b */

            if ($a->getDate()->eq($b->getDate())) return 0;

            return ($a->getDate()->gt($b->getDate()));
        });
    }

    /**
     * @param Carbon $date
     * @param mixed $value
     *
     * @return $this
     */
    public function push (Carbon $date, $value)
    {
        $exists = false;

        foreach ($this->data as $key => $item)
        {
            if ($item->getDate()->eq($date))
            {
                $this->data[$key] = $value;

                $exists = true;
            }
        }

        if (! $exists) array_push($this->data, new DataItem($date, $value));

        $this->sortingData();

        return $this;
    }

    /**
     * @return DataItem[]
     */
    public function getItems ()
    {
        return $this->data;
    }

    /**
     * @param Carbon $date
     *
     * @return mixed|null
     */
    public function getValueByDate (Carbon $date)
    {
        foreach ($this->data as $key => $item)
        {
            if ($item->getDate()->eq($date)) return $item->getValue();
        }

        return null;
    }
}