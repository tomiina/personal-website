<?php

class EmailController
{
    /**
     * Ulo�� zpr�vu do SESSION
     * @param type $message
     */
    private function setMessage($message)
    {
		$_SESSION['message'] = $message;
    }
	
    /**
     * Vr�t� zpr�vu ze SESSION
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
     * Obnov� str�nku a vypr�zdn� formul��
     */
    private function redirect()
    {
		header('Location: ' . $_SERVER['PHP_SELF']);
		die;
    }
	
    /**
     * Ove�� jestli jsou data z formul��e a p�ed� je MailSenderu
     * Zobraz� zpr�vu o �s�n�m odesl�n� nebo vyvol� vyj�mku
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
                $mailSender->sendMail('horak.tomas@mujmail.cz', 'Zpr�va z webu', $_POST['text'], $_POST['email']);
				
                $this->setMessage('V� Email byl �sp�n� odesl�n.');
                $this->redirect();
			}
            
			catch (UserException $e)
			{
                $this->setMessage('Chyba: ' . $e->getMessage());
			}
		}
    }
	
    /**
     * Vyp�e kontaktn� formul��
     */
    public function getForm()
    {
		include("view/kontakt.phtml");
		$message = $this->getMessage();
			if($message)
				{echo ("<p class='message'><strong>" . htmlspecialchars($message) . "</strong></p>");}
    }
}