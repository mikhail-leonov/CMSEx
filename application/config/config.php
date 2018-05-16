<?php

/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 * If you want to know why we use "define" instead of "const" @see http://stackoverflow.com/q/2447791/1114320
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: Project URL
 * Put your URL here, for local development "127.0.0.1" or "localhost" (plus sub-folder) is fine
 */
define('URL', 'http://recipe.localhost.com/');

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
$dbcfg = array();
$dbcfg["host"] = "localhost";
$dbcfg["user"] = "recipe";
$dbcfg["pass"] = "g9NacKpPidGqCSq4";
$dbcfg["name"] = "recipe";
$dbcfg["char"] = "utf8";
$GLOBALS["dbcfg"] = $dbcfg;
