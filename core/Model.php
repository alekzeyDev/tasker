<?php

use Respect\Validation\Validator;

class Model extends Core
{
    public $fields = [];
    public $values = [];
    public $errors = [];

    /**
     * @return array
     */
    public function getValues($name = NULL)
    {
        if (!empty($name) && !empty($this->values[$name])) {

            return $this->values[$name];
        }

        return $this->values;
    }

    /**
     * @param array $values
     */
    public function setValues($values)
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function load($params = [])
    {
        if (empty($params) && empty($_POST)) {

            return FALSE;
        }

        $params = !empty($params) ? $params : $_POST;

        $this->values = [];
        $this->errors = [];
        foreach ($params as $k => $param) {

            if (array_key_exists($k, $this->fields)) {

                $param = $this->filter($k, $param);
                $valid = $this->validate($k, $param);
                if(!$valid) {

                    $this->errors[$k] = TRUE;
                }

                $this->values[$k] = $param;
            }
        }

        if(!empty($this->errors)) {

            return FALSE;
        }

        return TRUE;
    }

    public function validate($field, $val) {

        if(empty($this->fields[$field]['validators'])) {

            return TRUE;
        }

        $validator = new Validator();

        return $validator->addRules($this->fields[$field]['validators'])
            ->validate($val);
    }

    public function filter($field, $val) {

        if(empty($this->fields[$field]['filters'])) {

            return $val;
        }

        foreach ($this->fields[$field]['filters'] as $filter) {

            $val = call_user_func($filter, $val);
        }

        return $val;
    }

    public function trigger($field, $val) {

        if(empty($this->fields[$field]['triggers'])) {

            return $val;
        }

        foreach ($this->fields[$field]['triggers'] as $trigger) {

            $val = call_user_func($trigger, $val);
        }

        return $val;
    }

    public function triggers() {

        foreach ($this->fields as $k => $field) {

            if(empty($field['triggers'])) {

                continue;
            }

            $this->values[$k] = $this->trigger($k, $this->values[$k]);
        }

        return TRUE;
    }

    public function find($params = NULL)
    {
        if (empty($params)) {

            $params = $this->getValues();
        }

        if (empty($params)) {

            return FALSE;
        }

        if (intval($params) == $params) {

            $where = $this->db->placehold("WHERE {$this->primary}=?", intval($params));

        } elseif (is_array($params)) {

            $where = [];
            foreach ($params as $k => $v) {

                $where[] = $this->db->placehold("{$k}=?", $v);
            }

            $where = "WHERE " . implode(" AND ", $where);
        }

        $query = $this->db->placehold("SELECT * FROM {$this->table} {$where}");

        if ($this->db->query($query)) {

            return $this->db->result();
        }

        return FALSE;
    }

    public function insert($data = NULL)
    {
        if (empty($data)) {

            $data = $this->getValues();
        }

        $query = $this->db->placehold("INSERT INTO {$this->table} SET ?%", $data);
        $this->db->query($query);

        return TRUE;
    }

    public function delete($id)
    {
        if (!empty($id)) {
            $query = $this->db->placehold("DELETE FROM {$this->table} WHERE id=?", intval($id));
            $this->db->query($query);
        }
    }

    public function update($id, $data)
    {
        $query = $this->db->placehold("UPDATE {$this->table} SET ?% WHERE id=?", $data, $id);
        $this->db->query($query);

        return TRUE;
    }
}
