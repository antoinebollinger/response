<?php
namespace Abollinger;

use \Abollinger\Helpers;

/**
 * Class Response
 *
 * A standardized API response wrapper.
 * Provides convenient methods to configure, retrieve, and send JSON responses with consistent structure.
 *
 * @package Partez\Api\View
 */
final class Response
{
    /**
     * The current response data.
     *
     * @var array
     */
    private array $response;

    /**
     * The default response template.
     *
     * @var array
     */
    private array $default;

    /**
     * Constructor for the Response class.
     *
     * Initializes the default response parameters and sets the initial response.
     *
     * @param array $default Optional overrides for default response parameters
     */
    public function __construct(array $default = [])
    {
        $this->default = array_merge([
            'code' => 200,
            'success' => true,
            'message' => 'Default message',
            'state' => 0,
            'data' => [],
        ], $default);

        $this->response = $this->default;
    }

    /**
     * Sends the current response as JSON and optionally exits the script.
     *
     * @param bool $terminate Whether to terminate the script after sending the response (default: true)
     * @return void
     */
    public function sendJSON(bool $terminate = true): void
    {
        http_response_code($_SERVER['REQUEST_METHOD'] === 'OPTIONS' ? 200 : $this->getCode());

        header("Access-Control-Allow-Origin: " . (defined('ALLOW_ORIGIN') ? ALLOW_ORIGIN : '*'));
        header("Access-Control-Allow-Methods: " . (defined('ALLOW_METHODS') ? ALLOW_METHODS : 'GET, POST, OPTIONS'));
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Access-Control-Allow-Credentials: true");
        header("Content-type: application/json; charset=UTF-8");

        echo $this->toJson();

        if ($terminate) {
            exit;
        }
    }

    /**
     * Converts the current response to a JSON string.
     *
     * @param int $options Optional JSON encoding options
     * @return string
     */
    public function toJson(int $options = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES): string
    {
        return json_encode($this->response, $options);
    }

    /**
     * Set multiple response parameters using an array.
     *
     * @param array $params Array of response parameters to override
     * @return self
     */
    public function set(array $params = []): self
    {
        $this->response = Helpers::defaultParams($this->response, $params);
        return $this;
    }

    /**
     * Set the HTTP status code.
     *
     * @param int $code
     * @return self
     */
    public function setCode(int $code = 200): self
    {
        $this->response['code'] = $code;
        return $this;
    }

    /**
     * Set the success flag.
     *
     * @param bool $success
     * @return self
     */
    public function setSuccess(bool $success = true): self
    {
        $this->response['success'] = $success;
        return $this;
    }

    /**
     * Set the message string.
     *
     * @param string $message
     * @return self
     */
    public function setMessage(string $message = 'Welcome to Partez API! 🚀'): self
    {
        $this->response['message'] = $message;
        return $this;
    }

    /**
     * Set the state indicator.
     *
     * @param int $state
     * @return self
     */
    public function setState(int $state = 0): self
    {
        $this->response['state'] = $state;
        return $this;
    }

    /**
     * Set the response data.
     *
     * @param array|string $data
     * @return self
     */
    public function setData(array|string $data = []): self
    {
        $this->response['data'] = $data;
        return $this;
    }

    /**
     * Get the full response array.
     *
     * @return array
     */
    public function get(): array
    {
        return $this->response;
    }

    /**
     * Get the HTTP status code.
     *
     * @return int
     */
    public function getCode(): int
    {
        return $this->response['code'];
    }

    /**
     * Get the success status.
     *
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->response['success'];
    }

    /**
     * Get the response message.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->response['message'];
    }

    /**
     * Get the response state.
     *
     * @return int
     */
    public function getState(): int
    {
        return $this->response['state'];
    }

    /**
     * Get the response data.
     *
     * @return array|string
     */
    public function getData(): array|string
    {
        return $this->response['data'];
    }

    /**
     * Resets the response to its default parameters.
     *
     * @return array The reset API response parameters
     */
    public function reset(): array
    {
        $this->response = $this->default;
        return $this->response;
    }
}
