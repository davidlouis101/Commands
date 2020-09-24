<?php

namespace Commands;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\Server;
use pocketmine\Player;
use muqsit\invmenu\{InvMenu, InvMenuHandler};
use pocketmine\entity\EffectInstance;
use pocketmine\entity\Effect;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{
  
public $myConfig;

public function onEnable(){
$this->getLogger()->info(TextFormat::GREEN . "Clearinventory is now Active");
$this->getLogger()->info(TextFormat::BLUE . "Author: Crow Balde");
$this->getServer()->getPluginManager()->registerEvents($this, $this);

$this->myConfig = (new Config($this->getDataFolder() . "config.yml", Config::YAML, array(
  "Messages" => [
    "ClearMessage" => "Setup in Config.yml"
    "PopupMessage" => "Setup in Config.yml"
    ]
  )));
}

public function onDisable(){
$this->getLogger()->info(TextFormat::RED. "Clearinventory is now Disabled");
$this->getLogger()->info(TextFormat::BLUE . "Author: Crow Balde");
}

public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{

switch($cmd->getName()){
		
       case "clear":
		if($sender instanceof Player){
			if($sender->hasPermission("clear.cmd")){
			  //Config
			  $config = $this->myConfig->getAll();
				$message = $config["Messages"] ["ClearMessage"];
				$popup = $config["Messages"] ["PopupMessage"];
				//sound
        $sender->getlevel()->addSound(new EndermanTeleportSound($sender));
        //messages and Clear uses
				$sender->sendMessage($message);
				$sender->sendPopup($popup);
        $sender->getInventory()->clearAll();
				$sender->getArmorInventory()->clearAll();
				$sender->removeAllEffects();
			}
		}
		break;
}
return true;
}
}
				  
