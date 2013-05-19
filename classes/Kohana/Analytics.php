<?php defined('SYSPATH') or die('No direct script access.');

abstract class Kohana_Analytics
{
    // Kohana_Analytics instance
    protected static $_instance;

    protected $_config;
    protected $_gapi;

    /**
     * Loads configuration options.
     *
     * @param array $config
     */
    public function __construct($config = array())
    {
        // Save the config in the object
        $this->_config = $config;

        // Load the GAPI http://code.google.com/p/gapi-google-analytics-php-interface/ library
        require Kohana::find_file('vendor', 'gapi-1.3/gapi.class');

        $this->_gapi = new gapi($this->_config['username'], $this->_config['password']);
    }

    /**
     * Singleton pattern.
     *
     * @return $this
     */
    public static function instance()
    {
        if ( ! isset(Analytics::$_instance))
        {
            // Load the configuration for this type
            $config = Kohana::$config->load('analytics');

            // Create a new session instance
            Analytics::$_instance = new Analytics($config);
        }

        return Analytics::$_instance;
    }

    /**
     * Return count views per page.
     *
     * @param string $pageUri
     *   Page uri without http://.
     *   e.g.: ~^/information_.[a-z0-9]?/about.php$    #Regular Expression
     *   e.g.: /information_abc/about.php     #Equals
     * @param string $startDate
     *   Date format is 'Y-m-d'. e.g.: 2013-04-01.
     *
     * @return int
     *   A count of page views.
     */
    public function getCountPageViews($pageUri, $startDate = NULL)
    {
        if (strpos($pageUri, '~') === 0) {
            // Regular Expression
            $filter = 'pagePath = ' . $pageUri;
        }
        else {
            // Equals
            $filter = 'pagePath == ' . $pageUri;
        }
        if (!$startDate)
            $startDate = date('Y-m-d', strtotime('1 month ago'));
        $this->_gapi->requestReportData(
            $this->_config['report_id'],
            array('visitorType'),
            array('pageViews'),
            NULL,
            $filter,
            $startDate
        );
        $pageViews = 0;
        foreach ($this->_gapi->getResults() as $result) {
            $pageViews += $result->getPageviews();
        }
        return $pageViews;
    }

}
