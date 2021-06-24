<?php

namespace ESign\Http;

class Response
{
    private $code = '200';

    private $body;

    /**
     * @var array $header
     */
    private $header = [];

    private $error;

    public function resolve(): Response
    {
        if ($this->code !== '200') {
            $this->setError($this->body);
        } else {
            if (json_decode($this->body)) {
                $this->body = json_decode($this->body, true);
                if ($this->body['code'] ?? false) {
                    if ($this->body['message'] ?? false == '成功') {
                        $this->body = $this->body['data'];
                    } else {
                        $this->setError($this->body['message']);
                    }
                }
            }
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Response
     */
    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Response
     */
    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;

    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @param array $header
     * @return Response
     */
    public function setHeader(array $header): self
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error): self
    {
        $this->error = $error;
        $this->code = '500';
        return $this;
    }


    public function isSuccess(): bool
    {
        return $this->code == '200';
    }

}