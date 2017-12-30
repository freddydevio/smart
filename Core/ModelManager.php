<?php

namespace Core;

abstract class ModelManager
{
    public function toArray($object){
        $reflector = new \ReflectionObject($object);
        $nodes = $reflector->getProperties();
        $out=[];
        foreach ($nodes as  $node) {
            $nod=$reflector->getProperty($node->getName());
            $nod->setAccessible(true);
            $out[$node->getName()]=$nod->getValue($object);
        }
        return $out;
    }
}