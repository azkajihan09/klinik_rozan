<?php

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) { chdir(FCPATH); }

require FCPATH . '../vendor/codeigniter4/framework/system/Boot.php';
require FCPATH . '../app/Config/Paths.php';

$paths = new Config\Paths();

exit(CodeIgniter\Boot::bootWeb($paths));
