<?php

    namespace AnotherColor;

    class Color{
        private $text = "";
        private $color = "white";
        private $background_color = "white";
        private $modifiers = array();
        // reset
        private $escape = '[0m';      // text reset;
        private $colors = array(
            // regular colors
            "black"=>'[0;30m',        // black
            "red"=>'[0;31m',          // red
            "green"=>'[0;32m',        // green
            "yellow"=>'[0;33m',       // yellow
            "blue"=>'[0;34m',         // blue
            "purple"=>'[0;35m',       // purple
            "cyan"=>'[0;36m',         // cyan
            "white"=>'[0;37m',        // white
        );
        private $modifier_types = array(
            // bold
            "bblack"=>'[1;30m',       // black
            "bred"=>'[1;31m',         // red
            "bgreen"=>'[1;32m',       // green
            "byellow"=>'[1;33m',      // yellow
            "bblue"=>'[1;34m',        // blue
            "bpurple"=>'[1;35m',      // purple
            "bcyan"=>'[1;36m',        // cyan
            "bwhite"=>'[1;37m',       // white

            // underline
            "ublack"=>'[4;30m',       // black
            "ured"=>'[4;31m',         // red
            "ugreen"=>'[4;32m',       // green
            "uyellow"=>'[4;33m',      // yellow
            "ublue"=>'[4;34m',        // blue
            "upurple"=>'[4;35m',      // purple
            "ucyan"=>'[4;36m',        // cyan
            "uwhite"=>'[4;37m',       // white

            // background
            "on_black"=>'[40m',       // black
            "on_red"=>'[41m',         // red
            "on_green"=>'[42m',       // green
            "on_yellow"=>'[43m',      // yellow
            "on_blue"=>'[44m',        // blue
            "on_purple"=>'[45m',      // purple
            "on_cyan"=>'[46m',        // cyan
            "on_white"=>'[47m',       // white

            // high intensity
            "iblack"=>'[0;90m',       // black
            "ired"=>'[0;91m',         // red
            "igreen"=>'[0;92m',       // green
            "iyellow"=>'[0;93m',      // yellow
            "iblue"=>'[0;94m',        // blue
            "ipurple"=>'[0;95m',      // purple
            "icyan"=>'[0;96m',        // cyan
            "iwhite"=>'[0;97m',       // white

            // bold high intensity
            "biblack"=>'[1;90m',      // black
            "bired"=>'[1;91m',        // red
            "bigreen"=>'[1;92m',      // green
            "biyellow"=>'[1;93m',     // yellow
            "biblue"=>'[1;94m',       // blue
            "bipurple"=>'[1;95m',     // purple
            "bicyan"=>'[1;96m',       // cyan
            "biwhite"=>'[1;97m',      // white

            // high intensity backgrounds
            "on_iblack"=>'[0;100m',   // black
            "on_ired"=>'[0;101m',     // red
            "on_igreen"=>'[0;102m',   // green
            "on_iyellow"=>'[0;103m',  // yellow
            "on_iblue"=>'[0;104m',    // blue
            "on_ipurple"=>'[0;105m',  // purple
            "on_icyan"=>'[0;106m',    // cyan
            "on_iwhite"=>'[0;107m',   // white

        );
    
        function __construct(){

        }
        function buildString(){
            $text = $this->text;
           // echo "text1: $text\n";
            if(sizeof($this->modifiers)){
                foreach($this->modifiers as $modifier){
                    //echo "modifier: " . $modifier.$this->color . " type : " . urlencode($this->modifier_types[$modifier.$this->color]). "\n";
                    if($modifier != "on_"){
                        $text = $this->modifier_types[$modifier.$this->color].$text;
                    }else{
                        $text = $this->modifier_types[$modifier.$this->background_color].$text;
                    }
                }
            }
            $text = $this->colors[$this->color].$text.$this->escape;

            return $text;
        }
        function revert(){
            $this->text = "";
            $this->color = "white";
            $this->background_color = "white";
            $this->modifiers = array();

        }
        function __invoke($text){
        // echo "invoke!\n";
            $this->text = $text;
            return $this;
        }

        function __toString(){
           // echo "to string!\n";
            $text = $this->buildString();
            $this->revert();
            return $text;
        }
        function __call($value, $args){
            if(sizeof($args) == 0){
                $args = array(true);
            }
            if($value=="color"){
                if(array_key_exists($args[0], $this->colors)) $this->color = $args[0]; 
            }else if($value == "bold"){
                $this->addRemoveModifier("b", $args[0]);
            }else if($value == "underline"){
                $this->addRemoveModifier("u", $args[0]);
            }else if($value == "background"){
                $this->modifiers[] = "on_";
                if(array_key_exists($args[0], $this->colors)) $this->background_color = $args[0]; 
            }
            

            return $this;
        }

        function addRemoveModifier($mod, $set){
            if($set == true) $this->modifiers[] = $mod;
            else if($index = array_search($mod, $this->modifiers)) unset($this->modifiers[$index]);
        }
    }