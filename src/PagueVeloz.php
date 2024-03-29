<?php

namespace PagueVeloz;

abstract class PagueVeloz
{

	private static $servicesAvailable = [
											['service'=>'Assinar', 'version'=> ['v1','v2'], 'default'=>'v2'],
											['service'=>'Cep', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'Cliente', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'Consultar', 'version'=> ['v1','v2'], 'default'=>'v2'],
											['service'=>'CreditoSMS', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'Extrato', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'Saldo', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'Tarifa', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'Saque', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'Transferencia', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'UsuarioCliente', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'MensagemSMS', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'PacotesSMS', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'Ping', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'DefaultBoleto', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'ConsultarBoleto', 'version'=> ['v1'], 'default'=>'v1'],
											['service'=>'ContaBancaria', 'version'=> ['v1','v2'], 'default'=>'v2'],
											['service'=>'Boleto', 'version'=> ['v2','v3'], 'default'=>'v3'],
											['service'=>'ComprarCreditoSMS', 'version'=> ['v2'], 'default'=>'v2'],
											['service'=>'TarifarBoleto', 'version'=> ['v1'], 'default'=>'v1'],
										];

	private static $version;

	public static $url;

	public static function ApiVersion($v)
	{
		self::$version = $v;

		return self;
	}

	public static function Url($url)
	{
		self::$url = $url;
	}

	private static function GetVersion($service, $v)
	{
		$version = NULL;

		if (!empty(self::$version))
			$version = array_pop(array_filter($service['version'], function($el)
			{
				if ($el === self::$version)
					return $el;

			}));
		else
		if (!empty($v))
			$version = array_pop(array_filter($service['version'], function($el) use ($v)
			{
				if ($el === $v)
					return $el;

			}));
		else
			$version = $service['default'];

		if (empty($version))
			throw new \Exception("Verão da API não encontrada", 1);


		return $version;
	}

	public static function Get()
	{
		return self::$servicesAvailable;
	}

	private static function GetService($service)
	{
		$listService = array_filter(self::Get(), function($el) use ($service)
		{
			if ($el['service'] === $service)
				return $el;
		});

		if (empty($listService) || count($listService) === 0 || count($listService) > 1)
			throw new \Exception("Erro ao localizar Serviço", 1);

		return array_pop($listService);
	}

	public static function Assinar($version = NULL)
	{
		$service = self::GetService('Assinar');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':

				$dto = new \PagueVeloz\Api\v1\Dto\AssinarDTO;
				$service =  new \PagueVeloz\Api\v1\Assinar($dto);
				break;
			case 'v2':
				$dto = new \PagueVeloz\Api\v2\Dto\AssinarDTO;
				$service =  new \PagueVeloz\Api\v2\Assinar($dto);
				break;
		}

		return $service;
	}

	public static function Cep($version = NULL)
	{
		$service = self::GetService('Cep');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':

				$service =  new \PagueVeloz\Api\v1\Cep;
				break;

		}

		return $service;
	}

	public static function Ping($version = NULL)
	{
		$service = self::GetService('Ping');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':

				$service =  new \PagueVeloz\Api\v1\Ping;
				break;

		}

		return $service;
	}

	public static function PacotesSMS($version = NULL)
	{
		$service = self::GetService('PacotesSMS');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':

				$service =  new \PagueVeloz\Api\v1\PacotesSMS;
				break;

		}

		return $service;
	}

	public static function Saldo($version = NULL)
	{
		$service = self::GetService('Saldo');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':

				$service =  new \PagueVeloz\Api\v1\Saldo;
				break;

		}

		return $service;
	}

	public static function ConsultarBoleto($version = NULL)
	{
		$service = self::GetService('ConsultarBoleto');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':

				$service =  new \PagueVeloz\Api\v1\ConsultarBoleto;
				break;

		}

		return $service;
	}


	public static function Saque($version = NULL)
	{
		$service = self::GetService('Saque');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':
				$dto = new \PagueVeloz\Api\v1\Dto\SaqueDTO;
				$service =  new \PagueVeloz\Api\v1\Saque($dto);
				break;

		}

		return $service;
	}

	public static function ComprarCreditoSMS($version = NULL)
	{
		$service = self::GetService('ComprarCreditoSMS');

		switch (self::GetVersion($service, $version))
		{
			case 'v2':
				$dto = new \PagueVeloz\Api\v2\Dto\ComprarCreditoSMSDTO;
				$service =  new \PagueVeloz\Api\v2\ComprarCreditoSMS($dto);
				break;

		}

		return $service;
	}

	public static function Boleto($version = NULL)
	{
		$service = self::GetService('Boleto');

		switch (self::GetVersion($service, $version))
		{
			case 'v2':
				$dto = new \PagueVeloz\Api\v2\Dto\BoletoDTO;
				$service =  new \PagueVeloz\Api\v2\Boleto($dto);
				break;
			case 'v3':
				$dto = new \PagueVeloz\Api\v3\Dto\BoletoDTO;
				$service =  new \PagueVeloz\Api\v3\Boleto($dto);
				break;

		}

		return $service;
	}

	public static function ContaBancaria($version = NULL)
	{
		$service = self::GetService('ContaBancaria');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':
				$dto = new \PagueVeloz\Api\v1\Dto\ContaBancariaDTO;
				$service =  new \PagueVeloz\Api\v1\ContaBancaria($dto);
				break;

			case 'v2':
				$dto = new \PagueVeloz\Api\v2\Dto\ContaBancariaDTO;
				$service =  new \PagueVeloz\Api\v2\ContaBancaria($dto);
				break;

		}

		return $service;
	}

	public static function DefaultBoleto($version = NULL)
	{
		$service = self::GetService('DefaultBoleto');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':
				$dto = new \PagueVeloz\Api\v1\Dto\DefaultBoletoDTO;
				$service =  new \PagueVeloz\Api\v1\DefaultBoleto($dto);
				break;

		}

		return $service;
	}

	public static function MensagemSMS($version = NULL)
	{
		$service = self::GetService('MensagemSMS');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':
				$dto = new \PagueVeloz\Api\v1\Dto\MensagemSMSDTO;
				$service =  new \PagueVeloz\Api\v1\MensagemSMS($dto);
				break;

		}

		return $service;
	}

	public static function UsuarioCliente($version = NULL)
	{
		$service = self::GetService('UsuarioCliente');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':
				$dto = new \PagueVeloz\Api\v1\Dto\UsuarioClienteDTO;
				$service =  new \PagueVeloz\Api\v1\UsuarioCliente($dto);
				break;

		}

		return $service;
	}

	public static function Transferencia($version = NULL)
	{
		$service = self::GetService('Transferencia');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':
				$dto = new \PagueVeloz\Api\v1\Dto\TransferenciaDTO;
				$service =  new \PagueVeloz\Api\v1\Transferencia($dto);
				break;

		}

		return $service;
	}

	public static function Tarifa($version = NULL)
	{
		$service = self::GetService('Tarifa');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':

				$service =  new \PagueVeloz\Api\v1\Tarifa;
				break;

		}

		return $service;
	}

	public static function TarifarBoleto($version = NULL)
	{
		$service = self::GetService('TarifarBoleto');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':
				$dto = new \PagueVeloz\Api\v1\Dto\TarifarBoletoDTO;
				$service =  new \PagueVeloz\Api\v1\TarifarBoleto($dto);
				break;

		}

		return $service;
	}

	public static function Extrato($version = NULL)
	{
		$service = self::GetService('Cep');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':

				$service =  new \PagueVeloz\Api\v1\Extrato;
				break;

		}

		return $service;
	}

	public static function CreditoSMS($version = NULL)
	{
		$service = self::GetService('Cep');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':

				$service =  new \PagueVeloz\Api\v1\CreditoSMS;
				break;

		}

		return $service;
	}

	public static function Consultar($version = NULL)
	{
		$service = self::GetService('Consultar');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':
				$dto = new \PagueVeloz\Api\v1\Dto\ConsultarDTO;
				$service =  new \PagueVeloz\Api\v1\Consultar($dto);
				break;
			case 'v2':
				$dto = new \PagueVeloz\Api\v2\Dto\ConsultarDTO;
				$service =  new \PagueVeloz\Api\v2\Consultar($dto);
				break;

		}

		return $service;
	}

	public static function Cliente($version = NULL)
	{
		$service = self::GetService('Cep');

		switch (self::GetVersion($service, $version))
		{
			case 'v1':
				$dto = new \PagueVeloz\Api\v1\Dto\ClienteDTO;

				$service =  new \PagueVeloz\Api\v1\Cliente($dto);
				break;

		}

		return $service;
	}
}
