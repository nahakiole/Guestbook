<?php


namespace Exception;


class PageNotFoundException extends ControllerException
{
    protected $action = 'notFound';
}