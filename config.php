<?php

return [
    /**
     * Logger class
     * Available:
     * "Core\SyslogLogger" - Log to syslog
     * "Core\SelfLogger"   - Log to the logs folder
     */
    'logger' => 'Core\SelfLogger',

    /**
     * What is the maximum file size when use use SelfLogger when
     * this system must create a new log file.
     */
    'max_log_size' => '10000000'
];