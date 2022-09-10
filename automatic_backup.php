#!/usr/bin/php
<?php
Global $sBackupFilename;
/*
Backup programado de Issabel modificado para enviar el backup via ftp
*/
load_default_timezone();

// All of the following assumes this script runs as root
$sBackupFilename = 'issabelbackup-'.date('YmdHis').'-ab.tar';
$sBackupDir = '/var/www/backup';
$BackupComponents = 'as_db,as_config_files,as_sounds,as_mohmp3,as_dahdi,email,fax,endpoint,otros,otros_new';
$retval = NULL;
system('/usr/share/issabel/privileged/backupengine --backup --backupfile '.
    $sBackupFilename.' --tmpdir '.$sBackupDir.' --components='.$BackupComponents, $retval);

    $ftpuser = "username";  // Username FTP
    $ftppass = "P4ssw0rd"; // Password FTP
    $ftppath = "example.com/back_customers/Gave/Elastix/";  // IP and Folder Server FTP
    $ftpurl = "ftp://".$ftpuser.":".$ftppass."@".$ftppath;

    $fp = fopen($sBackupDir."/".$sBackupFilename, 'r');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ftpurl.$sBackupFilename);
    curl_setopt($ch, CURLOPT_UPLOAD, 1);
    curl_setopt($ch, CURLOPT_INFILE, $fp);
    curl_setopt($ch, CURLOPT_INFILESIZE, filesize($sBackupDir."/".$sBackupFilename));
    curl_exec($ch);
    $error = curl_errno($ch);
    curl_close ($ch);
    if ($error == 0) {
       echo 'Archivo subido correctamente.';
        } else {
       echo 'Error al subir el archivo.';
        }


exit($retval);

function load_default_timezone()
{
    $sDefaultTimezone = @date_default_timezone_get();
    if ($sDefaultTimezone == 'UTC') {
        $sDefaultTimezone = 'America/New_York';
        $regs = NULL;
        if (is_link("/etc/localtime") && preg_match("|/usr/share/zoneinfo/(.+)|", readlink("/etc/localtime"), $regs)) {
            $sDefaultTimezone = $regs[1];
        } elseif (file_exists('/etc/sysconfig/clock')) {
            foreach (file('/etc/sysconfig/clock') as $s) {
                $regs = NULL;
                if (preg_match('/^ZONE\s*=\s*"(.+)"/', $s, $regs)) {
                    $sDefaultTimezone = $regs[1];
                }
            }
        }
    }
    date_default_timezone_set($sDefaultTimezone);


}


?>
