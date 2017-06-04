<?php defined('BASEPATH') OR exit('No direct script access allowed');



// SDK for create bot

        use \LINE\LINEBot;

        use \LINE\LINEBot\HTTPClient\CurlHTTPClient;



// SDK for build message

        use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

        use \LINE\LINEBot\MessageBuilder\StickerMessageBuilder;

        use \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;



// SDK for build button and template action

        use \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;

        use \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;



class Webhook extends CI_Controller {


    private $events;

    private $signature;


    private $bot;

    private $user;


    function __construct()

    {

        parent::__construct();

        $this->load->model('tebakkode_m');

    }


    public function index()

    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            echo "Hello Coders!";

            header('HTTP/1.1 400 Only POST method allowed');

            exit;

        }


        // get request

        $body = file_get_contents('php://input');

        $this->signature = isset($_SERVER['HTTP_X_LINE_SIGNATURE'])

                ? $_SERVER['HTTP_X_LINE_SIGNATURE']

                : "-";

        $this->events = json_decode($body, true);


        $this->tebakkode_m->log_events($this->signature, $body);

    }

}
