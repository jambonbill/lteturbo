<?php
/**
  * @author jambonbill
 */

namespace CRM;

use PDO;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
* @brief Jambonbill CRM user(s) functions
*/
class User
{
	private $db;
	private $UD;
	private $_user;

	
	public function __construct (Jambon $Jam)//bring your own db
    {
        $this->db=$Jam->db();
        $this->_user=$Jam->user();
    }

    /**
     * Return db connector
     * @return [type] [description]
     */
    private function db()
    {
        return $this->db;
    }


    private function user_id()
    {
        exit('user_id() toDo');
        //return $this->_ED->log();
    }


    /**
     * return auth_user record
     * @param  integer $id [description]
     * @return [type]      [description]
     */
    public function auth_user($id=0)
    {
		$id*=1;
		
		if (!$id) {
			return false;
		}
		
		$sql="SELECT * FROM auth_user WHERE id=$id LIMIT 1;";
        $q=$this->db()->query($sql) or die("Errror:".print_r($this->db()->errorInfo(), true)."<hr />$sql");

        return false;
    }

    
    /**
     * Return the list of users
     * @return [type] [description]
     */
    public function users()
    {

        $sql="SELECT * FROM auth_user WHERE 1;";
        $q=$this->db()->query($sql) or die("Errror:".print_r($this->db()->errorInfo(), true)."<hr />$sql");

        $dat=[];
        while($r=$q->fetch(PDO::FETCH_ASSOC)){
            $dat[]=$r;
        }
        return $dat;
    }


    /**
     * Create a active django/edx user
     * @param  string $email       must be unique, 75 chars max
     * @param  string $username    must be unique, 30 chars max
     * @param  string $first_name  first name, 30 chars max
     * @param  string $last_name   last name, 30 chars max
     * @param  string $date_joined datetime
     * @return integer             user_id
     */
    public function userCreate($email = '', $username = '', $first_name = '', $last_name = '', $date_joined = '')
    {


        $this->log->addInfo(__FUNCTION__."($email,[...])", ['user_id'=>$this->user_id()]);


        // echo "userCreate();\n";
        $email=trim(strtolower($email));

        if (!$email) {//email is the primary identifier in edx
            return false;
        }

        if ($uid = $this->userExist($email)) {
            return $uid;
        }

        // first name must be set
        if (!$username) {
            $username=explode("@", $email)[0];// we take the first part of the email as username if we dont have anything better
            //return false;
        }


        // date joined
        if (!$date_joined) {
            $date_joined="NOW()";
        } else {
            $date_joined="'$date_joined'";
        }

        $sql = "INSERT INTO auth_user (username, first_name, last_name, email, is_active, date_joined)";
        $sql.=" VALUES (".$this->db->quote($username).", ".$this->db->quote($first_name).", ".$this->db->quote($last_name).", '$email', 1, $date_joined);";

        $q=$this->db()->query($sql) or die("Errror:".print_r($this->db->errorInfo(), true)."<hr />$sql");

        $userid=$this->db()->lastInsertId();

        /*
        if ($userid) {
            $sql = "INSERT INTO edxapp.auth_userprofile (user_id, name, courseware, allow_certificate)";
            $sql.=" VALUES ('$userid', ".$this->db->quote($username).", 'course.xml', 1);";
            $q=$this->db->query($sql) or die(print_r($this->db->errorInfo(), true));
        } else {
            return false;
        }
        */

        return $userid;
    }


    /**
     * Delete student record, but doesnt delete associations
     * DO NOT USE FOR PRODUCTION !!!
     * @param  integer $user_id [description]
     * @return [type]           [description]
     */
    public function userDelete($user_id=0)
    {
        $user_id*=1;
        if(!$user_id)return false;

        $this->log->addInfo(__FUNCTION__."($user_id)", ['user_id'=>$this->user_id()]);//Log here

        $sql = "DELETE FROM auth_user WHERE id='$user_id' LIMIT 1;";
        $q=$this->db->query($sql) or die("Err:".print_r($this->db->errorInfo(), true)."<hr />$sql");

        return true;
    }


    /**
     * Return the user id of the user for a given email adress
     * @return [type] [description]
     */
    public function userExist($email = '')
    {
        $email=trim($email);

        $sql="SELECT id FROM auth_user WHERE email LIKE '$email';";
        $q=$this->db->query($sql) or die(print_r($this->db->errorInfo(), true));

        $r=$q->fetch(\PDO::FETCH_ASSOC);
        return $r['id'];
    }


    /**
     * Update user Password. Password must be encrypted first
     * @param  integer $user_id [description]
     * @param  string  $pass    [description]
     * @return [type]           [description]
     */
    public function updatePassword($user_id = 0, $pass = '')
    {
        $user_id*=1;

        if (!$pass || !$user_id) {
            return false;
        }

        $sql = "UPDATE auth_user SET password='$pass' WHERE id=$user_id LIMIT 1;";
        $q=$this->db->query($sql) or die(print_r($this->db->errorInfo(), true));

        $this->log->addInfo(__FUNCTION__."($user_id,password)", ['user_id'=>$this->user_id()]);

        return true;
    }
}