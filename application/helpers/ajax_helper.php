<?php
defined('BASEPATH') or exit('No direct script access allowed');

    /**
     * judge_http_request
     * リクエストの正当性をチェック
     *
     * @param   [str] $_SERVER['HTTP_X_CSRF_TOKEN'] && $_SESSION['token']
     * @return  void
     */
    if (! function_exists('judge_http_request')) {
        function judge_http_request()
        {
            if (empty($_SERVER['HTTP_X_CSRF_TOKEN']) || $_SERVER['HTTP_X_CSRF_TOKEN'] !== $_SESSION['token']) {
                header('HTTP/1.1 403 Forbidden');
                exit('不正な接続です');
            }
        }
    }

    /**
     * callback_json_msg
     *
     * ajaxコールバックにjsonを返す
     *
     * @param   bool
     * @param   string
     * @param   int
     * @return  array
     */

    if (! function_exists('callback_json_msg')) {
        function callback_json_msg(string $item, bool $type = true, int $index = null, string $item_1 = null)
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
                ],
                'student' => [
                    true => [
                        1 => [
                            'success' => [
                                'title' => '生徒の登録が完了しました',
                                'msg' => ''
                            ]
                        ],
                        2=> [
                            'success' => [
                                'title' => '生徒情報の更新が完了しました',
                                'msg' => ''
                            ]
                        ]
                    ],
                    false => [
                        'error' => [
                            'title' => '生徒の登録に失敗しました...',
                            'msg' => '既に登録されている可能性があります'
                        ]
                    ]
                ],
                'attend'=> [
                    true => [
                        1 => [
                            'sound' => [
                                'title' => 'ようこそ'.$item_1.'さん',
                                'msg' => '今日も一日がんばるぞい！'
                            ]
                        ],
                        2 => [
                            'sound' => [
                                'title' => 'お疲れ様でした',
                                'msg' => 'また明日も頑張りましょう'
                            ]
                        ]
                    ],
                    false => [
                        'error-1' => [
                            'title' => 'エラー',
                            'msg' => 'バーコードが登録されていない可能性があります'
                        ]
                    ]
                ]
            ];
            return $index? $msg[$item][$type][$index] : $msg[$item][$type];
        }
    }