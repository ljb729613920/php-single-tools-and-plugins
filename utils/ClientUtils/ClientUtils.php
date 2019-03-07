<?php
/**
 * User: jiabin
 * Date: 2019/3/7
 * Time: 16:26
 */

namespace Utils;


class ClientUtils {
    public $response = array();
    public $httpcode = 0;
    public $httperror = NULL;
    public $logs = array();
    public $url = NULL;
    public $agent = 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/535.2 (KHTML, like Gecko) Ubuntu/11.10 Chromium/15.0.874.106 Chrome/15.0.874.106 Safari/535.2';
    public $params = array();
    public $username = NULL;
    public $userpwd = NULL;
    public $dnsCache = TRUE;
    public $dnsCacheTime = 120;
    public $verifypeer = FALSE;
    public $timeout = 10000;
    public $maxredirs = 10;
    public $cookie = NULL;
    public $cookieFile = NULL;
    public $cookieJar = NULL;
    public $headers = NULL;
    // replace 'http://{:host}...' for binging ip & host
    public $ip = NULL;
    public $host = NULL;
    private $_curl, $_method;

    public function post()
    {
        $this->_method = 'post';
        $this->_exec();
    }

    public function get()
    {
        $this->_method = 'get';
        $this->_exec();
    }

    public function put()
    {
        $this->_method = 'put';
        $this->_exec();
    }

    public function delete()
    {
        $this->_method = 'delete';
        $this->_exec();
    }

    public function ping()
    {
        $this->_method = 'ping';
        $this->_exec();
        return $this->httpcode;
    }

    private function _exec()
    {
        $this->_curl = curl_init();
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->_curl, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($this->_curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($this->_curl, CURLOPT_USERAGENT, $this->agent);
        //curl_setopt($this->_curl, CURLOPT_DNS_USE_GLOBAL_CACHE, $this->dnsCache);
        curl_setopt($this->_curl, CURLOPT_DNS_CACHE_TIMEOUT, $this->dnsCacheTime);
        curl_setopt($this->_curl, CURLOPT_SSL_VERIFYPEER, $this->verifypeer);
        curl_setopt($this->_curl, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($this->_curl, CURLOPT_MAXREDIRS, $this->maxredirs);

        // cookie
        if ($this->cookie) {
            curl_setopt($this->_curl, CURLOPT_COOKIE, $this->cookie);
        }
        if ($this->cookieFile) {
            curl_setopt($this->_curl, CURLOPT_COOKIEFILE, $this->cookieFile);
        }
        if ($this->cookieJar) {
            curl_setopt($this->_curl, CURLOPT_COOKIEJAR, $this->cookieJar);
        }

        // http auth
        if ($this->username && $this->userpwd) {
            curl_setopt($this->_curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($this->_curl, CURLOPT_USERPWD, $this->username . ':' . $this->userpwd);
        }

        $arr = $this->params;
        $this->params = array();
        $this->_http_build_query_for_curl($arr, $this->params);
        switch ($this->_method) {
            case 'post':
                curl_setopt($this->_curl, CURLOPT_POST, TRUE);
                curl_setopt($this->_curl, CURLOPT_HTTPHEADER, $this->headers ? $this->headers : array("Content-type: multipart/form-data"));
                curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $this->params);
                break;
            case 'put':
                if ($this->headers) {
                    curl_setopt($this->_curl, CURLOPT_HTTPHEADER, $this->headers);
                }
                curl_setopt($this->_curl, CURLOPT_PUT, TRUE);
                $file = tmpFile();
                fwrite($file, $this->params);
                fseek($file, 0);
                curl_setopt($this->_curl, CURLOPT_INFILE, $file);
                curl_setopt($this->_curl, CURLOPT_INFILESIZE, strlen($this->params));
                break;
            case 'delete':
                if ($this->headers) {
                    curl_setopt($this->_curl, CURLOPT_HTTPHEADER, $this->headers);
                }
                curl_setopt($this->_curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
            default:
                $this->params = http_build_query($this->params);
                if ($this->params) {
                    $this->url .= (strpos($this->url, '?') ? '' : '?') . (substr($this->url, -1) == '&' ? '' : '&') . $this->params;
                }
                if ($this->headers) {
                    curl_setopt($this->_curl, CURLOPT_HTTPHEADER, $this->headers);
                }
                curl_setopt($this->_curl, CURLOPT_HTTPGET, TRUE);
                if ($this->_method == 'ping') {
                    curl_setopt($this->_curl, CURLOPT_NOBODY, TRUE);
                }
        }

        if ($this->_method != 'ping') {
            $this->_curlExecFollow();
        }

        if ($this->host && $this->ip) {
            $this->url = str_replace(':host', $this->ip, $this->url);
            curl_setopt($this->_curl, CURLOPT_HTTPHEADER, array('Host: ' . $this->host));
        }

        curl_setopt($this->_curl, CURLOPT_URL, $this->url);


        try {
            $this->response = curl_exec($this->_curl);
            $this->httpcode = curl_getinfo($this->_curl, CURLINFO_HTTP_CODE);
            $this->httperror = curl_error($this->_curl);
            curl_close($this->_curl);
        } catch (Exception $e) {
            $this->httpcode = 500;
            $this->httperror = $e;
        }

    }

    private function _curlExecFollow()
    {
        if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
            curl_setopt($this->_curl, CURLOPT_FOLLOWLOCATION, $this->maxredirs > 0);
            curl_setopt($this->_curl, CURLOPT_MAXREDIRS, $this->maxredirs);
        } else {
            curl_setopt($this->_curl, CURLOPT_FOLLOWLOCATION, FALSE);
            if ($this->maxredirs > 0) {
                $newurl = curl_getinfo($this->_curl, CURLINFO_EFFECTIVE_URL);

                $rch = curl_copy_handle($this->_curl);
                curl_setopt($rch, CURLOPT_HEADER, TRUE);
                curl_setopt($rch, CURLOPT_NOBODY, TRUE);
                curl_setopt($rch, CURLOPT_FORBID_REUSE, FALSE);
                curl_setopt($rch, CURLOPT_RETURNTRANSFER, TRUE);
                do {
                    curl_setopt($rch, CURLOPT_URL, $newurl);
                    $header = curl_exec($rch);
                    if (curl_errno($rch)) {
                        $code = 0;
                    } else {
                        $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
                        if ($code == 301 || $code == 302) {
                            $matches = array();
                            preg_match('/Location:(.*?)\n/', $header, $matches);
                            $newurl = trim(array_pop($matches));
                        } else {
                            $code = 0;
                        }
                    }
                } while ($code && --$this->maxredirs);
                curl_close($rch);
                if (!$this->maxredirs && ($code == 301 || $code == 302)) {
                    $this->_log('Too many redirects. When following redirects, libcurl hit the maximum amount.');
                    return FALSE;
                }

                curl_setopt($this->_curl, CURLOPT_URL, $newurl);
            }
        }
    }

    private function _log($msg)
    {
        $this->logs[] = $msg;
    }

    private function _http_build_query_for_curl($arrays, &$new = array(), $prefix = NULL)
    {
        if (is_object($arrays)) {
            $arrays = get_object_vars($arrays);
        }
        class_exists('Yii') && (Yii::$enableIncludePath = FALSE);
        if (is_array($arrays)) {
            foreach ($arrays AS $key => $value) {
                $k = isset($prefix) ? $prefix . '[' . $key . ']' : $key;
                if (is_array($value) OR is_object($value)) {
                    $this->_http_build_query_for_curl($value, $new, $k);
                } else {
                    if (0 === strpos($value, '@')) {
                        $file = substr($value, 1);
                        if (file_exists($file)) {
                            if (class_exists('CurlFile')) {
                                $new[$k] = new CurlFile($file, mime_content_type($file), basename($file));
                            } else {
                                $new[$k] = $value;
                            }
                        } else {
                            $new[$k] = '[@]' . $file;
                        }
                    } else {
                        $new[$k] = $value;
                    }
                }
            }
        } else {
            if (0 === strpos($arrays, '@')) {
                $file = substr($arrays, 1);
                if (file_exists($file)) {
                    if (class_exists('CurlFile')) {
                        $new = new CurlFile($file, mime_content_type($file), basename($file));
                    } else {
                        $new = $arrays;
                    }
                } else {
                    $new = '[@]' . $file;
                }
            } else {
                $new = $arrays;
            }
        }
        class_exists('Yii') && (Yii::$enableIncludePath = TRUE);
    }
}