/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package padrao;

import com.sun.org.apache.xerces.internal.impl.dv.util.Base64;
import java.awt.AWTException;
import java.awt.Image;
import java.awt.MenuItem;
import java.awt.PopupMenu;
import java.awt.SystemTray;
import java.awt.Toolkit;
import java.awt.TrayIcon;
import java.awt.TrayIcon.MessageType;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.*;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Random;
import java.util.Timer;
import java.util.TimerTask;
import java.util.regex.Pattern;
import javax.swing.JOptionPane;
import sat.SAT;
import si300.SI300;

public class TelaPrincipal extends javax.swing.JFrame {
    
    Connection conexao;
    PreparedStatement pst = null;
    ResultSet rs = null;
    String xml_retorno="";    
    Timer t = new Timer();
    String cod_ativacao = "";
    String signAC = "";
    public static TrayIcon trayIcon = null;
    
    Calendar hoje = Calendar.getInstance();
    String ano = (String.valueOf(hoje.get(Calendar.YEAR)));
    String mes = (String.valueOf(hoje.get(Calendar.MONTH) + 1));
    
    private static final int PORTA = 3175;
    
    public void pastas(){
        File emitidos = new File("c:\\Slimtec\\CF-e\\" + ano + "\\" + mes + "\\Emitidos\\"); // ajfilho é uma pasta!
        if (!emitidos.exists()) {
           emitidos.mkdirs(); //mkdir() cria somente um diretório, mkdirs() cria diretórios e subdiretórios.
        }
        
        File cancelados = new File("c:\\Slimtec\\CF-e\\" + ano + "\\" + mes + "\\Cancelados\\"); // ajfilho é uma pasta!
        if (!cancelados.exists()) {
           cancelados.mkdirs(); //mkdir() cria somente um diretório, mkdirs() cria diretórios e subdiretórios.
        }
    }
    
    private void executarDos(String comandoDos){  
        Process exec;  
        try {  
            exec = Runtime.getRuntime().exec(comandoDos);
        }catch (IOException e) { 
        }

    }
    
    public void dadosSat(){
        String sql = "SELECT * FROM sat";
            try {
                java.sql.Statement st = conexao.createStatement();
                rs = st.executeQuery(sql);
                
                while (rs.next()) {
                    cod_ativacao = rs.getString("sat_cod_ativacao");
                    signAC = rs.getString("sat_signAC");
                }
                
            }catch(Exception e){
                trayIcon.displayMessage("Gerenciador S@t Slimtec", "Não foi possível buscar informações sobre seu equipamento Sat\n", MessageType.ERROR);
                System.exit(0);
            }
    }
    
    public void listar(){        
        String sql = "SELECT * FROM cupom WHERE cupom_status!='Emitido' and cupom_status!='Cancelado' and cupom_status!='Falha'";
        
        try {
            txtStatus.setText("Buscando..");
            java.sql.Statement st = conexao.createStatement();
            rs = st.executeQuery(sql);
           
            while (rs.next()){
                if(rs.getString("cupom_status").equals("Emitir")) {
                   executarDos("rundll32 printui.dll,PrintUIEntry /dl /n \"Sweda Printer\"");
                   trayIcon.displayMessage("Gerenciador S@t Slimtec", "Emitindo Cupom", MessageType.INFO);
                   vender(rs.getString("pedido_id"), rs.getString("cupom_xml"));
                   executarDos("rundll32 printui.dll,PrintUIEntry /if /b \"Sweda Printer\" /f C:\\SwedaPrinter\\x32\\swedaprinter.inf /r \"COM3:\" /m \"Sweda Printer\"");
                }
                if(rs.getString("cupom_status").equals("Cancelar")) {
                   executarDos("rundll32 printui.dll,PrintUIEntry /dl /n \"Sweda Printer\"");
                   trayIcon.displayMessage("Gerenciador S@t Slimtec", "Cancelando Cupom", MessageType.INFO);
                   cancelar(rs.getString("pedido_id"), rs.getString("chaveConsulta"), rs.getString("cupom_xml"));
                   executarDos("rundll32 printui.dll,PrintUIEntry /if /b \"Sweda Printer\" /f C:\\SwedaPrinter\\x32\\swedaprinter.inf /r \"COM3:\" /m \"Sweda Printer\"");
                }
                
                if(rs.getString("cupom_status").equals("Imprimir")) {
                   executarDos("rundll32 printui.dll,PrintUIEntry /dl /n \"Sweda Printer\"");
                   trayIcon.displayMessage("Gerenciador S@t Slimtec", "Imprimindo Cupom", MessageType.INFO);
                   imprimir(rs.getString("chaveConsulta"), rs.getString("arquivoCFeBase64"));
                   executarDos("rundll32 printui.dll,PrintUIEntry /if /b \"Sweda Printer\" /f C:\\SwedaPrinter\\x32\\swedaprinter.inf /r \"COM3:\" /m \"Sweda Printer\"");
                }
                
            }
            txtStatus.setText("");
        } catch (Exception e) {
            System.out.println(e);
            trayIcon.displayMessage("Gerenciador S@t Slimtec", "Ops! Algo aconteceu aqui\n"+ e, MessageType.INFO);
            
        }
    }
    
    public void imprimir(String cfeChave, String CfeXml){
        int consultaStatusSi300 = SI300.INSTANCE.SI300_eBuscarPortaVelocidade();
        
        if (consultaStatusSi300 == 0) {
         trayIcon.displayMessage("Gerenciador S@t Slimtec", "Erro de Comunicação\nVerifique a impressora!", MessageType.ERROR);
        }else{
         SI300.INSTANCE.SI300_iImprimirXMLString(CfeXml, null, null, 0, null, null,0, true);
         SI300.INSTANCE.SI300_fecharPorta();
        }
                
        String sql = "UPDATE cupom SET cupom_status=? WHERE chaveConsulta=?";
            try {
                pst = conexao.prepareStatement(sql); 

                pst.setString(1, "Emitido");
                pst.setString(2, cfeChave);

                pst.executeUpdate();

            } catch (Exception e) {
                trayIcon.displayMessage("Gerenciador S@t Slimtec", "Ops! Algo aconteceu aqui\n"+ e, MessageType.ERROR);
            }
    }
    
    public void buscando(){
        t.schedule(new TimerTask() {
            @Override
            public void run() {
                try { 
                java.net.ServerSocket ss = new java.net.ServerSocket(PORTA); 
        }catch (java.net.BindException ex){ 
                
        } 
      catch (java.io.IOException ex){ 

        }
                listar();
            }
        }, 0, 5000);
    };
   
    public void vender(String pedido, String xmlString){
        Random gerador = new Random();
        int numero = gerador.nextInt(999999);
        
        Integer.parseInt(cod_ativacao);
                
        String ret = SAT.INSTANCE.EnviarDadosVenda(numero, cod_ativacao ,xmlString);
        
        String[] reto = ret.split(Pattern.quote("|"));
                          
        Integer codMsg = 0;
        Integer cccc = 0;
        
        if(reto.length > 4){
            if(reto[4].isEmpty()){
                codMsg = 0;
            }else{
                codMsg = Integer.parseInt(reto[4]);
            }
        }
            
        if(reto.length >= 6){
            String a = reto[6]; // string "a" recebe vetor com a base64
            byte[] byteArray = Base64.decode(a);// byteArray descodifica "a" 
            String decodedString = new String(byteArray);// String decodedString recebe byteArray.
            String xml_retorno = decodedString;
            

            String gv = xml_retorno;
            
            String sql = "UPDATE cupom SET cupom_status=? WHERE pedido_id=?";
            try {
                pst = conexao.prepareStatement(sql); 

                pst.setString(1, "Emitido");
                pst.setString(2, pedido);

                pst.executeUpdate();

            } catch (Exception e) {
                trayIcon.displayMessage("Gerenciador S@t Slimtec", "Ops! Algo aconteceu aqui\n"+ e, MessageType.ERROR);
            }
                      
            
            try{
                FileWriter nf = new FileWriter("c:\\Slimtec\\CF-e\\" + ano + "\\" + mes + "\\emitidos\\" + reto[8] + ".xml");
                PrintWriter arq = new PrintWriter(nf);
                arq.print(decodedString);
                nf.close();
            }catch(Exception erro){
                    trayIcon.displayMessage("Gerenciador S@t Slimtec", "Falha ao gerar arquivo xml" + erro, MessageType.ERROR);
            };
            
            System.out.println(reto[10]);
                      
            if(!reto[2].isEmpty()){
                cccc = Integer.parseInt(reto[2]);
            }
            
            atualiza(
                "Emitido",                  //cupom_status
                Integer.parseInt(reto[0]),  //numeroSessao
                Integer.parseInt(reto[1]),  //eEEEE
                cccc,                       //cCCC
                reto[3],                    //mensagem
                codMsg,                     //cod
                reto[5],                    //mensagemSEFAZ
                decodedString,              //arquivoCFe
                reto[7],  //timeStamp
                reto[8],                    //chaveConsulta
                reto[9],                    //valorTotalCFe
                reto[11],                   //assinaturaQRCODE
                Integer.parseInt(pedido)    //Pedido
            );
            
            int consultaStatusSi300 = SI300.INSTANCE.SI300_eBuscarPortaVelocidade();
            
            if (consultaStatusSi300 == 0) {
             trayIcon.displayMessage("Gerenciador S@t Slimtec", "Erro de Comunicação\nVerifique a impressora!", MessageType.ERROR);
             
            }else{
             SI300.INSTANCE.SI300_iImprimirXMLString(decodedString, null, null, 0, null, null,0, true);
             SI300.INSTANCE.SI300_fecharPorta();
             trayIcon.displayMessage("Gerenciador S@t Slimtec", "Emitido com Sucesso", MessageType.INFO);
            }
           
           
       }else{
            
            Timestamp timestamp = new Timestamp(System.currentTimeMillis());
            String dateTimeStamp = new SimpleDateFormat("yyyyMMddHHmmss").format(timestamp.getTime());
                
                
            atualiza(
                "Falha",                  //cupom_status
                Integer.parseInt(reto[0]),  //numeroSessao
                Integer.parseInt(reto[1]),  //eEEEE
                cccc,                       //cCCC
                reto[3],                    //mensagem
                codMsg,  //cod
                "",                    //mensagemSEFAZ
                "",                         //arquivoCFe
                dateTimeStamp,           //timeStamp
                "",                         //chaveConsulta
                "0",                         //valorTotalCFe
                "",                         //assinaturaQRCODE
                Integer.parseInt(pedido)    //Pedido
            );
            
            trayIcon.displayMessage("Gerenciador S@t Slimtec", "Falha ao Emitir", MessageType.ERROR);
       }
       

    }
        
    public void cancelar(String pedido, String cfeChave, String xmlString){
    Random gerador = new Random();
    int numero = gerador.nextInt(999999);
    
    Integer.parseInt(cod_ativacao);
            
    String ret = SAT.INSTANCE.CancelarUltimaVenda(numero, cod_ativacao , cfeChave, xmlString);
    
    String[] reto = ret.split(Pattern.quote("|"));
                      
    Integer codMsg = 0;
    Integer cccc = 0;
    
    
    if(reto.length > 4){
        if(reto[4].isEmpty()){
            codMsg = 0;
        }else{
            codMsg = Integer.parseInt(reto[4]);
        }
    }else{
        codMsg = 0;
    }
        
    if(reto.length >= 6){
        String a = reto[6]; // string "a" recebe vetor com a base64
        byte[] byteArray = Base64.decode(a);// byteArray descodifica "a" 
        String decodedString = new String(byteArray);// String decodedString recebe byteArray.
        String xml_retorno = decodedString;
        
        String gv = xml_retorno;
        
        try{
            FileWriter nf = new FileWriter("c:\\Slimtec\\CF-e\\" + ano + "\\" + mes + "\\Cancelados\\" + reto[8] + ".xml");
               PrintWriter arq = new PrintWriter(nf);
               arq.print(decodedString);
               nf.close();
        }catch(Exception erro){
                trayIcon.displayMessage("Gerenciador S@t Slimtec", "Falha ao gerar arquivo xml", MessageType.ERROR);
        };
        
        
        
        if(!reto[2].isEmpty()){
            cccc = Integer.parseInt(reto[2]);
        }
        
        atualiza(
            "Cancelado",                  //cupom_status
            Integer.parseInt(reto[0]),  //numeroSessao
            Integer.parseInt(reto[1]),  //eEEEE
            cccc,                       //cCCC
            reto[3],                    //mensagem
            codMsg,                     //cod
            reto[5],                    //mensagemSEFAZ
            decodedString,              //arquivoCFe
            reto[7],  //timeStamp
            reto[8],                    //chaveConsulta
            reto[9],                    //valorTotalCFe
            reto[11],                   //assinaturaQRCODE
            Integer.parseInt(pedido)    //Pedido
        );
        
        int consultaStatusSi300 = SI300.INSTANCE.SI300_eBuscarPortaVelocidade();
        
        if (consultaStatusSi300 == 0) {
         trayIcon.displayMessage("Gerenciador S@t Slimtec", "Erro de Comunicação\nVerifique a impressora!", MessageType.ERROR);
        }else{
         SI300.INSTANCE.SI300_iImprimirXMLString(decodedString, null, null, 0, null, null,0, true);
         SI300.INSTANCE.SI300_fecharPorta();
        }
       
       
   }else{
        
        Timestamp timestamp = new Timestamp(System.currentTimeMillis());
        String dateTimeStamp = new SimpleDateFormat("yyyyMMddHHmmss").format(timestamp.getTime());
            
            
        atualiza(
            "Falha",                  //cupom_status
            Integer.parseInt(reto[0]),  //numeroSessao
            Integer.parseInt(reto[1]),  //eEEEE
            cccc,                        //cCCC
            reto[3],                    //mensagem
            codMsg,  //cod
            "",                    //mensagemSEFAZ
            "",                         //arquivoCFe
            dateTimeStamp,           //timeStamp
            "",                         //chaveConsulta
            "0",                         //valorTotalCFe
            "",                         //assinaturaQRCODE
            Integer.parseInt(pedido)    //Pedido
        );
   }
   

}
    
    public void atualiza(String cupom_status, Integer numeroSessao, Integer eEEEE, Integer cCCC, String mensagem, Integer cod, String mensagemSEFAZ, String arquivoCFe, String timeStamp, String chaveConsulta, String valorTotalCFe, String assinaturaQRCODE, Integer pedido){     
       
       
        String sql = "UPDATE cupom SET cupom_status=?, numeroSessao=?, EEEEE=?, CCCC=?, mensagem=?, cod=?, mensagemSEFAZ=?, arquivoCFeBase64=?, timeStamp=?, chaveConsulta=?, valorTotalCFe=?, assinaturaQRCODE=? WHERE pedido_id=?";
        try {
            pst = conexao.prepareStatement(sql);            
            pst.setString(1, cupom_status);
            pst.setInt(2, numeroSessao);
            pst.setInt(3, eEEEE);
            pst.setInt(4, cCCC);
            pst.setString(5, mensagem);
            pst.setInt(6, cod);
            pst.setString(7, mensagemSEFAZ);
            pst.setString(8, arquivoCFe);
            pst.setString(9, timeStamp);
            pst.setString(10, chaveConsulta);
            pst.setString(11, valorTotalCFe);
            pst.setString(12, assinaturaQRCODE);

            
            pst.setInt(13, pedido);
            pst.executeUpdate();
            
        } catch (Exception e) {
            trayIcon.displayMessage("Gerenciador S@t Slimtec", "Ops! Algo aconteceu aqui\n"+ e, MessageType.ERROR);
        }
       
    }
    
    public static void menu(){
        TelaPrincipal tela = new TelaPrincipal();
        MenuItem gerenciador = new MenuItem("Gerenciador S@t Slimtec");
        MenuItem sair = new MenuItem("Sair");
        
        if (SystemTray.isSupported()) {
          SystemTray tray = SystemTray.getSystemTray();
          Image image = Toolkit.getDefaultToolkit().getImage("c:\\Slimtec\\icones\\image.png");
          PopupMenu popup = new PopupMenu();
          trayIcon = new TrayIcon(image, "Gerenciador S@t Slimtec", popup);
          trayIcon.setImageAutoSize(true); 
          
          popup.add(gerenciador);
          popup.add(sair);
          
          try {
            tray.add(trayIcon);
            trayIcon.displayMessage("Gerenciador S@t Slimtec", "Ativado", MessageType.INFO);
          } catch (AWTException e) {
            System.err.println("Não pode adicionar a tray");
          }
        } else {
          System.err.println("Tray indisponível");
        }
        
        
        gerenciador.addActionListener( new ActionListener() {
        public void actionPerformed(ActionEvent e) {
            tela.setVisible(true);
        }
        });
        
        sair.addActionListener( new ActionListener() {
        public void actionPerformed(ActionEvent e) {
            System.exit(0);
        }
        });
    }    
        
    public static boolean isNumeric (String s) {
    try {
        Long.parseLong (s); 
        return true;
    } catch (NumberFormatException ex) {
        return false;
    }
}        
            
            
    public TelaPrincipal() {
        initComponents();
        this.setLocationRelativeTo(null);
        
        try { 
                java.net.ServerSocket ss = new java.net.ServerSocket(PORTA); 
        }catch (java.net.BindException ex){ 
                JOptionPane.showMessageDialog(null,"Gerenciador S@t já esta sendo executado."); 
                System.exit(0); 
        } 
      catch (java.io.IOException ex){ 
                System.exit(0); 
        }
        
        conexao = Conexao.conectar();
        if(conexao == null){
            JOptionPane.showMessageDialog(null, "Não foi possvel conectar com o servidor.");
            System.exit(0);
        }
        dadosSat();
        
        Random gerador = new Random();
        int numero = gerador.nextInt(999999);       

        String consultaSAT = SAT.INSTANCE.ConsultarSAT(numero);
        String[] retoConsultaSAT = consultaSAT.split(Pattern.quote("|"));

        if(retoConsultaSAT.length < 3){
            JOptionPane.showMessageDialog(null, "Não foi comunicar com o Equipamento S@t.");
            System.exit(0);
        }
        
        pastas();
        
        //Random sessao = new Random();
        //int numeroSessao = sessao.nextInt(999999);
        //String consultaSat = SAT.INSTANCE.ConsultarSAT(numeroSessao);
        
        //String[] consultaSatRetorno = consultaSat.split(Pattern.quote("|"));
        //consultaSatRetorno[2]        
        
        
        buscando();
    }
    

    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jPanel1 = new javax.swing.JPanel();
        jLabel1 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        jLabel3 = new javax.swing.JLabel();
        txtStatus = new javax.swing.JLabel();

        setPreferredSize(new java.awt.Dimension(420, 100));
        setResizable(false);

        jPanel1.setBackground(new java.awt.Color(255, 255, 255));
        jPanel1.setPreferredSize(new java.awt.Dimension(420, 100));

        jLabel1.setFont(new java.awt.Font("Tahoma", 0, 24)); // NOI18N
        jLabel1.setText("Gerenciador S@t Slimtec");

        jLabel2.setFont(new java.awt.Font("Tahoma", 0, 14)); // NOI18N
        jLabel2.setText("Versão 1.0.12");

        jLabel3.setIcon(new javax.swing.ImageIcon("C:\\Slimtec\\icones\\info.png")); // NOI18N

        txtStatus.setText("Status");

        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(jLabel3)
                .addGap(30, 30, 30)
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING, false)
                    .addGroup(jPanel1Layout.createSequentialGroup()
                        .addComponent(txtStatus)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(jLabel2))
                    .addComponent(jLabel1))
                .addContainerGap(18, Short.MAX_VALUE))
        );
        jPanel1Layout.setVerticalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(jPanel1Layout.createSequentialGroup()
                        .addGap(23, 23, 23)
                        .addComponent(jLabel1)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                            .addComponent(jLabel2)
                            .addComponent(txtStatus)))
                    .addGroup(jPanel1Layout.createSequentialGroup()
                        .addContainerGap()
                        .addComponent(jLabel3)))
                .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
        );

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, 408, Short.MAX_VALUE)
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, 112, Short.MAX_VALUE)
        );

        setSize(new java.awt.Dimension(416, 139));
        setLocationRelativeTo(null);
    }// </editor-fold>//GEN-END:initComponents
    
    
       
    
  
    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(TelaPrincipal.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(TelaPrincipal.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(TelaPrincipal.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(TelaPrincipal.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>
           
        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {                
                menu();
            }
        });
    }
    
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JPanel jPanel1;
    private javax.swing.JLabel txtStatus;
    // End of variables declaration//GEN-END:variables
}