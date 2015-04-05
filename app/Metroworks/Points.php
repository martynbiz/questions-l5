<?php namespace App\Metroworks;

use GuzzleHttp\Client;

class Points
{
    private $key = null;
    private $sharedsecret = null;
    
    private $login;
    private $password;
    
    protected $client;
    
    protected $allowedActions = array("ask", "answer", "upvote", "upvoted", "downvote");
    
    // /**
    //  * 
    //  */
    // public function __construct($client, $config)
    // {
    //     $this->client = $client;
    //     $this->key = $config['key'];
    // }
    
    /**
     * 
     */
    public function send( array $params )
    {
        // verify params
        if (!isset($params['login']))
            throw new Exception('login not set');
        
        if (!isset($params['site_action']))
            throw new Exception('site_action not set');
        
        if (!in_array($params['site_action'], $this->allowedActions))
            throw new Exception('Invalid site_action given');
        
        if (!isset($params['target_type'])) {
            throw new Exception('target_type not set');
        } else {
            // check the relevant id index is provided
            switch($params['target_type']) {
                case 'question':
                    if (!isset($params['question_id']))
                        throw new Exception('question_id not set');
                    break;
                case 'answer':
                    if (!isset($params['answer_id']))
                        throw new Exception('answer_id not set');
                    break;
                case 'votable':
                    if (!isset($params['votable_id']))
                        throw new Exception('votable_id not set');
                    break;
                default:
                    // wrong type
                    throw new Exception('Invalid target_type given');
            }
        }
        
        
        // make request
        
        $client = new Client();
        
        $params = array_merge($params, [
            'password' => '...', //self::encrypt( $this->password, $this->key ),
            'ss' => ',,,', //self::encrypt( $this->sharedsecret, $this->key )
        ]);
        
        $response = $client->post('http://httpbin.org/post?format=json', [
            'headers' => [
                'X-Requested-With' => 'XMLHttpRequest',
                'X-Application' => 'qa',
            ],
            'body' => $params,
        ]);
        
        return $response->json();
        
        
        
        
        // $this->login = $params['login'];
        
        // $params = array_merge($params, array(
        //     'login'  => $this->login,
        //     'password' => self::encrypt( $this->password, $this->key ),
        //     'ss' => self::encrypt( $this->sharedsecret, $this->key )
        // ));
        
        // $client = $this->client;
        
        // $client->setMethod(Zend_Http_Client::POST);
        // $client->setHeaders(array(
        //     
        // ));
        // $client->setParameterGet(array(
        //     'format' => 'json'
        // ));
        
        // $client->setParameterPost($params);
        // $response = $client->request( );
        
        // return $response->isSuccessful();
    }
    
    /*
     * This and the next one both shamelessly ripped from the JT code.
     */
    private static function encrypt($message, $key)
    {
        // Create initialization vector for the cipher
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CFB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);

        // Generate 32 characters prefix because with Rijndael, using a different
        // IV for the decryption, will cause the first 32 characters to be corrupted
        // "Rijndael can sync up on each block so only the first one (here, 256 bits
        // = 32 characters long) will be corrupted."
        // When decrypting, we will ignore the first 32 characters.
        $generator = new Text_Password();
        $prefix32 = $generator->create(32, 'unpronounceable', 'alphabetical');

        return mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $prefix32 . $message, MCRYPT_MODE_CFB, $iv);
    }
    
    /**
     * 
     */
    private static function decrypt($message, $key)
    {
        // Create initialization vector for the cipher
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CFB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);

        // Decrypt the message
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $message, MCRYPT_MODE_CFB, $iv);

        // The first 32 characters will be corrupted, so ignore this.
        return substr($decrypted, 32);
    }
}






































// class QA_Points
// {
//     protected $key = null;
//     // protected $url = null;
//     protected $sharedsecret = null;
//     protected $login;
//     protected $password;
    
//     protected $client;
    
//     protected $allowedActions = array("ask", "answer", "upvote", "upvoted", "downvote");
    
//     /**
//     * This takes the login etc for the points api
//     * @param Zend_Http_Client $client This is the Zend_Http_Client for the request to api
//     * @param arrray $options Required: login
//     */
//     public function __construct(Zend_Http_Client $client, $settings)
//     {
//         // set http client
//         $this->client = $client;
        
//         // set parameters
//         if(isset($settings['key']) and isset($settings['shared_secret'])) {
//             $this->key = $settings['key'];
//             // $this->url = $settings['url'];
//             $this->sharedSecret = $settings['shared_secret'];
//         }
        
//         $this->password = (isset($settings['password'])) ? $settings['password'] : null;
//     }
    
//     // public function award( Question $question )
//     // {
//     //     $httpResponse = $this->pointsRequest(array(
//     //         'action' => 'award',
//     //         'question_id' => $question->id
//     //     ));
        
//     //     if( $httpResponse->isSuccessful() )
//     //         return true;
//     //     return false;
//     // }
    
//     // public function purchase( $amount, $note )
//     // {
//     //     $httpResponse = $this->pointsRequest(array(
//     //         'action' => 'purchase',
//     //         'amount' => $amount,
//     //         'note' => $note
//     //     ));
        
//     //     if( $httpResponse->isSuccessful() )
//     //         return true;
//     //     return false;
//     // }
    
//     // public function getBalance()
//     // {
//     //     $httpResponse = $this->pointsRequest(array(
//     //         'action' => 'checkbalance',
//     //         'amount' => '0'
//     //     ));
        
//     //     if( $httpResponse->isSuccessful() ) {
//     //         $body = $httpResponse->getBody();
//     //         $obj = json_decode($body);
//     //         $account = $obj->account;

//     //         return $account->balance;
//     //     } else {
//     //         return null;
//     //     }
//     // }
    
//     // public function login()
//     // {
//     //     $httpResponse = $this->pointsRequest(array(
//     //         'action' => 'login'
//     //     ));
        
//     //     if( $httpResponse->isSuccessful() )
//     //         return true;
//     //     return false;
//     // }
    
//     public function send($params)
//     {
//         // verify params
//         if (!isset($params['login']))
//             throw new Exception('login not set');
        
//         if (!isset($params['site_action']))
//             throw new Exception('site_action not set');
        
//         if (!in_array($params['site_action'], $this->allowedActions))
//             throw new Exception('Invalid site_action given');
        
//         if (!isset($params['target_type'])) {
//             throw new Exception('target_type not set');
//         } else {
//             // check the relevant id index is provided
//             switch($params['target_type']) {
//                 case 'question':
//                     if (!isset($params['question_id']))
//                         throw new Exception('question_id not set');
//                     break;
//                 case 'answer':
//                     if (!isset($params['answer_id']))
//                         throw new Exception('answer_id not set');
//                     break;
//                 case 'votable':
//                     if (!isset($params['votable_id']))
//                         throw new Exception('votable_id not set');
//                     break;
//                 default:
//                     // wrong type
//                     throw new Exception('Invalid target_type given');
//             }
//         }
        
//         if (!isset($params['target_type']))
//             throw new Exception('site_action not set');
        
//         // set default params, and login params
//         $params = array_merge(array(
//             // 'login' => 'martyn',
//             // 'site_action' => 'action',
//             // 'target_type' => 'question',
//             // '{target_type}_id' => 1,
//             'action' => 'custom',
//         ), $params, array(
//             // 'login'  => $params['login'],
//             'password' => self::encrypt( $this->password, $this->key ),
//             'ss' => self::encrypt( $this->sharedsecret, $this->key ),
//         ));
        
//         // send
//         $this->client->setMethod('POST');
//         $this->client->setHeaders(array(
//             'X-Requested-With' => 'XMLHttpRequest',
//             'X-Application' => 'qa'
//         ));
//         $this->client->setParameterGet(array(
//             'format' => 'json'
//         ));
//         $this->client->setParameterPost($params);
        
//         var_dump($this->key); exit;
        
//         $response = $this->client->request();
//         var_dump($response->getBody()); exit;
//         return $response->isSuccessful();
//     }
    
//     // public function __call( $action, $params )
//     // {
//     //     if(strpos($action,"report")===0) $action = strtolower(substr($action,6)); //reportLogin => login
        
//     //     $allowed_actions = array("ask", "answer", "upvote", "upvoted", "downvote");
//     //     $allowed_objects = array("Question", "Answer");
//     //     if (!in_array($action, $allowed_actions))
//     //         throw new Exception('Method ' . $action . ' not exists');
        
//     //     $request = array(
//     //         'action' => 'custom',
//     //         'site_action' => $action
//     //     );
        
//     //     $object = $params ? $params[0] : null; // should it allow multiple objects?
//     //     if (in_array(get_class($object), $allowed_objects)) {
//     //         $request['target_type'] = strtolower(get_class($object));
//     //         $request[strtolower(get_class($object)).'_id'] = $object->id;
//     //     }
        
//     //     $httpResponse = $this->pointsRequest($request);
        
//     //     return $httpResponse->isSuccessful();
//     // }
    
    
    
    
    
    
//     // public static function isConfigured()
//     // {
//     //     if( is_null($this->key) ||
//     //         is_null($this->url) || 
//     //         is_null($this->url) )
//     //     {
//     //         return false;
//     //     }
//     //     return true;
//     // }
    
    
    
    
//     /*
//      * Private Functions
//      */
//     // private function pointsRequest( array $params )
//     // {
//     //     $params = array_merge($params, array(
//     //         'login'  => $this->login,
//     //         'password' => self::encrypt( $this->password, $this->key ),
//     //         'ss' => self::encrypt( $this->sharedSecret, $this->key )
//     //     ));
        
//     //     $client = new Zend_Http_Client(
//     //         $this->url
//     //     );
//     //     $client->setMethod(Zend_Http_Client::POST);
//     //     $client->setHeaders(array(
//     //         'X-Requested-With' => 'XMLHttpRequest',
//     //         'X-Application' => 'qa'
//     //     ));
//     //     $client->setParameterGet(array(
//     //         'format' => 'json'
//     //     ));
//     //     $client->setParameterPost($params);
//     //     return $client->request();
//     // }
    
//     /*
//      * This and the next one both shamelessly ripped from the JT code.
//      */
//     public static function encrypt($message, $key)
//     {
//         // Create initialization vector for the cipher
//         $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CFB);
//         $iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);

//         // Generate 32 characters prefix because with Rijndael, using a different
//         // IV for the decryption, will cause the first 32 characters to be corrupted
//         // "Rijndael can sync up on each block so only the first one (here, 256 bits
//         // = 32 characters long) will be corrupted."
//         // When decrypting, we will ignore the first 32 characters.
//         $generator = new QA_TextPassword();
//         $prefix32 = $generator->create(32, 'unpronounceable', 'alphabetical');

//         return mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $prefix32 . $message, MCRYPT_MODE_CFB, $iv);
//     }

//     public static function decrypt($message, $key)
//     {
//         // Create initialization vector for the cipher
//         $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CFB);
//         $iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);

//         // Decrypt the message
//         $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $message, MCRYPT_MODE_CFB, $iv);

//         // The first 32 characters will be corrupted, so ignore this.
//         return substr($decrypted, 32);
//     }
// }    
