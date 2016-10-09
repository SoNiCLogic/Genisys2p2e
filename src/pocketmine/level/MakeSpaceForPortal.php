<?php
namespace pocketmine\level;
use pocketmine\scheduler\Task;
use pocketmine\block\Block;
use pocketmine\math\Vector3;

class MakeSpaceForPortal extends Task{
	public $pos;
	public function __construct(Position $pos)	{
		$this->pos = $pos;
	}

	public function onRun($currentTick) {
		$level = $this->pos->level;
		$x = $this->pos->getX() - 3;
		$y = 64;
		$z = $this->pos->getZ() - 3;
		while ($x < $this->pos->getX() + 4)	{
			while ($y < 69)	{
				while ($z < $this->pos->getZ() + 4)	{
					$level->setBlock(new Position($x, $y, $z, $level), Block::get(BLOCK::AIR));
					$z = $z + 1;
				}
				$y = $y + 1;
			}
			$x = $x + 1;
		}
		$level->setBlock(new Vector3($this->pos->getX(), 64, $this->pos->getY()), Block::get(Block::OBSIDIAN));
		
	}
}