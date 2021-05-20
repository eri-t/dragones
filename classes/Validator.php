<?php
class Validator
{
    /** @var array Los campos a validar. */
    protected $data;

    /** @var array Las reglas a aplicar. */
    protected $rules;

    /** @var array Los errores que ocurrieron. */
    protected $errors = [];

    /**
     * Validator constructor.
     * @param array $data
     * @param array $rules
     */
    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;

        // Realizamos la validación.
        $this->validate();
    }

    /**
     * Realiza la validación.
     */
    protected function validate()
    {
        foreach ($this->rules as $name => $rulelist) {
            $this->applyRules($name, $rulelist);
        }
    }

    /**
     * @param string $name
     * @param array $ruleList
     * @throws Exception
     */
    protected function applyRules(string $name, array $ruleList)
    {
        // $ruleList = ['required', 'min:3']
        foreach ($ruleList as $ruleName) {
            $this->applyRule($ruleName, $name);
        }
    }

    /**
     * @param string $ruleName
     * @param string $name
     * @throws Exception
     */
    protected function applyRule(string $ruleName, string $name): void
    {
        if (strpos($ruleName, ':') === false) {
            $method = "_" . $ruleName;
            if (!method_exists($this, $method)) {
                throw new Exception('No existe una regla de validación llamada "' . $ruleName . '"');
            }
            $this->{$method}($name);
        } else {
            $ruleData = explode(':', $ruleName);

            $method = "_" . $ruleData[0];
            if (!method_exists($this, $method)) {
                throw new Exception('No existe una regla de validación llamada "' . $ruleName . '"');
            }

            $this->{$method}($name, $ruleData[1]);
        }
    }


    /**
     * Retorna true si no hubo errores de validación.
     * false de lo contrario.
     *
     * @return bool
     */
    public function passes(): bool
    {
        return count($this->errors) === 0;
    }

    /**
     * Retorna el array de errores.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param string $name
     * @param string $message
     */
    protected function setErrors(string $name, string $message)
    {
        if (!isset($this->errors["name"])) {
            $this->errors[$name] = [];
        }
        $this->errors[$name][] = $message;
    }
    /**
     * Valida que el valor del campo no sea vacío.
     *
     * @param string $name
     * @return bool
     */
    protected function _required(string $name)
    {
        $value = $this->data[$name];
        if (empty($value)) {

            $this->setErrors($name, "El campo " . $name . " no puede quedar vacío.");
             return false;
        }
         return true;
    }

    /**
     * Valida que el valor del campo sea un número.
     *
     * @param string $name
     * @return bool
     */
    protected function _numeric(string $name)
    {
        $value = $this->data[$name];
        if (!is_numeric($value)) {
            $this->setErrors($name, "El campo " . $name . " debe ser un valor numérico.");
            return false;
        }
        return true;
    }

    /**
     * Valida que el campo tenga al menos $cantidad caracteres.
     *
     * @param string $name
     * @param int $long
     * @return bool
     */
    protected function _min($name, $long)
    {
        $value = $this->data[$name];
        if (strlen($value) < $long) {
            $this->setErrors($name, "El campo " . $name . " debe tener al menos " . $long . " caracteres.");

            return false;
        }
        return true;
    }
}
