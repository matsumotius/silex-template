<?php
namespace Tmpl\Tool;

class Encryption {

  public static function hash($str) {
    return hash('sha256', $str);
  }

}
