<?php
	
namespace Respect\Validation\Rules;
	
class Twitter extends AbstractRule
{
	private $pattern = '/^@[a-zA-Z0-9]/';
	private $account = NULL;
	
	public function validate($input){
		if(!preg_match('#^\S+$#', $input)) 	   return false;	
		if(!preg_match($this->pattern,$input)) return false;
		
		$curl = curl_init('http://api.twitter.com/1/users/show.json?screen_name='.substr($input,1));
		curl_setopt($curl,CURLOPT_HTTPGET,1);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		$this->account  = json_decode(curl_exec($curl)); 
		if(property_exists($this->account,'id')) return true;	
		
		return false;
	}	
	
	public function hasUrl(){
		if(!property_exists($this->account,'url')) return false;
		
		return true;	
	}

}

/**
 * LICENSE
 *
 * Copyright (c) 2009-2011, Alexandre Gomes Gaigalas.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 *
 *     * Redistributions in binary form must reproduce the above copyright notice,
 *       this list of conditions and the following disclaimer in the documentation
 *       and/or other materials provided with the distribution.
 *
 *     * Neither the name of Alexandre Gomes Gaigalas nor the names of its
 *       contributors may be used to endorse or promote products derived from this
 *       software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

