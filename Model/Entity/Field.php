<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 25.02.14
 * Time: 10:17
 */

namespace Model\Entity;


use View\Viewable;

class Field
{
    const TYPE_TEXT = 'text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_EMAIL = 'email';
    public $type;
    public $name;
    public $validation;
    public $required;
    public $value;

    /**
     * @param $name
     * @param string $type
     * @param string $validation
     * @param bool $required
     */
    public function __construct($name, $type = self::TYPE_TEXT, $validation = null, $required = true)
    {
        $this->name = $name;
        $this->type = $type;
        $this->validation = $validation;
        $this->required = $required;
    }

    /**
     * @return Boolean
     */
    public function isValid()
    {
        $valid = true;
        if ($this->required){
            $valid = $valid && !empty($this->value);
        }
        if ($this->validation == null){
            return $valid;
        }
        else {
            return $valid && filter_var($this->value, $this->validation);
        }
    }

    /**
     * @param $formGenerator \View\HTMLGenerator
     */
    public function render($formGenerator)
    {
        $options = [
            'valid' => $this->isValid() || !isset($this->value) ? '' : 'has-error'
        ];
        switch ($this->type) {
            case self::TYPE_TEXT:
            case self::TYPE_EMAIL:
                return $formGenerator->getInput($this->name,$this->value,$options);
            case self::TYPE_TEXTAREA:
                return $formGenerator->getTextarea($this->name,$this->value,$options);
            }
    }
} 