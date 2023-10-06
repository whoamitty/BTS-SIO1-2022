<?php
/**
 * User: SaphirAngel
 */


include_once 'config.inc.php';

class Profil
{
    static private $profilList;
    private $name;
    private $check;
    private $regCheck;
    private $advance;
    private $regAdvance;
    private $other;

    private $regMode = false;

    public function __construct($name)
    {
        if (empty($name)) throw new Exception("Un nom de profil doit être indiqué");
        $this->name = $name;
        $this->other = NOT_ACCEPTED;
        self::$profilList[$name] = $this;
    }

    static public function get($name)
    {
        if (isset(self::$profilList[$name]))
            return self::$profilList[$name];
        return false;
    }

    public function regCheck($keys, $flags = DEFAULT_FLAG, $options = '')
    {
        $this->regMode = true;
        $this->check($keys, $flags, $options, true);
    }

    public function check($keys, $flags = DEFAULT_FLAG, $options = '', $reg = false)
    {
        if (!empty($options))
            $flags |= CHECK;

        if (!is_array($keys)) $keys = array($keys);

        foreach ($keys as $num => $key) {
            $option = '';
            if (!empty($options)) {
                if (is_array($options) && isset($options[$num])) $option = $options[$num];
                else $option = $options;
            }

            if ($reg)
                $this->regCheck[$key] = [$flags, $option];
            else
                $this->check[$key] = [$flags, $option];
        }

        return $this;
    }

    public function regAdvance($keys, $orders, $default = null)
    {
        $this->advance($keys, $orders, $default, true);
    }

    public function advance($keys, $orders, $default = null, $reg = false)
    {
        $table = $this->advance;
        if ($reg) $table = $this->regAdvance;

        $defaultValue = null;
        if (!is_array($keys)) $keys = array($keys);

        foreach ($keys as $num => $key) {
            if ($default !== null) {
                if (!is_array($default)) $defaultValue = $default;
                else {
                    if (isset($default[$num]))
                        $defaultValue = $default[$num];
                }
            }
            if (!isset($table[$key]))
                 $table[$key] = array($orders, $defaultValue);
            else {
                $table[$key][0] = array_merge($table[$key][0], $orders);
                $table[$key][1] = $defaultValue;
            }
        }

        if ($reg) $this->regAdvance = $table;
        else $this->advance = $table;

        return $this;
    }

    public function data($key)
    {
        //Si la clé n'existe pas on essaye de passer en mode élargie
        if (!isset($this->check[$key], $this->advance[$key])) {
            $splitKey = preg_split("/_/", $key);
            if (count($splitKey) > 1) { // passage en mode élargie
                $key = $splitKey[count($splitKey) - 1];
                if (!isset($this->check[$key], $this->advance[$key])) return false;
            } else {
                return false;
            }
        }

        $return = ['check' => array(), 'advance' => array()];

        if (isset($this->check[$key])) $return['check'] = $this->check[$key];
        if (isset($this->advance[$key])) $return['advance'] = $this->advance[$key];

        if (isset($this->regCheck[$key])) $return['check'] = $this->check[$key];
        if (isset($this->regAdvance[$key])) $return['advance'] = $this->advance[$key];


        return $return;
    }

    public function other($flag)
    {
        if (in_array($flag, [ACCEPTED, NOT_ACCEPTED])) {
            $this->other = $flag;
        } else {
            $this->other = NOT_ACCEPTED;
        }

    }

    public function get_other_action()
    {
        return $this->other;
    }


    public function get_advance()
    {
        return $this->advance;
    }

    public function getRegMode()
    {
        return $this->regMode;
    }
}

$dirHandle = opendir('./profils');
while ($file = readdir($dirHandle))  {
    if ($file != '.' && $file != '..')
        include 'profils/'.$file;
}
