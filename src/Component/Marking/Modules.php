<?php
namespace EpitechAPI\Component\Marking;

use EpitechAPI\Connector;

/**
 * Class Modules represent the modules of an user.
 */
class Modules
{
    # # # # # # # # # # # # # # # # # # # #
    #              Constants              #
    # # # # # # # # # # # # # # # # # # # #

    const MARKS_URL = 'https://intra.epitech.eu/user/{LOGIN}/notes/?format=json';

    # # # # # # # # # # # # # # # # # # # #
    #              Attributes             #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Contains the Connector.
     *
     * @var \EpitechAPI\Connector
     */
    protected $connector;

    /**
     * Contains the modules.
     *
     * @var array
     */
    protected $modules = array();

    # # # # # # # # # # # # # # # # # # # #
    #      Constructor / Destructor       #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Initializes this component taking the Connector to interact with Epitech's intranet.
     *
     * @param Connector $connector The connector signed in.
     * @param string $login The login of the user to load data.
     * @throws \Exception If the Connector is not signed in.
     */
    public function __construct(Connector $connector, $login)
    {
        // If the use is not signed in, we can't use this component.
        if (!$connector->isSignedIn())
            throw new \Exception("The Connector is not signed in");

        $this->connector = $connector;

        // Retrieving the modules and activities from intranet for the specified user login
        $response = $this->connector->request(str_replace('{LOGIN}', $login, self::MARKS_URL));
        $data = $this->check($response);

        // Shortcuts
        $modules = $data['modules'];
        $activities = $data['notes'];

        // Adding the modules
        foreach ($modules as $module_data) {
            $module = new Module($module_data);
            $this->addModule($module);
        }

        // Adding the activities to the modules
        foreach ($activities as $activity_data) {
            $activity = new Activity($activity_data);
            if (array_key_exists($activity->getModuleCode(), $this->modules))
                $this->addModuleActivity($this->modules[$activity->getModuleCode()], $activity);
        }
    }

    # # # # # # # # # # # # # # # # # # # #
    #            Public Methods           #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Adds the specified module.
     *
     * @param Module $module
     */
    public function addModule(Module $module)
    {
        $this->modules[$module->getModuleCode()] = $module;
    }

    /**
     * Adds the specified activity to the specified module.
     *
     * @param Module $module
     * @param Activity $activity
     */
    public function addModuleActivity(Module $module, Activity $activity)
    {
        $module->addActivity($activity);
    }

    # # # # # # # # # # # # # # # # # # # #
    #          Getters / Setters          #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Obtains the modules.
     *
     * @return array
     */
    public function getModules()
    {
        return $this->modules;
    }

    # # # # # # # # # # # # # # # # # # # #
    #           Private Methods           #
    # # # # # # # # # # # # # # # # # # # #

    /**
     * Checks the response and returns its json content as array
     *
     * @param array $response The connector response
     * @return array The json response
     * @throws \Exception If the response code is not 200 or if the json response is null
     */
    protected function check($response)
    {
        // Shortcuts
        $code = $response['code'];
        $json = $response['json'];

        // If the response code is 404, the student is not found
        if ($code == 404)
            throw new \Exception('The user is not found');

        // If the response code is not 200, the intranet is down ! Again...
        if ($code !== 200)
            throw new \Exception('The HTTP response is not 200... Maybe Intranet is down ?!');

        // If the json is null, the response is not a valid json
        if ($json == null)
            throw new \Exception('Cannot parse the json response, bad formatted ?!');

        return $json;
    }

}
 