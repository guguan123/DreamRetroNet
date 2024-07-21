<?php
/**
 * Created by PhpStorm.
 * User: tao
 * Date: 2016-09-14
 * Time: 16:14
 */

class doHttps{
    public  $ch;
    function getdata($url){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HEADER,0);
        $temp = curl_exec($ch);
        if($temp === FALSE){
            return false;
        }
        $output = json_decode($temp,TRUE);
        return $output;
        curl_close($ch);
    }
}