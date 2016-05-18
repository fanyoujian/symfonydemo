<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();
$collection->add('index', new Route('/index', array(
    '_controller' => 'AppBundle:Projects:index',
)));

return $collection;