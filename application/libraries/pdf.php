<?php if(!defined('BASEPATH')) exit ('No direct script acces allowed');

require_once dirname(__FILE__). '/tcpdf.php';

class Pdf extends TCPDF
{
  function __construct()
  {
    parent::__construct();
  }
}
