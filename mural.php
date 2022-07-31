<?php
session_start();
if(isset($_SESSION['utilizador']))
	{
    	$usuario = "$_SESSION[utilizador]";
	}
	
?>
<SCRIPT src="valida.js" type=text/javascript></SCRIPT>
<FORM name=email2 onsubmit="return checkemail()" action=enviar_msg.php?a=confirma method=post>
<TABLE width=346 height="134" border=0 
align=center cellPadding=0 cellSpacing=0 style="">
  <TBODY>
  <TR>
    <TD width="61" height="82" vAlign=top><FONT color=#990099>&nbsp; &nbsp;</FONT><FONT face=Arial 
      color=#000000 size=1>Mensagem:</FONT></TD>
    <TD width="426">
      <div align="left">
        <textarea id=mensagem style="BORDER-RIGHT: #00008b 1px solid; BORDER-TOP: #00008b 1px solid; FONT-SIZE: 8pt; BORDER-LEFT: #00008b 1px solid; WIDTH: 228px; BORDER-BOTTOM: #00008b 1px solid; FONT-FAMILY: verdana; HEIGHT: 80px" name=mensagem rows=10 cols=34></textarea>
      </div></TD>
  </TR>
  <TR>
    <TD vAlign=top><INPUT type=hidden value=ok name=send_status></TD>
    <TD>
          <div align="left">
            <input style="BORDER-RIGHT: #00008b 1px solid; BORDER-TOP: #00008b 1px solid; FONT-SIZE: 8pt; BORDER-LEFT: #00008b 1px solid; WIDTH: 117px; CURSOR: hand; BORDER-BOTTOM: #00008b 1px solid; FONT-FAMILY: verdana; HEIGHT: 18px; BACKGROUND-COLOR: #ffffff" type=submit size=15 value="Enviar Mensagem" name=submit />
            <input style="BORDER-RIGHT: #00008b 1px solid; BORDER-TOP: #00008b 1px solid; FONT-SIZE: 8pt; BORDER-LEFT: #00008b 1px solid; WIDTH: 108px; CURSOR: hand; BORDER-BOTTOM: #00008b 1px solid; FONT-FAMILY: verdana; HEIGHT: 18px; BACKGROUND-COLOR: #ffffff" type=reset value="Limpar tudo" />
  </div></TD></TR></TBODY></TABLE>
<DIV align=left><BR></DIV></FORM></CENTER>
<CENTER>&nbsp;</CENTER>
<CENTER>&nbsp;</CENTER></TD><TD width="100" valign="top"></BODY></HTML>
