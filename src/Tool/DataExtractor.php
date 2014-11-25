<?php
namespace EpitechAPI\Tool;

/**
 * Class DataExtractor is a tool to extract data.
 */
class DataExtractor
{
    # # # # # # # # # # # # # # # # # # # #
    #            Public Methods           #
    # # # # # # # # # # # # # # # # # # # #

    static public function retrieve($response)
    {
        // Shortcuts
        $code = $response['code'];
        $json = $response['json'];

        // If the response code is 404, the student is not found
        if ($code == 404)
            throw new \Exception('EpitechAPI : Not Found');

        // If the response code is not 200, the intranet is down ! Again...
        if ($code !== 200)
            throw new \Exception('EpitechAPI : Intranet Not Responding...');

        // If the json is null, the response is not a valid json
        if ($json == null)
            throw new \Exception('EpitechAPI : Bad JSON Format');

        return $json;
    }

    /**
     * Extract the specified keys from the specified json.
     *
     * @param array $json The json content
     * @param array $keys The keys and sub keys
     * @return mixed|null The value or null if not found.
     */
    static public function extract(array $json = array(), array $keys = null)
    {
        $data = $json;
        foreach ($keys as $key) {
            if (array_key_exists($key, $data))
                $data = $data[$key];
            else
                return null;
        }
        return $data;
    }
}
 