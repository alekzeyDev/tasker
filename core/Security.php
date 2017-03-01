<?php

class Security extends Core
{
    public $captcha;

    public function __construct()
    {
        require __DIR__ . "/../vendor/captcha-com/captcha/lib/botdetect.php";

        $this->captcha = new \Captcha('MyCaptcha');
        $this->captcha->UserInputID = "CaptchaCode";
        $this->captcha->CodeStyle = \CodeStyle::Alphanumeric;
        $this->captcha->SoundEnabled = FALSE;
        $this->captcha->ReloadEnabled = FALSE;

        // override lib settings
        $LBD_CaptchaConfig = \CaptchaConfiguration::GetSettings();

        $LBD_CaptchaConfig->HandlerUrl = '/botdetect.php';
        $LBD_CaptchaConfig->HelpLinkEnabled = FALSE;
        $LBD_CaptchaConfig->RemoteScriptEnabled = FALSE;
        $LBD_CaptchaConfig->HelpLinkUrl = '';
    }
}
