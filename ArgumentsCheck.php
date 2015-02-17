<?php

class ArgumentsCheck
{
	static function CheckArguments(array $requiredArgs, array $actualArgs, $stringClass=null, $stringMethod=null)
	{
		$class		= ($stringClass  !== null) ? $stringClass  : "[UnknownClass]";
		$method		= ($stringMethod !== null) ? $stringMethod : "[UnknownMethod]";
		$place		= "$class::$method";
		$_required	= $requiredArgs;
		foreach($_required as $k => $r)
		{
			if(is_array($r))
			{
				foreach($r as $_a)
				{
					if(!array_key_exists($k, $actualArgs) || !array_key_exists($_a, $actualArgs["$k"]))
					{
						throw new Exception("$place \$data['$k']['$_a'] is missing.");
					}
				}
			}
			else if(!array_key_exists($r, $actualArgs))
			{
				throw new Exception("$place \$data['$r'] is missing.");
			}
		}
	}
}

?>
