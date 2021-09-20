<?php

namespace Sql;

class SqlResult
{

    public $returned_data = [];
    public $success = null;

    public function __construct()
    {
    }

    public function setReturnedData($data)
    {
        $this->data = $data;
    }

    public function setSuccess($success = true)
    {
        $this->success = $success;
    }
}
