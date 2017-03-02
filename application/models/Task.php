<?php

namespace models;

class Task extends \Model
{
    public $table = 'task';
    public $primary = 'id';
    public $values = [];
    public $fields = [
        'author'    => [
            'validators' => [
                'stringType',
                'notEmpty',
            ],
            'filters'    => [
                'trim',
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
        'text'      => [
            'validators' => [
                'stringType',
                'notEmpty',
            ],
            'filters'    => [
                'trim',
            ],
        ],
        'image'    => [
            'validators' => [
                'stringType',
                'notEmpty',
            ],
        ],
    ];

}
