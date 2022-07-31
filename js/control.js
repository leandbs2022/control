// JavaScript Document
function printDiv(divID)  
        {
        var conteudo = document.getElementById(divID).innerHTML;  
        var win = window.open();  
        win.document.write(conteudo);  
        win.print();  
        win.close();//Fecha após a impressão.  
        } 
        function cont(){
   var conteudo = document.getElementById('print').innerHTML;
   tela_impressao = window.open('about:blank');
   tela_impressao.document.write(conteudo);
   tela_impressao.window.print();
   tela_impressao.window.close();
}
  