<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
                'regex_match' => '全角カタカナで入力してください。'
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
    ],
    'students' => [
        [
            'field' => 'name[0]',
            'label' => '姓名',
            'rules' => 'required|trim',
            'errors' => [
                'required' => '%sを入力してください',
            ]
        ],
        [
            'field' => 'name[1]',
            'rules' => 'required|trim',
            'label' => '名前',
            'errors' => [
                'required' => '%sを入力してください',
            ]
        ],
        [
            'field' => 'kana[0]',
            'rules' => 'required|regex_match[/^[ァ-ヾ ]+$/u]|trim',
            'label' => '全角カナ姓名',
            'errors' => [
                'required' => '%sを入力してください',
                'regex_match' => '全角カタカナで入力してください。'
            ]
        ],
        [
            'field' => 'kana[1]',
            'rules' => 'required|regex_match[/^[ァ-ヾ ]+$/u]|trim',
            'label' => '全角カナ名前',
            'errors' => [
                'required' => '%sを入力してください',
                'regex_match' => '全角カタカナで入力してください。'
            ]
        ],
        [
            'field' => 'email',
            'rules' => 'required|valid_email|trim',
            'label' => 'メールアドレス',
            'errors' => [
                'required' => '%sを入力してください',
                'valid_email' => '正しいアドレスを入力してください'
            ]
        ],
        [
            'field' => 'tel',
            'rules' => 'required|numeric|trim',
            'label' => '電話番号',
            'errors' => [
                'required' => '%sを入力してください',
                'numeric' => 'ハイフンなしの数字のみで入力してください',
            ]
        ],
        [
            'field' => 'zip_code',
            'rules' => 'required|trim',
            'label' => '郵便番号',
            'errors' => [
                'required' => '%sを入力してください',
            ]
        ],
        [
            'field' => 'address',
            'rules' => 'required|trim',
            'label' => '住所',
            'errors' => [
                'required' => '%sを入力してください',
            ]
        ]
    ]
];