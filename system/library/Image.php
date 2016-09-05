<?php
    namespace Library;

    class Image
    {
        private $savePath = 'public/img_cache/';

        public function getContent($path)
        {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
        }

        public function getContentResize($path, $width, $height)
        {
            $type = pathinfo ($path, PATHINFO_EXTENSION);
            $name = md5($path . $width . $height);

            if (file_exists(BASE_PATH.$this->savePath.$name.'.'.$type))
            {
                return baseUrl().$this->savePath.$name.'.'.$type;
            }

            // Generate New Image
            list($oldWidth, $oldHeight) = getimagesize($path);
            $ratio = ($oldWidth < $oldHeight) ?
                ($width / $oldWidth) : ($height / $oldHeight);

            $newImage = imagecreatetruecolor($width, $height);
            $image = $this->createNewImage($type, $path);

            imagecopyresampled($newImage, $image, 0, 0, 0, 0,
                $oldWidth * $ratio, $oldHeight * $ratio, $oldWidth, $oldHeight);
            // imagecopy($cropedImage, $resizedImage, 0, 0, $width, $height, $oldWidth * $ratio, $oldHeight * $ratio);

            $this->output($type, $newImage, BASE_PATH.$this->savePath.$name.'.'.$type);
            imagedestroy($newImage);
            imagedestroy($image);
            return baseUrl().$this->savePath.$name.'.'.$type;
        }

        private function createNewImage($type, $path)
        {
            if ($type==='jpg' || $type==='jpeg')
            {
                return imagecreatefromjpeg($path);
            }
            else if ($type==='png')
            {
                return imagecreatefrompng($path);
            }
        }

        private function output($type, $img, $output)
        {
            if ($type==='jpg' || $type==='jpeg')
            {
                imagejpeg($img, $output);
            }
            else if ($type==='png')
            {
                imagepng($img, $output);
            }
        }
    }

?>
