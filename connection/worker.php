<?php
require_once("connection.php");
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$time = date('H:i:s');
$datetime = $date . ' ' . $time;
class Worker
{
    public $sql = array();
    public $conditions = array();
    public $type = '';
    public $key = '';

    function __construct($allow = 'all')
    {
        if ($allow !== 'all') {
            if (strtolower($_SERVER['REQUEST_METHOD']) != strtolower($allow)) {
                throw new Exception('Method not allowed');
            }
        }
    }

    public function init()
    {
        unset($this->sql);
        $this->sql = array();
        unset($this->conditions);
        $this->conditions = array();
        unset($this->type);
        $this->type = '';
        unset($this->key);
        $this->key = '';
    }

    public function query($query)
    {
        $this->sql[] = $query;
        return $this;
    }
    public function bind($arr = array())
    {

        $this->conditions[] = $arr;
        return $this;
    }
    public function type($type = 'array')
    {
        unset($this->type);
        $this->type = $type;
        return $this;
    }
    public function key($key)
    {
        $this->key = $key;
        return $this;
    }
    public function enc($data, $till)
    {
        $counter = 0;
        foreach ($data as $key => $value) {


            if ($counter >= $till) {
                $newArr[$key] = $value;
            } else {
                $newArr[$key] = openssl_encrypt($value, "AES-128-ECB", 'pass');
                $counter++;
            }
        }
        return $newArr;
    }


    public function fetch()
    {
        require 'connection.php';
        try {

            $conn->beginTransaction();
            foreach ($this->sql as $key => $value) {
                $stmt = $conn->prepare($this->sql[$key]);
                $stmt->execute((!empty($this->conditions[$key]) ? $this->conditions[$key] : []));
                if ($this->type != 'update') {
                    $row[] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
            }

            $conn->commit();



            switch ($this->type) {
                case 'json':
                    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $conn = null;
                    $this->init();
                    return json_encode($row);
                    break;

                case 'jsonSingle':
                    $row = $statement->fetchAll(\PDO::FETCH_ASSOC);
                    $result = json_encode(array_change_key_case($row[0], CASE_LOWER));
                    $conn = null;
                    $this->init();
                    return $result;
                    break;

                case 'insert':
                    $row = $conn->lastInsertId();
                    $conn = null;
                    $this->init();
                    return  $row;
                    break;

                case 'rows':
                    $result = $statement->fetchColumn();
                    $conn = null;
                    $this->init();
                    return $result;
                    break;

                case 'update':
                    $conn = null;
                    $this->init();
                    return  json_encode(['msg' => 'success']);
                    break;

                case 'updateString':
                    $conn = null;
                    $this->init();
                    return   'success';
                    break;

                default:

                    $conn = null;
                    $this->init();
                    return $row[0];

                    break;
            }


            $conn = null;
        } catch (Exception $e) {
            if (isset($conn)) {
                $conn->rollback();
            }
            $conn = null;
            $this->init();
            return "Error:  " . $e;
        }
    }
}
