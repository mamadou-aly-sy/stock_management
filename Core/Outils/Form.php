<?php

namespace Core\Outils;

class Form
{
    /**
     * @var mixed
     */
    protected $data;
    /**
     * @var mixed
     */
    public $formCode;

    /**
     * @param array $data
     * @param string $action
     * @param string $method
     */
    public function __construct(array $data = [], string $action = '', string $method = 'post')
    {
        $this->data     = $data;
        $this->formCode = '<form action="' . $action . '" method="' . $method . '">';
    }

    /**
     * @param array $properties
     * @return mixed
     */
    public function setProperties(array $properties = [])
    {
        $code = '';
        foreach ($properties as $key => $value) {
            $code .= $key . '="' . $value . '" ';
        }

        return $code;
    }

    /**
     * @param string $content
     * @param array $properties
     * @param string $for
     */
    public function label(string $content, array $properties = [], string $for = '')
    {
        $this->formCode .= "<label for='{$for}' " . $this->setProperties($properties) . ">$content</label>";
        return $this;
    }

    /**
     * @param string $name
     * @param string $type
     * @return mixed
     */
    public function input(string $labelName, string $name = '', string $type = 'text', array $properties = [])
    {
        $value          = isset($this->data[$name]) ? $this->data[$name] : '';
        $propertiesCode = $this->setProperties($properties);
        $this->formCode .= <<< EOT
        <div class="form-group">
            <label for="$name">$labelName</label>
            <input type="$type" id="$name" name="$name" value="$value" $propertiesCode >
        </div>
EOT;

        return $this;
    }

    /**
     * @param string $buttonText
     * @param string $type
     * @param string $name
     * @return mixed
     */
    public function submit(string $buttonText = 'submit', string $type = 'primary', string $name = '')
    {
        $this->formCode .= <<< EOT
        <button type="submit" class="btn btn-$type" name="$name">$buttonText</button>
EOT;

        return $this;
    }

    /**
     * @param string $labelName
     * @param string $name
     * @return mixed
     */
    public function password(string $labelName = 'Password', string $name = '')
    {
        $value = isset($this->data[$name]) ? $this->data[$name] : '';
        $this->formCode .= <<< EOT
        <div class="form-group">
            <label for="Password1">$labelName</label>
            <input type="password" class="form-control" id="Password1" name="$name" value="$value">
        </div>
EOT;

        return $this;
    }

    /**
     * @param string $labelName
     * @param string $name
     * @return mixed
     */
    public function checkbox(string $labelName = 'Check me out', string $name = '')
    {
        $this->formCode .= <<< EOT
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="Check1">
            <label class="form-check-label" for="Check1">Check me out</label>
        </div>
EOT;

        return $this;
    }

    /**
     * @param string $la
     */
    public function select(string $labelName = 'select', string $name = '', array $options = [])
    {
        $optionsCode = '';
        foreach ($options as $value => $option) {
            $optionsCode .= '<option value="' . $value . '">' . $option . '</option>';
        }
        $this->formCode .= <<< EOT
        <div class="form-group">
            <label for="Select1">$labelName</label>
            <select class="form-control" id="Select1">
                $optionsCode
            </select>
        </div>
EOT;
        return $this;
    }

    /**
     * @return mixed
     */
    public function show()
    {
        $this->formCode .= '</form>';
        echo $this->formCode;
    }
}
