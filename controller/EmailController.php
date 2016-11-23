<?php

class EmailController
{
    /**
     * Uloí zprávu do SESSION
     * @param type $message
     */
    private function setMessage($message)
    {
		$_SESSION['message'] = $message;
    }
	
    /**
     * Vrátí zprávu ze SESSION
     * @return string
     */
    public function getMessage()
    {
		if(isset($_SESSION['message']))
        {
			$message = $_SESSION['message'];
			unset($_SESSION['message']);
			return $message;
        }
        return '';
    }
	
    /**
     * Obnoví stránku a vyprázdní formuláø
     */
    private function redirect()
    {
		header('Location: ' . $_SERVER['PHP_SELF']);
		die;
    }
	
    /**
     * Oveøí jestli jsou data z formuláøe a pøedá je MailSenderu
     * Zobrazí zprávu o úsìšném odeslání nebo vyvolá vyjímku
     */
    public function send()
    {
		if(isset($_POST['text']))
		{
            try
			{
                $mailSender = new MailSender();
                $mailSender->validateEmail($_POST['email']);
                $mailSender->validateYear($_POST['year']);
                $mailSender->validateText($_POST['text']);
                $mailSender->sendMail('horak.tomas@mujmail.cz', 'Zpráva z webu', $_POST['text'], $_POST['email']);
				
                $this->setMessage('Váš Email byl úspìšnì odeslán.');
                $this->redirect();
			}
            
			catch (UserException $e)
			{
                $this->setMessage('Chyba: ' . $e->getMessage());
			}
		}
    }
	
    /**
     * Vypíše kontaktní formuláø
     */
    public function getForm()
    {
		include("view/kontakt.phtml");
		$message = $this->getMessage();
			if($message)
				{echo ("<p class='message'><strong>" . htmlspecialchars($message) . "</strong></p>");}
    }
}