<?php
namespace EpitechAPI\Component\Marking;

use EpitechAPI\Tool\DataExtractor;

/**
 * Class Activity represent a marked activity.
 */
class Activity
{
    # # # # # # # # # # # # # # # # # # # #
    #              Attributes             #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Contains the mark data.
     *
     * @var array
     */
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
     * Obtains the activity code.
     *
     * @return string|null
     */
    public function getActivityCode()
    {
        return DataExtractor::extract($this->data, array('codeacti'));
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
     * Obtains the title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return DataExtractor::extract($this->data, array('title'));
    }

    /**
     * Obtains the mark.
     *
     * @return int|null
     */
    public function getMark()
    {
        return DataExtractor::extract($this->data, array('final_note'));
    }

    /**
     * Obtains the comment.
     *
     * @return string|null
     */
    public function getComment()
    {
        return DataExtractor::extract($this->data, array('comment'));
    }

    /**
     * Obtains the DateTime.
     *
     * @return \DateTime|null
     */
    public function getDateTime()
    {
        if (($date = DataExtractor::extract($this->data, array('date'))))
            return \DateTime::createFromFormat('Y-m-d G:i:s', $date);
        return null;
    }

    /**
     * Obtains the examiner login.
     *
     * @return string|null
     */
    public function getExaminer()
    {
        return DataExtractor::extract($this->data, array('correcteur'));
    }
}
 