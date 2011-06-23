<?php
/**
 * Generic Model object. All other Model type classes should extend this file.
 *
 * @author Jason Zeiner
 *
 * Date May 1, 2011
 */
require_once APPCODE . 'AppObj.php';
// Does this need to extend AppObj?
class Model extends AppObj{
    protected $_DBConn;
    protected $TABLE_NAME;  // The name of the corresponding table in the database.
    protected $KEY;         // The column name of the table's primary key.
    protected $baseClass;   // The name of the class that defines the business 
                            // object/logic for the inheriting class.
    protected $result;      // The result from a select call to _DBConn, this 
                            // will either be a single object or an array of objects.
    
    public function __construct() {
        // Check if $_DB exists. It should have been instantiated in index.php
        if(!isset ($_DB) || empty($_DB)){
//            require_once APPCODE . 'DatabaseConnection.php';
//            $this->_DBConn = new DatabaseConnection();
//            
            // Using connectToDB function from index.php
            // To use a different database connection object only the reference 
            // to DatabaseConnection in index.php would need to be changed.
            $this->_DBConn = connectToDB();
        }else{
            // $_DBConn is assigned a reference of $_DB becoming a way to access
            // the same instance of DatabaseConnection
            $this->_DBConn = @$_DB;
        }
    }
    protected function select($queryString, $className = 'stdClass'){
        return $this->_DBConn->select($queryString, $className);
    }
    protected function update($queryString){
        return $this->_DBConn->update($queryString);
    }
    protected function insert($queryString){
        return $this->_DBConn->insert($queryString);
    }
    protected function delete($table_name, $primary_key_column, $id){
        return $this->_DBConn->delete($table_name, $primary_key_column, $id);
    }
}

?>
