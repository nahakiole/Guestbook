<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 11.02.14
 * Time: 18:37
 */

namespace View;

class HTMLView implements Viewable
{
    /**
     * @var HTMLTemplate[]
     */
    private $templates = [];
    /**
     * @var HTMLTemplate
     */
    public $template;
    private $header;

    public function setHeader($header)
    {
        $this->header = $header;
    }

    public function __construct($templateFile)
    {
        $this->template = new HTMLTemplate($templateFile);
    }

    public function addTemplate($name, Viewable $template)
    {
        if (!isset($this->templates[$name])) {
            $this->templates[$name] = $template;
        }
    }

    /**
     * @param $name
     *
     * @return HTMLTemplate
     */
    public function getTemplate($name)
    {
        return $this->templates[$name];
    }

    /**
     * Renders the view.
     */
    public function render()
    {
        $outputFile = $this->template->render();
        if (isset($this->header)) {
            header($this->header);
        }
        foreach ($this->templates as $templateName => $template) {
            $templateFile = $template->render();
            $outputFile = str_replace('{' . $templateName . '}', $templateFile, $outputFile);
        }
        $outputFile = preg_replace('/\{[A-Z_]+\}/', '', $outputFile);
        return $outputFile;
    }

} 