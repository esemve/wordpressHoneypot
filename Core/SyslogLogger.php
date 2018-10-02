<?php


namespace Core;

class SyslogLogger implements LoggerInterface
{
    public function log(string $ip): void
    {
        openlog("[WPHoneypot]", 0, LOG_LOCAL0);
        syslog(LOG_INFO, "WP Honeypot hit from ".$ip);
        closelog();
    }
}