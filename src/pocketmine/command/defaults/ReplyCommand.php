<?php

namespace pocketmine\command\defaults;

use pocketmine\command\CommandSender;
use pocketmine\event\TranslationContainer;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class ReplyCommand extends VanillaCommand {
	public function __construct($name) {
		parent::__construct ( $name, "Sends a message to the last person to /msg you.", "r <message>", [ 
				"reply" 
		] );
		$this->setPermission ( "pocketmine.command.tell" );
	}
	
	public function execute(CommandSender $sender, $currentAlias, array $args){
		if(!$this->testPermission($sender)){
			return true;
		}

		if ($sender->getLastMessage() == null)	{
			return true;
		}
	
		$name = strtolower($sender->getLastMessage()->getName());
		
		$sender->getServer()->dispatchCommand($sender, "msg " . $name . " " . implode(" ", $args));
	
		return true;
	}
}
