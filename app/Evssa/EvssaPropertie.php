<?php
namespace App\Evssa;

use Illuminate\Support\Facades\Config;
use App\Evssa\EvssaException;
use App\Evssa\EvssaUtil;

class EvssaPropertie
{

	public function __construct ( )
	{

	}

	public static function get (
		$key)
	{
		try {
			return Config :: get (
				'properties.' .
				$key );

		} catch (EvssaException $e) {
				EvssaUtil.agregarMensajeError("No existe el properties ".$key);
		}

	}

	public static function getUpper (
		$key)
	{
		return strtoupper (
			Config :: get (
				'properties.' .
					 $key ) );
	}
}
