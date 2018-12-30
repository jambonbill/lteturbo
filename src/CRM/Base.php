<?php
/**
  * @author jambonbill
  * Base class
 */

namespace CRM;

use PDO;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
* @brief Jambonbill.org users functions
*/
class Base
{
	private $db;
	private $UD;
	private $_user;

	public function __construct ()
    {

        $config_file_path='../../profiles/'.$_SERVER['HTTP_HOST'].'.json';

        if (!$config_file_path) {
            if (isset($_SESSION['configfile'])) {
                $config_file_path = @$_SESSION['configfile'];
            } else {
                throw new \Exception('Error: no config file');
            }
        }

        if (!is_file($config_file_path)) {
            throw new \Exception('Error: no config file "' . $config_file_path . '"');
        } else {
            // Load configuration
            $this->config = json_decode(file_get_contents($config_file_path));
            //print_r($this->config->pdo);
            $this->connect();
        }

        //User
        $this->UD=new \Django\UserDjango($this->db);
        $session = $this->UD->djangoSession();//

        $this->_user = $this->UD->auth_user($session['session_data']);

        //LOGGER
    }

    private function connect()
    {

        $db_host = $this->config->pdo->host;
        $db_name = $this->config->pdo->name;
        $db_driver=$this->config->pdo->driver;
        $db_user = $this->config->pdo->user;
        $db_pass = $this->config->pdo->pass;

        try {
            $dsn = $db_driver . ":host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8";
            $this->db = new \PDO($dsn, $db_user, $db_pass);
        } catch (\PDOException $e) {
            self::$failed = true;
            echo "<li>" . $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * [db description]
     * @return [type] [description]
     */
    public function db()
    {
        return $this->db;
    }

    
    /**
     * Return Userdjango
     */
    public function UD(){
        return $this->UD;
    }

    /**
     * End user session
     * @return [type] [description]
     */
    public function logout()
    {
        $this->UD->logout();
        return true;
    }

    public function useronly()
    {
        if(!$this->_user){
            echo "user only";
            exit;
        }
    }

    public function staffonly()
    {
        if(!$this->is_staff()){
            echo "error: staff only";
            exit;
        }
    }


    /**
     * Return current user id !
     * @return [type] [description]
     */
    public function user()
    {
        return $this->_user;
    }

    public function user_id()
    {
        return $this->_user['id'];
    }

    public function is_staff(){
        return $this->_user['is_staff'];
    }

    public function is_active(){
        return $this->_user['is_active'];
    }

    public function is_superuser(){
        return $this->_user['is_superuser'];
    }



    /**
     * Return a user record
     * @param  integer $id [description]
     * @return [type]      [description]
     */
    public function auth_user($id=0)
    {
        $id*=1;
        if(!$id)return [];

        $sql="SELECT * FROM auth_user WHERE id=$id LIMIT 1;";
        $q=$this->db()->query($sql) or die(print_r($this->db()->errorInfo(), true) . "<hr />$sql");;
        $r=$q->fetch(\PDO::FETCH_ASSOC);
        if($r)return $r;
        return [];
    }

}