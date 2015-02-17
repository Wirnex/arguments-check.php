<?php

	require 'ArgumentsCheck.php';

	function feedMeWithAnArray(array $data)
	{
		$balance = 0;
		ArgumentsCheck::CheckArguments(array('userId', 'sum', 'timestamp'),  $data);
		//
		// here we sure that all arguments passed to function
		//
		$userId  = $data['userId'];
		$balance += $data['sum'];
		$time	 = $data['timestamp'];
	}
	
	class TestArgumentsCheck extends PHPUnit_Framework_TestCase
	{
		function test_checkArgumentsGood()
		{
			$requiredArgs = array('Messages'=>array('send_user_id', 'recv_user_id', 'message'), 'email');
			$actualArgs   = array('Messages'=>array('send_user_id'=>4, 'recv_user_id'=>6, 'message'=>'Hello'), 'email'=>'my_email');
			ArgumentsCheck::CheckArguments($requiredArgs,  $actualArgs, 'ClassName', 'function');
		}
		
		function test_checkArgumentsGood2()
		{
			$requiredArgs = array('username', 'city', 'email');
			$actualArgs   = array('city'=>'Rome', 'username'=>'Vittorio', 'email'=>'iamvittorio@rome.it');
			ArgumentsCheck::CheckArguments($requiredArgs,  $actualArgs);
		}
		
		function test_checkArgumentsGood3()
		{
			// call function with correct arguments
			feedMeWithAnArray(array('userId'=>130, 'sum'=>1000, 'timestamp'=>'2014-06-29 13:44'));
		}
		
		/**
		 * @expectedException Exception
		 * @expectedExceptionMessage [UnknownClass]::[UnknownMethod] $data['timestamp'] is missing.
         */
		function test_checkArgumentsBad0()
		{
			// here one of array's key typed wrong
			feedMeWithAnArray(array('userId'=>130, 'sum'=>1000, 'timestam'=>'2014-06-29 13:44'));
		}

		/**
		 * @expectedException Exception
		 * @expectedExceptionMessage [UnknownClass]::[UnknownMethod] $data['Goods']['milk'] is missing.
         */
		function test_checkArgumentsBad1()
		{
			$requiredArgs = array('Messages'=>array('send_user_id', 'message'), 'Goods'=>array('milk', 'bread'));
			$actualArgs   = array('Messages'=>array('send_user_id'=>4, 'recv_user_id'=>6, 'message'=>'Hello'));
			ArgumentsCheck::CheckArguments($requiredArgs,  $actualArgs);
		}
		
		/**
		 * @expectedException Exception
		 * @expectedExceptionMessage Message::postNewMessage $data['id'] is missing.
		 */
		function test_checkArgumentsBad2()
		{
			$requiredArgs = array('send_user_id', 'message', 'id');
			$actualArgs   = array('send_user_id'=>4, 'recv_user_id'=>6, 'message'=>'Hello');
			ArgumentsCheck::CheckArguments($requiredArgs,  $actualArgs, 'Message', 'postNewMessage');
		}
	}
