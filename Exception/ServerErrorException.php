<?php


namespace Exception;

class ServerErrorException extends ControllerException
{
    protected $action = 'serverError';
}
