<?php

declare(strict_types=1);

namespace App\Kernel;

use App\Constants\StatusCode;

//use App\Service\QueueService;
use Hyperf\Di\Annotation\AbstractAnnotation;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Response;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class ResponseCreate extends AbstractAnnotation
{
//    /**
//     * 通过 `@Inject` 注解注入由 `@var` 注解声明的属性类型对象
//     *
//     * @Inject
//     * @var QueueService
//     */
//    private $queueService;

    /**
     * @param $request
     * @param $response
     * @param string|null $statusCode
     * @param string|null $message
     * @param $data
     * @return PsrResponseInterface
     */
    public function create($request, $response, ?string $statusCode,$data = []): PsrResponseInterface
    {
        $result = new ResponseJson($data);
        if (!$response instanceof ResponseInterface) {
            $response = new Response($response);
        }

//        //调用队列 记录日志
//        $params['url'] = $request->getRequestUri();
//        $params['requestData'] = $request->all();
//        $params['responseData'] = ['code' => StatusCode::getHttpCode($statusCode), 'message' => $message, 'data' => $data];

//        $this->queueService->push($params, 1, 0);

        return $response->withStatus(StatusCode::getHttpCode($statusCode))->json($result);
    }

    /**
     * 成功返回模板
     * @param $request
     * @param $response
     * @param $data
     * @param string|null $message
     * @return PsrResponseInterface
     */
    public  function success($request, $response, $data = [], ?string $message = null): PsrResponseInterface
    {
        $statusCode = StatusCode::Success;
        $message = $message ?? StatusCode::getMessage(StatusCode::Success);
        $data = [
            'code' => StatusCode::getHttpCode(StatusCode::Success),
            'message' => $message,
            'data' => $data
        ];
        return $this->create($request, $response, $statusCode,$data);
    }

    /**
     * @param $request
     * @param $response
     * @param string $statusCode
     * @param string|null $message
     * @param int $code
     * @return PsrResponseInterface
     */
    public  function error($request, $response, string $statusCode, ?string $message = null, int $code): PsrResponseInterface
    {
        $data = [
            'code' => $code ?? StatusCode::getHttpCode($statusCode),
            'message' => $message ?? StatusCode::getMessage($statusCode),
            'data' => []
        ];
        return $this->create($request, $response, $statusCode,$data);
    }
}
