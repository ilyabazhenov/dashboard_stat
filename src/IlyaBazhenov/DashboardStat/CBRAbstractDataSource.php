<?php namespace IlyaBazhenov\DashboardStat;

use Carbon\Carbon;
use SimpleXMLElement;

abstract class CBRAbstractDataSource extends AbstractDataSource
{
    /**
     * @return string
     */
    abstract protected function getEntityCode ();

    /**
     * @param Carbon $date
     *
     * @return string
     */
    protected function getDateUrlFormatted (Carbon $date)
    {
        return $date->format('d/m/Y');
    }

    /**
     * @param Carbon $period_start
     * @param Carbon $period_end
     *
     * @return SimpleXMLElement
     */
    protected function getXml (Carbon $period_start, Carbon $period_end)
    {
        $url = 'http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=' . $this->getDateUrlFormatted($period_start) . '&date_req2=' .
            $this->getDateUrlFormatted($period_end) . '&VAL_NM_RQ=' . $this->getEntityCode();

        return simplexml_load_string(file_get_contents($url));
    }

    /**
     * @param Carbon $period_start
     * @param Carbon $period_end
     *
     * @return DataContainer
     */
    protected function makeDataContainer (Carbon $period_start, Carbon $period_end)
    {
        $container = new DataContainer();

        $xml = $this->getXml($period_start, $period_end);

        if (isset($xml->Record) && count($xml->Record))
        {
            foreach ($xml->Record as $item)
            {
                $date = Carbon::parse((string)$item->attributes()->Date);

                $value = floatval((string) str_replace(',', '.', $item->Value));

                $container->push($date, $value);
            }
        }

        return $container;
    }
}