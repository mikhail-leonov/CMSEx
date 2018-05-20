<?php

trait TestCaseEx
{
    /**
     * Prepare Api Call CURL Settings
     *
     * @param string $url Api endpoint URL 
     * @param string $action get OR post 
     * @param array $params get parameters OR post fields OR params for other requests
     * @return array settings for Api call
     */
    public function prepareApiCallSettings($url, $action = 'get', $params = [])
    {
        $settings = [];
        $settings[CURLOPT_RETURNTRANSFER] = 1;
        $settings[CURLOPT_USERAGENT] = 'PHPUnit Url Tester';
        $action = strtolower($action);

        if ('get' === $action) {
            if (count($params) > 0) {
                $url = "{$url}?" . http_build_query($params);
            }
        } else {
            if ('post' === $action) {
                $settings[CURLOPT_POST] = 1;
                $settings[CURLOPT_POSTFIELDS] = $params;
            } else {
		$data_json = json_encode($params);

                $settings[CURLOPT_CUSTOMREQUEST] = strtoupper($action);
		$settings[CURLOPT_HTTPHEADER] = array('Content-Type: application/json','Content-Length: ' . strlen($data_json));
		$settings[CURLOPT_POSTFIELDS] = $data_json;
	    }
	}
        $settings[CURLOPT_URL] = $url;

	return $settings;
    }	

    /**
     * Make Api Call and return response
     *
     * @param string $url Api endpoint URL 
     * @param string $action get OR post 
     * @param array $params get parameters OR post fields OR params for other requests
     * @return array settings for Api call
     */
    public function callApiEndPoint($path, $action = 'get', $params = [])
    {
        $curl = curl_init();
        $settings = $this->prepareApiCallSettings(URL . $path, $action, $params);
	$settings[CURLOPT_FOLLOWLOCATION] = 0;
        curl_setopt_array($curl, $settings);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    /**
     * Make Api Call and return redirect
     *
     * @param string $url Api endpoint URL 
     * @param string $action get OR post 
     * @param array $params get parameters OR post fields OR params for other requests
     * @return array settings for Api call
     */
    public function callApiRedirect($path, $action = 'get', $params = [])
    {
	$redirect = "";
        $curl = curl_init();
        $settings = $this->prepareApiCallSettings(URL . $path, $action, $params);
	$settings[CURLOPT_FOLLOWLOCATION] = 1;
	$settings[CURLOPT_HEADER] = 1;
        curl_setopt_array($curl, $settings);
        $response = curl_exec($curl);
	if (preg_match('#Location: (.*)#', $response, $r)) { 
	    $redirect = trim($r[1]); 
        }
        curl_close($curl);
        return $redirect;
    }


    /**
     * Assert that a class has a method
     *
     * @param string $class name of the class
     * @param string $method name of the searched method
     * @throws ReflectionException if $class don't exist
     * @throws PHPUnit_Framework_ExpectationFailedException if a method isn't found
     */
    public function assertClassMethodExist($class, $method)
    {
        $oReflectionClass = new ReflectionClass($class);
        $this->assertSame(true, $oReflectionClass->hasMethod($method));
    }
    
    /**
     * Assert that a object has a method
     *
     * @param Object $obj Object to test
     * @param string $method name of the searched method
     * @throws PHPUnit_Framework_ExpectationFailedException if a method isn't found
     */
    public function assertObjectMethodExist($obj, $method)
    {
        $this->assertSame(true, method_exists($obj, $method));
    }
    
    /**
     * Assert that a json_encode response is a negative and no additional data
     *
     * @param string $response json encoded string
     */
    public function assertNegativeJsonResponse($response)
    {
        $this->assertNotEmpty($response);

        $response = json_decode($response, true);
        $this->assertInternalType('array', $response);
        $this->assertNotSame(null, $response);

        $this->assertArrayHasKey('result', $response);
        $this->assertSame(0, (int)$response['result']);

        $this->assertArrayHasKey('data', $response);
        $this->assertEmpty($response['data']);
    }
    
    /**
     * Assert that a json_encode response is a positive and data
     *
     * @param string $response json encoded string
     */
    public function assertPositiveJsonResponse($response)
    {
        $this->assertNotEmpty($response);

        $response = json_decode($response, true);
        $this->assertInternalType('array', $response);
        $this->assertNotSame(null, $response);

        $this->assertArrayHasKey('result', $response);
        $this->assertSame(1, (int)$response['result']);

        $this->assertArrayHasKey('data', $response);
    }
    
    /**
     * Assert that a xml response is a negative and data
     *
     * @param string $response xml encoded string
     */
    public function assertNegativeXmlResponse($response)
    {
        $this->assertNotEmpty($response);
        
	$root = new SimpleXMLElement($response);
        $this->assertSame(0, (int)$root->result[0]);
    }
    
    /**
     * Assert that a xml response is a positive and data
     *
     * @param string $response xml encoded string
     */
    public function assertPositiveXmlResponse($response)
    {
        $this->assertNotEmpty($response);
        
	$root = new SimpleXMLElement($response);
        $this->assertSame(1, (int)$root->result[0]);
    }



}
