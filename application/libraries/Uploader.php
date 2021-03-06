<?php
defined("BASEPATH") or die("No direct script access allowed");
class Uploader
{
    public function __construct()
    {
        $this->ci =& get_instance();
    }

    /**
     * Default config
     *
     * @param $config
     * @return mixed
     */
    private function config_image($config)
    {
        $config['upload_path'] = empty($config['path']) ? './' : $config['path'];
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = isset($config['max_size']) ? $config['max_size'] : 8192;
        $config['max_width'] = isset($config['max_width']) ? $config['max_width'] : 8192;
        $config['max_height'] = isset($config['max_height']) ? $config['max_height'] : 768;
        $config['encrypt_name'] = TRUE;

        return $config;
    }

    /**
     * Upload an image to the server
     *
     * @param $nameFile
     * @param null $config
     * @return array
     * @internal param $path
     */
    public function upload_image($nameFile, $config = null)
    {
        $response = array();

        $this->ci->load->library('upload', $this->config_image($config));

        if (!$this->ci->upload->do_upload($nameFile)) {
            $error = array('error' => $this->ci->upload->display_errors());

            $response['status'] = 0;
            $response['data'] = $error;
        } else {
            $data = $this->ci->upload->data();

            chmod($data['full_path'], 0664);

            $response['status'] = 1;
            $response['data'] = $data;

            $this->compress_image($data['full_path'], $data['full_path']);
        }

        return $response;
    }

    /**
     * Upload multiple images to the server
     *
     * @param $nameFiles
     * @param $files
     * @param $path
     * @param null $config
     * @return array
     * @internal param $nameFile
     */
    public function upload_multiple_image($nameFiles, $files, $path, $config = null)
    {
        $response = array();

        if (is_null($config)) {
            $this->config_image($path);
        }

        $this->ci->load->library('upload', $config);
        $cpt = count($files[$nameFiles]['name']);

        // http://stackoverflow.com/a/11539061/2901396
        for ($i = 0; $i < $cpt; $i++) {

            $_FILES[$nameFiles]['name'] = $files[$nameFiles]['name'][$i];
            $_FILES[$nameFiles]['type'] = $files[$nameFiles]['type'][$i];
            $_FILES[$nameFiles]['tmp_name'] = $files[$nameFiles]['tmp_name'][$i];
            $_FILES[$nameFiles]['error'] = $files[$nameFiles]['error'][$i];
            $_FILES[$nameFiles]['size'] = $files[$nameFiles]['size'][$i];
            $this->ci->upload->initialize($config);

            if (!$this->ci->upload->do_upload($nameFiles)) {
                $error = array('error' => $this->ci->upload->display_errors());
                $response['status'] = 0;
                $response['data'][] = $error;
            } else {
                $data = $this->ci->upload->data();
                $response['status'] = 1;
                $response['data'][] = $data;
            }
        }

        return $response;
    }

    /**
     * Compress the image size Using Tinypng
     * https://tinypng.com/developers
     *
     * @param $from
     * @param null $to
     * @return bool
     */
    protected function compress_image($from, $to)
    {
        if (empty(getenv('TINYPNG'))) {
            return false;
        }

        \Tinify\setKey(getenv('TINYPNG'));

        $sourceData = \Tinify\fromFile($from);
        $sourceData->toFile($to);

        chmod($to, 0664);
    }

    /**
     * Resize imagen using Tinypng
     * https://tinypng.com/developers
     *
     * @param $image
     * @param string $method
     * @param $width
     * @return bool
     */
    public function resize_image($image, $method = 'scale', $width) {
        if (empty(getenv('TINYPNG'))) {
            return false;
        }

        \Tinify\setKey(getenv('TINYPNG'));

        $source = \Tinify\fromFile($image);
        $resized = $source->resize([
            "method" => $method,
            "width" => $width
        ]);

        $imgExplode = explode('.', $image);
        $to = "{$imgExplode[0]}-$width.{$imgExplode[1]}";

        $resized->toFile($to);
    }

}