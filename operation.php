<?php
	error_reporting (NULL);
	$operands = strip_forbidden_chars ($_POST["op"]);
	$operandCount = count ($operands);
	
	$tmpOperands[] = $operands[0];
	
	for ($i = 1; $i < $operandCount; ++$i)
	{
		$tmpLastIdx = count ($tmpOperands) - 1;
		
		switch ($operands[$i])
		{	
			case '*':
			$tmpOperands[$tmpLastIdx] = $tmpOperands[$tmpLastIdx] * $operands[$i + 1];
			$i++;
			break;
			
			case '/':
			$tmpOperands[$tmpLastIdx] = $tmpOperands[$tmpLastIdx] / $operands[$i + 1];
			$i++;
			break;
			
			default:			
			$tmpOperands[] = $operands[$i];			
			break;
		}
	}
	
	$operands = $tmpOperands;
	
	$result = $operands[0];
	
	for ($i = 1; $i < $operandCount - 1; ++$i)
	{
		switch ($operands[$i])
		{
			case '+':
			$result += $operands[$i + 1];
			break;
			
			case '-':
			$result -= $operands[$i + 1];
			break;
		}
	}
	
	$rnd = mt_rand (min($result, 0), max($result, 0));
	
	$output["result"] = $result;
	
	if ($rnd == $result)
	{
		$output["luck"] = "win";
		$bool = 1;
	}
	else
	{
		$output["luck"] = "lose";
		$bool = 0;
	}

	echo json_encode ($output);
	
	function strip_forbidden_chars ($operands)
	{
		for ($i = 0; $i < count ($operands); ++$i)
		{
			$operands[$i] = str_replace ("'", "", $operands[$i]);
		}
		
		return $operands;
	}
?>