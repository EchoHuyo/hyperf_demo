<?php

declare(strict_types=1);

namespace App\Exception\Handler;

use App\Constants\StatusCode;
use App\Exception\BusinessException;
use App\Kernel\ResponseCreate;
use Hyperf\Di\Annotation\Inject;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class BusinessExceptionHandler extends ExceptionHandler
{
    /**
     * @var RequestInterface
     */
    protected $request;
    /**
     * 通过 `@Inject` 注解注入由 `@var` 注解声明的属性类型对象
     *
     * @Inject
     * @var ResponseCreate
     */
    private $responseCreate;

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        /** @var BusinessException $throwable */
        return $this->responseCreate->error($this->request, $response, $throwable->getStatusCode(),$throwable->getMessage(),$throwable->getCode());
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof BusinessException;
    }
}
