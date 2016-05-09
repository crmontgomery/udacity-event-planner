<?php 

class Hash
{
	//Hash::create('md5','password', 'salt');
	public static function create($algo, $data, $salt)
	{
		$context = hash_init($algo, HASH_HMAC, $salt);

		hash_update($context, $data);

		return hash_final($context);
	}
}