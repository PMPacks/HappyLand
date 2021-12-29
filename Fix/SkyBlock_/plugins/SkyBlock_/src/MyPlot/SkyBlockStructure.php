<?php

namespace MyPlot;

use pocketmine\math\Vector3;
use pocketmine\level\ChunkManager;
use pocketmine\block\Block;
use pocketmine\level\generator\populator\Populator;
use pocketmine\utils\Random;
use pocketmine\level\generator\Generator;
use pocketmine\level\format\Chunk;

class SkyBlockStructure extends Populator{
	public $generator = null;

	public function __construct(Generator $gen){
		$this->generator = $gen;
	}

	/**
	 *
	 * @param ChunkManager $level 
	 * @param Chunk $chunk 
	 * @param int $Xofchunk 
	 * @param int $Zofchunk 
	 */
	public static function placeObject(ChunkManager $level, $chunk, $Xofchunk, $Zofchunk){
		$vec = new Vector3($chunk->getX() * 16 + $Xofchunk, 0, $chunk->getZ() * 16 + $Zofchunk);
		$vec = $vec->subtract(7, 0, 7); // fix offset
		for($x = 4; $x < 12; $x++){
			for($z = 4; $z < 12; $z++){
				$level->setBlockIdAt($vec->x + $x, 68, $vec->z + $z, Block::GRASS);
			}
		}
		for($x = 5; $x < 10; $x++){
			for($z = 5; $z < 10; $z++){
				$level->setBlockIdAt($vec->x + $x, 67, $vec->z + $z, Block::DIRT);
				//$level->setBlockIdAt($vec->x + $x, 72, $vec->z + $z, Block::LEAVES); // 72
			}
		}
		for($x = 6; $x < 9; $x++){
			for($z = 6; $z < 9; $z++){
				//$level->setBlockIdAt($vec->x + $x, 73, $vec->z + $z, Block::LEAVES); // 73
				$level->setBlockIdAt($vec->x + $x, 66, $vec->z + $z, Block::DIRT); // 66
			}
		}
		//
		#Custom By Phuongaz
			$level->setBlockIdAt($vec->x + 7, 64, $vec->z + 7, Block::IRON_BLOCK); // 0
			$level->setBlockIdAt($vec->x + 7, 63, $vec->z + 7, Block::IRON_BLOCK); 
			$level->setBlockIdAt($vec->x + 7, 62, $vec->z + 7, Block::DIAMOND_BLOCK); 
			$level->setBlockIdAt($vec->x + 8, 64, $vec->z + 7, Block::IRON_ORE); 
			$level->setBlockIdAt($vec->x + 7, 64, $vec->z + 8, Block::IRON_ORE);
            $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 6, Block::IRON_ORE);
            $level->setBlockIdAt($vec->x + 6, 64, $vec->z + 7, Block::IRON_BLOCK);  			
	   //Tree
	   $level->setBlockIdAt($vec->x + 8, 69, $vec->z + 8, Block::LOG); 
	   $level->setBlockIdAt($vec->x + 9, 69, $vec->z + 8, Block::LOG); 
	   $level->setBlockIdAt($vec->x + 8, 69, $vec->z + 9, Block::LOG);
	   
	   $level->setBlockIdAt($vec->x + 9, 70, $vec->z + 9, Block::LOG); 
	   $level->setBlockIdAt($vec->x + 9, 71, $vec->z + 10, Block::LOG); 
	   $level->setBlockIdAt($vec->x + 9, 72, $vec->z + 11, Block::LOG); 
	   
	   $level->setBlockIdAt($vec->x + 9, 73, $vec->z + 10, Block::LEAVES); 
	   $level->setBlockIdAt($vec->x + 9, 74, $vec->z + 9, Block::LEAVES); 
	   $level->setBlockIdAt($vec->x + 9, 73, $vec->z + 8, Block::LEAVES); 
	   $level->setBlockIdAt($vec->x + 9, 72, $vec->z + 7, Block::LEAVES); 
	   
	   $level->setBlockIdAt($vec->x + 10, 73, $vec->z + 11, Block::LEAVES); 
	   $level->setBlockIdAt($vec->x + 11, 74, $vec->z + 11, Block::LEAVES);
       $level->setBlockIdAt($vec->x + 12, 73, $vec->z + 11, Block::LEAVES); 
       $level->setBlockIdAt($vec->x + 13, 72, $vec->z + 11, Block::LEAVES); 	 

       $level->setBlockIdAt($vec->x + 8, 73, $vec->z + 11, Block::LEAVES);
       $level->setBlockIdAt($vec->x + 7, 74, $vec->z + 11, Block::LEAVES);
       $level->setBlockIdAt($vec->x + 6, 73, $vec->z + 11, Block::LEAVES);    
	   $level->setBlockIdAt($vec->x + 5, 72, $vec->z + 11, Block::LEAVES); 
	   
	   $level->setBlockIdAt($vec->x + 9, 73, $vec->z + 12, Block::LEAVES); 
	   $level->setBlockIdAt($vec->x + 9, 74, $vec->z + 13, Block::LEAVES); 
	   $level->setBlockIdAt($vec->x + 9, 73, $vec->z + 14, Block::LEAVES);
       $level->setBlockIdAt($vec->x + 9, 72, $vec->z + 15, Block::LEAVES);
	   
   	  $level->setBlockIdAt($vec->x + 9, 73, $vec->z + 11, Block::LEAVES); 	   
	  
	   //Custom
	     $level->setBlockIdAt($vec->x + 9, 68, $vec->z + 5, Block::GLOWSTONE); 
		  $level->setBlockIdAt($vec->x + 6, 68, $vec->z + 7, Block::GLOWSTONE); 
		  
		  $level->setBlockIdAt($vec->x + 6, 69, $vec->z + 10, Block::HAY_BLOCK); 
		   $level->setBlockIdAt($vec->x + 7, 69, $vec->z + 11, Block::HAY_BLOCK); 
		    $level->setBlockIdAt($vec->x + 5, 69, $vec->z + 11, Block::HAY_BLOCK);
			 $level->setBlockIdAt($vec->x + 4, 69, $vec->z + 10, Block::HAY_BLOCK); 
		   $level->setBlockIdAt($vec->x + 7, 70, $vec->z + 11, Block::HAY_BLOCK); 
		    $level->setBlockIdAt($vec->x + 5, 70, $vec->z + 11, Block::HAY_BLOCK);
			 $level->setBlockIdAt($vec->x + 4, 70, $vec->z + 10, Block::HAY_BLOCK); 
		  
		  	       $level->setBlockIdAt($vec->x + 9, 69, $vec->z + 6, Block::TALL_GRASS); 
		            $level->setBlockIdAt($vec->x + 6, 69, $vec->z + 8, Block::TALL_GRASS); 
					 $level->setBlockIdAt($vec->x + 7, 69, $vec->z + 5, Block::TALL_GRASS);
                       $level->setBlockIdAt($vec->x + 9, 69, $vec->z + 6, Block::TALL_GRASS); 					 
					      $level->setBlockIdAt($vec->x + 10, 69, $vec->z + 9, Block::TALL_GRASS); 
						   $level->setBlockIdAt($vec->x + 4, 69, $vec->z + 5, Block::RED_FLOWER);
						    $level->setBlockIdAt($vec->x + 5, 69, $vec->z + 9, Block::RED_FLOWER); 
							 $level->setBlockIdAt($vec->x + 8, 69, $vec->z + 4, Block::RED_FLOWER); 
						  
		   $level->setBlockIdAt($vec->x + 9, 68, $vec->z + 5, Block::GRAVEL); 
		   $level->setBlockIdAt($vec->x + 8, 68, $vec->z + 6, Block::GRAVEL); 
		   $level->setBlockIdAt($vec->x + 5, 68, $vec->z + 5, Block::GRAVEL); 
		   $level->setBlockIdAt($vec->x + 6, 68, $vec->z + 6, Block::GRAVEL); 
	   //test
	     $level->setBlockIdAt($vec->x + 5, 69, $vec->z + 6, Block::FENCE); 
	       $level->setBlockIdAt($vec->x + 5, 70, $vec->z + 6, Block::FENCE); 
		   	       $level->setBlockIdAt($vec->x + 5, 71, $vec->z + 6, Block::PUMPKIN); 
		     $level->setBlockIdAt($vec->x + 5, 70, $vec->z + 7, Block::HAY_BLOCK);
			   $level->setBlockIdAt($vec->x + 5, 70, $vec->z + 5, Block::HAY_BLOCK);
	   //
	   
		
		$level->setBlockIdAt($vec->x + 7, 65, $vec->z + 7, Block::DIRT); // 1
		$level->setBlockIdAt($vec->x + 7, 66, $vec->z + 7, Block::DIRT); // 2
		$level->setBlockIdAt($vec->x + 7, 67, $vec->z + 7, Block::DIRT); // 3
	/*	$level->setBlockIdAt($vec->x + 7, 69, $vec->z + 7, Block::LOG); // 5
		$level->setBlockIdAt($vec->x + 7, 70, $vec->z + 7, Block::LOG); // 6
		$level->setBlockIdAt($vec->x + 7, 71, $vec->z + 7, Block::LOG); // 7
		$level->setBlockIdAt($vec->x + 7, 72, $vec->z + 7, Block::LOG); // 8
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 7, Block::LOG); // 9*/
		$level->setBlockIdAt($vec->x + 4, 68, $vec->z + 11, Block::AIR); // 68
		$level->setBlockIdAt($vec->x + 4, 68, $vec->z + 4, Block::AIR);
		$level->setBlockIdAt($vec->x + 11, 68, $vec->z + 4, Block::AIR);
		$level->setBlockIdAt($vec->x + 11, 68, $vec->z + 11, Block::AIR);
/*		$level->setBlockIdAt($vec->x + 5, 72, $vec->z + 5, Block::AIR); // 72
		$level->setBlockIdAt($vec->x + 5, 72, $vec->z + 9, Block::AIR);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 5, Block::AIR);
		$level->setBlockIdAt($vec->x + 9, 72, $vec->z + 9, Block::AIR);*/
		/*$level->setBlockIdAt($vec->x + 5, 73, $vec->z + 7, Block::LEAVES); // 73
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 5, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 9, 73, $vec->z + 7, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 7, 73, $vec->z + 9, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 6, Block::LEAVES); // 74
		$level->setBlockIdAt($vec->x + 6, 74, $vec->z + 7, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 8, 74, $vec->z + 7, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 7, 74, $vec->z + 8, Block::LEAVES);
		$level->setBlockIdAt($vec->x + 7, 75, $vec->z + 7, Block::LEAVES);*/ // 75
		$level->setBlockIdAt($vec->x + 7, 65, $vec->z + 8, Block::DIRT); // 65
		$level->setBlockIdAt($vec->x + 8, 65, $vec->z + 7, Block::DIRT);
		$level->setBlockIdAt($vec->x + 7, 65, $vec->z + 6, Block::DIRT);
		$level->setBlockIdAt($vec->x + 6, 65, $vec->z + 7, Block::DIRT);
		$level->setBlockIdAt($vec->x + 5, 66, $vec->z + 7, Block::DIRT); // 66
		$level->setBlockIdAt($vec->x + 7, 66, $vec->z + 5, Block::DIRT);
		$level->setBlockIdAt($vec->x + 9, 66, $vec->z + 7, Block::DIRT);
		$level->setBlockIdAt($vec->x + 7, 66, $vec->z + 9, Block::DIRT);
		$level->setBlockIdAt($vec->x + 4, 67, $vec->z + 7, Block::DIRT); // 67
		$level->setBlockIdAt($vec->x + 7, 67, $vec->z + 4, Block::DIRT);
		$level->setBlockIdAt($vec->x + 7, 67, $vec->z + 10, Block::DIRT);
		$level->setBlockIdAt($vec->x + 10, 67, $vec->z + 7, Block::DIRT);
	}

	public function populate(ChunkManager $level, $chunkX, $chunkZ, Random $random){
		$chunk = $level->getChunk($chunkX, $chunkZ);
		$shape = $this->generator->getShape($chunkX << 4, $chunkZ << 4);
		for($Z = 0; $Z < 16; ++$Z){
			for($X = 0; $X < 16; ++$X){
				$type = $shape[($Z << 4) | $X];
				if($type === MyPlotGenerator::ISLAND){
					self::placeObject($level, $chunk, $X, $Z);
				}
			}
		}
	}
}