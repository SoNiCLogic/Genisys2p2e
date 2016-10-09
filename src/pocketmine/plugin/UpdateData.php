<?php
namespace Yournamespace;

use pocketmine\scheduler\Task;

class UpdateData extends Task{

  public function __construct(MainClass $plugin){
    parent::__construct($plugin);
  }

  public function onRun($currentTick){
      //update your data $this->getOwner() returns your main class
  }
}