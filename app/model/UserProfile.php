<?php
class UserProfile
{
    protected $id = null;
	protected $user_id = null;
	protected $email = null;
	protected $first_name = null;
	protected $last_name = null;
	protected $middle_name = null;
	protected $suffix = null;
	protected $mobile_number = null;
	protected $date_created = null;
	protected $is_active = null;

	public function getId() {
		return $this->id;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getUser_id() {
		return $this->user_id;
	}

	public function getFirst_name() {
        return $this->first_name;
	}
	
	public function getLast_name() {
        return $this->last_name;
	}

	public function getMiddle_name() {
        return $this->middle_name;
	}

	public function getSuffix() {
        return $this->suffix;
	}

	public function getMobile_number() {
		return $this->mobile_number;
	}

	public function getDate_created() {
		return $this->date_created;
	}

	public function getIs_active() {
		return $this->is_active;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setUser_id($user_id) {
		$this->user_id = $user_id;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setFirst_name($first_name) {
		$this->first_name = $first_name;
	}

	public function setLast_name($last_name) {
		$this->last_name = $last_name;
	}

	public function setMiddle_name($middle_name) {
		$this->middle_name = $middle_name;
	}

	public function setSuffix($suffix) {
		$this->suffix = $suffix;
	}

	public function setMobile_number($mobile_number) {
		$this->mobile_number = $mobile_number;
	}

	public function setDate_created($date_created) {
		$this->date_created = $date_created;
	}

	public function setIs_active($is_active = null) {
		if ($is_active == null)
		{
			$this->is_active = 1;
		}
		
		$this->is_active = $is_active;
	}

	public function __construct(array $options = null)
	{
		if (is_array($options))
		{
			$this->setOptions($options);
		}
	}
	
	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if(('mapper' == $name) || !method_exists($this, $method))
		{
			throw new Exception('Invalid game property');
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if(('mapper' == $name) || !method_exists($this, $method))
		{
			throw new Exception('Invalid game property');
		}
		return $this->$method();
	}
	
	public function setOptions(array $options)
	{
		foreach($options as $key => $value)
		{
	
			if($value)
			{
				if(is_numeric($value))
				{
					if(strpos($value, '.') !== false)
					{
						$this->$key = (float)$value;
					}
					else
					{
						$this->$key = (int)$value;
					}
				}
				else
				{
					$this->$key = $value;
				}
			}
			else
			{
				if(is_numeric($value))
				{
					$this->$key = 0;
				}
				else
				{
					$this->$key = NULL;
				}
			}
		}
		return $this;
	}
	
	public function toArray(array $exceptions = null)
	{
		$properties = get_object_vars($this);
		$array = array();
	
		if(null != $exceptions)
		{
			foreach($exceptions as $k => $v)
			{
				if(array_key_exists($v, $properties))
				{
					unset($properties[$v]);
				}
			}
		}
	
		foreach($properties as $key => $value)
		{
			$br = false;
			if(!null == $exceptions)
			{
				if(is_array($exceptions))
				{
					foreach ($exceptions as $val)
					{
						if(0 === strpos($key, $val))
						{
							$br = true;
						}
	
					}
					if(!$br)
					{
						$array [$key] = $value;
					}
				}
				else
				{
					if(false === strpos($key, $exceptions))
					{
						$array [$key] = $value;
					}
				}
	
			}
			else
			{
				$array [$key] = $value;
			}
	
		}
		return $array;
	}
}
?>