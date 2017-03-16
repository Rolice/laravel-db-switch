<?php
namespace Rolice\LaravelDbSwitch;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\MySqlConnection;

/**
 * Class DbSwitcher
 */
class DbSwitchService
{
    /**
     * Function which changes directly the default connection DB transparently for the database and models instances.
     * @param string $database The database to switch to.
     */
    public function to($database)
    {
        Config::set('database.default', $database);
    }

    /**
     * Method that changes specific, custom connection database with another.
     * @param string $key The unified key under which you sill switch dynamically databases, ex. platform, site, etc.
     * @param string $database The database to switch to.
     */
    public function connectionTo($key, $database)
    {
        Config::set("database.connections.{$key}.database", $database);

        $this->reconnect($key, $database);
    }

    /**
     * Changes platform active connection database name and reconnect to it.
     * @param string $key The connection key under which you will switch databases, ex. platform, site, etc.
     * @param string $database The database to reconnect to.
     */
    protected function reconnect($key, $database)
    {
        $connections = DB::getConnections();
        /** @var MySqlConnection $connection */
        $connection = isset($connections[$key]) ? $connections[$key] : '';

        if (is_object($connection) && $connection->getDatabaseName() != $database) {
            $connection->setDatabaseName($database);
            $connection->reconnect();
        }
    }

}
