<?php
/*require_once '/home/shunkin/video-pozdravlenie.com/www/system/Raven/Autoloader.php';
Raven_Autoloader::register();
$client = new Raven_Client('https://78886c863af642f5b93e7dc7b033b9c3:3d3ebee940b34913b57c89508166beef@sentry.io/251024');
$error_handler = new Raven_ErrorHandler($client);
$error_handler->registerExceptionHandler();
$error_handler->registerErrorHandler();
$error_handler->registerShutdownFunction();*/
class CropAvatar {
  private $src;
  private $data;
  private $dst;
  private $type;
  private $file;
  private $filename;
  private $extension;
  private $msg;
 
  function __construct($file, $data, $filename) {
    $this -> setFileName($filename);
    $this -> setSrc($file, $data);
  }
 
  private function setSrc($src, $data) {
    if (!empty($src)) {
      $this -> src = $src;
 
      if ($data['type']) {
        $this -> extension = str_replace ( "image/", '' , $data['type'] );
        $this -> setDst();
      }
    }
  }

  private function setFileName($data) {
    if (!empty($data)) {
      $this -> filename = $data;
    } 
  }
 
 
  private function setDst() {
    if (!file_exists('upload/')) {
      mkdir('upload/', 0777, true);
    }

    $img = $this -> src;

    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $img = base64_decode($img);

 
    $this -> dst = file_put_contents('upload/' . uniqid ($this -> filename . "_" . date('Ymd') . "-" . date('His') . "_", true) . '.' . $this -> extension, $img);

  }
 
 
  private function codeToMessage($code) {
    $errors = array(
      UPLOAD_ERR_INI_SIZE =>'The uploaded file exceeds the upload_max_filesize directive in php.ini',
      UPLOAD_ERR_FORM_SIZE =>'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
      UPLOAD_ERR_PARTIAL =>'The uploaded file was only partially uploaded',
      UPLOAD_ERR_NO_FILE =>'No file was uploaded',
      UPLOAD_ERR_NO_TMP_DIR =>'Missing a temporary folder',
      UPLOAD_ERR_CANT_WRITE =>'Failed to write file to disk',
      UPLOAD_ERR_EXTENSION =>'File upload stopped by extension',
    );
 
    if (array_key_exists($code, $errors)) {
      return $errors[$code];
    }
 
    return 'Unknown upload error';
  }
 
  public function getResult() {
    return !empty($this -> data) ? $this -> dst : $this -> src;
  }
 
  public function getMsg() {
    return $this -> msg;
  }
}
 
$crop = new CropAvatar(
  isset($_POST['croppedImage']) ? $_POST['croppedImage'] : null,
  isset($_FILES['croppedData']) ? $_FILES['croppedData'] : null,
  isset($_POST['filename']) ? $_POST['filename'] : null
);
 
$response = array(
  'state'  => 200,
  'message' => $crop -> getMsg(),
  'result' => $crop -> getResult()
);
 
echo json_encode($response);