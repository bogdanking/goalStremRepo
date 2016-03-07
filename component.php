

<?php

//define('_JEXEC', 1) or die;
require 'Requests_library.php';

class Data
{
	public $_photo;
	public $_name;
	public $_year;
	public $_month;
	public $_day;
	public $_alias;
	public $_current_career_clubs;

	public function constructor($photo,$name,$year,$month,$day,$alias,$career)
	{

		$_photo=$photo;
		$_name = $name;
		$_year = $year;
		$_month = $month;
		$_day = $day;
		$_alias = $alias;
		$_current_career_clubs = $career;

	}
}



class Player
{

	public $player;
	public $request;
	public $parser;

	public function constructor()
	{
		$this->request = new getApi();
		$this->player = new Player();
		$this->parser = array();
	}

	public function decodeJSON($jsonString)
	{
		$this->parseData(json_decode($jsonString, true, 2));
	}

	public function start1($token,$playerID)
	{
		$this->getPlayerData($token, $playerID);
	}

	public function start2($token,$playerID)
	{
		$this->getStaticPlayerData($token, $playerID);
	}

	public function start3($token,$playerID)
	{
		$this->getDetailData($token, $playerID);
	}

    private function getPlayerData($token,$playerID)
	{
    $recievedPlayerData = infoPlayer($playerID);
    return $recievedPlayerData;
    } 
	
	private function getStaticPlayerData($token, $playerID) 
	{
    $recievedStaticPlayerData =  playerStat($playerID); 
    return $recievedStaticPlayerData;
    } 
	
	private function getDetailData($token,$playerID)
	{

    $recievedDetailData = detailPlayerStat($playerID);

    return $recievedDetailData;
    } 
    }




	 function parseData($recievedData)
	 {

		 $parser = array();
		 foreach ($recievedData as $date) {

			 $data = new Data($date['_foto_url']['title'], $date['_name']['title'], $date['_year']['home'], $date['_month']['away'], $date['$_day']['away'],$date['_alias']['away'],$date['$_current_career_clubs']['home']);
             $parser[] = $date;
	 
     }


		 echo "<table>";

		 foreach($parser as $date){
			 echo "
<tr>
<th>{$date->_photo}</th><th>{$date->_name}</th><th>:</th><th>{$date->_year}</th><th>{$date->_month}</th>
<th>{$date->_day}</th><th>{$date->_alias}</th><th>:</th><th>{$date->__current_career_clubs}</th>
</tr>

	";
		 }
		 echo
              "</table>";

		 echo

		       "<style>

table{ bgcolor=\"#FFEFD5\" width: 200%;border: 2px; }
th{text-align: center;border=\"1px\";}
td{text-align: center;border=\"1px\";}

                </style>";


$player = new Player();
		 $player->start1(0, 0);
		 $player->start2(0, 0);
		 $player->start3(0, 0);

}
?>

