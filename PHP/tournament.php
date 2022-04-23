<?php
require_once "player.php";

class Tournament {
    private string $name;
    private string $tournamentDate;
    private array $players;

    public function getTournamentDate() {
        return $this->tournamentDate;
    }
    
    public function setTournamentDate($tournamentDate) {
        $this->tournamentDate = $tournamentDate;
        return $this;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getPlayers() {
        return $this->players;
    }
    
    public function setPlayers($players) {
        $this->players = $players;
        return $this;
    }

    public function __construct($name, $date = null) {

        if($name != null && $date == null)
        {
            $this->name = $name;
            $this->tournamentDate = date("Y-m-d", strtotime("+1 day"));
            $this->players = [];
        }

        if($name != null && $date != null)
        {
            $this->name = $name;
            $strToDate = str_replace(".","-",$date);
            $this->tournamentDate = date('Y-m-d', strtotime($strToDate));
            $this->players = [];
        }
    }

    public function addPlayer($player) {
        array_push($this->players,$player);
        return $this;
    }

    public function createPairs() {
        error_reporting(0);
        $pairs = [];

        $tmp = 0;

        for($ik = 0; $ik < count($this->players); $ik++)
        {
            for($jk = $tmp; $jk < count($this->players); $jk++)
            {
                if ($this->players[$ik]->getName() != $this->players[$jk]->getName())
                {
                    array_push($pairs, array($this->players[$ik],$this->players[$jk]));
                }
            }
            $tmp++;
        }

        $usedNodes = [];

      $pairsCount = count($pairs);
      $addedDays = 0;
      for ($i = 0; $i < $pairsCount; $i++)
      {      
        $usedNodes = [];
        if ($pairs[$i] != null)
        {
            print date('d.m.Y', strtotime("+".$addedDays." day", strtotime($this->tournamentDate)));
            $addedDays++;
            print "\n";
          print $pairs[$i][0]->getName() . $pairs[$i][0]->getCity()  . ' => ' . $pairs[$i][1]->getName() . $pairs[$i][1]->getCity();
          print "\n";
          array_push($usedNodes, $pairs[$i][0]);
          array_push($usedNodes, $pairs[$i][1]);
          
          unset($pairs[$i]);
          $pairsCount++;

          for ($j = 0; $j < $pairsCount; $j++)
          {
            if (!is_null($pairs[$j]))
            {
              if (!in_array($pairs[$j][0], $usedNodes) && !in_array($pairs[$j][1], $usedNodes))
              {
                print $pairs[$j][0]->getName() . $pairs[$j][0]->getCity()  . ' => ' . $pairs[$j][1]->getName() . $pairs[$j][1]->getCity();
                print "\n";
                array_push($usedNodes, $pairs[$j][0]);
                array_push($usedNodes, $pairs[$j][1]);
                unset($pairs[$j]);
                $pairsCount++;
                $j = -1;
              }
            }           
          }
          $j = 0;
        }
      }
      print "\n\n";
    }
}
