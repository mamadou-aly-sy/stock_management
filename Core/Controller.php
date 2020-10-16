<?php
namespace Core;

class Controller
{
    /**
     * Redering a view
     *
     * @param string $filePath
     * @param array $data
     * @param string|null $template
     * @return void
     */
    public function render(string $filePath, array $data = [], ?string $template = null)
    {
        extract($data);
        ob_start();
        if (file_exists(VIEWS_DIR . DS . $filePath . '.' . config('application.views_file_extension'))) {
            include VIEWS_DIR . DS . $filePath . '.' . config('application.views_file_extension');
        }
        $pageContent = ob_get_clean();
        if ($template) {
            require VIEWS_DIR . DS . $template . '.' . config('application.views_file_extension');
        } else {
            require VIEWS_DIR . DS . config('application.default_template') . '.' . config('application.views_file_extension');
        }
        header("HTTP/1.1 200 Ok");
        header("Content-type: text/html; charset=utf-8");
        flush();
    }

    public function redirect(string $filePath)
    {
        header("Location:" . config('application.host') . $filePath);
        exit();
    }
}
