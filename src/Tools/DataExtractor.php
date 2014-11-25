<?php
namespace EpitechAPI\Tools;

/**
 * Class DataExtractor is a tool to extract data.
 */
class DataExtractor
{
    # # # # # # # # # # # # # # # # # # # #
    #            Public Methods           #
    # # # # # # # # # # # # # # # # # # # #

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
 