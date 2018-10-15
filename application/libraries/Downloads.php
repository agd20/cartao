<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloads {

    protected $CI;

    public function __construct()
    {
		$this->CI =& get_instance();
		$this->CI->load->model('pedidos_model');
		$this->CI->load->helper('array');
    }

    public function download_arquivo($arquivos)
  	{
  		if($arquivos <> ""){
		
      
			foreach($arquivos as $arquivo){
				
				
				
				/*
				echo $arquivo->idPedido."<br>";
				echo $arquivo->idItem_Pedido."<br>";
				*/
				$nome_arquivo = $arquivo->arquivo.".pdf";
				
				
				//Cria aquivo zip e adicionar pdfs
				$zip_name = FCPATH."assets/pdf/".$arquivo->idPedido.".zip"; // Zip name
				if(!file_exists($zip_name)){
					$zip = new ZipArchive();
				
					$zip->open($zip_name,  ZipArchive::CREATE);
				
				}
				if(file_exists($nome_arquivo)){
					$zip->addFromString(basename($nome_arquivo),  file_get_contents($nome_arquivo));  
				}
				else{
					echo"file does not exist";
				}
				
				
			}
			
			$zip->close();
			
			// Faz o download do PDF
			$aquivozip = $zip_name;	
			set_time_limit(0);
			if(isset($aquivozip) && file_exists($aquivozip)){ // faz o teste se a variavel não esta vazia e se o arquivo realmente existe
		
				header('Content-Description: File Transfer');
				header("Content-Disposition: attachment; filename=".basename($aquivozip)); // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
				header("Content-Type: application/pdf"); // informa o tipo do arquivo ao navegador
				header('Content-Transfer-Encoding: binary');
				header("Content-Length: ".filesize($aquivozip)); // informa o tamanho do arquivo ao navegador
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Expires: 0');
				ob_end_clean(); //essas duas linhas antes do readfile
				flush();
				readfile($aquivozip); // lê o arquivo
				//exit; // aborta pós-ações
				 
			} 

			//remove o arquivo zip
			exec('rm '.$aquivozip);
				   
				
			
			
		}
  	}
	

}

?>
