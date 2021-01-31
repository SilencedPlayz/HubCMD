<?php

namespace SilencedTick880;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use pocketmine\level\sound\BlazeShootSound;

class main extends PluginBase implements Listener {
         
         public function onEnable(){
                  @mkdir($this->getDataFolder());
                  $this->saveDefaultConfig();
                  $this->getResources("config.yml");
         }
         
         public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {
                  
                  switch($cmd->getName()){
                           case "hub":
                                    if($sender instanceof Player){
                                             $sender->teleport($this->getServer()->getDefaultLevel()->getSpawnLocation());
                                             if($this->getConfig()->get("allow_title") == true){
                                                      $sender->addTitle($this->getConfig()->get("hub_title"), $this->getConfig()->get("hub_subtitle"));
                                             }
                                             
                                             if($this->getConfig()->get("allow_message") == true){
                                                      $sender->sendMessage($this->getConfig()->get("hub_message"));
                                             }
                                             
                                             if($this->getConfig()->get("allow_sound") == true){
                                                      $sender->getLevel()->addSound(new BlazeShootSound($sender));
                                             }
                                    }
                           break;
                           
                           case "spawn":
                                    if($sender instanceof Player){
                                             $sender->teleport($sender->getLevel()->getSafeSpawn());
                                             if($this->getConfig()->get("allow_title") == true){
                                                      $sender->addTitle($this->getConfig()->get("spawn_title"), $this->getConfig()->get("spawn_subtitle"));
                                             }
                                             
                                             if($this->getConfig()->get("allow_message") == true){
                                                      $sender->sendMessage($this->getConfig()->get("spawn_message"));
                                             }
                                             
                                             if($this->getConfig()->get("allow_sound") == true){
                                                      $sender->getLevel()->addSound(new BlazeShootSound($sender));
                                             }
                                    }
                           break;
                  }
                  return true;
         }
}
