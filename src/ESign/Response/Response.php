<?php

namespace ESign\Response;

abstract class Response
{
    protected $code = '200';

    protected $body;

    /**
     * @var array $header
     */
    protected $header = [];

    protected $error;

    public function resolve(): self
    {
        if ($this->code !== '200') {
            $this->setError($this->body);
        } else {
            if (json_decode($this->body)) {
                $this->body = json_decode($this->body, true);
                if (($code = $this->body['code'] ?? '') OR $code === 0) {

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
     * @return
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param  $body
     * @return Response
     */
    public function setBody( $body): self
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