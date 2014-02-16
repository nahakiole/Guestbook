<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 12.02.14
 * Time: 07:08
 */

namespace View;


class HTMLTemplate implements Viewable
{

    public $templateFile;

    private $preRenderedTemplate;
    private $renderedOutput = '';

    /**
     * List with placeholders
     *
     * @var array
     */
    public $variables = [];
    public $blockVariables = [];

    /**
     * @param Every Template has to be based on a templatefile
     */
    public function __construct($templateFile)
    {
        $this->templateFile = $templateFile;
    }


    /**
     * Adds the provided array to the variables array.
     * The Key defines the placeholder and the value the value of the variable.
     *
     * @param $variable array
     */
    public function setVariable($variable)
    {
        $this->variables = array_merge($this->variables, $variable);
    }

    public function setBlockVariable($variable)
    {
        $this->blockVariables = array_merge($this->blockVariables, $variable);
    }

    /**
     * Renders the provided template with the defined variables
     *
     * @param bool $keepBlockVariables
     *
     * @return string
     */
    public function preRender($keepBlockVariables = false)
    {
        if (!isset($this->preRenderedTemplate)) {
            $this->preRenderedTemplate = $this->renderStaticTemplate();
        }
        $output = $this->preRenderedTemplate;
        foreach ($this->blockVariables as $name => $value) {
            $output = str_replace('{' . $name . '}', $value, $output);
        }
        $this->renderedOutput .= $output;
        if (!$keepBlockVariables) {
            $this->blockVariables = [];
        }
    }

    /**
     * Renders the provided template with the defined variables
     *
     * @return string
     */
    public function render()
    {
        if (empty($this->renderedOutput)) {
            $this->preRender();
        }
        return $this->renderedOutput;
    }

    public function renderStaticTemplate()
    {
        $templateFile = file_get_contents($this->templateFile);
        foreach ($this->variables as $placeholder => $value) {
            $templateFile = str_replace('{' . $placeholder . '}', $value, $templateFile);
        }
        return $templateFile;
    }
} 