<?php
namespace Tmpl\Service;

use Tmpl\Tool\Encryption;
use Tmpl\Entity\User;
use Tmpl\Exception\TmplException;

class UserService {

  private $em; // entity manager
  private $users;

  public function __construct($em) {
    $this->em    = $em;
    $this->users = $this->em->getRepository(User::getRepository());
  }

  public function getUserByAutoId($id) {
    return $this->users->findOneById($id);
  }

  public function getUserByUserId($user_id) {
    return $this->users->findOneByUserId($user_id);
  }

  public function isValidUser($user_id, $password) {
    $user = $this->getUserByUserId($user_id);
    return $user && $user->password == Encryption::hash($password);
  }

  public function isConflict($user_id) {
    $user = $this->getUserByUserId($user_id);
    return ($user) ? true : false;
  }

  private function checkValidSaveQuery($query) {
    if (false === isset($query['user_id'])) {
      throw new TmplException('ユーザIDが入力されていません');
    }
    if (false === isset($query['password'])) {
      throw new TmplException('パスワードが入力されていません');
    }
    if ($this->isConflict($query['user_id'])) {
      throw new TmplException('指定されたユーザIDは既に使用されています');
    }
    return true;
  }

  public function save($query = array()) {
    $this->checkValidSaveQuery($query);
    $user = new User(array(
      'user_id'  => $query['user_id'],
      'password' => Encryption::hash($query['password'])
    ));
    $this->em->persist($user);
    $this->em->flush();
    return $user;
  }
}
