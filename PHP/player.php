<?php
class Player
{
    private string $name;
    private string $city;

    public function getCity()
    {
        return $this->city? " (".$this->city.")" : "";
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function __construct($name)
    {
        $this->name = $name;
        $this->city = ""; 
    }
}
