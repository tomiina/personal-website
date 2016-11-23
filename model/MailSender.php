<?php

class MailSender
{
    /**
     * Odešle email
     * @param type $to Emailová adresa adresáta
     * @param type $subject Pøedmìt zprávy
     * @param type $text Text zprávy
     * @param type $from Emailová adresa odesílatele
     * @throws UserException
     */
    public function sendMail($to, $subject, $text, $from)
	{
        $header = "From: " . $from;
        $header .= "\nMIME-Version: 1.0\n";
        $header .= "Content-Type: text/html; charset=\"utf-8\"\n";
		if (!mail($to, $subject, $text, $from))
            {throw new UserException('Email se nepodaøilo odeslat.');}
	}
	
    /**
     * Ovìøí formát emailové adresy
     * @param type $email
     * @throws UserException
     */
    public function validateEmail($email)
    {
        if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/u", $email))
            {throw new UserException('Emailová adresa musí mít formát jmeno@domena.cz.');}
    }

    /**
     * Ovìøí rok
     * @param type $year
     * @throws UserException
     */
    public function validateYear($year)
    {
        if ($year != date("Y"))
            {throw new UserException('Špatnì vyplnìný rok.');}
    }

    /**
     * Ovìøí jestli je vyplnìna zpráva
     * @param type $text
     * @throws UserException
     */
    public function validateText($text)
    {
        if (!$text)
            {throw new UserException('Zpráva musí být vyplnìna.');}
    }
}