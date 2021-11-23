<?php
/**
 * Telegram Bot Class.
 * @author MEPR
 */

class Telegram {
    private $bot_id  = "your_bot_id";
    private $data    = array();
    private $updates = array();
    /// Class constructor
    /**
     * Create a Telegram instance from the bot token
     * \param bot_id the bot token
     * \return an instance of the class
     */
    public function __construct($bot_id) {
        $this->bot_id = $bot_id;
        $this->data = $this->getData();
    }
    /// Do requests to Telegram Bot API
    /**
     * Contacts the various API's endpoints
     * \param api the API endpoint
     * \param $content the request parameters as array
     * \param $post boolean tells if $content needs to be sends
     * \return the JSON Telegram's reply
     */
    public function endpoint($api, array $content, $post = true) {
        $url = 'https://api.telegram.org/bot' . $this->bot_id . '/' . $api;
        if ($post)
            $reply = $this->sendAPIRequest($url, $content);
        else
            $reply = $this->sendAPIRequest($url, array(), false);
        return json_decode($reply, true);
    }

    public function getMe() {
        return $this->endpoint("getMe", array(), false);
    }
    public function sendMessage(array $content) {
        return $this->endpoint("sendMessage", $content);
    }

    public function forwardMessage(array $content) {
        return $this->endpoint("forwardMessage", $content);
    }
    public function sendPhoto(array $content) {
        return $this->endpoint("sendPhoto", $content);
    }
    public function sendAudio(array $content) {
        return $this->endpoint("sendAudio", $content);
    }
    public function sendDocument(array $content) {
        return $this->endpoint("sendDocument", $content);
    }
    public function sendSticker(array $content) {
        return $this->endpoint("sendSticker", $content);
    }
    public function sendVideo(array $content) {
        return $this->endpoint("sendVideo", $content);
    }
    public function sendVoice(array $content) {
        return $this->endpoint("sendVoice", $content);
    }
    public function sendLocation(array $content) {
        return $this->endpoint("sendLocation", $content);
    }
    public function sendVenue(array $content) {
        return $this->endpoint("sendVenue", $content);
    }
    public function sendContact(array $content) {
        return $this->endpoint("sendContact", $content);
    }
    public function sendChatAction(array $content) {
        return $this->endpoint("sendChatAction", $content);
    }
    public function getUserProfilePhotos(array $content) {
        return $this->endpoint("getUserProfilePhotos", $content);
    }
    public function getFile($file_id) {
        $content = array('file_id' => $file_id);
        return $this->endpoint("getFile", $content);
    }
    public function kickChatMember(array $content) {
        return $this->endpoint("kickChatMember", $content);
    }
    public function leaveChat(array $content) {
        return $this->endpoint("leaveChat", $content);
    }
        public function unbanChatMember(array $content) {
        return $this->endpoint("unbanChatMember", $content);
    }
    public function getChat(array $content) {
        return $this->endpoint("getChat", $content);
    }
    public function getChatAdministrators(array $content) {
        return $this->endpoint("getChatAdministrators", $content);
    }
    public function getChatMembersCount(array $content) {
        return $this->endpoint("getChatMembersCount", $content);
    }
    public function getChatMember(array $content) {
        return $this->endpoint("getChatMember", $content);
    }
    public function answerInlineQuery(array $content) {
        return $this->endpoint("answerInlineQuery", $content);
    }
    public function answerCallbackQuery(array $content) {
        return $this->endpoint("answerCallbackQuery", $content);
    }    
    public function editMessageText(array $content) {
        return $this->endpoint("editMessageText", $content);
    }
    public function editMessageCaption(array $content) {
        return $this->endpoint("editMessageCaption", $content);
    }
    public function editMessageReplyMarkup(array $content) {
        return $this->endpoint("editMessageReplyMarkup", $content);
    }
    public function downloadFile($telegram_file_path, $local_file_path) {
        $file_url = "https://api.telegram.org/file/bot" . $this->bot_id . "/" . $telegram_file_path;
        $in = fopen($file_url, "rb");
        $out = fopen($local_file_path, "wb");
        while ($chunk = fread($in, 8192)) {
            fwrite($out, $chunk, 8192);
        }
        fclose($in);
        fclose($out);
    }
    public function setWebhook($url, $certificate = "") {
        if ($certificate == "") {
            $content = array('url' => $url);
        } else {
            $content = array('url' => $url, 'certificate' => $certificate);
        }
        return $this->endpoint("setWebhook", $content);
    }
    public function getData() {
        if (empty($this->data)) {
            $rawData = file_get_contents("php://input");
            return json_decode($rawData, true);
        } else {
            return $this->data;
        }
    }
    /// Set the data currently used
    public function setData(array $data) {
        $this->data = $data;
    }
    /// Get the text of the current message
    /**
     * \return the String users's text
     */
    public function Text() {
        return $this->data["message"] ["text"];
    }
    /// Get the chat_id of the current message
    /**
     * \return the String users's chat_id
     */
    public function ChatID() {
        return $this->data["message"]["chat"]["id"];
    }
    /// Get the callback_query of the current update
    /**
     * \return the String callback_query
     */
    public function Callback_Query() {
        return $this->data["callback_query"];
    }
    /// Get the callback_query id of the current update
    /**
     * \return the String callback_query id
     */
    public function Callback_ID() {
        return $this->data["callback_query"]["id"];
    }
    /// Get the Get the data of the current callback
    /**
     * \return the String callback_data
     */
    public function Callback_Data() {
        return $this->data["callback_query"]["data"];
    }
    /// Get the Get the message of the current callback
    /**
     * \return the Message
     */
    public function Callback_Message() {
        return $this->data["callback_query"]["message"];
    }
    /// Get the Get the chati_id of the current callback
    /**
     * \return the String callback_query
     */
    public function Callback_ChatID() {
        return $this->data["callback_query"]["message"]["chat"]["id"];
    }
    /// Get the date of the current message
    /**
     * \return the String message's date
     */
    public function Date() {
        return $this->data["message"]["date"];
    }
    /// Get the first name of the user
    public function FirstName() {
        return $this->data["message"]["from"]["first_name"];
    }
/// Get the last name of the user
    public function LastName() {
        return $this->data["message"]["from"]["last_name"];
    }
/// Get the username of the user
    public function Username() {
        return $this->data["message"]["from"]["username"];
    }
/// Get the location in the message
    public function Location() {
        return $this->data["message"]["location"];
    }
/// Get the update_id of the message
    public function UpdateID() {
        return $this->data["update_id"];
    }
/// Get the number of updates
    public function UpdateCount() {
        return count($this->updates["result"]);
    }
    /// Get the first name of the user
    //public function MessageID() {
    //    return $this->data["message_id"];
    //}
    /// Tell if a message is from a group or user chat
    /**
     *  
     *  \return BOOLEAN true if the message is from a Group chat, false otherwise
     */
    public function messageFromGroup() {
        if ($this->data["message"]["chat"]["type"] == "private") {
            return false;
        }
        return true;
    }
    public function messageFromGroupTitle() {
        if ($this->data["message"]["chat"]["type"] != "private") {
            return $this->data["message"]["chat"]["title"];
        }
        return null;
    }
    /// Set a custom keyboard
    /** This object represents a custom keyboard with reply options
     * \param $options Array of Array of String; Array of button rows, each represented by an Array of Strings
     * \param $onetime Boolean Requests clients to hide the keyboard as soon as it's been used. Defaults to false.
     * \param $resize Boolean Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     * \param $selective Boolean Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * \return the requested keyboard as Json
     */
    public function buildKeyBoard(array $options, $onetime = false, $resize = false, $selective = true) {
        $replyMarkup = array(
            'keyboard' => $options,
            'one_time_keyboard' => $onetime,
            'resize_keyboard' => $resize,
            'selective' => $selective
        );
        $encodedMarkup = json_encode($replyMarkup, true);
        return $encodedMarkup;
    }
    /// Set an InlineKeyBoard
    /** This object represents an inline keyboard that appears right next to the message it belongs to.
     * \param $options Array of Array of InlineKeyboardButton; Array of button rows, each represented by an Array of InlineKeyboardButton
     * \return the requested keyboard as Json
     */
    public function buildInlineKeyBoard(array $options) {
        $replyMarkup = array(
            'inline_keyboard' => $options,
        );
        $encodedMarkup = json_encode($replyMarkup, true);
        return $encodedMarkup;
    }
    /// Create an InlineKeyboardButton
    /** This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
     * \param $text String; Array of button rows, each represented by an Array of Strings
     * \param $url String Optional. HTTP url to be opened when button is pressed
     * \param $callback_data String Optional. Data to be sent in a callback query to the bot when button is pressed
     * \param $switch_inline_query String Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot�s username and the specified inline query in the input field. Can be empty, in which case just the bot�s username will be inserted.
     * \return the requested button as Array
     */
    public function buildInlineKeyboardButton($text, $url = "", $callback_data = "", $switch_inline_query = "") {
        $replyMarkup = array(
            'text' => $text
        );
        if ($url != "") {
            $replyMarkup['url'] = $url;
        } else if ($callback_data != "") {
            $replyMarkup['callback_data'] = $callback_data;
        } else if ($switch_inline_query != "") {
            $replyMarkup['switch_inline_query'] = $switch_inline_query;
        }
        return $replyMarkup;
    }
    /// Create a KeyboardButton
    /** This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
     * \param $text String; Array of button rows, each represented by an Array of Strings
     * \param $request_contact Boolean Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only
     * \param $request_location Boolean Optional. If True, the user's current location will be sent when the button is pressed. Available in private chats only
     * \return the requested button as Array
     */
    public function buildKeyboardButton($text, $request_contact = false, $request_location = false) {
        $replyMarkup = array(
            'text' => $text,
            'request_contact' => $request_contact,
            'request_location' => $request_location
        );
        if ($url != "") {
            $replyMarkup['url'] = $url;
        } else if ($callback_data != "") {
            $replyMarkup['callback_data'] = $callback_data;
        } else if ($switch_inline_query != "") {
            $replyMarkup['switch_inline_query'] = $switch_inline_query;
        }
        return $replyMarkup;
    }
    /// Hide a custom keyboard
    /** Upon receiving a message with this object, Telegram clients will hide the current custom keyboard and display the default letter-keyboard. By default, custom keyboards are displayed until a new keyboard is sent by a bot. An exception is made for one-time keyboards that are hidden immediately after the user presses a button. 
     * \param $selective Boolean Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * \return the requested keyboard hide as Array
     */
    public function buildKeyBoardHide($selective = true) {
        $replyMarkup = array(
            'hide_keyboard' => true,
            'selective' => $selective
        );
        $encodedMarkup = json_encode($replyMarkup, true);
        return $encodedMarkup;
    }
    /// Display a reply interface to the user
    /* Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if the user has selected the bot�s message and tapped �Reply'). This can be extremely useful if you want to create user-friendly step-by-step interfaces without having to sacrifice privacy mode. 
     * \param $selective Boolean Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     * \return the requested force reply as Array
     */
    public function buildForceReply($selective = true) {
        $replyMarkup = array(
            'force_reply' => true,
            'selective' => $selective
        );
        $encodedMarkup = json_encode($replyMarkup, true);
        return $encodedMarkup;
    }
    /// Receive incoming messages using polling
    /** Use this method to receive incoming updates using long polling.
     * \param $offset Integer Identifier of the first update to be returned. Must be greater by one than the highest among the identifiers of previously received updates. By default, updates starting with the earliest unconfirmed update are returned. An update is considered confirmed as soon as getUpdates is called with an offset higher than its update_id.
     * \param $limit Integer Limits the number of updates to be retrieved. Values between 1�100 are accepted. Defaults to 100
     * \param $timeout Integer Timeout in seconds for long polling. Defaults to 0, i.e. usual short polling
     * \param $update Boolean If true updates the pending message list to the last update received. Default to true.
     * \return the updates as Array
     */
    public function getUpdates($offset = 0, $limit = 100, $timeout = 0, $update = true) {
        $content = array('offset' => $offset, 'limit' => $limit, 'timeout' => $timeout);
        $this->updates = $this->endpoint("getUpdates", $content);
        if ($update) {
            if(count($this->updates["result"]) >= 1) { //for CLI working.
                $last_element_id = $this->updates["result"][count($this->updates["result"]) - 1]["update_id"] + 1;
                $content = array('offset' => $last_element_id, 'limit' => "1", 'timeout' => $timeout);
                $this->endpoint("getUpdates", $content);
            }
        }
        return $this->updates;
    }
    /// Serve an update
    /** Use this method to use the bultin function like Text() or Username() on a specific update.
     * \param $update Integer The index of the update in the updates array.
     */
    public function serveUpdate($update) {
        $this->data = $this->updates["result"][$update];
    }
    private function sendAPIRequest($url, array $content, $post = true) {
        if (isset($content['chat_id'])) {
            $url = $url . "?chat_id=" . $content['chat_id'];
            unset($content['chat_id']);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_PROXY, 'your_proxy');
        curl_setopt($ch, CURLOPT_PROXYPORT, 'your_port');
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function apiRequestMedia($method, $idchat, $data) 
    {
        $chat_id = $idchat;
        //$bot_url = (API_URL);
        $url = 'https://api.telegram.org/bot' . $this->bot_id . '/' . $method . '?chat_id=' . $chat_id;
        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($ch, CURLOPT_PROXY, 'your_proxy');
        curl_setopt($ch, CURLOPT_PROXYPORT, 'your_port');
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    
}
// Helper for Uploading file using CURL
if (!function_exists('curl_file_create')) {
    function curl_file_create($filename, $mimetype = '', $postname = '') {
        return "@$filename;filename="
                . ($postname ? : basename($filename))
                . ($mimetype ? ";type=$mimetype" : '');
    }
}
?>