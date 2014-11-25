<?php
namespace EpitechAPI\Component\Marking;

use EpitechAPI\Tool\DataExtractor;

/**
 * Class Module represent a module.
 */
class Module
{
    # # # # # # # # # # # # # # # # # # # #
    #              Attributes             #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Contains the module data.
     *
     * @var array
     */
    protected $data = array();

    /**
     * Contains the module activities.
     *
     * @var array
     */
    protected $activities = array();

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
    #            Public Methods           #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Add an activity of this module.
     *
     * @param Activity $activity
     */
    public function addActivity(Activity $activity)
    {
        if ($activity->getActivityCode())
            $this->activities[$activity->getActivityCode()] = $activity;
    }

    # # # # # # # # # # # # # # # # # # # #
    #          Getters / Setters          #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Obtains the activities.
     *
     * @return array
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * Obtains the mark average.
     *
     * @param int $precision The precision of the result.
     * @return float
     */
    public function getMarkAverage($precision = 2)
    {
        $total = 0;
        foreach ($this->activities as $activity)
            $total += $activity->getMark();
        return number_format($total / count($this->activities), $precision);
    }

    /**
     * Obtains the school year.
     *
     * @return int|null
     */
    public function getSchoolYear()
    {
        return DataExtractor::extract($this->data, array('scolaryear'));
    }

    /**
     * Obtains the module code.
     *
     * @return string|null
     */
    public function getModuleCode()
    {
        return DataExtractor::extract($this->data, array('codemodule'));
    }

    /**
     * Obtains the title.
     *
     * @return mixed|null
     */
    public function getTitle()
    {
        return DataExtractor::extract($this->data, array('title'));
    }

    /**
     * Obtains the amount of credits earned.
     *
     * @return int|null
     */
    public function getCredits()
    {
        return DataExtractor::extract($this->data, array('credits'));
    }

    /**
     * Obtains the grade.
     *
     * @return string|null
     */
    public function getGrade()
    {
        return DataExtractor::extract($this->data, array('grade'));
    }
}
 