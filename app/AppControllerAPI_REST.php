<?php
declare (strict_types = 1);

namespace approot;

use approot\App;
use approot\AppDB;

/**
 *
 *
 */
class AppControllerAPI_REST
{

    /**
     *
     *
     */
    public function __construct()
    {
        $requestMethod = App::$request->getMethod();

        $data['method'] = $requestMethod;

        $this->beforeInit($data);
        $this->init($data);
        $this->afterInit($data);
        $this->routerMethod($requestMethod);
        $this->notFound();
    }

    /**
     *
     *
     */
    protected function beforeInit(array $data): void
    {

    }

    /**
     *
     *
     */
    private function init(array $data): void
    {
        // clear the old headers
        header_remove();
    }

    /**
     *
     *
     */
    protected function afterInit(array $data): void
    {

    }

    /**
     *
     *
     */
    private function routerMethod(string $method): void
    {
        if ($method == 'GET') {
            if (empty($_GET)) {
                $this->getAll();
            } else {
                $this->get();
            }
        } else
        if ($method == 'POST') {
            $this->post();
        } else
        if ($method == 'PUT') {
            $this->put();
        } else
        if ($method == 'PATCH') {
            $this->patch();
        } else
        if ($method == 'DELETE') {
            $this->delete();
        }
    }

    /**
     *
     *
     */
    protected function getAll(): void
    {

    }

    /**
     *
     *
     */
    protected function get(): void
    {

    }

    /**
     *
     *
     */
    protected function post(): void
    {

    }

    /**
     *
     *
     */
    protected function put(): void
    {

    }

    /**
     *
     *
     */
    protected function patch(): void
    {

    }

    /**
     *
     *
     */
    protected function delete(): void
    {

    }

    /**
     * Response of data in JSON format
     *
     * @param array $data JSON data
     * @example $this->responseJSON(["status" => "1"])
     */
    final protected function responseJSON(array $data): void
    {
        header('Content-Type: application/json; charset=utf-8');

        // Connections db close
        AppDB::closeConnections();

        echo json_encode($data);
        die();
    }


    /**
     * String output
     *
     * @param string $str
     * @example $this->responseText("test")
     */
    final protected function responseText(string $str): void
    {
        header('Content-Type: text/plain; charset=utf-8');

        // Connections db close
        AppDB::closeConnections();

        echo $str;
        die();
    }


    /**
     * Output text in format of HTML
     *
     * @param string $str
     * @example $this->responseHTML("test")
     */
    final protected function responseHTML(string $str): void
    {
        header('Content-type: text/html; charset=utf-8');

        // Connections db close
        AppDB::closeConnections();

        echo $str;
        die();
    }


    /**
     *
     *
     */
    private function notFound(): void
    {
        http_response_code(404);
        die();
    }

}
