<?php
namespace EpitechAPI\Component\Netsoul;

use EpitechAPI\Tool\DataExtractor;

class Log
{
    # # # # # # # # # # # # # # # # # # # #
    #              Attributes             #
    # # # # # # # # # # # # # # # # # # # #

    protected $data = array();

    # # # # # # # # # # # # # # # # # # # #
    #      Constructor / Destructor       #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Initializes this class using the data.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    # # # # # # # # # # # # # # # # # # # #
    #          Getters / Setters          #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Obtains the timestamp.
     *
     * @return int|null
     */
    public function getTimestamp()
    {
        return DataExtractor::extract($this->data, array(0));
    }

    /**
     * Obtains the DateTime.
     *
     * @return \DateTime|null
     */
    public function getDateTime()
    {
        if (($timestamp = DataExtractor::extract($this->data, array(0)))) {
            $datetime = new \DateTime();
            $datetime->setTimestamp($timestamp);
            return $datetime;
        }
        return null;
    }

    /**
     * Obtains the seconds of « time_active »
     *
     * @return float|null
     */
    public function getInsideActive()
    {
        return DataExtractor::extract($this->data, array(1));
    }

    /**
     * Obtains the seconds of « time_inactive »
     *
     * @return float|null
     */
    public function getInsideInactive()
    {
        return DataExtractor::extract($this->data, array(2));
    }

    /**
     * Obtains the seconds of « time_out_active »
     *
     * @return float|null
     */
    public function getOutsideActive()
    {
        return DataExtractor::extract($this->data, array(3));
    }

    /**
     * Obtains the seconds of « time_out_inactive »
     *
     * @return float|null
     */
    public function getOutsideInactive()
    {
        return DataExtractor::extract($this->data, array(4));
    }

    /**
     * Obtains the seconds of « time_average »
     *
     * @return float|null
     */
    public function getAverage()
    {
        return DataExtractor::extract($this->data, array(5));
    }
}
 