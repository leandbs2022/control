<?php
	$msg[] = "<p style=\"color:#FF0000;font-size:12px;font-family:Verdana;\" align=\"center\">";
	class invent
		{
		
		
		#empresas
				function adicionar_empresa($cnpj,$ins_est,$fant,$end,$cid,$bai,$cep,$uf,$tel) 
					{
						$end= strtoupper($end);
						$fant= strtoupper($fant);
						$cid= strtoupper($cid);
						$bai= strtoupper($bai);
						$uf= strtoupper($uf);
						if(empty($cnpj))
								{
									echo "<label style=background-color:yellow align=center>favor verificar se todos os campos foi preenchido!!!</label>";
								}else{
				$query = mysqli_query($conn,"INSERT INTO `empre`(`cnpj`,`estad`, `fant`, `end`, `cid`, `bai`, `cep`, `uf`, `tel`) VALUES ('$cnpj','$ins_est','$fant','$end','$cid','$bai','$cep','$uf','$tel')") or die(mysql_error());
						echo "Operacao foi concluida com sucesso!!!";
						return $query;
								}
					}
					
	function alter_em($cnpj,$ins_est,$fant,$end ,$cid,$bai,$cep,$uf,$tel)
		{	
			$query = mysqli_query("SELECT * FROM `empre` WHERE cnpj='$cnpj'");
			if(mysqli_num_rows($query)){
	$query = mysqli_query($conn,"UPDATE `empre` SET  `estad`='$ins_est',`fant`='$fant',`end`='$end',`cid`='$cid',`bai`='$bai',`cep`='$cep',`uf`='$uf',`tel`='$tel' WHERE cnpj='$cnpj'") or die(mysql_error());
	
			echo "Essa empresa ja existe seus dados so foram atualizados!!!";
			return $query;	
			}else{
			echo "<label style=background-color:yellow align=center>Nenhum registro encontrado</label>";
						}
		}
	}
	
	
?>