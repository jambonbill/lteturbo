<?php
/**
 * Djang : Django Session / Id base functions
 * Do not use, UserDjango is probably what you want
 * Ver 0.1 - 2018-02-01
 * @author : jambonbill
 */

namespace Django;

class Djang
{
    private $db;
    private $UD;
    private $user;
    private $DEBUG;

    public function __construct()
    {

        // Create PDO object
        $pdo=new \PDO\Pdo;
        $this->db=$pdo->db();

        // User
        $this->UD=new \PDO\UserDjango($this->db);
        $session = $this->UD->djangoSession();//

        //echo "<pre>session:";print_r($session);echo "</pre>";

        $this->user = $this->UD->auth_user($session['session_data']);

    }

    /**
     * [db description]
     * @return [type] [description]
     */
    public function db()
    {
        return $this->db;
    }

    public function user()
    {
        return $this->user;
    }

    public function user_id()
    {
        return $this->user['id'];
    }

    public function debug($b)
    {
        $this->DEBUG=$b;
    }

    public function is_staff()
    {

        if ($this->user) {
            return $this->user['is_staff'];
        }

        return false;
    }

    public function is_active()
    {
        return $this->user['is_active'];
    }

    public function is_superuser()
    {
        return $this->user['is_superuser'];
    }

    /**
     * Return django auth_user data
     * @param  integer $uid [description]
     * @return [type]       [description]
     */
    public function auth_user($uid = 0)
    {
        $uid*=1;
        if (!$uid) {
            return false;
        }

        $sql="SELECT * FROM auth_user WHERE id=$uid LIMIT 1;";
        $q=$this->db->query($sql);
        $r=$q->fetch(\PDO::FETCH_ASSOC);
        return $r;
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
}
