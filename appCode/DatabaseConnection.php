<?php
/**
 * Description of DatabaseConnection
 *
 * @author Jason Zeiner
 *
 * Date Apr 30, 2011
 */
class DatabaseConnection {
    private $host;
    private $login;
    private $password;
    private $database;
    private $_DB;
    
    public function __construct() {
        $this->host = DB_HOST;
        $this->login = DB_LOGIN;
        $this->password = DB_PASSWORD;
        $this->database = DATABASE;
        
        $this->_DB = new mysqli($this->host, $this->login, $this->password, $this->database);
    }
    public function select($queryString, $returnClass = 'stdClass'){
        // Include the optional returnClass so this class has access to the 
        // properties and methods defined in returnClass.
        if($returnClass != 'stdClass'){
            require_once APPCODE . $returnClass . '.php';
        }
        //Tried to use mysql_escape_string with $queryString and it failed, why?
        $query = $this->_DB->query($queryString);
        $num_rows = $query->num_rows;
        
        if($num_rows > 1){
            $results = array();
            while($row = $query->fetch_object($returnClass)){
                $results[] = $row;
            }
            return $results;
        } elseif ($num_rows == 1) {
            return $query->fetch_object($returnClass);
        }else{
            return false;
        }
    }
    public function insert($queryString){
        $result = $this->_DB->query($queryString);
        $return = ($result) ? $this->_DB->insert_id : false;
        return $return;
    }
    public function update($queryString){
        return $this->_DB->query($queryString);
    }
    public function delete($table_name, $primary_key_column, $id){
        $deleteString = "DELETE FROM {$table_name} WHERE {$primary_key_column} = '{$id}'";
        return $this->_DB->query($deleteString);
    }
    /**
     * Close current database connection.
     */
    public function close(){
        $this->_DB->close();
    }
    /**
     * Query the database with the given query string then return true on success 
     * or false on failure.
     * 
     * @param type $queryString A SQL string to query the database with.
     * @return type boolean 
     */
    private function query($queryString){
        if(!$this->_DB->query(mysql_escape_string($queryString))){
            return false;
        }  else {
            return true;
        }
    }
}

?>
