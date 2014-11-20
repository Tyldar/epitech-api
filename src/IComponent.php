<?php
namespace EpitechAPI;

interface IComponent
{
    /**
     * Initializes this component taking the Connector to interact with Epitech's intranet.
     *
     * @param Connector $connector The connector signed in.
     */
    public function __construct(Connector $connector);

    /**
     * Obtains the Connector.
     *
     * @return Connector
     */
    public function getConnector();
}