<?php

class Turbosms extends Core
{
    public $auth;
    public $client;
    public $sms;

    public function __construct()
    {
        if (empty($this->auth)) {

            $this->auth = [
                'login'    => $this->config->turbosms_login,
                'password' => $this->config->turbosms_password,
            ];
        }

        $this
            ->setClient()
            ->auth();
    }

    /**
     * @param SoapClient $client
     */
    public function setClient()
    {
        $this->client = new SoapClient('http://turbosms.in.ua/api/wsdl.html');

        return $this;
    }

    /**
     * @return SoapClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return mixed
     */
    public function getSms()
    {
        return $this->sms;
    }

    /**
     * @param mixed $sms
     */
    public function setSms($sender, array $numbers, $text, $wappush = NULL)
    {
        $this->sms = [
            'sender'      => $sender,
            'destination' => implode(',', $numbers),
            'text'        => $text,
        ];

        if ($wappush) {

            $this->sms = array_merge($this->sms, [
                'wappush' => (string)$wappush,
            ]);
        }

        return $this;
    }

    public function auth()
    {
        $res = $this->client->Auth($this->auth);

        return $res->AuthResult;
    }

    public function getFunctions()
    {
        return $this->client->__getFunctions();
    }

    // Получаем количество доступных кредитов
    public function GetCreditBalance()
    {
        $res = $this->client->GetCreditBalance();

        return $res->GetCreditBalanceResult;
    }

    /**
     * Выводим результат отправки.
     * echo $result->SendSMSResult->ResultArray[0];
     *
     * ID первого сообщения
     * echo $result->SendSMSResult->ResultArray[1];
     *
     * ID второго сообщения
     * echo $result->SendSMSResult->ResultArray[2];
     */
    public function sendSMS()
    {
        return $this->client->SendSMS($this->sms);
    }

    // Запрашиваем статус конкретного сообщения по ID
    public function GetMessageStatus($messageId)
    {
        $res = $this->client->GetMessageStatus([
            'MessageId' => $messageId,
        ]);

        return $res->GetMessageStatusResult;
    }

    // Запрашиваем массив ID сообщений, у которых неизвестен статус отправки
    public function GetNewMessages()
    {
        $res = $this->client->GetNewMessages();

        // Есть сообщения
        if (!empty ($res->GetNewMessagesResult->ResultArray)) {

            $array = [];
            // Запрашиваем статус каждого сообщения по ID
            foreach ($res->GetNewMessagesResult->ResultArray as $msg_id) {
                $sms = ['MessageId' => $msg_id];
                $status = $this->client->GetMessageStatus($sms);

                $array[$msg_id] = $status->GetMessageStatusResult;
            }

            return $array;
        }
    }
}
