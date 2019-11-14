<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = [
    'prov-register' => [
        [
            'field' => 'prov-email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email|trim',
            'errors' => [
                'required' => '%s を入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ],
    ],
    'login' => [
        [
            'field' => 'login-email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email|trim',
            'errors' => [
                'required' => '%s を入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ],
        [
            'field' => 'login-password',
            'label' => 'パスワード',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください',
            ]
        ],
    ],
    'forgot-password' => [
        [
            'field' => 'forgot-email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email|trim',
            'errors' => [
                'required' => '%sを入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ]
    ],
    'reset-password' => [
        [
            'field' => 'reset-password',
            'label' => 'パスワード',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'confirm-password',
            'label' => 'パスワード再確認',
            'rules' => 'required|matches[reset-password]|trim'
        ]
    ],
    'register' => [
        [
            'field' => 'shop_name',
            'label' => 'ユーザ名',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'shop_kana',
            'label' => 'フリガナ',
            'rules' => 'required|regex_match[/^[ァ-ヾ ]+$/u]|trim',
            'errors' => [
                'required' => '%sを入力してください',
                "regex_match" => "全角カタカナで入力してください。"
            ]
        ],
        [
            'field' => 'shop_email',
            'label' => 'メールアドレス',
            'rules' => 'required|valid_email|trim',
            'errors' => [
                'required' => '%sを入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ],
        [
            'field' => 'shop_tel',
            'label' => '電話番号',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'shop_zip_code',
            'label' => '郵便番号',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'shop_address',
            'label' => '住所',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'shop_password',
            'label' => 'パスワード',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'shop_confirm_pass',
            'label' => 'パスワード再確認',
            'rules' => 'required|matches[shop_password]|trim'
        ]
    ]
];