<?php
    include_once "DBConnector.php";

    class FileUploader{
        private static $target_directory="uploads/";
        private static $size_limit=50000;//size is in bytes
        private $uploadOk=false;
        private $file_original_name;
        private $file_type;
        private $file_size;
        private $final_file_name;

        public function setOriginalName($name){
            $this->file_original_name=$name;
        }

        public function getOriginalName(){
            return $this->file_original_name;
        }

        public function setFileType($type){
            $this->file_type=$type;
        }

        public function getFileType(){
            return $this->file_type;
        }

        public function setFileSize($size){
            $this->file_size=$size;
        }

        public function getFileSize(){
            return $this->file_size;
        }

        public function setFinalFileName($final_name){
            $this->final_file_name=$final_name;
        }

        public function getFinalFileName(){
            return $this->final_file_name;
        }

        public function uploadFile(){

            $con=new DBConnector;

            // $targetFilePath=$target_directory.$image;
            // move_uploaded_file($image,$targetFilePath);

            $imageName=$this->getOriginalName();
            $username=$_SESSION['username'];
            $uploadQuery="UPDATE users SET image_name='$img_name' WHERE username='$username'";

            if($this->uploadOk()){
                $imgUp=mysqli_query($con->conn,$uploadQuery);
                $unset($_SESSION['username']);
            }   


            if(isset($_POST['btn-upload'])){

            }
            
           
        }

        public function fileAlreadyExists(){

            $this->saveFilePathTo();

            $exists_in_dir = false;

            //will check if file exists in directory
            if(file_exists($this->file_path)){
                $exists_in_dir = true;
            }

            return $exists_in_dir;
        }


        public function saveFilePathTo(){

             //Gets the parent directory holding all files
             $trgt_dir  = self::$target_directory;

            //Fuse the directory to that particular filename
            $trgt_file = $trgt_dir . basename($this->file_original_name);
      
            $this->file_path = $trgt_file;
        }

        public function moveFile(){

            $result_set = move_uploaded_file($this->final_file_name, $this->file_path);

            if($result_set){
              $this->uploadOk=true;
            }
      
            return $this->uploadOk;
        }
        public function fileTypeIsCorrect(){

            $imageExtensions = array("jpeg","jpg","png", "jpeg");

            $is_of_type_extensions = false;
      
            $type = $this->file_type;
      
            if(in_array($type, $imageExtensions)){
              $is_of_type_extensions = true;
            }
      
            return $of_type_extensions;

        }
        public function fileSizeIsCorrect(){

            $size_OK = false;
            $limit = self::$size_limit;

            if($this->file_size < 5000000000){
                $size_OK = true;

                return $size_OK;
            }

            return $size_OK;
        }

        public function fileWasSelected(){

            $selected = false;

            if($this->file_original_name){
              $this->uploadOk = true;
              $selected  = true; 
              return $selected;
            }
      
            return $selected;
        }
    }
?>