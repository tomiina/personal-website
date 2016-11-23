<?php

class MailSender
{
    /**
     * Ode�le email
     * @param type $to Emailov� adresa adres�ta
     * @param type $subject P�edm�t zpr�vy
     * @param type $text Text zpr�vy
     * @param type $from Emailov� adresa odes�latele
     * @throws UserException
     */
    public function sendMail($to, $subject, $text, $from)
	{
        $header = "From: " . $from;
        $header .= "\nMIME-Version: 1.0\n";
        $header .= "Content-Type: text/html; charset=\"utf-8\"\n";
		if (!mail($to, $subject, $text, $from))
            {throw new UserException('Email se nepoda�ilo odeslat.');}
	}
	
    /**
     * Ov��� form�t emailov� adresy
     * @param type $email
     * @throws UserException
     */
    public function validateEmail($email)
    {
        if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/u", $email))
            {throw new UserException('Emailov� adresa mus� m�t form�t jmeno@domena.cz.');}
    }

    /**
     * Ov��� rok
     * @param type $year
     * @throws UserException
     */
    public function validateYear($year)
    {
        if ($year != date("Y"))
            {throw new UserException('�patn� vypln�n� rok.');}
    }

    /**
     * Ov��� jestli je vypln�na zpr�va
     * @param type $text
     * @throws UserException
     */
    public function validateText($text)
    {
        if (!$text)
            {throw new UserException('Zpr�va mus� b�t vypln�na.');}
    }
}