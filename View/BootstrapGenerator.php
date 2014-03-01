<?php


namespace View;


class BootstrapGenerator extends HTMLGenerator
{

    function getInput($name, $value, $options = [])
    {
        return "<div class=\"control-group " . $options['valid']
        . "\"><label class=\"control-label\" for=\"$name\">$name<br/></label><input class=\"form-control\" value=\"$value\" type=\"text\" id=\"$name\"  name=\"$this->name[$name]\"/></div><br/>";
    }

    function getTextarea($name, $value, $options = [])
    {
        return "<div class=\"control-group " . $options['valid']
        . "\"><label class=\"control-label\"  for=\"$name\">$name<br/></label><textarea class=\"form-control\"  id=\"$name\"  name=\"$this->name[$name]\">$value</textarea></div><br/>";

    }

    function getSubmit($name, $value, $options = [])
    {
        return "<button class=\"btn btn-primary send-comment\" type=\"submit\" id=\"$name\" name=\"$this->name[$name]\">$value</button><br/>";

    }
}