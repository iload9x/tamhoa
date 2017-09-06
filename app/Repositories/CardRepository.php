<?php

namespace App\Repositories;

use App\Card;
use Auth;

class CardRepository
{
  private $config;

  public function __construct() {
    $this->config = array(
      "URLPAYMENT" => "http://megapay.com.vn:8080/megapay_server?",
      "PROCESSING_CODE" => "10002",
      "PROJECT_ID" => "82814",
      "USER_NAME" => "wapa2pro@gmail.com",
      "ACCOUNT" => "iload9x",
      "PAYMENT_CHANNEL" => "1"
    );
  }

  public function latest() {
    return Card::latest();
  }

  public function find_by($colunm, $value) {
    return Card::where($colunm, $value)->first();
  }

  public function latest_paginate($per_page = 10) {
    return $this->latest()->paginate($per_page, ["*"], "card_page");
  }

  public function whereBetween($colunm, $value) {
    return Card::whereBetween($colunm, $value);
  }

  public function create($user, $card) {
    $user->cards()->save(new Card([
      "serial" => $card["serial"],
      "pin" => $card["pin"],
      "amount" => $card["amount"],
      "telcocode" => $card["telcocode"],
      "coin" => $this->rate_coin($card["amount"])
    ]));

    $user->update_coin($this->rate_coin($card["amount"]));
  }

  public function rate_coin($amount = 0) {
    return 10 * $amount;
  }

  // payment -------------------------
  public function charging($card_info) {
    $info["cardSerial"] = $card_info["serial"];
    $info["cardPin"] = $card_info["pin"];
    $info["telcoCode"] = $card_info["telcocode"];
    
    $project_id = $this->config["PROJECT_ID"];
    $trans_id = $project_id . date("YmdHis") . rand(1, 99999);
    $payment_data = array(
      "serial" => $info["cardSerial"],
      "mpin" => $info["cardPin"],
      "transid" => $trans_id,
      "telcocode" => $info["telcoCode"],
      "username" => $this->config["USER_NAME"],
      "payment_channel" => $this->config["PAYMENT_CHANNEL"]
    );
    
    $send_payment_info = array(
      "processing_code" => $this->config["PROCESSING_CODE"],
      "project_id" => $this->config["PROJECT_ID"],
      "data" => json_encode($payment_data)
    );

    $url = $this->config["URLPAYMENT"];
    $url = $url . urlencode("request=" . json_encode($send_payment_info));
    $response = $this->get_curl($url);  
    if($response){
      $json = json_decode($response, true);
      $data = json_decode($json["data"], true);
      $status = $json["status"];
      // $status = "00";
      // $data["payment_amount"] = 20000;

      if($status){
        if($status == "00") {
          return $data["payment_amount"];
        }
        return false;
      }
      return false;
    }
    return false;
  }
/*
   * function mã hóa chữ ký
   * author: Vu Dinh Phuong
   * date: 13/12/2016
   */
  private function signature_hash($transId, $config, $data)
  {
    return md5($config["partnerId"]."&".$data["cardSerial"]."&".$data["cardPin"]."&".$transId."&".$data["telcoCode"]."&".md5($config["password"]));
  }

  /*
   * function tạo mã giao dịch (transid) theo partner
   * author: Vu Dinh Phuong
   * date: 13/12/2016
   */
  private function get_transid($config)
  {
    return $config['partnerId'].'_'.date('YmdHis').'_'.rand(0, 999);
  }

  /*
   * function parse string response to Array
   * it make developer to easy to process
   * author: Vu Dinh Phuong
   * date: 27/03/2014
   */
  private function parseArray($response)
  {
    $return = array();
    $response = explode('&', $response);
    if(!empty($response)){
      foreach($response as $key => $value){
        $data = explode('=', $value);
        if(!empty($data[1])){
          $return[$data[0]] = $data[1];
        }
      }
      return $return;
    }else{
      return array();
    }
  }

  /*
   * function get curl
   * author: Vu Dinh Phuong
   * date: 13/12/2016
   */
  private function get_curl($url)
  {
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);

    $str = curl_exec($curl);
    if(empty($str)) $str = $this->curl_exec_follow($curl);
    curl_close($curl);

    return $str;
  }
  /*
   * function dùng curl gọi đến link
   * author: Vu Dinh Phuong
   * date: 13/12/2016
   */
  private function curl_exec_follow($ch, &$maxredirect = null)
  {
    $user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5)".
    " Gecko/20041107 Firefox/1.0";
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent );

    $mr = $maxredirect === null ? 5 : intval($maxredirect);

    if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {

      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $mr > 0);
      curl_setopt($ch, CURLOPT_MAXREDIRS, $mr);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    } else {

      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

      if ($mr > 0)
      {
        $original_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        $newurl = $original_url;

        $rch = curl_copy_handle($ch);

        curl_setopt($rch, CURLOPT_HEADER, true);
        curl_setopt($rch, CURLOPT_NOBODY, true);
        curl_setopt($rch, CURLOPT_FORBID_REUSE, false);
        do
        {
          curl_setopt($rch, CURLOPT_URL, $newurl);
          $header = curl_exec($rch);
          if (curl_errno($rch)) {
            $code = 0;
          } else {
            $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
            if ($code == 301 || $code == 302) {
              preg_match('/Location:(.*?)\n/', $header, $matches);
              $newurl = trim(array_pop($matches));

              if(!preg_match("/^https?:/i", $newurl)){
                $newurl = $original_url . $newurl;
              }
            } else {
              $code = 0;
            }
          }
        } while ($code && --$mr);

        curl_close($rch);

        if (!$mr)
        {
          if ($maxredirect === null)
            trigger_error('Too many redirects.', E_USER_WARNING);
          else
            $maxredirect = 0;

          return false;
        }
        curl_setopt($ch, CURLOPT_URL, $newurl);
      }
    }
    return curl_exec($ch);
  }
}
