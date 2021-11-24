<?php
declare(strict_types=1);

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use App\Logic\User\UserHandler;
use App\Constants\ErrorCode;

class UserController extends AbstractController
{
    /**
     * @Inject
     * @var UserHandler
     */
    public $UserHandler;


    /**
     * 创建商品
     */
    public function create()
    {
        // 验证商品创建
        $params = $this->request->all();

        return apiReturn(ErrorCode::SUCCESS, '', $this->UserHandler->create($params));
    }


}
