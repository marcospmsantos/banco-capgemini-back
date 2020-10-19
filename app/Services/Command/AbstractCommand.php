<?php

namespace App\Services\Command;


abstract class AbstractCommand
{
    /**
     * @var array
     */
    protected $data;

    /**
     * Command constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Handle the command.
     *
     * @return mixed
     */
    abstract public function handle();

}