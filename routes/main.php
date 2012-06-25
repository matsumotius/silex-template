<?php
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->match('/', function() use ($app) {
  return "hello";
})
->bind('index');

$app->error(function (\Exception $e, $code) use ($app) {
  switch ($code) {
    case 404:
      $message = 'お探しのページは見つかりませんでした';
      break;
    default:
      $message = $e->getMessage();
      if (false === isset($message)) $message = '予期せぬエラーが発生しました';
  }
  return $message;
});
