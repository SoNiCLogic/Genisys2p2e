<?php
namespace pocketmine\level;
use pocketmine\scheduler\Task;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\item\Item;

class MakeSafePlace extends Task	{
	public $pos;
	public $server;
	public $player;
	public function __construct(Position $pos, Server $s, Player $p)	{
		$this->pos = $pos;
		$this->server = $s;
		$this->player = $p;
	}

	public function onRun($currentTick) {
		$this->player->setAbsorption(0);
		$level = $this->pos->getLevel();
		$x = $this->pos->getX();
		$z = $this->pos->getZ();
		$y = 64;
		$level->setBlock(new Vector3($x, $y, $z), Block::get(Block::AIR), false, false);
		$level->setBlock(new Vector3($x, $y + 1, $z), Block::get(Block::AIR), false, false);
		$level->setBlock(new Vector3($x, $y + 2, $z), Block::get(Block::STONE), false, false);
		$level->setBlock(new Vector3($x, $y - 1, $z), Block::get(Block::STONE), false, false);
		$level->setBlock(new Vector3($x, $y - 2, $z), Block::get(Block::PORTAL), false, false);
		$this->player->sendMessage("Done! A portal block has been placed below you.");
		$this->player->teleport($this->pos);
	}
}
