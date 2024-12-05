<?php
class Database
{
    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );

        try {
            $this->dbh = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Error de conexión a la base de datos: " . $e->getMessage());
            throw new Exception("Error de conexión a la base de datos");
        }
    }

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        try {
            return $this->stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al ejecutar la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function resultSet()
    {
        try {
            $this->execute();
            return $this->stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error al obtener resultados: " . $e->getMessage());
            return false;
        }
    }

    public function single()
    {
        try {
            $this->execute();
            return $this->stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error al obtener resultado: " . $e->getMessage());
            return false;
        }
    }

    public function lastInsertId()
    {
        try {
            return $this->dbh->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error al obtener el último ID insertado: " . $e->getMessage());
            return false;
        }
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
    
    public function beginTransaction()
    {
        return $this->dbh->beginTransaction();
    }

    public function commit()
    {
        return $this->dbh->commit();
    }

    public function rollBack()
    {
        return $this->dbh->rollBack();
    }
}
