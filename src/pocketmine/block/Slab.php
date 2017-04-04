<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace pocketmine\block;

use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\math\AxisAlignedBB;
use pocketmine\Player;

class Slab extends WoodSlab{
	
	const STONE = 0;
	const SANDSTONE = 1;
	const WOODEN = 2;
	const COBBLESTONE = 3;
	const BRICK = 4;
	const STONE_BRICK = 5;
	const QUARTZ = 6;
	const NETHER_BRICK = 7;
	const PURPUR_BLOCK = 8;

	protected $id = self::SLAB;
    protected $doubleId = self::DOUBLE_SLAB;

	public function __construct($meta = 0){
		$this->meta = $meta;
	}

	public function getHardness() {
		return 2;
	}

	public function getName() : string{
		static $names = [
			0 => "Stone",
			1 => "Sandstone",
			2 => "Wooden",
			3 => "Cobblestone",
			4 => "Brick",
			5 => "Stone Brick",
			6 => "Quartz",
			7 => "Purpur",
		];
		return (($this->meta & 0x08) > 0 ? "Upper " : "") . $names[$this->meta & 0x07] . " Slab";
	}

	public function getBurnChance() : int{
		$type = $this->meta & 0x07;
		if($type == self::WOODEN){
			return 5;
		}
		return 0;
	}

	public function getBurnAbility() : int{
		$type = $this->meta & 0x07;
		if($type == self::WOODEN){
			return 5;
		}
		return 0;
	}

    public function getToolType(){
        return Tool::TYPE_PICKAXE;
    }

	public function getDrops(Item $item) : array {
		if($item->isPickaxe() >= 1){
			return [
				[$this->id, $this->meta & 0x07, 1],
			];
		}else{
			return [];
		}
	}
}