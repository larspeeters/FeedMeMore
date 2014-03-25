<?php
	class Post
	{
		private $m_sSubject;
		private $m_sMention;
		private $m_sText;
		
		public function __set($p_sProperty, $p_vValue)
		{
			switch ($p_sProperty) 
			{
				case 'Subject':
				if(empty($p_vValue)){
					throw new Exception("geef een onderwerp");
				}
					$this->m_sSubject = $p_vValue;
					break;
				
				case 'Mention':
				if(empty($p_vValue)){
					throw new Exception("maak een keuze");
				}
					$this->m_sMention = $p_vValue;
					break;
					
				case 'Text':
				if(empty($p_vValue)){
					throw new Exception("geef uitleg");
				}
					$this->m_sText = $p_vValue;
					break;
			}
		}

		public function __get($p_sProperty)
		{
			switch ($p_sProperty) {
				case 'Subject':
					return $this->m_sSubject;
					break;

				case 'Mention':
					return $this->m_sMention;
					break;

				case 'Text':
					return $this->m_sText;
					break;
			}
		}

		public function send()
		{
			echo "Dit is het onderwerp: " . $this->m_sSubject . "<br> Dit is de gemaakte keuze: " . $this->m_sMention . "<br> Dit is de uitleg: " . $this->m_sText;
			echo "blablablabla";
		}
	}

?>