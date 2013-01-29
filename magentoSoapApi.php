<?php
	/**
	*	Magento SOAP API library. 
	*	Copyright (C) 2013 Joshua Warren (http://joshuawarren.com), Creatuity Corp. (http://creatuity.com/)
	* 	This software is made available under the terms of the GNU GPL v3 (http://www.gnu.org/licenses/gpl.txt)
	*
	* 	This program is free software: you can redistribute it and/or modify
	* 	it under the terms of the GNU General Public License as published by
	* 	the Free Software Foundation, either version 3 of the License, or
	* 	(at your option) any later version.
	*
	* 	This program is distributed in the hope that it will be useful,
	* 	but WITHOUT ANY WARRANTY; without even the implied warranty of
	* 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* 	GNU General Public License for more details.
	*
	* 	You should have received a copy of the GNU General Public License
	* 	along with this program.  If not, see <http://www.gnu.org/licenses/>.
	*/


class magentoSoapApi {
	protected $client; 
	protected $session;
	
	public function __construct($soapEndpoint, $soapUsername, $soapPassword) {
		$this->client = new SoapClient($soapEndpoint);
		$this->session = $this->client->login($soapUsername, $soapPassword);
		
    }
	
   public function __destruct() {
       $this->client->endSession($this->session);
   }
   
   /*
   	* $arguments can be a single variable or if multiple arguments, an array of arguments
   	*/
   protected function _callMethod($method, $callArguments = null) {
		$args = array();
		$args['session'] = $this->session; // session must be the first argument
		if(!is_null($callArguments)) {
			if(!is_array($callArguments)) {
				$arguments = array();
				$arguments[] = $callArguments; 
			} else {
				$arguments = $callArguments;
			}
			$args = array_merge($args, $arguments);				
		}
		try {
			$result = $this->client->__soapCall($method, $args);		   		   			
		} catch (Exception $e) {
			echo 'Caught exception: ' . $e->getMessage(); 
		}
		return $result;		
   }
   
   /*
    * Accepts an array of filters, returns an array of matching orders
    */
   public function salesOrderList($filters = null) {
	   $result = $this->_callMethod('salesOrderList', $filters);
	   return $result;
   }
   
   public function salesOrderInfo($orderIncrementId) {
		$result = $this->_callMethod('salesOrderInfo', $orderIncrementId);
		return $result;	   
   }
   
   public function catalogProductList($filters = null) {
	   $result = $this->_callMethod('catalogProductList', $filters);
	   return $result;
   }
   
   public function catalogProductInfo($productIdOrSku) {
	   $result = $this->_callMethod('catalogProductInfo', $productIdOrSku);
	   return $result;
   }
   
   public function catalogCategoryInfo($categoryId) {
	   $result = $this->_callMethod('catalogCategoryInfo', $categoryId);
	   return $result;
   }
}