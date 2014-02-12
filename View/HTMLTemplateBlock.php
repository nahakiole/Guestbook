<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 12.02.14
 * Time: 12:48
 */

namespace View;


class HTMLTemplateBlock extends HTMLTemplate
{
    private $preRenderedTemplate;
    private $renderedOutput = '';

    public $blockVariables = [];

    public function setBlockVariable($name, $value)
    {
        $this->blockVariables[$name] = $value;
    }

    public function nextBlock()
    {
        $this->blockVariables = [];
    }

    /**
     * Renders the provided template with the defined variables
     * @return string
     */
    public function preRender()
    {
        if (!isset($this->preRenderedTemplate)) {
            $this->preRenderedTemplate = parent::render();
        }
        $output = $this->preRenderedTemplate;
        foreach ($this->blockVariables as $name => $value) {
            $output = str_replace('{' . $name . '}', $value, $output);
        }
        $this->renderedOutput .= $output;
    }

    public function render(){
        return $this->renderedOutput;
    }
} 