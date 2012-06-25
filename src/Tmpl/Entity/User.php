<?php
namespace Tmpl\Entity;

/**
 * @Entity
 * @Table(name="users")
 */
class User extends BaseEntity {

  /** @Id @Column(type="integer") @GeneratedValue */
  protected $id;

  /** @Column(name="user_id", type="string") */
  protected $userId;

  /** @Column(name="password", type="string") */
  protected $password;

  /** @Column(name="created_at", type="datetime") */
  protected $createdAt;

  public function __construct($query = array()) {
    // set default values
    $this->createdAt     = new \DateTime();
    // set values
    if (count($query) > 0) $this->set($query);
  }

}
