<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 12.02.14
 * Time: 07:08
 */

namespace View;


class HTMLTemplate
{

    public $templateFile;

    /**
     * List with placeholders
     * @var array
     */
    public $variables = [];

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
     * @param $variable array
     */
    public function setVariable($variable)
    {
        $this->variables = array_merge($this->variables, $variable);
    }

    /**
     * Renders the provided template with the defined variables
     * @return string
     */
    public function render()
    {
        $templateFile = file_get_contents($this->templateFile);
        foreach ($this->variables as $placeholder => $value) {
            $templateFile = str_replace('{' . $placeholder . '}', $value, $templateFile);
        }
        return $templateFile;
    }
} 