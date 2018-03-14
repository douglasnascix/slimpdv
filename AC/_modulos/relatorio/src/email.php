<?php
set_time_limit(0);
session_start();
//header("Content-type: text/xml");
include "../../../config/config.php";

include "../../empresa/src/empresa.class.php";
include "../../relatorio/src/cupom.class.php";

$cupomOBJ = new Cupom(new Config());


$empresaOBJ = new Empresa(new Config());
$empresa = $empresaOBJ->listar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ano = $_POST['ano'];
    $mes = $_POST['mes'];
    $cupoms = $cupomOBJ->listarOK($mes, $ano);
}

require '../../../_plugins/mpdf60/mpdf.php';


$conteudoPDF = '<div>
<table>
    <thead>
        <tr>
            <th>Chave Consulta</th>
            <th>Status</th>
            <th>Data</th>
            <th>Valor</th>                              
        </tr>
    </thead>
    <tbody>';
    foreach ($cupoms as $cupom) {
        $conteudoPDF .=  '<tr>
            <td>'; if($cupom['chaveConsulta'] != "0"){$conteudoPDF .= $cupom['chaveConsulta'];};
            $conteudoPDF .= '</td>
            <td>'. $cupom['cupom_status'].'</td>
            <td>'. date_format(date_create($cupom['timeStamp']), "d/m/Y H:i:s").'</td>
            <td>R$ '. number_format($cupom['valorTotalCFe'], 2, ',', '.') .'</td>
            '. $totalGeral += $cupom['valorTotalCFe'].'
        </tr>';
    };
$conteudoPDF .= '
    </tbody>
</table>
<h2 align="right">Total: R$ '. number_format($totalGeral, 2, ',', '.') .'</h2>
</div>';



//gera PDF
$mpdf=new mPDF(); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($conteudoPDF);
$arquivo = $mpdf->Output('', 'S');
//cria arquivo
$fp = fopen("relatorio.pdf", "a");
$escreve = fwrite($fp, $arquivo);
fclose($fp);


//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../_plugins/PHPMailer/src/Exception.php';
require '../../../_plugins/PHPMailer/src/PHPMailer.php';
require '../../../_plugins/PHPMailer/src/SMTP.php';

//gerar zip
include('exportar-zip.php');

$emailHTML = '<body style="background-color:#f3f2f0; font-family: tahoma, sans-serif; font-size: 12pt;"><table width="600" align="center" cellpadding="0" cellspacing="0"><tr><td width="50%" height="102" valign="middle"><img src="http://slimtecinformatica.com.br/email/sistema/logo-cinza.png"></td><td width="50%" align="right" valign="middle"><p style="font-family: tahoma;font-size: 12px;font-weight: bold">Slimtec Informática © 2017<br>(11) 4352-7630 / 2534-8329<br>contato@slimtecinformatica.com.br</p></td></tr> <tr><td colspan="2"><img src="http://slimtecinformatica.com.br/email/sistema/barimage.png" width="600"></d> </tr><tr><td height="225" colspan="2" valign="top" bgcolor="#fff" style="padding-left:30px;padding-top:10px;"><h2>Olá,</h2><p>Segue anexo arquivos xml referente ao mês de '.mes($_POST['mes']).'</p><p>Empresa: '.$empresa['empresa_razao'].'</p></td></tr><tr><td colspan="2" align="center" scope="row"><p style="font-family: tahoma;font-size: 12px;font-weight: bold">Por favor não responda essa mensagem.<br>Esse é um e-mail automático do SlimPDV - S@t fiscal</p></td></tr></table>
</body>';

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.slimtecinformatica.com.br';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'sistema@slimtecinformatica.com.br';                 // SMTP username
    $mail->Password = 'patus3175';                           // SMTP password
    $mail->SMTPSecure = 'false';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('sistema@slimtecinformatica.com.br', 'SlimPDV');  
    $mail->addAddress($empresa['empresa_email_contabilidade']);               // Name is optional
    $mail->AddReplyTo('douglas@slimtecinformatica.com.br', 'Douglas');


    //Attachments
    $mail->addAttachment(Compress($_POST['ano'], $_POST['mes']));         // Add attachments
    //add relatorio pdf;
    $mail->addAttachment('relatorio.pdf');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = utf8_decode('Xml de '.mes($_POST['mes']).' da empresa '.$empresa['empresa_razao']);
    $mail->Body    = utf8_decode($emailHTML);
    $mail->AltBody = utf8_decode('Xml de '.mes($_POST['mes']).' da empresa '.$empresa['empresa_razao']);

    $mail->send();
    echo 'Enviado Com Sucesso';
} catch (Exception $e) {
    echo 'Erro ao Enviar.<br>';
    echo 'Detalhes: ' . $mail->ErrorInfo;
}