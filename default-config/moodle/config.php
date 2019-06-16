<?php  // Moodle configuration file

$moodle_host = $_SERVER['HTTP_HOST'];
//echo $moodle_host;die;

//print(__DIR__ . '/configs/'.$moodle_host.'_config.php');die;
//require_once(__DIR__ . '/configs/'.$moodle_host.'_config.php');
$tenant_slug = str_replace("." , "_" , $moodle_host);

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = getenv('WPC_DB_HOST');
$CFG->dbname    = $tenant_slug;
$CFG->dbuser    = getenv('WPC_DB_USER');
$CFG->dbpass    = getenv('WPC_DB_PASSWORD');
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => '',
  'dbsocket' => '',
  'dbcollation' => 'utf8_general_ci',
);

$CFG->wwwroot   = getenv('DEFAULT_MOODLE_PROTOCL').$moodle_host;
$CFG->dataroot  = getenv('APP_ROOT_DIR').'/moodata/'.$tenant_slug.'_data';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

require_once(__DIR__ . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!