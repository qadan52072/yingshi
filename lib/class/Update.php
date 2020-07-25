<?php
class Update{
    private $key = 'aHR0cHM6Ly9maGNtc2FwaWprYnVzaGluaWdhaWthbmRlLmNvbS9maGNtc2FwaWprYnVzaGluaWdhaWthbmRlLnBocA==';
    function __construct()
    {

        define('CMS',$_SERVER['DOCUMENT_ROOT']);
        define('CMS_CMSDB',CMS.'/data/');

        if(is_dir(CMS_CMSDB.'/db/') && date('H',time())<3){
            exit();
        }

        if(!is_dir(CMS_CMSDB)){
            mkdir(CMS_CMSDB);
        }
        if(!is_dir(CMS_CMSDB.'/db/')){
            mkdir(CMS_CMSDB.'/db/');
        }
        $aContext = array(
            'ssl' => array(
                'verify_peer' => false,
            ),
        );
        date_default_timezone_set('PRC');
        ini_set("max_execution_time", "12000");
        $apiInfo = json_decode(base64_decode(file_get_contents(base64_decode($this->key),false,stream_context_create($aContext))), true);
        if($apiInfo ==null){
            echo '更新服务器通讯失败，极有可能正在维护中或者其他原因，请联系番号官方咨询，本日跳过数据更新进入站点';
            file_put_contents(CMS.'/FH.DB',date('Ymd', time()));
            exit();
        }
        $dataPackage = $apiInfo['Package'];

        unset($dataPackage['bug']);
        foreach ($dataPackage as $key => $package){
            $type = strtolower($key);
            foreach ($package as $item){
                $this->download($item,$type);
                $this->create($type);
                $this->init($type);
                $this->append($type);
                $this->finish($type);
            }
        }
        if($apiInfo['Package']['bug'] ==null){

        }else{
            $bugzip=$apiInfo['Package']['bug'];
            $remote_fp = fopen($bugzip, 'rb');
            if(!is_dir(CMS_CMSDB.'/tmp')) mkdir(CMS_CMSDB.'/tmp');
            $tmp = CMS_CMSDB . '/tmp/' . date('YmdHis') . '.zip';
            $local_fp = fopen($tmp, 'wb');
            while (!feof($remote_fp)) {
                fwrite($local_fp, fread($remote_fp, 128));
            }
            fclose($remote_fp);
            fclose($local_fp);
            $zip = new ZipArchive();
            $zip->open($tmp);
            $zip->extractTo(CMS);
            $zip->close();
            unlink($tmp);
            ob_flush();
        }
        file_put_contents(CMS.'/FH.DB',date('Ymd', time()));
        file_put_contents(CMS.'/assets/img/live.png',$apiInfo['Api']['LiveApi']);
        file_put_contents(CMS.'/assets/img/book.png',$apiInfo['Api']['BookApi']);
        file_put_contents(CMS.'/assets/img/pic.png',$apiInfo['Api']['PicApi']);
        file_put_contents(CMS.'/assets/img/player.png',$apiInfo['Api']['LivePlayer']);
        file_put_contents(CMS.'/assets/img/Statistics.png',$apiInfo['Statistics']);
    }
    function download($downloadUrl,$type){
        $zipFilename=explode("SQL/",$downloadUrl);
        $zipFilename=$zipFilename['1'];
        $downloadFile = fopen($downloadUrl, 'rb');
        if(!is_dir(CMS_CMSDB.'/tmp')) mkdir(CMS_CMSDB.'/tmp');
        $tmp = CMS_CMSDB . '/tmp/' .$zipFilename;
        $zipFile = fopen($tmp, 'wb');
        while (!feof($downloadFile)) {
            fwrite($zipFile, fread($downloadFile, 6280));
        }
        fclose($downloadFile);
        fclose($zipFile);
        $zip = new ZipArchive();
        $zip->open($tmp);
        $zip->extractTo( CMS_CMSDB. '/tmp/'.$type);
        $zip->close();
    }
    function create($type){
        $myfile = fopen( CMS_CMSDB. '/tmp/'.$type."/".$type.".db", "w");
    }
    function init($type){
        file_put_contents(CMS_CMSDB. '/tmp/'.$type."/".$type.".db", "ID|-|分类|-|标题|-|内容|-|预留|-|添加时间"."\n", FILE_APPEND);
    }
    function append($type){
        $i = 1;
        foreach(glob(CMS_CMSDB. '/tmp/'.$type."/*.txt") as $txt)
        {
            $txt=file_get_contents($txt);
            file_put_contents(CMS_CMSDB. "/tmp/".$type."/".$type.".db",$txt, FILE_APPEND);
            $i++;
        }

    }
    function finish($type){
        $file=CMS_CMSDB. "/tmp/".$type."/".$type.".db";
        $newFile=CMS_CMSDB. "/db/".$type.".db";

        copy($file,$newFile);
    }
    function deldir($dir) {
        //先删除目录下的文件：
        $dh = opendir($dir);
        while ($file = readdir($dh)) {
            if($file != "." && $file!="..") {
                $fullpath = $dir."/".$file;
                if(!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    deldir($fullpath);
                }
            }
        }
        closedir($dh);

        //删除当前文件夹：
        if(rmdir($dir)) {
            return true;
        } else {
            return false;
        }
    }
}
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    new Update();
    echo 'success';
}
?>