<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T13:37:29+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-02T01:32:32+07:00

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('level_model');
        $this->load->model('user_model');
        $this->load->model('front_slider_model');
        $this->load->model('information_model');

        $this->layout = 'template/frontend';
    }

    public function index()
    {
        $data['front_slider'] = $this->front_slider_model->all();
        $data['product_category'] = get_data_curl(base_url('api/product/get_list_product_category'));
        $data['promo_slider']     = get_data_curl(base_url('api/promo/get_promo'))->DATA;
        $post_new_arrival = array(
            'ARR_ORDER' => 'product.id DESC',
            'LIMIT_START' => 0,
            'LIMIT_END' => 4
        );
        $data['product_new_arrival'] = get_data_curl(base_url('api/product/get_product'), $post_new_arrival);
        $data['product_best_seller'] = get_data_curl(base_url('api/product/get_best_seller'), ['LIMIT' => 4]);
        $data['product_special_offer'] = get_data_curl(base_url('api/product/get_special_offer'));
        $data['information'] = $this->information_model->all();
        $this->_container_fluid = false;
        $this->render('index', $data);
    }

    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->session->userdata('id_user') && $this->session->userdata('level') == 3) {
            $level = $this->level_model->first(3);
            if($level) {
                redirect($level->redirect);
            } else {
                show_404();
            }
        }

        if ($this->form_validation->run() == false) {
            $this->render('login');
        } else {
            $post = array(
                'EMAIL' => $this->input->post('email', true),
                'PASSWORD' => $this->input->post('password', true)
            );
            $result = get_data_curl(base_url('api/general/login'), $post);

            if($result->STATUS == 'SUCCESS') {
                $data = array(
                    'email' => $this->input->post('email', true),
                    'password' => sha1($this->input->post('password', true))
                );
                $validate = $this->user_model->validate($data);
                if ($validate != false) {
                    if ($validate->id_level == 3) {
                        $sess = array(
                            'id_user' => $validate->id,
                            'level' => $validate->id_level,
                            'status' => $validate->status
                        );
                        $this->session->set_userdata($sess);
                        $level = $this->level_model->first($validate->id_level);

                        if($level) {
                            if ($this->session->userdata('redirect')) {
                                $redirect_session = $this->session->userdata('redirect');
                                $this->session->unset_userdata('redirect');
                                redirect($redirect_session);
                            } else {
                                redirect($level->redirect);
                            }
                        } else {
                            show_404();
                        }
                    } else {
                        $this->session->set_flashdata('message', array('message' => 'You\'re not authorized here', 'class' => 'alert-danger' ));
                        redirect('login');
                    }
                }
            } else {
                $this->session->set_flashdata('message', array('message' => ucwords(strtolower($result->MESSAGE)), 'class' => ($result->STATUS == 'SUCCESS' ? 'alert-success' : 'alert-danger') ));
                redirect('login');
            }
        }
    }

    public function login_admin()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == false) {
            $this->render('login_admin');
        } else {
            $post = array(
                'EMAIL' => $this->input->post('email', true),
                'PASSWORD' => $this->input->post('password', true)
            );
            $result = get_data_curl(base_url('api/general/login'), $post);

            if($result->STATUS == 'SUCCESS') {
                $data = array(
                    'email' => $this->input->post('email', true),
                    'password' => sha1($this->input->post('password', true))
                );
                $validate = $this->user_model->validate($data);
                if ($validate != false) {

                    if ($validate->id_level != 3) {
                        $sess = array(
                            'id_user' => $validate->id,
                            'level' => $validate->id_level,
                            'status' => $validate->status
                        );
                        $this->session->set_userdata($sess);
                        $level = $this->level_model->first($validate->id_level);

                        if($level) {
                            redirect($level->redirect);
                        } else {
                            show_404();
                        }
                    } else {
                        $this->session->set_flashdata('message', array('message' => 'You\'re not authorized here', 'class' => 'alert-danger' ));
                        redirect('admin/login');
                    }
                }
            } else {
                $this->session->set_flashdata('message', array('message' => ucwords(strtolower($result->MESSAGE)), 'class' => ($result->STATUS == 'SUCCESS' ? 'alert-success' : 'alert-danger') ));
                redirect('admin/login');
            }
        }
    }

    public function loginSosmed()
    {
        $type   = $this->input->get('type');
        switch ($type) {
            case 'facebook':
                require_once APPPATH.'libraries/auth/platforms/facebook-app/facebook-sdk-v5/autoload.php';
                
                $fb = new Facebook\Facebook([
                    'app_id' => "771315916357629",
                    'app_secret' => "60c34819dbf9922240231c1b4f8e748d",
                    'default_graph_version' => 'v2.5'
                ]);
                $helper         = $fb->getRedirectLoginHelper();

                try {
                    $accessToken = $helper->getAccessToken();
                } catch(Facebook\Exceptions\FacebookResponseException $e) {
                    // When Graph returns an error
                    echo '1. Graph returned an error: ' . $e->getMessage();
                    exit;
                } catch(Facebook\Exceptions\FacebookSDKException $e) {
                    // When validation fails or other local issues
                    echo '2. Facebook SDK returned an error: ' . $e->getMessage();
                    exit;
                }

                if (isset($accessToken)) { // is login
                    try {
                        // Returns a `Facebook\FacebookResponse` object
                        $response = $fb->get('/me?fields=id,name,email,gender,verified', $accessToken);
                    } catch(Facebook\Exceptions\FacebookResponseException $e) {
                        echo '3. Graph returned an error: ' . $e->getMessage();
                        exit;
                    } catch(Facebook\Exceptions\FacebookSDKException $e) {
                        echo '4. Facebook SDK returned an error: ' . $e->getMessage();
                        exit;
                    }

                    $user   = $response->getGraphUser();

                    if ($user) {
                        $data = array(
                            'email' => $user['email'],
                        );
                        $validate = $this->user_model->validate($data);

                        if ($validate != false) {
                            if ($validate->id_level == 3) {
                                $sess = array(
                                    'id_user' => $validate->id,
                                    'level' => $validate->id_level,
                                    'status' => $validate->status
                                );
                                $this->session->set_userdata($sess);
                                $level = $this->level_model->first($validate->id_level);

                                if($level) {
                                    if ($this->session->userdata('redirect')) {
                                        $redirect_session = $this->session->userdata('redirect');
                                        $this->session->unset_userdata('redirect');
                                        redirect($redirect_session);
                                    } else {
                                        redirect($level->redirect);
                                    }
                                } else {
                                    show_404();
                                }
                            } else {
                                $this->session->set_flashdata('message', array('message' => 'You\'re not authorized here', 'class' => 'alert-danger' ));
                                redirect('login');
                            }
                        } else {

                            $this->load->helper('string');
                            $token_user = strtolower(random_string('alnum', 40));
                            $new_password = random_string('nozero', 8);

                            // New User
                            $data = [
                                'id_user_category' => 0,
                                'oauth_uid' => '',
                                'oauth_provider' => 0,
                                'email' => $user['email'],
                                'password' => sha1($new_password),
                                'name' => $user['name'],
                                'notification' => 0,
                                'user_token' => $token_user,
                                'id_level' => 3,
                                'status' => '1',
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ];
                            $insert = $this->db->insert('user', $data);
                            if ($insert) {

                                $data_mail['username'] = $user['email'];
                                $data_mail['password'] = $new_password;

                                /* Send Email */
                                $config = array(
                                    'protocol' => trim($this->config->item('mail_protocol')),
                                    'smtp_host' => trim($this->config->item('mail_smtp_host')),
                                    'smtp_port' => trim($this->config->item('mail_smtp_port')),
                                    'smtp_user' => trim($this->config->item('mail_smtp_user')),
                                    'smtp_pass' => trim($this->config->item('mail_smtp_pass')),
                                    'mailtype' => 'html',
                                    'validate' => TRUE,
                                    'smtp_crypto' => 'ssl',
                                    'newline'   => "\r\n"
                                );

                                $this->load->library('email', $config);

                                $mail_support = $this->config->item('mail_support');
                                $mail_support_name = $this->config->item('mail_support_name');

                                $this->email->from($mail_support, $mail_support_name);
                                $this->email->to($user['email']);
                                $this->email->subject('New Account Information');

                                $template_new_user_socmed = $this->load->view('template/frontend/_new_user_socmed', $data_mail, true);

                                $this->email->message($template_new_user_socmed);
                                $this->email->send();

                                $sess = array(
                                    'id_user' => $this->db->insert_id(),
                                    'level' => 3,
                                    'status' => 1
                                );
                                $this->session->set_userdata($sess);
                                $level = $this->level_model->first(3);

                                if($level) {
                                    if ($this->session->userdata('redirect')) {
                                        $redirect_session = $this->session->userdata('redirect');
                                        $this->session->unset_userdata('redirect');
                                        redirect($redirect_session);
                                    } else {
                                        redirect($level->redirect);
                                    }
                                } else {
                                    show_404();
                                }
                            }                        
                        }
                    }
                    //$auth   = $this->validateUser($user);
                    
                }else{ // not login

                    $permissions    = ['email']; // optional
                    $loginUrl       = $helper->getLoginUrl(site_url('login-sosmed?type=facebook'), $permissions);
                    redirect($loginUrl);
                }
                
            break;
            case 'twitter':
                require_once APPPATH.'libraries/auth/platforms/twitter-app/twitteroauth/twitteroauth.php';
                $tt_key     = "Rutec7IdV2XCohCWAqO9ARKIH";
                $tt_secret  = "EHO8eVW3Ao4AXWnBIfh0Q1kU8A6T4PaZxSh9MEjFG55PbfBm1i";
                if ( isset($_SESSION['oauth_token']) && isset($_SESSION['oauth_token_secret']) ) {

                    /* If the oauth_token is old redirect to the connect page. */
                    if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
                        $_SESSION['oauth_status'] = 'oldtoken';
                        redirect(site_url('logout'));
                    }
                    
                    /* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
                    $connection = new TwitterOAuth($tt_key, $tt_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

                    /* Save the access tokens. Normally these would be saved in a database for future use. */
                    $_SESSION['access_token'] = $connection->getAccessToken($_REQUEST['oauth_verifier']);

                    /* Remove no longer needed request tokens */
                    unset($_SESSION['oauth_token']);
                    unset($_SESSION['oauth_token_secret']);

                    /* If HTTP response is 200 continue otherwise send to connect page to retry */
                    if (200 == $connection->http_code) {

                        /* Create a TwitterOauth object with consumer/user tokens. */
                        $connection = new TwitterOAuth($tt_key, $tt_secret, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);

                        /* If method is set change API call made. Test is called by default. */
                        $params = array('include_email' => 'true', 'include_entities' => 'false', 'skip_status' => 'true');
                        $user   = $connection->get('account/verify_credentials',$params);
                        $auth   = $this->validateUser((array)$user);

                    } else {
                        /* Save HTTP status for error dialog on connnect page.*/
                        redirect(site_url('logout'));
                    }

                }
                else {

                    $connection     = new TwitterOAuth($tt_key, $tt_secret);
                    /* Get temporary credentials. */
                    $request_token  = $connection->getRequestToken(site_url('login-sosmed?type=twitter'));

                    /* Save temporary credentials to session. */
                    $_SESSION['oauth_token']        = $token = $request_token['oauth_token'];
                    $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
                     
                    /* If last connection failed don't display authorization link. */
                    switch ($connection->http_code) {
                        case 200:
                            /* Build authorize URL and redirect user to Twitter. */
                            $url = $connection->getAuthorizeURL($token);
                            redirect($url);
                        break;
                        default:
                            /* Show notification if something went wrong. */
                            echo 'Could not connect to Twitter. Refresh the page or try again later.';
                    }

                }
            break;
            case 'google':
                require_once APPPATH.'libraries/Google/autoload.php';
                $client_id = '922054655048-ba74sud5cnp6mou0338evhf37c7t41s4.apps.googleusercontent.com'; 
                $client_secret = 'U70zqnBmOQ13ktjky9YyjM07';
                $redirect_uri = 'http://codelabs.id/karuizawa/login-sosmed?type=google';

                $client = new Google_Client();
                $client->setAccessType('online');
                $client->setClientId($client_id);
                $client->setClientSecret($client_secret);
                $client->setRedirectUri($redirect_uri);
                $client->addScope("email");
                $client->addScope("profile");

                $service = new Google_Service_Oauth2($client);

                if (isset($_GET['code'])) {
                    $client->authenticate($_GET['code']);
                    $_SESSION['access_token'] = $client->getAccessToken();

                    $user = $service->userinfo->get();

                    if ($user) {
                        $data = array(
                            'email' => $user->email,
                        );
                        $validate = $this->user_model->validate($data);

                        if ($validate != false) {
                            if ($validate->id_level == 3) {
                                $sess = array(
                                    'id_user' => $validate->id,
                                    'level' => $validate->id_level,
                                    'status' => $validate->status
                                );
                                $this->session->set_userdata($sess);
                                $level = $this->level_model->first($validate->id_level);

                                if($level) {
                                    if ($this->session->userdata('redirect')) {
                                        $redirect_session = $this->session->userdata('redirect');
                                        $this->session->unset_userdata('redirect');
                                        redirect($redirect_session);
                                    } else {
                                        redirect($level->redirect);
                                    }
                                } else {
                                    show_404();
                                }
                            } else {
                                $this->session->set_flashdata('message', array('message' => 'You\'re not authorized here', 'class' => 'alert-danger' ));
                                redirect('login');
                            }
                        } else {

                            $this->load->helper('string');
                            $token_user = strtolower(random_string('alnum', 40));
                            $new_password = random_string('nozero', 8);

                            // New User
                            $data = [
                                'id_user_category' => 0,
                                'oauth_uid' => '',
                                'oauth_provider' => 0,
                                'email' => $user->email,
                                'password' => sha1($new_password),
                                'name' => $user->givenName.' '.$user->familyName,
                                'notification' => 0,
                                'user_token' => $token_user,
                                'id_level' => 3,
                                'status' => '1',
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ];
                            $insert = $this->db->insert('user', $data);
                            if ($insert) {

                                $data_mail['username'] = $user->email;
                                $data_mail['password'] = $new_password;

                                /* Send Email */
                                $config = array(
                                    'protocol' => trim($this->config->item('mail_protocol')),
                                    'smtp_host' => trim($this->config->item('mail_smtp_host')),
                                    'smtp_port' => trim($this->config->item('mail_smtp_port')),
                                    'smtp_user' => trim($this->config->item('mail_smtp_user')),
                                    'smtp_pass' => trim($this->config->item('mail_smtp_pass')),
                                    'mailtype' => 'html',
                                    'validate' => TRUE,
                                    'smtp_crypto' => 'ssl',
                                    'newline'   => "\r\n"
                                );

                                $this->load->library('email', $config);

                                $mail_support = $this->config->item('mail_support');
                                $mail_support_name = $this->config->item('mail_support_name');

                                $this->email->from($mail_support, $mail_support_name);
                                $this->email->to($user->email);
                                $this->email->subject('New Account Information');

                                $template_new_user_socmed = $this->load->view('template/frontend/_new_user_socmed', $data_mail, true);

                                $this->email->message($template_new_user_socmed);
                                $this->email->send();

                                $sess = array(
                                    'id_user' => $this->db->insert_id(),
                                    'level' => 3,
                                    'status' => 1
                                );
                                $this->session->set_userdata($sess);
                                $level = $this->level_model->first(3);

                                if($level) {
                                    if ($this->session->userdata('redirect')) {
                                        $redirect_session = $this->session->userdata('redirect');
                                        $this->session->unset_userdata('redirect');
                                        redirect($redirect_session);
                                    } else {
                                        redirect($level->redirect);
                                    }
                                } else {
                                    show_404();
                                }
                            }
                        }
                    }
                }

                if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
                    $client->setAccessToken($_SESSION['access_token']);
                } else {
                    $authURL = $client->createAuthUrl();
                    header('Location: ' . filter_var($authURL, FILTER_SANITIZE_URL));
                }

            break;
            case 'yahoo':

                require_once APPPATH.'libraries/YahooOauth2.php';

                $client_id = 'dj0yJmk9MHhHSENvNW5SM3d2JmQ9WVdrOWRGSjZTM05OTlRJbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD0wOQ--'; 
                $client_secret = '6a3f2344911b016bc1c36025257bf77d318f810a';
                $redirect_uri = 'http://codelabs.id/karuizawa/login-sosmed?type=yahoo';

                $client = new YahooOAuth2();

                if (isset($_GET['code'])) {

                    $code = $_GET['code'];
                    $token = $client->get_access_token($client_id, $client_secret, $redirect_uri, $code);
                    $headers = array('Authorization: Bearer ' . $token);
                    $result = $client->fetch('https://social.yahooapis.com/v1/user/me/profile?format=json','','',$headers);
                    $result = json_decode($result);
                    
                    $result_data = [
                        'email' => $result->profile->emails[0]->handle,
                        'firstname' => $result->profile->givenName,
                        'lastname' => $result->profile->familyName,
                    ];

                    $data = array(
                        'email' => $result_data['email'],
                    );
                    $validate = $this->user_model->validate($data);

                    if ($validate != false) {
                        if ($validate->id_level == 3) {
                            $sess = array(
                                'id_user' => $validate->id,
                                'level' => $validate->id_level,
                                'status' => $validate->status
                            );
                            $this->session->set_userdata($sess);
                            $level = $this->level_model->first($validate->id_level);

                            if($level) {
                                if ($this->session->userdata('redirect')) {
                                    $redirect_session = $this->session->userdata('redirect');
                                    $this->session->unset_userdata('redirect');
                                    redirect($redirect_session);
                                } else {
                                    redirect($level->redirect);
                                }
                            } else {
                                show_404();
                            }
                        } else {
                            $this->session->set_flashdata('message', array('message' => 'You\'re not authorized here', 'class' => 'alert-danger' ));
                            redirect('login');
                        }
                    } else {

                        $this->load->helper('string');
                        $token_user = strtolower(random_string('alnum', 40));
                        $new_password = random_string('nozero', 8);

                        // New User
                        $data = [
                            'id_user_category' => 0,
                            'oauth_uid' => '',
                            'oauth_provider' => 0,
                            'email' => $result_data['email'],
                            'password' => sha1($new_password),
                            'name' => $result_data['firstname'].' '.$result_data['lastname'],
                            'notification' => 0,
                            'user_token' => $token_user,
                            'id_level' => 3,
                            'status' => '1',
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
                        $insert = $this->db->insert('user', $data);
                        if ($insert) {

                            $data_mail['username'] = $result_data['email'];
                            $data_mail['password'] = $new_password;

                            /* Send Email */
                            $config = array(
                                'protocol' => trim($this->config->item('mail_protocol')),
                                'smtp_host' => trim($this->config->item('mail_smtp_host')),
                                'smtp_port' => trim($this->config->item('mail_smtp_port')),
                                'smtp_user' => trim($this->config->item('mail_smtp_user')),
                                'smtp_pass' => trim($this->config->item('mail_smtp_pass')),
                                'mailtype' => 'html',
                                'validate' => TRUE,
                                'smtp_crypto' => 'ssl',
                                'newline'   => "\r\n"
                            );

                            $this->load->library('email', $config);

                            $mail_support = $this->config->item('mail_support');
                            $mail_support_name = $this->config->item('mail_support_name');

                            $this->email->from($mail_support, $mail_support_name);
                            $this->email->to($result_data['email']);
                            $this->email->subject('New Account Information');

                            $template_new_user_socmed = $this->load->view('template/frontend/_new_user_socmed', $data_mail, true);

                            $this->email->message($template_new_user_socmed);
                            $this->email->send();

                            $sess = array(
                                'id_user' => $this->db->insert_id(),
                                'level' => 3,
                                'status' => 1
                            );
                            $this->session->set_userdata($sess);
                            $level = $this->level_model->first(3);

                            if($level) {
                                if ($this->session->userdata('redirect')) {
                                    $redirect_session = $this->session->userdata('redirect');
                                    $this->session->unset_userdata('redirect');
                                    redirect($redirect_session);
                                } else {
                                    redirect($level->redirect);
                                }
                            } else {
                                show_404();
                            }
                        }
                    }

                } else {

                    header("HTTP/1.1 302 Found");
                    header("Location: " . $client->getAuthorizationURL($client_id, $redirect_uri));
                    exit;

                }

                /*
                require_once APPPATH.'libraries/OpenID/openid.php';

                try {

                    $openid = new LightOpenID($_SERVER['HTTP_HOST']);

                    if (!$openid->mode)
                    {
                        //The yahoo openid url
                        $openid->identity = 'https://me.yahoo.com';
                        
                        //Get additional yahoo account information about the user , name , email , country
                        $openid->required = array('contact/email' , 'namePerson/familyName' , 'namePerson/givenName' , 'pref/language' , 'contact/country/home'); 
                        
                        //start discovery
                        header('Location: ' . $openid->authUrl());

                    } else {
                        if ($openid->validate())
                        {
                            //User logged in
                            $d = $openid->getAttributes();
                            
                            //$first_name = $d['namePerson/first'];
                            //$last_name = $d['namePerson/last'];
                            $email = $d['contact/email'];
                            //$language_code = $d['pref/language'];
                            //$country_code = $d['contact/country/home'];
                            
                            $data = array(
                                'email' => $email ,
                            );
                            
                            //now signup/login the user.
                            print_r($d);die();
                        }
                    }

                } catch (ErrorException $e) {
                    echo $e->getMessage();
                }
                */
            break;
        }
    }

    public function validateUser($user)
    {
        $check_email_exists = $this->user_model->count(array('email' => $user['email']));
        if($check_email_exists == 0)
        {
            $data_save = array('name' => $user['name'],
                                'email' => $user['email'],
                                'phone' => "",
                                'password' => "",
                                'id_level' => '3', //member
                                'status' => '1', //active
                                'created_at' => $this->now
                            );
            $this->user_model->save($data_save);
            $this->validateUser($data_save);

        }else{

            $data_check = array('email' => $user['email']);
            $validate = $this->user_model->validate($data_check);
            if ($validate != false) {

                $data = array();
                $data = $validate;
                $data->user_token = sha1($validate->email.date("Ymd"));
                $this->user_model->edit(
                    $validate->id, array('user_token' => $data->user_token)
                );
                if($data) {
                    foreach($data as $key => $value) {
                        $newget[strtoupper($key)] = $value;
                    }
                    $datapi['STATUS'] = 'SUCCESS';
                    $datapi['MESSAGE'] = 'LOGIN SUCCESS';
                    $datapi['DATA'] = $newget;

                    $sess = array(
                        'id_user' => $validate->id,
                        'level' => $validate->id_level,
                        'status' => $validate->status
                    );
                    $this->session->set_userdata($sess);
                    $level = $this->level_model->first($validate->id_level);

                    if($level) {
                        redirect($level->redirect);
                    } else {
                        show_404();
                    }
                }

            }else{
                $this->session->set_flashdata('message', array('message' => ucwords("USER NOT FOUND"), 'class' => 'alert-danger'));
                redirect('login');
            }
        }
    }

    public function register() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'full name', 'required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'confirm password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('accept_term_service', 'accept the terms of service', 'required');

        if($this->form_validation->run() == false) {
            $this->render('register');
        } else {
            $post = array(
                'NAME' => $this->input->post('name', true),
                'EMAIL' => $this->input->post('email', true),
                'PHONE' => $this->input->post('phone', true),
                'PASSWORD' => $this->input->post('password', true),
                'CONFIRM_PASSWORD' => $this->input->post('confirm_password', true),
                'ACCEPT_TERMS_SERVICE' => $this->input->post('accept_term_service', true)
            );
            $result = get_data_curl(base_url('api/general/register'), $post);

            $this->session->set_flashdata('message', array('message' => $result->STATUS . '. ' . $result->MESSAGE, 'class' => ($result->STATUS == 'SUCCESS' ? 'alert-success' : 'alert-danger') ));
            redirect('register');
        }
    }

    public function forgot_password() {
        if(!$this->input->post()) {
            $this->render('forgot_password');
        } else {
            $data_post = array(
                'EMAIL' => $this->input->post('email', true)
            );
            $result = get_data_curl(base_url('api/user/forgot_password'), $data_post);

            $this->session->set_flashdata('message', array('message' => $result->MESSAGE, 'class' => ($result->STATUS == 'SUCCESS' ? 'alert-success' : 'alert-danger') ));
            redirect('forgot-password');
        }
    }

    public function reset_password($encrypt_id_user = null, $encrypt_generate_password = null) {
       
        $encrypt_id_user = $this->uri->segment(2);
        $encrypt_generate_password = $this->uri->segment(3);
        $decrypt_id_user = decrypt_text($encrypt_id_user);
        $decrypt_generate_password = decrypt_text($encrypt_generate_password);

        $this->load->model('user_model');
        $data_update = array(
            'password' => sha1($decrypt_generate_password)
        );
        $this->user_model->edit($decrypt_id_user, $data_update);
        $this->session->set_flashdata('message', array('message' => 'Password successfully changed. Please login using your email and your new password.', 'class' => 'alert-success' ));
        redirect('login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function subscribes() {
        if(!$this->input->post()) {
            $this->render('form_subscribes');
        } else {
            if ($this->input->post('email', true) && $this->input->post('email', true) != '') {
                $data_post = array(
                    'EMAIL' => $this->input->post('email', true)
                );
                $result = get_data_curl(base_url('api/general/subscribes'), $data_post);

                $this->session->set_flashdata('message', array('message' => $result->MESSAGE, 'class' => ($result->STATUS == 'SUCCESS' ? 'alert-success' : 'alert-danger') ));
                redirect('subscribes');
            } else {
                $this->session->set_flashdata('message', array('message' => 'Your email address is required', 'class' => 'alert-danger' ));
                redirect('subscribes');
            }
        }
    }
}
