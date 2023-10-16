<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CSV_file
{
    function __construct()
    {
        require_once APPPATH . "/third_party/csv/autoload.php";
    }
}
