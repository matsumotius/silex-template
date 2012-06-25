<?php
abstract class TmplTestCase extends PHPUnit_Framework_TestCase {

  public $test;

  public function __construct($name = NULL, array $data = array(), $dataName = '') {

    /**
     * get ServiceContainer
     */
    $this->test = require APP_DIR . '/scripts/app.php';

    /**
     * call parent constructor
     */
    parent::__construct($name, $data, $dataName);

  }

  public function revertTable($table) {
    // get sql file path
    $filepath = APP_DIR . '/resources/sql/'      . $table . '.sql';
    $testpath = APP_DIR . '/tests/resources/sql/' . $table . '.sql';
    // execute revert
    if (file_exists($filepath)) {
      $this->test['db']->query(file_get_contents($filepath));
    }
    if (file_exists($testpath)) {
      $this->test['db']->query(file_get_contents($testpath));
    }
  }
}
