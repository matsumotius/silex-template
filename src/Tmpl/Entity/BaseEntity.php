<?php
namespace Tmpl\Entity;
use Tmpl\Util\Inflector;

abstract class BaseEntity {

  public static function getRepository() {
    return get_called_class();
  }

  public function __get($name) {
    $column = Inflector::variable($name);
    if (property_exists($this, $column)) {
      return $this->$column;
    }
    return null;
  }

  public function __set($name, $param) {
    $column = Inflector::variable($name);
    if (property_exists($this, $column)) {
      $this->$column = $param;
    }
  }

  public function __call($name, $params) {
    if (strpos($name, 'get') === 0) {
      $column = substr($name, 3);
      return $this->$column;
    }
    if (strpos($name, 'set') === 0) {
      $column = substr($name, 3);
      $this->$column = $params[0];
    }
  }

  public function set($params) {
    foreach ($params as $key => $value) {
      $this->$key = $value;
    }
  }

  public function toArray() {
    return get_object_vars($this);
  }

  public static function getAllColumns($alias = "") {
    $columns = array();
    $properties = get_class_vars(get_called_class());
    if ($alias != "") $alias .= ".";
    foreach ($properties as $key => $values) {
      array_push($columns, "{$alias}{$key}");
    }
    return $columns;
  }
}
