<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('json_msg'))
{
    /**
     * Element
     *
     * Lets you determine whether an array index is set and whether it has a value.
     * If the element is empty it returns NULL (or whatever you specify as the default value.)
     *
     * @param	bool
     * @param	string
     * @return	array
     */
    function json_msg(string $item, bool $type, int $index = NULL)
    {
        $msg = [
            'login' => [
                true => [
                    'success' => [
                        'title' => 'ログインに成功しました',
                        'msg' => ''
                    ]
                ],
                false => [
                    'error' => [
                        'title' => 'ログインに失敗しました...',
                        'msg' => 'メールかパスワードが間違っています'
                    ]
                ]
            ],
            'register' => [
                true => [
                    'success' => [
                        'title' => '登録が完了しました！',
                        'msg' => ''
                    ]
                ],
                false => [
                    'error' => [
                        'title' => '登録に失敗しました...',
                        'msg' => "登録時間の有効期限が切れました。\nまたメールアドレスを送信してください"
                    ]
                ]
            ],
            
            'send_token' => [
                true => [
                    'success' => [
                        'title' => 'パスワードリセットメールを送信しました！',
                        'msg' => 'メールを送信しましたのでご確認ください'
                    ]
                ],
                false => [
                    'error' => [
                        'title' => 'メールの送信に失敗しました...',
                        'msg' => "既にメールを送信している可能性があります。\nメールが届いていない場合はしばらく待ってから\n再申請してください"
                    ]
                ]
            ],        
            'prov' => [
                true => [
                    'success' => [
                        'title' => '仮登録が完了しました！',
                        'msg' => 'メールを送信しましたのでご確認ください'
                    ]
                ],
                false => [
                    'error' => [
                        'title' => '仮登録に失敗しました...',
                        'msg' => 'メールアドレスが既に登録されている可能性があります'
                    ]
                ]
            ],
            'password_reset' => [
                false => [
                    [
                        'error' => [
                            'title' => '仮登録に失敗しました...',
                            'msg' => "再発行の有効期限が切れました。\nまたメールアドレスを送信してください"
                        ]
                    ],
                    [
                        'error' => [
                            'title' => '仮登録に失敗しました...',
                            'msg' => "再発行の有効期限が切れました。\nまたメールアドレスを送信してください"
                        ]
                    ]
                ]
            ]

        ];
        return $index? $msg[$item][$type][$index] : $msg[$item][$type];
    }
}
