<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('js/script.js') }} "></script>
</head>
<body>
    <header>
        <div id ="head">
            <h1><a href="/top"><img src="{{ asset('images/atlas.png') }}"></a></h1>
            <div id="user-profile">
                <div id="user-name">
                    <p>{{ Auth::user()->username }} さん</p>
                    <span class="slide-button-down"></span>
                    <img class="user-image" src="{{ \Storage::url(Auth::user()->images) }}" style="border-radius: 50%;">
                </div>
                <ul>
                    <li onclick="location.href='/top'"><a>HOME</a></li>
                    <li onclick="location.href='/profile'"><a>プロフィール編集</a></li>
                    <li onclick="location.href='/logout'"><a>ログアウト</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield("content")
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p>{{ Auth::user()->username }}さんの</p>
                <div class="follow-count">
                    <p class="follow-title">フォロー数</p>
                    <p>{{ Auth::user()->follows()->count() }}名</p>
                </div>
                <p class="btn follow" onclick="location.href='/follow-list'"><a>フォローリスト</a></p>
                <div class="follow-count">
                    <p class="follow-title">フォロワー数</p>
                    <p>{{ Auth::user()->followers()->count() }}名</p>
                </div>
                <p class="btn follow" onclick="location.href='/follower-list'"><a>フォロワーリスト</a></p>
            </div>
            <p class="btn user" onclick="location.href='/search'"><a>ユーザー検索</a></p> <!-- getで送っている -->
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>
