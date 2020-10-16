<?php

namespace Core;

abstract class Model
{
    /**
     * Table name inside the database
     *
     * @var string
     */
    protected $tableName;

    /**
     * Ignored properties
     */
    const IGNORED_FIELD = ['tableName', 'id', 'created_at'];

    /**
     * Abstract Model Constructor
     *
     * @param integer|null $id
     */
    public function __construct(?int $id = null)
    {
        if (!is_null($id) && is_int($id)) {
            $user        = self::find($id);
            $attributtes = get_object_vars($user);
            foreach ($attributtes as $key => $value) {
                $this->$key = $value;
            }
            $this->id = $id;
        }
        $this->tableName = self::generateTableName();
    }

    /**
     * Save the Object in the database
     *
     * @return void
     */
    public function save()
    {
        $params        = get_object_vars($this);
        $fields        = [];
        $values        = [];
        $questionMarks = [];
        foreach ($params as $key => $value) {
            if (in_array($key, self::IGNORED_FIELD)) {
                continue;
            }

            $fields[]        = $key;
            $values[]        = $value;
            $questionMarks[] = '?';
        }
        $fields        = implode(', ', $fields);
        $questionMarks = implode(', ', $questionMarks);
        $sqlRequest    = "INSERT INTO " . static::generateTableName() . "($fields) VALUES($questionMarks);";
        return Database::execute($sqlRequest, $values);
    }

    /**
     * Update the current Object by his id
     *
     * @return void
     */
    public function update()
    {
        if (is_null($this->id)) {
            throw new \Exception("Soory you can update a user without an id please set the id first", 1);
            die;
        }
        $params        = get_object_vars($this);
        $fields        = [];
        $values        = [];
        $questionMarks = [];
        foreach ($params as $key => $value) {
            if (in_array($key, self::IGNORED_FIELD)) {
                continue;
            }

            $fields[]        = $key . " = ?";
            $values[]        = $value;
            $questionMarks[] = '?';
        }
        $fields     = implode(', ', $fields);
        $sqlRequest = "UPDATE " . static::generateTableName() . " SET $fields WHERE id = {$this->id};";
        return Database::execute($sqlRequest, $values);
    }

    public static function generateTableName()
    {
        $className = explode('\\', get_called_class());
        return strtolower(end($className)) . 's';
    }

    /**
     * Get All element of a database table
     *
     * @return mixed
     */
    public static function all()
    {

        return Database::query(
            'SELECT * FROM ' . static::generateTableName(),
            [],
            false,
            get_called_class()
        );
    }

    /**
     * Find an element in the database by od
     *
     * @param integer $id
     * @return object
     */
    public static function find(int $id)
    {
        static::generateTableName();
        return Database::query(
            'SELECT * FROM ' . static::generateTableName() . ' WHERE id = :id',
            ['id' => $id],
            true,
            get_called_class()
        );
    }

    /**
     * Delete an element in the databade by id or array of ids
     *
     * @param mixed $id
     * @return bool
     */
    public function delete($id = null)
    {
        if (is_array($id)) {
            foreach ($id as $value) {
                Database::execute(
                    'DELETE FROM ' . static::generateTableName() . ' WHERE id = ?',
                    [$value]
                );
            }
            return true;
        } elseif (is_null($id)) {
            if (is_null($this->id)) {
                throw new \Exception("Soory you can update a user without an id please set the id first", 1);
                die;
            }
            return Database::execute(
                'DELETE FROM ' . static::generateTableName() . ' WHERE id = ?',
                [$this->id]
            );
        }
        return Database::execute(
            'DELETE FROM ' . static::generateTableName() . ' WHERE id = ?',
            [$id]
        );

    }
}
