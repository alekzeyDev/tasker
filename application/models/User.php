<?php

namespace models;

class User extends \Model
{
    public $table = 'user';
    public $primary = 'id';
    public $values = [];
    public $fields = [
        'login'    => [
            'validators' => [
                'stringType',
                'notEmpty',
            ],
            'filters'    => [
                'trim',
            ],
        ],
        'password' => [
            'validators' => [
                'stringType',
                'notEmpty',
            ],
            'filters'    => [
                'trim',
            ],
            'triggers'   => [
                'md5',
            ],
        ],
        'email'    => [
            'validators' => [
                'email',
                'notEmpty',
            ],
            'filters'    => [
                'trim',
            ],
        ],
        'fio'      => [
            'validators' => [
                'stringType',
                'notEmpty',
            ],
            'filters'    => [
                'trim',
            ],
        ],
    ];

}
