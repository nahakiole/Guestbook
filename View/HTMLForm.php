<?php


namespace View;


class HTMLForm implements Viewable
{
    private $name;

    /**
     * @var \Model\Entity\Entity
     */
    private $entity;

    /**
     * @var HTMLGenerator
     */
    private $formGenerator;

    /**
     * @param $name
     * @param $formGenerator HTMLGenerator
     * @param $entity \Model\Entity\Entity
     */
    public function __construct($name, $formGenerator, $entity)
    {
        $this->name = $name;
        $this->formGenerator = $formGenerator;
        $this->formGenerator->name = $name;
        $this->entity = $entity;
        foreach ($this->entity->fields as $field) {
            if (isset($_POST[$this->name][$field->name])) {
                $field->value = $_POST[$this->name][$field->name];

            }
        }
    }

    /**
     * Returns if form is Valid.
     * @return bool
     */
    public function isValid()
    {
        $isValid = true;
        foreach ($this->entity->fields as $field) {
            $isValid = $isValid && $field->isValid();
        }
        return $isValid;
    }

    /**
     * @param $name
     * @return \Model\Entity\Field|null
     */
    public function getField($name){
        foreach ($this->entity->fields as $field) {

            if ($field->name == $name) {
                return $field;
            }
        }
        return null;
    }

    /**
     * @return \Model\Entity\Entity
     */
    public function getEntity(){
        return $this->entity;
    }

    /**
     * @return String
     */
    public function getJavascript()
    {
        $javascript = "jQuery('#$this->name .control-group').removeClass('has-error');\n";
        if (!$this->isValid()) {
            foreach ($this->entity->fields as $field) {
                if (!$field->isValid()) {
                    $javascript .= "jQuery('#$field->name').parent().addClass('has-error');\n";
                }
            }
        }
        else {

        }
        return $javascript;
    }

    public function render()
    {
        $output = "<form action=\"/\" method=\"post\" id=\"$this->name\">";
        foreach ($this->entity->fields as $field) {
            $output .= $field->render($this->formGenerator);
        }
        $output .= $this->formGenerator->getSubmit('Absenden', 'Absenden');
        $output .= "</form>";
        return $output;
    }

    public function clearValues()
    {
        foreach ($this->entity->fields as $field) {
            $field->value = null;
        }
    }
} 