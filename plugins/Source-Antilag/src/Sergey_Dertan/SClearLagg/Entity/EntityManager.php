<?php
namespace Sergey_Dertan\SClearLagg\Entity;

use pocketmine\entity\Creature;
use pocketmine\entity\Human;
use pocketmine\Server;
use NORA\RPGMobs\Boss;
use Sergey_Dertan\SClearLagg\SClearLaggMainFolder\SClearLaggMain;

/*
 * Класс в котором будет происходить удаление объектов
 */

/**
 * Class EntityManager
 * @package Sergey_Dertan\SClearLagg\Entity
 */
class EntityManager
{
    function __construct(SClearLaggMain $main)
    {
        $this->main = $main;
    }

    /**
     * @return SClearLaggMain
     */
    function getMain()
    {
        return $this->main;
    }
    /**
     * @return int
     */
    function removeEntities()
    {
        $entitiesCount = 0;
        foreach (Server::getInstance()->getLevels() as $level) { 
            foreach ($level->getEntities() as $entity) { 
                if (!$entity instanceof Creature and !$entity instanceof Human) {
                    $entity->close();
                    $entitiesCount++;
                }
            }
        }
        return $entitiesCount;
    }

    /**
     * @return int
     */
    function removeMobs()
    {
        $mobsCount = 0;
        foreach (Server::getInstance()->getLevels() as $level) {
            foreach ($level->getEntities() as $entity) {
                if ($entity instanceof Creature && !($entity instanceof Human) && !($entity instanceof Boss)) {
                    $entity->close();
                    $mobsCount++;
                }
            }
        }
        return $mobsCount;
    }
}