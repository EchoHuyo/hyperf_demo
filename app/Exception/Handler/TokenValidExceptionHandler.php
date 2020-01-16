<?php


namespace App\Exception\Handler;

use App\Constants\StatusCode;
use Hyperf\Di\Annotation\Inject;
use App\Exception\BusinessException;
use App\Kernel\ResponseCreate;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Phper666\JwtAuth\Exception\TokenValidException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class TokenValidExceptionHandler extends ExceptionHandler
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

        return $this->responseCreate->error($this->request, $response, StatusCode::Success,$throwable->getMessage(),StatusCode::getHttpCode(StatusCode::Console_Connect_TokenInvalid));
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof TokenValidException;
    }
}