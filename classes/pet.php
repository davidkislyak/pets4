<?php

/**
 * Pet class, provides a way to represent a pet object with a name and color.
 *
 * @author David Kislyak
 * @copyright 2020
 */
class pet
{
    private $_name;
    private $_color;

    /**
     * Pet class constructor.
     *
     * @param string $name the name of the pet
     * @param string $color the color of the pet
     */
    function __construct($name = "unknown", $color = "unknown")
    {
        $this->_name = $name;
        $this->_color = $color;
    }

    //Setters
    function setName($name)
    {
        $this->_name = $name;
    }

    function setColor($color)
    {
        $this->_color = $color;
    }

    //Getters
    function getName()
    {
        return $this->_name;
    }

    function getColor()
    {
        return $this->_color;
    }

    //Methods
    function eat()
    {
        echo $this->_name . " is eating.<br>";
    }

    function talk()
    {
        echo $this->_name . " is making a sound<br>";
    }
}