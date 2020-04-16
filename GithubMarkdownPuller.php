<?php
class GithubMarkdownPuller {

  public function get($github_url, $github_user_agent) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $github_url);
    curl_setopt($curl, CURLOPT_USERAGENT, $github_user_agent);
    curl_setopt($curl, CURLOPT_ENCODING, "");
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_ENCODING, "");
    $curl_data = curl_exec($curl);
    if(!($data = json_decode($curl_data))) {
      return $this -> json_error("curl failure ", 'curl returned:'.curl_error($curl));
      }
    curl_close($curl);
    return $data;
  }
  public function json_error($error, $error_description) {
    $error_types = array ('curl failure');
   if (array_search($error, $error_types) === false) {
     $bad = preg_replace('/[^a-zA-Z0-9_ -]/s','',$error);
     $output = ["error" => 'unknown error', "error_description" => "unknown code: $bad"];
     return json_encode($output);
     }
   $output = array("error" => $error, "error_description" => $error_description);
   return json_encode($output);
   }
}