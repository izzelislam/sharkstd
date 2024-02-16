<?php

namespace App\Services\Tool;

use LaravelEasyRepository\BaseService;

interface ToolService extends BaseService{
    public function updateData($id, $data);
}
