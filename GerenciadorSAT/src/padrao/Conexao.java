package padrao;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.sql.*;

/**
 *
 * @author DOUGLAS
 */
public class Conexao {
    
    public static String servidor;
    public static String usuario;
    public static String senha;
    public static String banco;
    
    
    public static void lerConfig(){
    String nome = "c:\\Slimtec\\ConfigServer.ini"; 
    String[] linhas = new String[4];    
        try {
            try (FileReader arq = new FileReader(nome)) {          

                int n = 0;            
                BufferedReader lerArq = new BufferedReader(arq);
                String linha;
                while ((linha = lerArq.readLine()) != null) {
                    linhas[n] = linha;
                    n++;
                } }

            servidor = linhas[0];
            usuario = linhas[1];
            banco = linhas[3];
            if(linhas[2] == null){
                senha = "";
            }else{
                senha = linhas[2];
            };            

        } catch (IOException e) {
            System.err.printf("Erro na abertura do arquivo: %s.\n",
              e.getMessage());
        }        
    }
    
    public static Connection conectar(){
        lerConfig();
        java.sql.Connection conexao = null;
        String driver = "com.mysql.jdbc.Driver";
        
        try {
            Class.forName(driver);
            conexao = DriverManager.getConnection("jdbc:mysql://"+servidor+":3306/"+banco+"",usuario,senha);
            return conexao;
        } catch (Exception e) {
            return null;
        }
    
    }

       
    
}
