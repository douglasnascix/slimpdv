<?php
function mes($mesNumero){
    switch ($mesNumero) {
        case 1:
            $mes = 'Janeiro';
            break;
        case 2:
            $mes = 'Fevereiro';
            break;

        case 3:
            $mes = 'Marco';
            break;
        case 4:
            $mes = 'Abril';
            break;
        case 5:
            $mes = 'Maio';
            break;
        case 6:
            $mes = 'Junho';
            break;
        case 7:
            $mes = 'Julho';
            break;
        case 8:
            $mes = 'Agosto';
            break;
        case 9:
            $mes = 'Setembro';
            break;
        case 10:
            $mes = 'Outubro';
            break;
        case 11:
            $mes = 'Novembro';
            break;
        case 12:
            $mes = 'Dezembro';
            break;
    };

    return $mes;
}


function Compress($ano, $mesNumero){

    // Normaliza o caminho do diretório a ser compactado
    $source_path = realpath('c:/Slimtec/Cf-e/'.$ano.'/'.$mesNumero.'/');

    // Caminho com nome completo do arquivo compactado
    // Nesse exemplo, será criado no mesmo diretório de onde está executando o script
    $zip_file = __DIR__.'\\'.'CFe'.mes($mesNumero).$ano.'.zip';

    // Inicializa o objeto ZipArchive
    $zip = new ZipArchive();
    $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    // Iterador de diretório recursivo
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source_path),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
        // Pula os diretórios. O motivo é que serão inclusos automaticamente
        if (!$file->isDir()) {
            // Obtém o caminho normalizado da iteração corrente
            $file_path = $file->getRealPath();

            // Obtém o caminho relativo do mesmo.
            $relative_path = substr($file_path, strlen($source_path) + 1);

            // Adiciona-o ao objeto para compressão
            $zip->addFile($file_path, $relative_path);
        }
    }

    // Fecha o objeto. Necessário para gerar o arquivo zip final.
    $zip->close();

    // Retorna o caminho completo do arquivo gerado
    return $zip_file;
}