<?php

namespace Dakele\Weather;

use GuzzleHttp\Client;
use Dakele\Weather\Exceptions\HttpException;
use Dakele\Weather\Exceptions\InvalidArgumentException;

class Ip{

    protected $key;

    protected $guzzleOptions = [];

    public function __construct($key)
    {
        $this->key=$key;
    }

    public function getHttpClient(){
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options){
        $this->guzzleOptions=$options;
    }

    /*获取ip
     * */
    public function getIp($ip=null,$format='json'){
        $url = 'https://restapi.amap.com/v3/ip?';

        if (!\in_array(\strtolower($format), ['xml', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: '.$format);
        }

        if (!\in_array(\strtolower($type), ['base', 'all'])) {
            throw new InvalidArgumentException('Invalid type value(base/all): '.$type);
        }



        $query=array_filter([
            'key'=>$this->key,
            'ip'=>$ip,
        ]);
        try{
            $response=$this->getHttpClient()->get($url,[
                'query'=>$query,
            ])->getBody()->getContents();
            return $response;
//            return 'json'===$format ? \json_encode($response,true):$response;
        }catch (\Exception $e){
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }

    }
}