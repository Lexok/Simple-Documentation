<?php

namespace SimpleDocumentation;

class Migration
{
    /**
     *  Hold previous version settings
     */
    public $settings = array();


    /**
     *  Initialise migration
     */
    public function __construct()
    {
        $this->loadSettings();
    }


    /**
     *  Load Old Version settings
     */
    public function loadSettings()
    {

    }
}
