<?php

namespace Ejercicios\ejercicio4_2\core;

use Ejercicios\ejercicio4_2\model\vo\UsuarioVo;
use Ejercicios\ejercicio4_2\model\vo\SensorVo;
/**
 * Wrapper del HTTP request.
 */
class Request
{
    public ?UsuarioVo $usuario = null;
    public ?SensorVo $sensor = null;

    /**
     * @return $Uri de la pertición HTTP
     */
    public function uri(): string
    {
        //TODO
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * 
     * @return $Método de la petición HTTP
     */
    public function method(): string
    {
        //TODO
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * 
     * @return $JSON de la petición HTTP formateado como un array asociativo.
     */
    public function body(): array
    {
        //TODO
        return json_decode(file_get_contents('php://input'), true) ?? [];
    }

    /**
     * @param string $headerKey Clave de la cabecera HTTP
     * @return $Valor de la cabecera HTTP o null si no se encuentra.
     */
    public function getHeader(string $headerKey):?string
    {
        //TODO
        return getallheaders()[$headerKey];
    }

    /**
     * Comprueba si los atributos del JSON que va en el cuerpo de la petición cumplen con las reglas indicadas en $rules.
     * El formato de $rules es ['atributo_X' => 'regla1|regla2|...|regla_n', ..., 'atributo_Y' => 'regla1|regla2|...|regla_n']
     * Si algun atributo no cumple con sus reglas de validación (HTTP 400) se responde con un error de validación y se corta la ejecución.
     * @param array $rules
     * @return void
     */
    public function validate(array $rules)
    {
        //TODO
        /*$data = $this->body();
        $errors = [];

        foreach($rules as $field => $rule_string){
            $rulesArray = explode('|', $rule_string);
            foreach($rulesArray as $rule) {
                //Required
                if ($rule === 'required' && !isset($data[$field])) {
                    $errors[$field][] = "Campo obligatorio";
                    continue;
                }

                //Es entero
                if ($rule === 'int' && isset($data[$field]) && !is_int($data[$field])) {
                    $errors[$field][] = "El campo debe ser un entero";
                    continue;
                }

                //Es string
                if ($rule === 'string' && isset($data[$field]) && !is_string($data[$field])) {
                    $errors[$field][] = "El campo debe ser un string";
                    continue;
                }

                //Es numero
                if ($rule === 'numeric' && isset($data[$field]) && !is_numeric($data[$field])) {
                    $errors[$field][] = "El campo debe ser un número";
                    continue;
                }

                //Mayor que tamaño maximo
                if (str_starts_with($rule, 'max')) {
                    $max = (int) explode(':', $rule[1]);
                    $dataLength = is_string($data[$field]) ? strlen($data[$field]) : $data[$field];
                    if (isset($data[$field]) && $dataLength > $max) {
                        $errors[$field][] = "El campo es mayor que el tamaño máximo permitido";
                        continue;
                    }
                }

                //Menor que tamaño minimo
                if (str_starts_with($rule, 'min')) {
                    $min = (int) explode(':', $rule[1]);
                    $dataLength = is_string($data[$field]) ? strlen($data[$field]) : $data[$field];
                    if (isset($data[$field]) && $dataLength < $min) {
                        $errors[$field][] = "El campo es menor que el tamaño mínimo permitido";
                        continue;
                    }
                }
            }
        }

        if(!empty($errors)){
            Response::json(['message' => 'Datos inválidos', 'errors' => $errors], 400);
            exit;
        }
            */
    }


}