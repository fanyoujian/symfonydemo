<?php
namespace AppBundle;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * fyj
 * 20160512
 * 公共类
 */
class Util extends Controller
{
	public static function valiedSession(Request $request)
	{
		$session = $request->getSession();

        $login = $session->get('login');
        return empty($login)?0:1;

	}

	/** 
     * 创建 目录
     * @param  [type] $dir [description]
     * @return [type]      [description]
     */
    public static function createDir($dir)
    {
        return is_dir($dir) or (Util::createDir(dirname($dir)) and mkdir($dir, 0777));
    }

  /**
     * $type 1 livemeeting banner 组 icon］
     */
    public static function filecrate()
    {

        //$dirfile='uploads/livemeeting/icon';

        $targetDir = 'uploads/news/icon';


        Util::createDir($targetDir);

        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds


        $fileName = $_FILES["file"]["name"];
        $error = $_FILES["file"]["error"];
        $file_tmp = $_FILES["file"]["tmp_name"];


        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;


        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {

           

            if ($error || !is_uploaded_file($file_tmp)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            if (!$in = @fopen($file_tmp, "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        if (!$chunks || $chunk == $chunks - 1) {

            rename("{$filePath}.part", $filePath);
        }

        $url = $targetDir.'/'.$fileName;
        return $url;
     
      
    }
}